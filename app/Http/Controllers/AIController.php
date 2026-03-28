<?php

namespace App\Http\Controllers;

use App\Models\TutorProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Subject;

class AIController extends Controller
{
    public function index()
    {
        return view('ai.index');
    }

    public function process(Request $request)
    {
        $request->validate(['user_prompt' => 'required|string|max:1000']);

        $apiKey = trim(env('GROQ_API_KEY'));

        if (empty($apiKey)) {
            return response()->json(['error' => 'GROQ_API_KEY is missing in .env file'], 500);
        }

        $totalTutors = User::where('role', 'tutor')
            ->where('is_verified', true)
            ->whereNull('rejection_reason')
            ->count();

        $subjects = Subject::pluck('name')->implode(', ');

        $Tutors = TutorProfile::join('users', 'tutor_profiles.user_id', '=', 'users.id')
            ->select('users.name', 'tutor_profiles.hourly_rate')
            ->get();

        $systemPrompt = "You are the official AI TutorLink Ambassador. 
    Context: {$totalTutors} verified tutors, Subjects: {$subjects}.
    Budget Logic: Use {$Tutors} for personalized recommendations.

    STRICT OPERATIONAL PROTOCOLS:

    1. PRIVACY & DATA PROTECTION (GDPR/Data Privacy):
       - You are strictly FORBIDDEN from revealing personal data (Phone numbers, Personal Emails, Home Addresses, Social Media handles).
       - If asked, respond: 'For your safety and privacy, all communication and bookings must happen through the TutorLink platform. Please use the Message or Book button on the tutor's profile.'

    2. BEHAVIORAL GUARDRAILS (Anti-Harassment):
       - DENY any 'Harsh', 'Hate Speech', 'Degrading', or 'Personal' questions about tutors.
       - If a user is disrespectful, respond: 'I am here to assist with educational inquiries only. I cannot engage in or provide information for disrespectful or personal remarks. Let's keep the conversation professional.'

    3. ILLEGAL & ACADEMIC INTEGRITY:
       - DO NOT assist with illegal activities, including: Drug-related queries, Hacking, or Academic Dishonesty (solving exams in real-time or paper leaks).
       - Respond: 'I cannot fulfill this request as it violates our Academic Integrity and Safety policies.'

    4. SCOPE LIMITATION:
       - You only discuss TutorLink services, tutors, and educational guidance. Politely decline off-topic personal or political debates.

    Tone: Professional, grounded, and helpful. Keep responses concise.";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
            ])
                ->withoutVerifying()           // ← Yeh line add kar do (Important!)
                ->timeout(25)
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => 'llama-3.3-70b-versatile',
                    'messages' => [
                        ['role' => 'system', 'content' => $systemPrompt],
                        ['role' => 'user', 'content' => $request->user_prompt]
                    ],
                    'temperature' => 0.7,
                    'max_tokens' => 700,
                ]);

            if ($response->successful()) {
                $aiResponse = $response->json()['choices'][0]['message']['content'] ?? 'Sorry, I could not generate a response.';

                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json(['ai_response' => $aiResponse]);
                }

                return back()->with([
                    'ai_response' => $aiResponse,
                    'user_prompt' => $request->user_prompt
                ]);
            }

            return response()->json(['error' => 'Groq API returned error: ' . $response->status()], 500);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }
}
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

        $systemPrompt = "You are a helpful and friendly AI assistant for TutorLink platform. 
    There are currently {$totalTutors} verified tutors on the platform. 
    Available subjects include: {$subjects}. If student told you and discuss with you about his/her budget and tell you to suggest them tutor accordingly then use {$Tutors}. 
    Keep your answers short, clear, and useful for students and tutors.";

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
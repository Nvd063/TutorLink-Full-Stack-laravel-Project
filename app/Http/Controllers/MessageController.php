<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{


    // Get all conversations for logged in user
    public function conversations()
    {
        // Un logo ki list jinse user ne baat ki hai
        $userId = auth()->id();
        $conversations = Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with(['sender', 'receiver'])
            ->latest()
            ->get()
            ->unique(function ($item) use ($userId) {
                return $item->sender_id == $userId ? $item->receiver_id : $item->sender_id;
            });

        return view('messages.index', compact('conversations'));
    }


    // Create new conversation
    public function startConversation(Request $request)
    {
        $request->validate([
            'tutor_id' => 'required|exists:users,id'
        ]);

        $user_id = auth()->id();

        $conversation = Conversation::firstOrCreate([
            'student_id' => $user_id,
            'tutor_id' => $request->tutor_id
        ]);

        return response()->json($conversation);
    }

    // Send message
    public function sendMessage(Request $request)
{
    // 1. Validation
    $request->validate([
        'message' => 'required', 
        'receiver_id' => 'required'
    ]);

    $auth_id = auth()->id();
    $receiver_id = $request->receiver_id;

    // 2. Conversation dhoondo ya banao
    $conversation =     Conversation::where(function($q) use ($auth_id, $receiver_id) {
            $q->where('student_id', $auth_id)->where('tutor_id', $receiver_id);
        })->orWhere(function($q) use ($auth_id, $receiver_id) {
            $q->where('student_id', $receiver_id)->where('tutor_id', $auth_id);
        })->first();

    if (!$conversation) {
        $conversation = Conversation::create([
            'student_id' => auth()->user()->role == 'student' ? $auth_id : $receiver_id,
            'tutor_id' => auth()->user()->role == 'tutor' ? $auth_id : $receiver_id,
        ]);
    }

    // 3. Message save karein (Sahi columns ke sath)
    Message::create([
        'conversation_id' => $conversation->id,
        'sender_id'       => $auth_id,
        'receiver_id'     => $receiver_id, // Screenshot ke mutabiq ye zaroori hai
        'message'         => $request->message,
        'is_read'         => false         // Screenshot ke mutabiq ye bhi zaroori hai
    ]);

    return back();
}

    // Get all messages for a conversation
    public function messages($id)
    {
        $userId = auth()->id();

        // Mark messages as read when opening chat
        Message::where('sender_id', $id)
            ->where('receiver_id', $userId)
            ->update(['is_read' => true]);

        $messages = Message::where(function ($q) use ($id, $userId) {
            $q->where('sender_id', $userId)->where('receiver_id', $id);
        })->orWhere(function ($q) use ($id, $userId) {
            $q->where('sender_id', $id)->where('receiver_id', $userId);
        })->orderBy('created_at', 'asc')->get();

        $chatPartner = User::with('tutorProfile')->findOrFail($id);

        return view('messages.chat', compact('messages', 'chatPartner'));
    }

}
<?php

namespace App\Ai\Agents;

use Laravel\Ai\Promptable;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Concerns\RemembersConversations;

class StudentAssistant implements Agent, Conversational
{
    use Promptable, RemembersConversations;

    public function instructions(): string
    {
        return "You are a helpful academic assistant for 'Professional Tutoring' platform. Your job is to guide students on how to find tutors, answer their study-related questions, and explain platform features. Be polite and concise.";
    }
}
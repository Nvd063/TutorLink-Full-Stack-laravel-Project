<?php

namespace App\Ai\Agents;

use Laravel\Ai\Promptable;
use Laravel\Ai\Contracts\Agent;

class BioGenerator implements Agent
{
    use Promptable;

    public function instructions(): string
    {
        return "You are a professional profile writer. Analyze the provided CV/Resume text and write a professional, short, and engaging bio (max 350 words) for a tutoring platform. Focus on experience and skills.";
    }
}
<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            // Tutor fields (Optional validation)
            'title' => ['nullable', 'string', 'max:255'],
            'expertise' => ['nullable', 'string'],
            'bio' => ['nullable', 'string'],
            'experience' => ['nullable', 'integer'],
            'hourly_rate' => ['nullable', 'integer'],
            'profile_image' => ['nullable', 'image', 'max:2048'],
            'location' => ['required_if:role,tutor', 'nullable', 'string', 'max:255'],

            'degree_certificate' => [
                'required_if:role,tutor',
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:2048'
            ],

            'cv_resume' => [
                'required_if:role,tutor',
                'nullable',
                'file',
                'mimes:pdf,doc,docx',
                'max:2048'
            ],

        ];
    }
}

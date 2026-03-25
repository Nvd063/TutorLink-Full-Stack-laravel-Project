<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TutorProfile extends Model
{
    protected $fillable = [
        'user_id',
        'bio',
        'profile_image',
        'experience',
        'hourly_rate',
        'title',
        'expertise',
        'location',
        'degree_certificate',
        'cv_resume'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Ye property batati hai ke kaun kaun si fields save ho sakti hain
    protected $fillable = [
        'student_id', 
        'tutor_id', 
        'subject', 
        'booking_time', 
        'status', 
        'message',
        'rejection_reason',
    ];

    // Relationships (Taake hum dekh saken kisne book kiya aur kisko)
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }
}
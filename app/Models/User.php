<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\AvailabilitySlot;
use App\Models\TutorProfile;
use App\Models\Booking;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Yeh line add ki hai
        'is_verified',       // Ye lazmi hona chahiye
        'rejection_reason',  // Ye bhi lazmi hona chahiye
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- Relationships ---

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'tutor_subjects', 'tutor_id', 'subject_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function conversationsAsStudent()
    {
        return $this->hasMany(Conversation::class, 'student_id');
    }

    public function conversationsAsTutor()
    {
        return $this->hasMany(Conversation::class, 'tutor_id');
    }

    public function products()
    {
        return $this->hasMany(StoreProduct::class, 'tutor_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviewsGiven()
    {
        return $this->hasMany(Review::class, 'student_id');
    }

    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'tutor_id');
    }
    public function unreadMessagesCount()
    {
        return Message::where('receiver_id', $this->id)
            ->where('is_read', false)
            ->count();
    }

    // App\Models\User.php

    public function availabilitySlots()
    {
        return $this->hasMany(AvailabilitySlot::class);
    }

    // Sath hi tutorProfile wala bhi check karle agar nahi hai to:
    public function tutorProfile()
    {
        return $this->hasOne(TutorProfile::class);
    }
    public function tutorStudents()
    {
        return $this->hasMany(Booking::class, 'tutor_id');
    }
    // User.php
    public function studentBookings()
    {
        return $this->hasMany(Booking::class, 'student_id');
    }

    public function tutorBookings()
    {
        return $this->hasMany(Booking::class, 'tutor_id');
    }
}
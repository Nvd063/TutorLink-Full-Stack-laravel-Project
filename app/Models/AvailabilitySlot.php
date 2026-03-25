<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvailabilitySlot extends Model
{
    // Ye fields add karein
    protected $fillable = [
        'user_id',
        'day_of_week',
        'start_time',
        'end_time',
    ];

    // Tutor ke sath relationship (optional but good)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
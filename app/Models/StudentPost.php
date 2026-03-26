<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentPost extends Model
{
    protected $fillable = ['user_id', 'title', 'description'];

    /**
     * Relationship: A post belongs to a student (user)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
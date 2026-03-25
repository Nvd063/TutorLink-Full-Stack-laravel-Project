<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name'];

public function tutors()
{
    return $this->belongsToMany(User::class,'tutor_subjects','subject_id','tutor_id');
}
}

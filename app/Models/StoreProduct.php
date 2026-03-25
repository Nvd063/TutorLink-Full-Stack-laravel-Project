<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreProduct extends Model
{
    protected $fillable = [
'tutor_id',
'title',
'description',
'price',
'file_path'
];

public function tutor()
{
    return $this->belongsTo(User::class,'tutor_id');
}

public function orders()
{
    return $this->hasMany(Order::class,'product_id');
}

public function downloads()
{
    return $this->hasMany(Download::class,'product_id');
}
}

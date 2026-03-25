<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
protected $fillable = [
    'student_id',
    'product_id',
    'tutor_id',
    'total_amount',
    'tutor_share',
    'admin_commission',
    'status',
    'transaction_reference',
    'is_verified'
];

public function user()
{
    return $this->belongsTo(User::class);
}

public function product()
{
    return $this->belongsTo(StoreProduct::class,'product_id');
}
}

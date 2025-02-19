<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'user_id', 
        'price',
        'status',
    ];
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

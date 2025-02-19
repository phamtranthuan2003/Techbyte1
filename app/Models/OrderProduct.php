<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'order_id',
        'product_id',
        'name_product',
        'quantity',
        'price',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

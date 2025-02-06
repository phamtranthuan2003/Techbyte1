<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    protected $table = 'cart_products';


    protected $fillable = [
        'cart_id', 
        'product_id',
        'price',
        'quantity',
    ];
    public function products(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}

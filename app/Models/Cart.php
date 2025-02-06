<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';


    protected $fillable = [
        'user_id',
        'price',
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}

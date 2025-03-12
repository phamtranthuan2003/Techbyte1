<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $table = 'color_capacity_product';


    protected $fillable = [
        'product_id',
        'color_id',
        'capacity_id'
    ];
    public function products(){
    //
    }
}

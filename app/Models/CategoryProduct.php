<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    protected $table = 'category_product';


    protected $fillable = [
        'name',
        'price',
        '',
    ];
    public function products(){
    //  
    }
}

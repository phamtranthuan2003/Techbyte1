<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';


    
    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'provider_id',
        'category',
    ];
    public function provider()
    {
        return $this->belongsTo(Provider::class,'provider_id','id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
   
    


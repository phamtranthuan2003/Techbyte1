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
        'role',
        'sell',
    ];
    public function provider()
    {
        return $this->belongsTo(Provider::class,'provider_id','id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }
    public function reviews() {
        return $this->hasMany(Review::class);
    }
    public function images()
{
    return $this->hasMany(Images::class);
}
    public function firstImage()
    {
        return $this->hasOne(Images::class);
        
    }
    public function storages() {
        return $this->belongsToMany(ProductStorage::class);
    }
    public function colors() {
        return $this->belongsToMany(ProductColor::class);
    }
}
    


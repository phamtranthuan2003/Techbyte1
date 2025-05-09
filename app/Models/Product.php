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
    public function colors()
{
    return $this->belongsToMany(ProductColor::class, 'color_capacity_product', 'product_id', 'color_id')->distinct();
}

public function capacities()
{
    return $this->belongsToMany(ProductCapacity::class, 'color_capacity_product', 'product_id', 'capacity_id')->distinct();
}
protected static function booted()
{
    static::creating(function ($product) {
        $lastId = Product::max('id') + 1;
        $product->product_code = 'PROD-' . str_pad($lastId, 6, '0', STR_PAD_LEFT);
    });
}

}
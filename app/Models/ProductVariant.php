<?php

use App\Models\Product;
use Faker\Core\Color;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = ['product_id', 'color_id', 'storage_id', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

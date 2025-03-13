<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $fillable = ['product_id', 'image_path', 'sort_order'];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExportProduct extends Model
{
    protected $table = 'output_products';

    protected $fillable = ['product_id', 'quantity', 'exported_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}


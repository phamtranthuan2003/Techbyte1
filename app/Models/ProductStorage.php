<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStorage extends Model {
    use HasFactory;
    protected $fillable = ['product_id', 'storage','price'];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}

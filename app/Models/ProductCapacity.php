<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCapacity extends Model {
    use HasFactory;
    protected $table = 'product_capacities';
    protected $fillable = ['name','price'];

    public function products()
{
    return $this->belongsToMany(Product::class, 'color_capacity_product', 'color_id', 'product_id');
}

}

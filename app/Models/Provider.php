<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'providers';


    protected $fillable = [
        'name',
        'address',
        'tele',
    ];
    public function products(){
        return $this->hasMany(Product::class, 'provider_id', 'id');
    }
    public function ImputProduct(){
        return $this->hasMany(Product::class, 'provider_id', 'id');
    }
}

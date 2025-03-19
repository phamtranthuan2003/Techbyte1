<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = ['name', 'code', 'discount', 'expires_at'];


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_promotions', 'promotion_id', 'user_id');
    }
}

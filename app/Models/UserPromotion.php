<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPromotion extends Model
{
    protected $fillable = ['user_id', 'promotion_id'];

    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'promotion_id');
    }
}

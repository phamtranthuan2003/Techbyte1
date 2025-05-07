<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImputProduct extends Model
{
    protected $table = 'imputProducts';

    protected $fillable = ['name', 'quantity', 'description','provider_id','position'];

    public function provider()
    {
        return $this->belongsTo(Provider::class,'provider_id','id');
    }
}

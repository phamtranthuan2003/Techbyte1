<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Notifications\Notifiable;
// Thêm thư viện để mã hóa password
class Admin extends Model
{
    protected $table = 'users';


    protected $fillable = [
        //

    ];
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}

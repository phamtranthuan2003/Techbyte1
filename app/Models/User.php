<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Notifications\Notifiable;
// Thêm thư viện để mã hóa password
class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    protected $table = 'users';


    protected $fillable = [
        'name',
        'birthday',
        'sex',
        'address',
        'email',
        'password',
        'role',
        

    ];
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}

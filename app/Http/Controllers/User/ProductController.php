<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\error;

class ProductController extends Controller

{
    public function list()
    {
        
        return view('users.products.list');
    }
    public function pay()
    {
        
        return view('users.products.pay');
    }

}
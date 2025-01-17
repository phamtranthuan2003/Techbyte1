<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class AdminController extends Controller

{
    public function home()
    {
        return view('admins.users.home');
    }
    public function user()
    {
        return view('admins.users.user');
    }
    public function adduser()
    {
        return view('admins.adduser');
    }
    public function listproduct()
    {
        return view('admins.products.listproduct');
    }
}
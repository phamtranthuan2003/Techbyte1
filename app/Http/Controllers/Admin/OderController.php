<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class OderController extends Controller
{
    public function list()
    {
        return view('admins.orders.list');
    }
    
}
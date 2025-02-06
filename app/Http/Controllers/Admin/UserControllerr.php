<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class UserControllerr extends Controller
{
    public function list()
    {   
        $users = User::get();
        return view('admins.users.list', compact('users'));
    }
    public function deleteuser($id)
    {
        
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admins.users.list')->with('success', 'Cập nhật sản phẩm thành công');
    }
    
}
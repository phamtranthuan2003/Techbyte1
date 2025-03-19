<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Promotion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class PromotionController extends Controller
{
    public function list()
    {
        $promotions = Promotion::get();
        $users = User::get();
        return view('admins.promotions.list', compact('promotions'));
    }
    public function deleteuser($id)
    {

        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admins.users.list')->with('success', 'Cập nhật sản phẩm thành công');
    }
    public function create()
    {
        return view('admins.promotions.create');
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $promotions = Promotion::create($data);
        return redirect()->route('admins.promotions.list');
    }
    public function edit($id)
    {

        // Tìm sản phẩm cần chỉnh sửa
        $promotion = Promotion::findOrFail($id);

        return view('admins.promotions.edit', compact('promotion'));
    }

    public function update(Request $request, $id)
    {

        // Tìm sản phẩm cần cập nhật
        $promotion = Promotion::findOrFail($id);

        $validatedData = $request->all();

        // Cập nhật dữ liệu sản phẩm
        $promotion->update($validatedData);

        // Phản hồi thông báo thành công
        return redirect()->route('admins.promotions.list')->with('success', 'Cập nhật sản phẩm thành công');
    }
    public function delete($id)
    {
        $promotion = Promotion::findOrFail($id);
        $promotion->delete();
        return redirect()->route('admins.promotions.list')->with('success', 'Xóa sản phẩm thành công');

    }

}

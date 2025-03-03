<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryControllerr extends Controller
{
    public function create()
    {
        return view('admins.categories.create');
    }
    public function store(Request $request)
    {
        $data = $request->all();
        Category::create($data);
        return redirect()->route('admins.categories.list');
    }

    public function listcategory()
    {   
        $categories = Category::get();
        return view('admins.categories.list', compact('categories'));
    }
    public function edit($id)
    {
   
        // Tìm sản phẩm cần chỉnh sửa
        $category = Category::findOrFail($id);

        return view('admins.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        
        // Tìm sản phẩm cần cập nhật
        $category = Category::findOrFail($id);

        $validatedData = $request->all();

        // Cập nhật dữ liệu sản phẩm
        $category->update($validatedData);

        // Phản hồi thông báo thành công
        return redirect()->route('admins.categories.list')->with('success', 'Cập nhật sản phẩm thành công');
    }
    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admins.categories.list')->with('success', 'Xóa sản phẩm thành công');
        
    }
}
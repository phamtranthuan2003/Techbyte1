<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Order;
use App\Models\ProductCapacity;
use App\Models\Category_Product;
use App\Models\CategoryProduct;
use App\Models\Images;
use App\Models\ProductColor;
use ProductVariant;

class ColorController extends Controller
{
    public function create()
    {
        return view('admins.colors.create');
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $color = ProductColor::create($data);
        return redirect()->route('admins.colors.list');

    }
    public function list()
    {
        $colors = ProductColor::get();
        return view('admins.colors.list', compact('colors'));
    }
    public function edit($id)
    {

        // Tìm sản phẩm cần chỉnh sửa
        $color = ProductColor::findOrFail($id);

        return view('admins.colors.edit', compact('color'));
    }

    public function update(Request $request, $id)
    {

        // Tìm sản phẩm cần cập nhật
        $category = Category::findOrFail($id);

        $validatedData = $request->all();

        // Cập nhật dữ liệu sản phẩm
        $category->update($validatedData);

        // Phản hồi thông báo thành công
        return redirect()->route('admins.colors.list')->with('success', 'Cập nhật sản phẩm thành công');
    }
    public function delete($id)
    {
        $color = ProductColor::findOrFail($id);
        $color->delete();
        return redirect()->route('admins.categories.list')->with('success', 'Xóa sản phẩm thành công');

    }

}

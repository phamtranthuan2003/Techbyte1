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

class CapacityController extends Controller
{
    public function create()
    {
        return view('admins.capacities.create');
    }
    public function store(Request $request)
    {
       $data = $request->all();
       $capacity = ProductCapacity::create($data);
       return redirect()->route('admins.products.list');
    }
    public function list()
    {   
        $capacities = ProductCapacity::get();
        return view('admins.capacities.list', compact('capacities'));
    }
    public function edit($id)
    {
   
        // Tìm sản phẩm cần chỉnh sửa
        $capacity = ProductCapacity::findOrFail($id);

        return view('admins.capacities.edit', compact('capacity'));
    }

    public function update(Request $request, $id)
    {
        
        // Tìm sản phẩm cần cập nhật
        $capacity = ProductCapacity::findOrFail($id);

        $validatedData = $request->all();

        // Cập nhật dữ liệu sản phẩm
        $capacity->update($validatedData);

        // Phản hồi thông báo thành công
        return redirect()->route('admins.capacities.list')->with('success', 'Cập nhật sản phẩm thành công');
    }
    public function delete($id)
    {
        $capacity = ProductCapacity::findOrFail($id);
        $capacity->delete();
        return redirect()->route('admins.capacities.list')->with('success', 'Xóa sản phẩm thành công');
        
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Provider;

class ProductController extends Controller
{
    public function create()
    {
        $provider = Provider::get();
        return view('products.create', compact('provider',));
    }

    public function store(Request $request)
    {
        // Lấy toàn bộ dữ liệu từ request
        $data = $request->all();

        $data['name'] = $data['lastname'] . ' '. $data['firstname'];

        $data['description'] = $data['description1'] . ' '. $data['description2'];
        
        // Tạo mới sản phẩm
        Product::create($data);
        // Phản hồi thông báo thành công
        echo "Thêm sản phẩm thành công";
    }

    public function edit($id)
    {
        // Tìm sản phẩm cần chỉnh sửa
        $product = Product::findOrFail($id);
        $provider = Provider::get();

        // Điều hướng đến view 'product.edit' và truyền dữ liệu của sản phẩm
        return view('products.edit', compact('product','provider'));
    }

    public function update(Request $request, $id)
    {
        
        // Tìm sản phẩm cần cập nhật
        $product = Product::findOrFail($id);

        $validatedData = $request->all();

        // Cập nhật dữ liệu sản phẩm
        $product->update($validatedData);

        // Phản hồi thông báo thành công
        echo "Cập nhật sản phẩm thành công";
    }
    public function delete($id)
    {
        // Tìm sản phẩm theo ID
        $product = Product::findOrFail($id);
        $product->delete();
        echo "Xoa sản phẩm thành công";
        
    }
    public function listproduct(Request $request)
    {
        $product = Product::with('provider')->get();
        return view('products.listproduct', compact('product'));
    
    }
}
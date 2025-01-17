<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Category_Product;
use App\Models\CategoryProduct;

class ProductController extends Controller
{
    public function create()
    {
        $category = Category::get();
        $provider = Provider::get();
        return view('admins.products.create', compact('provider','category'));
    }

    public function store(Request $request)
    {   
        // Lấy toàn bộ dữ liệu từ request
        $data = $request->all();

        $data['description'] = $data['description1'] . ' '. $data['description2'];
        
        // Tạo mới sản phẩm
        $Product = Product::create($data);

        foreach ($data['category_id'] as $category) {
        CategoryProduct::create([
            'category_id' => $category,
            'product_id' => $Product->id
        ]);
    }
        echo "Thêm sản phẩm thành công";
    
    }

    public function edit($id)
    {
        // Tìm sản phẩm cần chỉnh sửa
        $product = Product::findOrFail($id);
        $provider = Provider::get();


        return view('admins.products.edit', compact('product','provider'));
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
        $product = Product::findOrFail($id);
        $product->delete();
        echo "Xoa sản phẩm thành công";
        
    }
    public function listproduct(Request $request)
    {
        $products = Product::with(['provider','categories'])->get();
        return view('admins.products.listproduct', compact('products'));
    }
}
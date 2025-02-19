<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Category_Product;
use App\Models\CategoryProduct;

class ProductControllerr extends Controller
{
    public function create()
    {
        $categories = Category::all();
        $providers = Provider::all();
        return view('admins.products.create', compact('providers', 'categories'));
    }
    
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id',
            'provider_id' => 'required|exists:providers,id'
        ]);
    
        // Create the product
        $product = Product::create($request->except('category_id'));
    
        // Attach categories using Eloquent relationships
        $product->categories()->attach($request->category_id);
    
        return redirect()->route('admins.products.list')->with('success', 'Thêm sản phẩm thành công');
    }
    
    public function edit($id)
    {
        
        $products = Product::find( $id );
        $providers = Provider::get();
        $categories = Category::get();
        

        return view('admins.products.edit', compact('products', 'providers', 'categories'));
        
    }

    public function update(Request $request, $id)
    {
        
        // Tìm sản phẩm cần cập nhật
        $product = Product::findOrFail($id);
        
        $data = $request->all();

        
        // Cập nhật dữ liệu sản phẩm
        $product->update($data);
        $product->categories()->sync($request->category_id);

        return redirect()->route('admins.products.list')->with('success', 'Cập nhật sản phẩm thành công');
    }
    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admins.products.list')->with('success', 'Xoa sản phẩm thành công');
        
    }
    public function listproduct()
    {
        $products = Product::with(['provider','categories'])->get();
        return view('admins.products.listproduct', compact('products'));
    }
    
}
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

class ProductControllerr extends Controller
{
    public function create()
    {
        $colors = ProductColor::all();
        $capacities = ProductCapacity::all();
        $categories = Category::all();
        $providers = Provider::all();
        return view('admins.products.create', compact('providers', 'categories','capacities','colors'));
    }
    
    public function store(Request $request)
{   dd($request->all());
    // dd(
    // // Validate dữ liệu
    // $request->validate([
    //     'name' => 'required|string|max:255',
    //     'price' => 'required|numeric|min:0',
    //     'images' => 'required|array',
    //     'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    //     'category_id' => 'required|array',
    //     'category_id.*' => 'exists:categories,id',
    //     'provider_id' => 'required|exists:providers,id'
    // ]);
    $firstImagePath = null;
  

    // Tạo sản phẩm, lưu ảnh đầu tiên vào cột `image`
    $product = Product::create(array_merge(
        $request->except(['category_id', 'images']),
        ['image' => $firstImagePath]
    ));

    // Lưu toàn bộ ảnh vào bảng `images`
    if ($request->hasFile('images')) {
        $imageData = [];
        foreach ($request->file('images') as $image) {
        
            $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'image/' . $fileName;
            $image->move(public_path('image'), $fileName);

            $imageData[] = [
                'product_id' => $product->id,
                'image_path' => $imagePath,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Chèn nhiều ảnh vào database một lần
        Images::insert($imageData);
    }
    $productvarian = ProductVariant::create();

    return redirect()->route('admins.products.list')->with('success', 'Thêm sản phẩm thành công');
}
    
public function edit($id)
{
    $product = Product::findOrFail($id);
    $providers = Provider::all();
    $categories = Category::all();
    $images = Images::where('product_id', $id)->get(); // Lấy danh sách ảnh của sản phẩm

    return view('admins.products.edit', compact('product', 'providers', 'categories', 'images'));
}

public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'images' => 'nullable|array',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'category_id' => 'required|array',
        'category_id.*' => 'exists:categories,id',
        'provider_id' => 'required|exists:providers,id'
    ]);

    // Cập nhật thông tin sản phẩm
    $product->update($request->except(['category_id', 'images']));

    // Cập nhật danh mục sản phẩm
    $product->categories()->sync($request->category_id);

    // Xử lý upload ảnh mới mà không xóa ảnh cũ
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            do {
                // Tạo tên file ngẫu nhiên bằng UUID
                $fileName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'image/' . $fileName;
            } while (file_exists(public_path($imagePath))); // Kiểm tra xem file đã tồn tại chưa

            // Lưu ảnh vào public/image/
            $image->move(public_path('image'), $fileName);

            // Lưu đường dẫn ảnh vào database
            Images::create([
                'product_id' => $product->id,
                'image_path' => $imagePath,
            ]);
        }
    }

    return redirect()->route('admins.products.list')->with('success', 'Cập nhật sản phẩm thành công');
}



    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back();
        
    }
    public function listproduct()
    {   
        $products = Product::with(['provider', 'categories'])
        ->where('sell', '>', 5)
        ->paginate(10);
        return view('admins.products.listproduct', compact('products'));
    }
    public function inventory()
    {   $products = Product::with(['provider', 'categories'])
        ->where('sell', '<', 5)
        ->paginate(10);
        

        return view('admins.products.inventory', compact('products'));
    }
    public function updatestatus($id)
    {
        $order = Order::findOrFail($id);
    
        if ($order->status >= 4) {
            $order->delete(); // Xóa đơn hàng nếu status > 4
        } else {
            $order->status += 1;
            $order->save();
        }
    
        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
    
}
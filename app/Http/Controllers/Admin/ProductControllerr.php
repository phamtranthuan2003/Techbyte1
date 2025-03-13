<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\File;
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
use App\Models\ProductVariant;


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
{
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
    foreach ($request->color_id as $color) {
        foreach ($request->capacity_id as $capacity) {
            ProductVariant::create([
                'product_id' => $product->id,
                'color_id' => $color,
                'capacity_id' => $capacity,
            ]);
        }
    }
    $product->categories()->attach((array) $request->category_id);

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
        'provider_id' => 'required|exists:providers,id',
        'image_order' => 'nullable|string'
    ]);

    // Cập nhật thông tin sản phẩm
    $product->update($request->except(['category_id', 'images', 'deleted_images', 'image_order']));

    // Cập nhật danh mục sản phẩm
    $product->categories()->sync($request->category_id);

    // Xóa ảnh nếu có deleted_images
    if ($request->has('deleted_images')) {
        $deletedImages = explode(',', $request->deleted_images);
        foreach ($deletedImages as $imageId) {
            $image = Images::find($imageId);
            if ($image) {
                $filePath = public_path($image->image_path);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $image->delete();
            }
        }
    }

    // Lưu ảnh mới
    $newImageIds = [];
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $fileName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'image/' . $fileName;

            $image->move(public_path('image'), $fileName);

            $newImage = Images::create([
                'product_id' => $product->id,
                'image_path' => $imagePath,
                'sort_order' => 0 // Gán tạm sort_order = 0, lát sẽ cập nhật đúng thứ tự
            ]);

            $newImageIds[] = $newImage->id;
        }
    }

    // Cập nhật thứ tự ảnh theo image_order gửi từ frontend
    if ($request->has('image_order')) {
        $imageOrder = explode(',', $request->image_order);

        foreach ($imageOrder as $index => $imageId) {
            Images::where('id', $imageId)->update(['sort_order' => $index]);
        }
    }

    // Đảm bảo ảnh mới thêm vào cũng có thứ tự đúng
    if (!empty($newImageIds)) {
        $existingMaxSortOrder = Images::where('product_id', $product->id)->max('sort_order') ?? 0;
        foreach ($newImageIds as $index => $imageId) {
            Images::where('id', $imageId)->update(['sort_order' => $existingMaxSortOrder + $index + 1]);
        }
    }

    // Cập nhật ảnh đại diện (thumbnail) là ảnh có `sort_order` nhỏ nhất
    $firstImage = Images::where('product_id', $product->id)->orderBy('sort_order')->first();
    if ($firstImage) {
        $product->update(['thumbnail' => $firstImage->image_path]);
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

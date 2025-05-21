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
use App\Models\ImputProduct;
use App\Models\OutputProduct;
use Symfony\Component\Console\Output\Output;
use Carbon\Carbon;
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
    if ($request->filled('deleted_images')) {
        $deletedImages = array_filter(explode(',', $request->deleted_images), 'is_numeric');
        Images::whereIn('id', $deletedImages)->each(function ($image) {
            if (file_exists(public_path($image->image_path))) {
                unlink(public_path($image->image_path));
            }
            $image->delete();
        });
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
                'sort_order' => 0,
            ]);
            $newImageIds[] = $newImage->id;
        }
    }

    // Cập nhật thứ tự ảnh theo image_order gửi từ frontend
    if ($request->filled('image_order')) {
        $imageOrder = array_filter(explode(',', $request->image_order), 'is_numeric');
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
    if ($firstImage = Images::where('product_id', $product->id)->orderBy('sort_order')->first()) {
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
  $oneMonthAgo = Carbon::now()->subMonth();

        $query = Product::with(['provider', 'categories'])
                        ->where('sell', '<', 5);

        $querym = Product::with(['provider', 'categories'])
                        ->where('sell', '>', 5);
        $products = $querym->paginate(10);
        $totalCount = $query->count();
        $totalmCount = $querym->getQuery()->count();
        $oldproducts = Product::select('name', 'sell', 'created_at')
                            ->where('created_at', '<', $oneMonthAgo)
                            ->get()
                            ->map(function ($product) {
        $product->days_since_created = round($product->created_at->diffInDays(now()));
        return $product;
    });
        return view('admins.products.listproduct', compact('products', 'totalCount', 'totalmCount','oldproducts'));
    }
    public function inventory()
    {
        $query = Product::with(['provider', 'categories'])
                ->where('sell', '<', 5);
        $querym = Product::with(['provider', 'categories'])
        ->where('sell', '>', 5);
        $products = $query->paginate(10);
        $totalCount = $query->getQuery()->count();
        $totalmCount = $querym->getQuery()->count();


        return view('admins.products.inventory', compact('products', 'totalCount', 'totalmCount'));
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
    public function input()
    {
        $providers = Provider::all();
        return view('admins.products.imput', compact('providers'));
    }
    public function inputSuccess(Request $request)
    {
        $data = $request->all();
        ImputProduct::create($data);
        return redirect()->route('admins.products.list');
    }
    public function listImputProduct()
    {
        $Imputproducts = ImputProduct::get();
        $query = Product::with(['provider', 'categories'])
                ->where('sell', '<', 5);
        $querym = Product::with(['provider', 'categories'])
        ->where('sell', '>', 5);
        $products = $querym->paginate(10);
        $totalCount = $query->getQuery()->count();
        $totalmCount = $querym->getQuery()->count();
        return view('admins.products.listImputProduct', compact('products', 'Imputproducts', 'totalCount', 'totalmCount'));
    }
    public function editimput($id)
    {
        $product = ImputProduct::findOrFail($id);
        $providers = Provider::all();
        return view('admins.products.editImput', compact('product','providers'));
    }

    public function updateimput(Request $request, $id)
    {
        $product = ImputProduct::findOrFail($id);
        $validatedData = $request->all();
        $product->update($validatedData);
        return redirect()->route('admins.products.listImputProduct')->with('success', 'Cập nhật sản phẩm thành công');
    }
    public function deleteimput($id)
    {
        $products = ImputProduct::findOrFail($id);
        $products->delete();
        return redirect()->route('admins.products.listImputProduct')->with('success','');
        
    }
    public function output (Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        $product = Product::findOrFail($id);
        if ($request->quantity > $product->sell) {
            return back()->with('error', 'Số lượng xuất vượt quá tồn kho!');
        }
        $product->sell -= $request->quantity;
        $product->save();
            OutputProduct::create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'exported_at' => now(),
        ]);
        return back()->with('success', 'Xuất kho thành công!');
        }
        public function listoutput()
        {
            $outputs = OutputProduct::with('product')->latest()->paginate(10);
            $query = Product::with(['provider', 'categories'])
                ->where('sell', '<', 5);
            $querym = Product::with(['provider', 'categories'])
            ->where('sell', '>', 5);
            $products = $querym->paginate(10);
            $totalCount = $query->getQuery()->count();
            $totalmCount = $querym->getQuery()->count();
                return view('admins.products.listoutput', compact('outputs', 'products', 'totalCount', 'totalmCount'));
        }
        public function export()
        {
           
        }
}

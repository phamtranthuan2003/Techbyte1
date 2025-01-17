<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function create()
    {
        return view('admins.categories.create');
    }
    public function store(Request $request): void
    {
        $data = $request->all();
        Category::create($data);
        echo "Thêm sản phẩm thành công";
    }
}
<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;


class CategoryController extends Controller
{
    public function category($id)
    {
        $category = Category::with('products')->findOrFail($id);
        $categories = Category::get();
        
        
        $products = $category->products;

        return view('users.categories.category', compact('categories', 'products', 'category'));
    }
}
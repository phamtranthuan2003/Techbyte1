<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provider;

class ProviderController extends Controller
{
    public function create()
    {
        return view('providers.create');
    }
    public function store(Request $request)
    {
        $data = $request->all();
        Provider::create($data);
        echo "Thêm sản phẩm thành công";
    }
}
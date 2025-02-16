<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;

class ProviderController extends Controller
{
    public function create()
    {
        return view('admins.providers.create');
    }
    public function store(Request $request)
    {
        $data = $request->all();
        Provider::create($data);
        return redirect()->route('admins.providers.list');
    }
    public function edit($id)
    {
        // Tìm sản phẩm cần chỉnh sửa
        $provider = Provider::findOrFail($id);
        

        // Điều hướng đến view 'product.edit' và truyền dữ liệu của sản phẩm
        return view('admins.providers.edit', compact('provider'));
    }

    public function update(Request $request, $id)
    {
        
        // Tìm sản phẩm cần cập nhật
        $provider = Provider::findOrFail($id);

        $validatedData = $request->all();

        // Cập nhật dữ liệu sản phẩm
        $provider->update($validatedData);

        // Phản hồi thông báo thành công
        return redirect()->route('admins.providers.list')->with('success', 'Cập nhật sản phẩm thành công');
    }
    public function list()
    {
        $providers = Provider::get();
        return view('admins.providers.list', compact('providers'));
    }
    public function delete($id)
    {
        $providers = Provider::findOrFail($id);
        $providers->delete();
        echo "Xoa sản phẩm thành công";
        
    }
}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang quản lý sản phẩm - Admin</title>
</head>

<body>
    <h1>Danh sách sản phẩm</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Mô tả</th>
                <th>Nhà cung cấp</th>
                <th>Chức năng</th>
                <th>Danh mục</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->provider ? $product->provider->name : '' }}</td>
                    <td>
                     
                        <a href="{{ route('products.edit', $product->id) }}">
                            <button type="button">Sửa</button>
                        </a>

                       
                        <form action="{{ route('products.delete', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</button>
                        </form>
                    </td>
                    <td>
              
                        @foreach ($product->categories as $category)
                            <span>{{ $category->name }}</span><br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

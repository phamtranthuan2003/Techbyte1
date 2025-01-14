<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang quản lý sản phẩm - Admin</title>

</head>

<body>
    <h1>Danh sách sản phẩm</h1>
    <form>
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
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->provider ? $product->provider->name : '' }}</td>
                        <td>
                <div>
                        <a href="{{ route('product.edit', $product->id) }}">
                        <button type="button">Sửa</button>
                        </a>
                                
            <form action="{{ route('product.delete', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                    @method('DELETE')
                        <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</button>
                        </form>
                </div>
                        </td>
                        <td>
                @foreach ($product->categories as $category)
                        {{ $category->name }}
                @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</body>

</html>

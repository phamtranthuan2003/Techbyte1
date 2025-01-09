<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang quản lý sản phẩm - Admin</title>
</head>

<body>
    <h1>Danh sach san pham</h1>
    <form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Ten</th>
                <th>Gia</th>
                <th>Mo ta</th>
                <th>Nguoi cung cap</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{($product->provider ? $product->provider->name : '')}}</td>
                    <td>
                    <div>
                    <button><a href="{{ route('product.edit', $product->id) }}">Sửa</a></button>
                        <button>Xóa</button>
                    </div>
                </td>
                </tr><br>
            @endforeach
        </tbody>
    </table>
    </form>
</body>

</html>
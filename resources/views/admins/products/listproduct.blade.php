<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang quản lý sản phẩm - Admin</title>
</head>

<body>
<div class="sidebar">
        <div class="logo">
            <h2>Admin Dashboard</h2>
        </div>
        <ul class="menu">
            <li><a href="{{ route('admins.home') }}">Tổng quan</a></li>
            <li><a href="{{ route('admins.user') }}">Quản lý người dùng</a></li>
            <li><a href="{{ route('products.list') }}">Quản lý đơn hàng</a></li>
            <!-- <li><a href="./admin_setting_management.html">Cài đặt</a></li> -->
            <li><a href="{{ route('users.login') }}" onclick="logout()">Đăng xuất</a></li>
        </ul>
    </div>
    
    <div class="main-content">  
        <header>
            <h1>Quản lý sản phẩm</h1>
            <!-- Thêm ô tìm kiếm vào đây -->
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Tìm kiếm sản phẩm..." onkeyup="searchProduct()">
            </div>
        </header>
        <section class="add-Product" >
            <!-- Thay đổi button thành link để điều hướng -->
            <a href="./admin_addproduct_management.html">
                <button>Thêm sản phẩm</button>
            </a>
        </section>

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

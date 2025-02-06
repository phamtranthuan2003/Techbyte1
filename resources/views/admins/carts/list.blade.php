<x-app-layout>
<div class="sidebar">
        <div class="logo">
            <h2>Admin Dashboard</h2>
        </div>
        <ul class="menu">
        <li><a href="{{ route('admins.home') }}">Tổng quan</a></li>
        <li><a href="{{ route('admins.users.list') }}">Quản lý người dùng</a></li>
        <li><a href="{{ route('admins.carts.list') }}">Quản lý đơn hàng</a></li>
        <li><a href="{{ route('admins.products.list') }}">Quản lý sản phẩm</a></li>
        <li><a href="{{ route('admins.categories.list') }}">Danh mục</a></li>
        <li><a href="{{ route('admins.providers.list') }}" onclick="logout()">Nhà Cung Cấp</a></li>
        <li><a href="{{ route('users.login') }}" onclick="logout()">Đăng xuất</a></li>

        </ul>
    </div>
    
    <div class="main-content">      
        <header>
            <h1>Quản lý đơn hàng</h1>
          
            <!-- Thêm ô tìm kiếm vào đây -->
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Tìm kiếm sản phẩm..." onkeyup="searchProduct()">
            </div>
        </header>
        <div class="add">
            <a href="{{ route('admins.products.create') }}">
                        <button type="button">Thêm</button>
            </a>
            </div>
        <section class="add-to-cart" >
        </section>
    
    <table class="table-admin">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Địa Chỉ</th>
                <th>Số Điện Thoại</th>
                <th>Hình thức thanh toán</th>

        </thead>
        <tbody>
           
                    
             
          
        </tbody>
    </table>

</x-app-layout>

<x-app-layout>
<form class="admin">
<!-- Sidebar -->
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

<!-- Main Content -->
<div class="main-content">
    <!-- Header -->
    <header>
        <h1 class="dsnd">Danh sách nhà cung cấp</h1>
        
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Tìm kiếm người dùng..." onkeyup="searchUser()">
        </div>
    </header>
    <div class="add">
            <a href="{{ route('admins.providers.create') }}">
                        <button type="button">Thêm</button>
            </a>
        </div>
    <section>
        <table class="table-admin">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nhà Cung Cấp</th>
                    <th>Địa Chỉ</th>
                    <th>Số Điện Thoại</th>
                    <th>Chức Năng</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($providers as $providers)
                    <tr>
                        <td>{{ $providers->id }}</td>
                        <td>{{ $providers->name }}</td>
                        <td>{{ $providers->address }}</td>
                        <td>{{ $providers->tele }}</td>
                        <td>
                    <a href="{{ route('admins.providers.edit', $providers->id) }}">
                        <button type="button">Sửa</button>
                    </a>

                
                <form action="{{ route('admins.providers.delete', $providers->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</button>
                </form>
                        
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</div>
</form>

</x-app-layout>

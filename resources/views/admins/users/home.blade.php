<x-app-layout>
    <form class="admin">
    <div class="sidebar">
    <div class="logo">
            <h2>Admin Dashboard</h2>
        </div>
        <ul class="menu">
        <li><a href="{{ route('admins.home') }}">Tổng quan</a></li>
        <li><a href="{{ route('admins.users.list') }}">Quản lý người dùng</a></li>
        <li><a href="{{ route('admins.orders.orderNotPlaced') }}">Quản lí đơn hàng</a></li>
        <li><a href="{{ route('admins.products.list') }}">Quản lý sản phẩm</a></li>
        <li><a href="{{ route('admins.categories.list') }}">Danh mục</a></li>
        <li><a href="{{ route('admins.providers.list') }}" onclick="logout()">Nhà Cung Cấp</a></li>
        <li><a href="{{ route('users.login') }}" onclick="logout()">Đăng xuất</a></li>

        </ul>
    </div>
    
    <div class="main-content">
        <header>
            <h1>Tổng quan</h1>
        </header>
        
        <section class="statistics" id="statistics" name="statistics">
            <div class="stat-card">
                <h3 name="1">Người dùng</h3>
                <p></p>
            </div>
            <div class="stat-card">
                <h3 name="2">Số lượng sản phẩm</h3>
                <p></p>
            </div>
            <div class="stat-card">
                <h3 name="3">Số  lượng sản phẩm tồn kho</h3>
                <p></p>
            </div>
        </section>

    </div>
    </form>
</x-app-layout>

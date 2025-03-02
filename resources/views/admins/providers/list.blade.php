<x-app-layout>
    <div class="admin">
        <div class="sidebar">
            <div class="logo">
                <h2>Admin Dashboard</h2>
            </div>
            <ul class="menu">
                <li><a href="{{ route('admins.home') }}">🏠 Tổng quan</a></li>
                <li><a href="{{ route('admins.users.list') }}">👥 Quản lý người dùng</a></li>
                <li><a href="{{ route('admins.orders.orderNotPlaced') }}">📦 Quản lý đơn hàng</a></li>
                <li><a href="{{ route('admins.products.list') }}">🛒 Quản lý sản phẩm</a></li>
                <li><a href="{{ route('admins.categories.list') }}">🗂️ Danh mục</a></li>
                <li><a href="{{ route('admins.providers.list') }}">🚚 Nhà Cung Cấp</a></li>
                <li><a href="{{ route('users.login') }}" onclick="logout()">🚪 Đăng xuất</a></li>
            </ul>
        </div>
<!-- Main Content -->
<div class="main-content">
    <!-- Header -->
    <header>
    <h1 class="dsnd">🚚 Danh sách nhà cung cấp</h1>
        
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Tìm kiếm người dùng..." onkeyup="searchUser()">
        </div>
    </header>
    <div class="add">
            <a href="{{ route('admins.providers.create') }}">
                        <button type="button">➕ Thêm</button>
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
                                    <button class="edit-btn">✏️ Sửa</button>
                        </a>

                
                <form action="{{ route('admins.providers.delete', $providers->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">🗑️ Xóa</button>
                </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</div>
</form>
<script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById("searchInput");
            const tableRows = document.querySelectorAll(".table-admin tbody tr");

            searchInput.addEventListener("keyup", function () {
                const searchText = searchInput.value.toLowerCase();

                tableRows.forEach(row => {
                    const cells = row.querySelectorAll("td");
                    let found = false;

                    cells.forEach(cell => {
                        if (cell.textContent.toLowerCase().includes(searchText)) {
                            found = true;
                        }
                    });

                    row.style.display = found ? "" : "none";
                });
            });
        });
    </script>
        <style>
        .admin { display: flex; }
        .sidebar { width: 220px; background: #343a40; color: white; padding: 20px; }
        .menu li a { color: white; display: block; padding: 10px; }
        .main-content { flex: 1; padding: 20px; }
        header { display: flex; justify-content: space-between; align-items: center; }
        .search-container input { padding: 8px; width: 300px; border-radius: 5px; }
        .table-admin { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table-admin th, .table-admin td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        .product-img { width: 50px; height: 50px; object-fit: cover; border-radius: 5px; }
    </style>
</x-app-layout>

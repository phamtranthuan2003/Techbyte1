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
                <li><a href="{{ route('admins.categories.list') }}">🗂️ Quản lí danh mục</a></li>
                <li><a href="{{ route('admins.providers.list') }}">🚚 Nhà cung cấp</a></li>
                <li><a href="{{ route('admins.capacities.list') }}">🗄️ Quản lý dung lượng</a></li>
                <li><a href="{{ route('admins.colors.list') }}">🎨  Màu Sắc</a></li>
                <li><a href="{{ route('admins.colors.list') }}">🎨  Quản lí hình ảnh</a></li>
                <li><a href="{{ route('admins.colors.list') }}">🎨  Quản lí bài viết</a></li>
                <li><a href="{{ route('users.login') }}" onclick="logout()">🚪 Đăng xuất</a></li>
            </ul>
        </div>

        <div class="main-content">
            <header>
                <h1>👥 Danh sách người dùng</h1>
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="🔍 Tìm kiếm người dùng...">
                </div>
            </header>

            <div class="add">
                <a href="{{ route('users.create') }}">
                    <button type="button">➕ Thêm người dùng</button>
                </a>
            </div>

            <section class="user-list">
                <table class="table-admin">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Họ Tên</th>
                            <th>Ngày Sinh</th>
                            <th>Giới Tính</th>
                            <th>Địa Chỉ</th>
                            <th>Số Điện Thoại</th>
                            <th>Email</th>
                            <th>Vai Trò</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->birthday }}</td>
                                <td>{{ $user->sex }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <a href="{{ route('users.edit', $user->id) }}">
                                        <button type="button" class="edit-btn">✏️ Sửa</button>
                                    </a>
                                    <form action="{{ route('admins.users.deleteuser', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn" onclick="return confirm('Bạn chắc chắn muốn xóa người dùng này?');">🗑️ Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </div>
    </div>

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
        .add-btn, .edit-btn, .delete-btn { padding: 5px 10px; border: none; cursor: pointer; border-radius: 5px; }
        .add-btn { background: #28a745; color: white; }
        .edit-btn { background: #ffc107; color: black; }
        .delete-btn { background: #dc3545; color: white; }
    </style>
</x-app-layout>

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
                <li><a href="{{ route('admins.providers.list') }}">Nhà Cung Cấp</a></li>
                <li><a href="{{ route('users.login') }}" onclick="logout()">Đăng xuất</a></li>
        
            </ul>
        </div>
        <div class="main-content">
            <header>
                <h1 class="dsnd">Danh sách người dùng</h1>
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Tìm kiếm người dùng...">
                </div>
            </header>

            <div class="add">
                <a href="{{ route('users.create') }}">
                    <button type="button">Thêm</button>
                </a>
            </div>

            <section>
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
                            <th>Tùy Chỉnh</th>
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
                                        <button type="button">Sửa</button>
                                    </a>

                                    <!-- Xóa người dùng -->
                                    <form action="{{ route('admins.users.deleteuser', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Bạn chắc chắn muốn xóa người dùng này?');">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </div>

        @csrf
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
</x-app-layout>

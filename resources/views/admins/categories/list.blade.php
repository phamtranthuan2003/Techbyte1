<x-app-layout>
<div class="admin">
<!-- Sidebar -->
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
        <h1 class="dsnd">Danh sách danh mục</h1>
        
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Tìm kiếm người dùng..." onkeyup="searchUser()">
        </div>
    </header>
    <div class="add">
            <a href="{{ route('admins.categories.create') }}">
                        <button type="button">Thêm</button>
            </a>
        </div>
    <section>
        <table class="table-admin">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Danh Mục</th>
                    <th>Mô Tả</th>
                    <th>Chức Năng</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                    <a href="{{ route('admins.categories.edit', $category->id) }}">
                        <button type="button">Sửa</button>
                    </a>

                
                <form action="{{ route('admins.categories.delete', $category->id) }}" method="POST" style="display:inline;">
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

</x-app-layout>

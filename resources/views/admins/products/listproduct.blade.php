<x-app-layout>
<div class="sidebar">
        <div class="logo">
            <h2>Admin Dashboard</h2>
        </div>
        <ul class="menu">
        <li><a href="{{ route('admins.home') }}">Tổng quan</a></li>
        <li><a href="{{ route('admins.users.list') }}">Quản lý người dùng</a></li>
        <li><a href="{{ route('admins.orders.list') }}">Quản lý đơn hàng</a></li>
        <li><a href="{{ route('admins.products.list') }}">Quản lý sản phẩm</a></li>
        <li><a href="{{ route('admins.categories.list') }}">Danh mục</a></li>
        <li><a href="{{ route('admins.providers.list') }}" onclick="logout()">Nhà Cung Cấp</a></li>
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
        <div class="add">
            <a href="{{ route('admins.products.create') }}">
                        <button type="button">Thêm</button>
            </a>
            </div>
        <section class="add-Product" >
        </section>
    
    <table class="table-admin">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Mô tả</th>
                <th>Ảnh</th>
                <th>Số lượng sản phẩm</th>
                <th>Tùy Chỉnh</th>
                <th>Nhà cung cấp</th>
                <th>Danh mục</th>
               
                <th>Chức năng</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->image }}</td>
                    <td>{{ $product->sell }}</td>
                    <td>{{ $product->role }}</td>
                    <td>{{ $product->provider ? $product->provider->name : '' }}</td>
                    <td>@foreach ($product->categories as $category)
                    {{ $category->name }}<br>
                        @endforeach
                    </td>
                    <td>
                     
                        <a href="{{ route('admins.products.edit', $product->id) }}">
                            <button type="button">Sửa</button>
                        </a>

                       
                        <form action="{{ route('admins.products.delete', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</button>
                        </form>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
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

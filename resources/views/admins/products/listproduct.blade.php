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
    
        <div class="main-content">
            <header>
                <h1>🛍️ Quản lý sản phẩm</h1>
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="🔍 Tìm kiếm sản phẩm...">
                </div>
            </header>
    
            <div class="add">
                <a href="{{ route('admins.products.create') }}">
                    <button class="add-btn">➕ Thêm sản phẩm</button>
                </a>
            </div>
    
            <table class="table-admin">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Giá</th>
                        <th>Mô tả</th>
                        <th>Ảnh</th>
                        <th>Số lượng</th>
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
                            <td>{{ number_format($product->price) }} VND</td>
                            <td>{{ $product->description }}</td>
                            <td><img src="{{ $product->image }}" alt="Ảnh" class="product-img"></td>
                            <td>{{ $product->sell }}</td>
                            <td>{{ $product->provider ? $product->provider->name : 'N/A' }}</td>
                            <td>
                                @foreach ($product->categories as $category)
                                    {{ $category->name }}<br>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('admins.products.edit', $product->id) }}">
                                    <button class="edit-btn">✏️ Sửa</button>
                                </a>
                                <form action="{{ route('admins.products.delete', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">🗑️ Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <script>
        document.getElementById("searchInput").addEventListener("keyup", function () {
            let searchText = this.value.toLowerCase();
            document.querySelectorAll(".table-admin tbody tr").forEach(row => {
                let found = Array.from(row.children).some(cell => cell.textContent.toLowerCase().includes(searchText));
                row.style.display = found ? "" : "none";
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
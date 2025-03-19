<x-app-layout>
    <div class="admin">
        <div class="main-content">
            <header>
                <h1>👥 Danh sách mã khuyến mại</h1>
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="🔍 Tìm kiếm người dùng...">
                </div>
            </header>

            <div class="add">
                <a href="{{ route('admins.promotions.create') }}">
                    <button type="button">➕ Thêm mã khuyến mại</button>
                </a>
            </div>

            <section class="user-list">
                <table class="table-admin">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên khuyến mại</th>
                            <th>Mã khuyến mại</th>
                            <th>Giảm giá</th>
                            <th>Ngày hết hạn</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($promotions as $promotion)
                            <tr>
                                <td>{{ $promotion->id }}</td>
                                <td>{{ $promotion->name }}</td>
                                <td>{{ $promotion->code }}</td>
                                <td>{{ number_format($promotion->discount) }} VND</td>
                                <td>{{ $promotion->expires_at }}</td>
                                <td>
                                    <a href="{{ route('admins.promotions.edit', $promotion->id) }}">
                                        <button type="button" class="edit-btn">✏️ Sửa</button>
                                    </a>
                                    <form action="{{ route('admins.promotions.delete', $promotion->id) }}" method="POST" style="display:inline;">
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

<x-app-layout>
    <div class="admin">
<div class="main-content">

    <header>
    <h1 class="dsnd">Danh sách màu sắc</h1>

        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Tìm kiếm người dùng..." onkeyup="searchUser()">
        </div>
    </header>
    <div class="add">
            <a href="{{ route('admins.colors.create') }}">
                        <button type="button">➕ Thêm màu sắc</button>
            </a>
        </div>
    <section>
        <table class="table-admin">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Danh Mục</th>
                    <th>Giá</th>
                    <th>Chức Năng</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($colors as $color)
                    <tr>
                        <td>{{ $color->id }}</td>
                        <td>{{ $color->name }}</td>
                        <td>{{ $color->price }}</td>
                        <td>
                        <a href="{{ route('admins.colors.edit', $color->id) }}">
                                    <button class="edit-btn">✏️ Sửa</button>
                        </a>


                <form action="{{ route('admins.colors.delete', $color->id) }}" method="POST" style="display:inline;">
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
        .add-btn { background: #28a745; color: white !important  }
        .edit-btn { background: #ffc107; color: black; }
        .delete-btn { background: #dc3545; color: white; }
</style>

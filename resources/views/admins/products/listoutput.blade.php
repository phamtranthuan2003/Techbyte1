<x-app-layout>
    <div class="admin">
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
            <div class="add">
                <a href="{{ route('admins.products.input') }}">
                    <button class="add-btn">➕ Thêm Nhập kho</button>
                </a>
            </div>

            <div class="inventory">
                <a href="{{ route('admins.products.list') }}">
                    <button class="inventory"> Sản phẩm hiện có</button>
                </a>
                <a href="{{ route('admins.products.inventory') }}">
                    <button class="inventory">Sản phẩm cần bổ sung</button>
                </a>
                <a href="{{ route('admins.products.listImputProduct') }}">
                    <button class="listImputProduct">Danh sách nhập kho</button>
                </a>
                <a href="{{ route('admins.products.listoutput') }}">
                    <button class="listExports">Danh sách xuất kho</button>
                </a>
            </div>
            <table class="table-admin">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Thời gian xuất</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($exports as $export)
                        <tr>
                            <td>{{ $export->id }}</td>
                            <td>{{ $export->product->name ?? 'N/A' }}</td>
                            <td>{{ $export->quantity }}</td>
                            <td>{{ \Carbon\Carbon::parse($export->exported_at)->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
                    {{-- <div class="pagination-container">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </div> --}}
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
        .inventory {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 20px;
}

.inventory a {
    text-decoration: none;
}

.inventory button {
    background-color: #4CAF50; /* Màu xanh lá */
    color: white;
    font-size: 16px;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
}

.inventory button:hover {
    background-color: #45a049;
}

.inventory button:active {
    background-color: #3e8e41;
}

    </style>
</x-app-layout>

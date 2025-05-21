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
            {{-- <div class="add">
                <a href="{{ route('admins.products.input') }}">
                    <button class="add-btn">➕ Thêm Nhập kho</button>
                </a>
            </div> --}}
            <div class="add">
                <form action="/export-products" method="GET">
                    <button type="submit">Xuất danh sách hàng tồn kho</button>
                </form>
            </div>
            <div>
                <span>Có {{ $oldproducts->count() }} sản phẩm chậm luân chuyển
                    <a href="#" onclick="toggleDetails()">Chi tiết</a>
                </span>

                {{-- Danh sách chi tiết (ẩn/hiện nếu muốn) --}}
                <ul id="old-products-detail" style="display: none; margin-top: 10px;">
                    @foreach ($oldproducts as $product)
                        <li>{{ $product->name }} - Còn lại: {{ $product->sell }} sản phẩm - Chậm luân chuyển {{ $product->days_since_created }} ngày</li>
                    @endforeach
                </ul>
            </div>
            <div class="inventory">
                <a href="{{ route('admins.products.list') }}">
                    <button class="inventory"> Sản phẩm hiện có ({{$totalmCount}})</button>
                </a>
                <a href="{{ route('admins.products.inventory') }}">
                    <button class="inventory">Sản phẩm cần bổ sung ({{$totalCount}})</button>
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
                        <th>Tên</th>
                        <th>Giá</th>
                        <th>Ảnh</th>
                        <th>Số lượng</th>
                        <th>Nhà cung cấp</th>
                        <th>Danh mục</th>
                        <th>Xuất kho</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ number_format($product->price) }} VND</td>
                            <td><img src="{{ $product->image }}" alt="Ảnh" class="product-img"></td>
                            <td>{{ $product->sell }}</td>
                            <td>{{ $product->provider ? $product->provider->name : 'N/A' }}</td>
                            <td>
                                @foreach ($product->categories as $category)
                                    {{ $category->name }}<br>
                                @endforeach
                            </td>
                            <td>
                                <form action="{{route("admins.products.output" , ['id' => $product->id])}}" method="POST">
                                @csrf
                                    <div class="modal-content">
                                    <div class="modal-body">
                                        <input type="number" name="quantity" class="form-control" min="1" max="{{ $product->sell }}" required> <br><br>
                                        <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exportModal{{ $product->id }}">
                                            Xuất kho
                                        </button>
                                    </div>
                                    </div>
                                </form>
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
                    <div class="pagination-container">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </div>
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
         function toggleDetails() {
        const detail = document.getElementById('old-products-detail');
        detail.style.display = detail.style.display === 'none' ? 'block' : 'none';
        }
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

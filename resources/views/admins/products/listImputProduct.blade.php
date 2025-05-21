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
        <a href="">
            <button class="add-btn">➕  Quét mã </button>
        </a>
    </div> --}}

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
        <div>
            <table class="table-admin">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mã hàng</th>
                        <th>Số lượng</th>
                        <th>Đơn vị tính</th>
                        <th>Nhà cung cấp</th>
                        <th>Vị trí lưu trữ</th>
                        <th>Chức năng</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($Imputproducts as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->provider ? $product->provider->name : 'N/A' }}</td>
                            <td>{{ $product->position }}</td>
                            <td>
                                <a href="{{ route('admins.products.editimput', $product->id) }}">
                                    <button class="edit-btn">✏️ Sửa</button>
                                </a>
                                <form action="{{ route('admins.products.deleteimput', $product->id) }}" method="POST" style="display:inline;">
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

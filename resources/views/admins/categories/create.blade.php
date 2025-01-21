<x-app-layout>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-container">
            <h1>Thêm Danh Mục</h1>
            
         
            <div class="form-group">
                <label for="name">Danh Mục:</label>
                <input type="text" name="name" id="name" placeholder="Nhập tên danh mục" required>
            </div>

           
            <div class="form-group">
                <label for="description">Mô Tả:</label>
                <input type="text" name="description" id="description" placeholder="Nhập mô tả" required>
            </div>


            <div class="form-group">
                <button type="submit">Thêm Danh Mục</button>
            </div>
        </div>
    </form>
    </style>
</x-app-layout>

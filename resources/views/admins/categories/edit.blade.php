<x-app-layout>
    <form action="{{ route('admins.categories.store') }}" method="POST">
        @csrf
        <div class="form-container">
            <h1>Sua Danh Mục</h1>
            
         
            <div class="form-group">
                <label for="name">Danh Mục:</label>
                <input type="text" name="name" id="name" placeholder="Nhập tên danh mục" value="{{$category->name}}" required>
            </div>

           
            <div class="form-group">
                <label for="description">Mô Tả:</label>
                <input type="text" name="description" id="description" placeholder="Nhập mô tả" value="{{$category->description}}" required>
            </div>


            <div class="form-group">
                <button type="submit">Sửa Danh Mục</button>
            </div>
        </div>
    </form>
    </style>
</x-app-layout>

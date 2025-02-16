<x-app-layout>
    <form action="{{ route('admins.categories.update', ['id' => $category->id]) }}" method="POST">
        @csrf
        @method('PUT') <!-- This ensures the form is treated as an update request -->
        <div class="form-container">
            <h1>Sửa Danh Mục</h1>
            
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
</x-app-layout>

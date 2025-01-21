<x-app-layout>
    <h1> Thêm sản phẩm </h1>
    <form action="{{ route('admins.products.store') }}" method="post">
    @csrf
        <label for="name">
            Tên:
            <input type="text" name="name" required>
        </label><br><br>
        <label for="Price">
            Giá:
            <input type="number" name="price" required min="1"> <br> <br>

            <label for="describe1">
            Mo Ta 1
            </label>
            <input type="text" name="description1"required><br> <br>
            <label for="describe2">Mo Ta 2</label>
            <input type="text" name="description2"required>
        </label><br><br>
         <select multiple name="category_id[]"required>
    

            @foreach ($category as $category)

                <option value="{{ $category->id }}">{{ $category->name }}</option>
            
                @endforeach

        </select><br><br>
        <label for="Image">
            Ảnh:
            <input type="file" name="image" accept="image/*">
        </label>
        <select name="provider_id"required>
    

            @foreach ($provider as $provider)

                <option value="{{ $provider->id }}">{{ $provider->name }}</option>
            
                @endforeach

        </select><br><br>
       
    
        <button type="submit">Tạo sản phẩm</button>
    </form>
</x-app-layout>

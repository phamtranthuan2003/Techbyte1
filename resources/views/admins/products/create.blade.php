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
            <input type="text" name="price" required min="1"> <br> <br>

            <label for="describe">
            Mô tả 
            </label>
            <input type="text" name="description"required><br> <br>

            <label for="sell">
            bán ra 
            </label>
            <input type="text" name="sell"required><br> <br>


         <select multiple name="category_id[]"required>
            
            @foreach ($categories as $category)

                <option value="{{ $category->id }}">{{ $category->name }}</option>
            
            @endforeach

        </select><br><br>

        
        <label for="Image">
            Ảnh:
            <input type="text" name="image" accept="image/*">
        </label>
        
        <select name="provider_id"required>
    

            @foreach ($providers as $provider)

                <option value="{{ $provider->id }}">{{ $provider->name }}</option>
            
            @endforeach

        </select><br><br>
        <div class="role-options">
                <div class="radio-group">
                    <input type="radio" id="presently" name="role" value="Hien"> Hien
                </div>
                <div class="radio-group">
                    <input type="radio" id="hide" name="role" value="An" checked> An
                </div>
            </div>
    
        <button type="submit">Tạo sản phẩm</button>
    </form>
</x-app-layout>

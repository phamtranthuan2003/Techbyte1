<x-app-layout>
    <h1> sua san pham </h1>
    <form action="{{ route('admins.products.update', $products->id) }}" method="post" class="editProduct">
    @csrf
 
        <label for="Name">
            Tên:
            <input type="text" name="name" required value="{{ $products->name }}">
        </label><br><br>
        <label for="Price">
            Giá:
            <input type="number" name="price" required min="1" value="{{$products->price}}">
        </label><br><br>
        <label for="description">
            Mo ta:
            <input type="text" name="description" required value="{{ $products->description}}">
        </label><br><br>
        <select id="provider" name="provider_id" required>
        <option value="" disabled>-- Chọn nhà cung cấp --</option>
        @foreach ($providers as $provider)
            <option value="{{ $provider->id }}" 
                {{ $products->provider_id == $provider->id ? 'selected' : '' }}>
                {{ $provider->name }}
            </option>
        @endforeach
        
    </select>
    <select name="category_id[]" multiple required>
    <option value="" disabled>-- Chọn danh mục --</option>
    @foreach ($categories as $category)
        <option value="{{ $category->id }}"
            {{ $products->categories->contains($category->id) ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
    @endforeach
</select>
        <label for="Image">
            Ảnh:
            <input type="text" name="image" accept="image/*" value="{{$products->image}}">
        </label><br><br>
    <div class="role-options">
    
        <input type="radio" name="role" value="Hiện" {{ isset($product) && $product->role === 'Hien' ? 'checked' : '' }}>
        <label for="presently">Hiện</label>
    </div>
    <div class="role-options">
        <input type="radio" name="role" value="Ẩn" {{ isset($product) && $product->role === 'An' ? 'checked' : '' }}>
        <label for="hide">Ẩn</label>
    </div>



        <button type="submit">Sua san pham</button>
    </form><br>
    <form action="/products/delete/{{$products->id}}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')">Xóa sản phẩm</button>
    </form>
        
</x-app-layout>
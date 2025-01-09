<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
    <h1> sua san pham </h1>
    <form action="/products/update/{{ $product->id }}" method="post">
    @csrf
    @method('PUT')
        <label for="Name">
            Tên:
            <input type="text" name="name" required value="{{ $product->name }}">
        </label><br><br>
        <label for="Price">
            Giá:
            <input type="number" name="price" required min="1" value="{{$product->price}}">
        </label><br><br>
        <label for="description">
            Mo ta:
            <input type="text" name="description" required value="{{ $product->description}}">
        </label><br><br>
        <select id="provider" name="provider_id" required>
        <option value="" disabled>-- Chọn nhà cung cấp --</option>
        @foreach ($provider as $provider)
            <option value="{{ $provider->id }}" 
                {{ $product->provider_id == $provider->id ? 'selected' : '' }}>
                {{ $provider->name }}
            </option>
        @endforeach
    </select>
        <label for="Image">
            Ảnh:
            <input type="file" name="image" accept="image/*" value="{{$product->image}}">
        </label><br><br>
        

        <button type="submit">Sua san pham</button>
    </form><br>
    <form action="/products/delete/{{$product->id}}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')">Xóa sản phẩm</button>
    </form>
        
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
    <h1> Thêm sản phẩm </h1>
    <form action="/products/create" method="post">
    @csrf
        <label for="lastname">
            Tên:
            <input type="text" name="lastname" required>
        </label><br><br>
        <label for="firstname">
            Ho:
            <input type="text" name="firstname" required>
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
</body>
</html>

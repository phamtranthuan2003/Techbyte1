<!DOCTYPE html>
<lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="{{ route('categories.store') }}" method="POST">
@csrf
    <h1>Danh muc</h1>
    <label for="name"> Ten the loai
        <input type="text" name="name">
    </label>
    <label for="price">
        Mo ta
        <input type="text" name="description">
    </label>
    <button type="submit">Them danh muc</button>
</body>

</form>
</html>
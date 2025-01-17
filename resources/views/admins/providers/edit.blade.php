<!DOCTYPE html>
<lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="{{ route('providers.update', $provider->id) }}" method="post">
@csrf
@method('PUT')
    <h1>Thay doi nha cung cap</h1>
    <label for="name">Ten nha cung cap
        <input type="text" name="name" value="{{$provider->name}}">
    </label>
    <label for="address">
        Dia chi
        <input type="text" name="address" value="{{$provider->address}}">
    </label>
    <label for="tele">
        so dien thoai
        <input type="number" name="tele" value="{{$provider->tele}}">
    </label>
    <button type="submit">them nha cung cap</button>
</body>

</form>
</html>
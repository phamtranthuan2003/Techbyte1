<!DOCTYPE html>
<lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="/providers/create" method="post">
@csrf
    <h1>Nha cung cap</h1>
    <label for="name">Ten nha cung cap
        <input type="text" name="name">
    </label>
    <label for="address">
        Dia chi
        <input type="text" name="address">
    </label>
    <label for="tele">
        so dien thoai
        <input type="number" name="tele">
    </label>
    <button type="submit">them nha cung cap</button>
</body>

</form>
</html>
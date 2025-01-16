<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Dang ki</h2>
    <form action="{{ route('users.store') }}" method="post">
        @csrf
        <label for="Name">
            Ten:
            <input type="text" name="name">
        </label><br><br>
        <label for="Email">
            Email:
            <input type="text" name="email">
        </label><br><br>
        <label for="Password">
            Mat Khau:
            <input type="password" name="password">
        </label><br><br>
        <button type="submit">Dang ki</button>
    </form>
</body>
</html>

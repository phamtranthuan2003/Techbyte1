<x-app-layout>
<form action="{{ route('admins.providers.update', $provider->id) }}" method="post">
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

</x-app-layout>
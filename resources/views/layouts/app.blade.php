<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">

        <!-- Scripts -->

        <!-- Styles -->
        @livewireStyles
    </head>
    <div class="sidebar">
        <div class="logo">
            <h2>Admin Dashboard</h2>
        </div>
        <ul class="menu">
            <li><a href="{{ route('admins.home') }}">🏠 Tổng quan</a></li>
            <li><a href="{{ route('admins.users.list') }}">👥 Quản lý người dùng</a></li>
            <li><a href="{{ route('admins.orders.orderNotPlaced') }}">📦 Quản lý đơn hàng</a></li>
            <li><a href="{{ route('admins.products.list') }}">🛒 Quản lý sản phẩm</a></li>
            <li><a href="{{ route('admins.categories.list') }}">🗂️ Quản lí danh mục</a></li>
            <li><a href="{{ route('admins.providers.list') }}">🚚 Nhà cung cấp</a></li>
            <li><a href="{{ route('admins.capacities.list') }}">🗄️ Quản lý dung lượng</a></li>
            <li><a href="{{ route('admins.colors.list') }}">🎨  Màu Sắc</a></li>
            <li><a href="{{ route('admins.promotions.list') }}">  Quản lí khuyễn mại</a></li>
            <li><a href="{{ route('admins.posts.list') }}">  Quản lí bài viết</a></li>
            <li><a href="{{ route('users.login') }}" onclick="logout()">🚪 Đăng xuất</a></li>
        </ul>
    </div>
    <body class="font-sans antialiased">
            <main>
                {{ $slot }}
            </main>
            <footer>
            </footer>
        @livewireScripts

    </body>
</html>

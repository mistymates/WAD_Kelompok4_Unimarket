<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniMarket</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <nav>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('catalog') }}">Catalog</a></li>
                @auth
                    <li><a href="{{ route('cart') }}">Cart</a></li>
                    @if(Auth::user()->role == 'admin')
                        <li><a href="{{ route('admin.users') }}">User Management</a></li>
                    @elseif(Auth::user()->role == 'seller')
                        <li><a href="{{ route('seller.products') }}">My Products</a></li>
                    @endif
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
        </nav>

        <div class="content">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

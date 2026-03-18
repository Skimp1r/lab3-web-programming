<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Abstract Shop')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('abstract-shop.home') }}">Abstract Shop</a>
        <div class="navbar-nav">
            <a class="nav-link" href="{{ route('abstract-shop.products.index') }}">Товары</a>
            <a class="nav-link" href="{{ route('abstract-shop.categories.index') }}">Категории</a>
            <a class="nav-link" href="{{ route('abstract-shop.suppliers.index') }}">Поставщики</a>
            <a class="nav-link" href="{{ route('abstract-shop.customers.index') }}">Клиенты</a>
            <a class="nav-link" href="{{ route('abstract-shop.warehouses.index') }}">Склады</a>
            <a class="nav-link" href="{{ route('abstract-shop.orders.index') }}">Заказы</a>
        </div>
    </div>
</nav>

<main class="container py-4">
    @if ($errors->any())
        <div class="alert alert-danger">
            <div class="fw-bold mb-1">Ошибки валидации:</div>
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>
</body>
</html>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Админка: @yield('title')</title>

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <title>@yield('title')</title>
    <link rel="icon" href="/img/Fevicon.png" type="image/png">
    <link rel="stylesheet" href="/vendors/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/vendors/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="/vendors/nice-select/nice-select.css">
    <link rel="stylesheet" href="/vendors/owl-carousel/owl.theme.default.min.css">
    <link rel="stylesheet" href="/vendors/owl-carousel/owl.carousel.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/add.css">

    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/admin.css" rel="stylesheet">

    @if ('custom_css')
        @yield('custom_css')
    @endif
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ route('index') }}">
                    Вернуться на сайт
                </a>

                <div id="navbar" class="collapse navbar-collapse">
                    @admin
                        <ul class="nav navbar-nav">
                            <li @adminrouteactive('categories.index')><a href="{{route('categories.index')}}">Категории</a></li>
                            <li @adminrouteactive('products.index')><a href="{{route('products.index')}}">Товары</a></li>
                            <li @adminrouteactive('home')><a href="{{route('home')}}">Заказы</a></li>
                        </ul>
                    @endadmin

                    <ul class="nav navbar-nav navbar-right">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('login')}}">Войти</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('register')}}">Зарегистрироваться</a>
                            </li>
                        @endguest
                        @auth
                            <li><a href="{{route('reset')}}">Сброс проекта</a></li>
                            <li><a href="{{route('logout')}}">Выйти</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <div class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>

</html>

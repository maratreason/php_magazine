<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title')</title>
        <link rel="icon" href="/img/Fevicon.png" type="image/png">
        <link rel="stylesheet" href="/vendors/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="/vendors/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="/vendors/themify-icons/themify-icons.css">
        <link rel="stylesheet" href="/vendors/nice-select/nice-select.css">
        <link rel="stylesheet" href="/vendors/owl-carousel/owl.theme.default.min.css">
        <link rel="stylesheet" href="/vendors/owl-carousel/owl.carousel.min.css">
        <meta name="csrf-token" content="{{csrf_token()}}">
        @if('custom_css')
            @yield('custom_css')
        @endif
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/add.css">
    </head>
    <body>
        <!--================ Start Header Menu Area =================-->
        <header class="header_area">
            <div class="main_menu">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container">
                        <a class="navbar-brand logo_h" href="{{route('index')}}"><img src="img/logo.png" alt=""></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                            <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
                                <li @routeactive('index')>
                                    <a href="{{route('index')}}" class="nav-link">Главная</a>
                                </li>
                                <li @routeactive('shop*')>
                                    <a href="{{route('shop')}}" class="nav-link">Интернет-магазин</a>
                                </li>
                                <li @routeactive('basket')>
                                    <a href="{{route('basket')}}" class="nav-link">Корзина</a>
                                </li>

                                <li class="nav-item submenu dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                        aria-haspopup="true" aria-expanded="false">Blog</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
                                        <li class="nav-item"><a class="nav-link" href="single-blog.html">Blog
                                                Details</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Контакты</a></li>
                            </ul>

                            <ul class="nav-shop ml-auto">
                                <li class="nav-item">
                                    <button>
                                        <a href="{{route('basket')}}">
                                            <i class="ti-shopping-cart"></i>
                                            <span class="nav-shop__circle">
                                                {{ isset($order) ? $order->getOrderCount() : 0 }}
                                            </span>
                                        </a>
                                    </button>
                                </li>

                            </ul>
                            <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
                                @guest
                                    <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Войти</a></li>
                                @endguest
                                @auth
                                    @admin
                                        <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Панель администратора</a></li>
                                    @else
                                        <li class="nav-item"><a class="nav-link" href="{{route('person.orders.index')}}">Мои заказы</a></li>
                                    @endadmin
                                    <li class="nav-item"><a class="nav-link" href="{{route('get-logout')}}">Выйти</a></li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <!--================ End Header Menu Area =================-->

        @if (session()->has('success'))
            <p class="alert alert-success text-center">{{session()->get('success')}}</p>
        @endif
        @if (session()->has('warning'))
            <p class="alert alert-warning text-center">{{session()->get('warning')}}</p>
        @endif

        @yield('content')

        <!--================ Start footer Area  =================-->
        <footer class="footer">
            <div class="footer-area">
                <div class="container">
                    <div class="row section_gap">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="single-footer-widget tp_widgets">
                                <h4 class="footer_title large_title">Наша миссия</h4>
                                <p>
                                    Равным образом сложившаяся структура организации в значительной степени обуславливает создание позиций,
                                    занимаемых участниками в отношении поставленных задач.
                                </p>
                                <p>
                                    Идейные соображения высшего порядка, а также постоянное информационно-пропагандистское обеспечение нашей деятельности
                                </p>
                            </div>
                        </div>
                        <div class="offset-lg-1 col-lg-2 col-md-6 col-sm-6">
                            <div class="single-footer-widget tp_widgets">
                                <h4 class="footer_title">Меню</h4>
                                <ul class="list">
                                    <li><a href="{{ route('index') }}">Главная</a></li>
                                    <li><a href="{{ route('shop') }}">Интернет-Магазин</a></li>
                                    <li><a href="{{ route('basket') }}">Корзина</a></li>
                                    <li><a href="#">Blog</a></li>
                                    <li><a href="{{ route('contact') }}">Контакты</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="single-footer-widget instafeed">
                                <h4 class="footer_title">Галерея</h4>
                                <ul class="list instafeed d-flex flex-wrap">
                                    <li><img src="/img/gallery/r1.jpg" alt=""></li>
                                    <li><img src="/img/gallery/r2.jpg" alt=""></li>
                                    <li><img src="/img/gallery/r3.jpg" alt=""></li>
                                    <li><img src="/img/gallery/r5.jpg" alt=""></li>
                                    <li><img src="/img/gallery/r7.jpg" alt=""></li>
                                    <li><img src="/img/gallery/r8.jpg" alt=""></li>
                                </ul>
                            </div>
                        </div>
                        <div class="offset-lg-1 col-lg-3 col-md-6 col-sm-6">
                            <div class="single-footer-widget tp_widgets">
                                <h4 class="footer_title">Наши контакты</h4>
                                <div class="ml-40">
                                    <p class="sm-head">
                                        <span class="fa fa-location-arrow"></span>
                                        г.Москва
                                    </p>
                                    <p>Проспект Ленина, 1/2</p>

                                    <p class="sm-head">
                                        <span class="fa fa-phone"></span>
                                        Телефон
                                    </p>
                                    <p>
                                        +123 456 7890 <br>
                                        +123 456 7890
                                    </p>

                                    <p class="sm-head">
                                        <span class="fa fa-envelope"></span>
                                        Email
                                    </p>
                                    <p>
                                        free@infoexample.com <br>
                                        www.infoexample.com
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="container">
                    <div class="row d-flex">
                        <p class="col-lg-12 footer-text text-center">
                            Copyright &copy;
                            <script> document.write(new Date().getFullYear()); </script> Все права защищены
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <!--================ End footer Area  =================-->

        <script src="/vendors/jquery/jquery-3.2.1.min.js"></script>
        <script src="/vendors/bootstrap/bootstrap.bundle.min.js"></script>
        <script src="/vendors/skrollr.min.js"></script>
        <script src="/vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="/vendors/nice-select/jquery.nice-select.min.js"></script>
        <script src="/vendors/jquery.ajaxchimp.min.js"></script>
        <script src="/vendors/mail-script.js"></script>
        @if('custom_js')
            @yield('custom_js')
        @endif
        <script src="/js/main.js"></script>
    </body>
</html>

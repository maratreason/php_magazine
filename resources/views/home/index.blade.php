@extends('layouts.main')

@section('title', 'Aroma Shop - Главная')

@section('content')
    <main class="site-main">

        <!--================ Hero banner start =================-->
        <section class="hero-banner">
            <div class="container">
                <div class="row no-gutters align-items-center pt-60px">
                    <div class="col-5 d-none d-sm-block">
                        <div class="hero-banner__img">
                            <img class="/img-fluid" src="/img/home/hero-banner.png" alt="">
                        </div>
                    </div>
                    <div class="col-sm-7 col-lg-6 offset-lg-1 pl-4 pl-md-5 pl-lg-0">
                        <div class="hero-banner__content">
                            <h4>Счастливые покупки</h4>
                            <h1>Предлагаем наши лучшие продукты</h1>
                            <p>Равным образом рамки и место обучения кадров позволяет оценить значение системы обучения кадров, соответствует насущным потребностям.</p>
                            <a class="button button-hero" href="{{ route('shop') }}">Перейти в магазин</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--================ Hero banner start =================-->

        <!--================ Hero Carousel start =================-->
        <section class="section-margin mt-0">
            <div class="owl-carousel owl-theme hero-carousel">
                <div class="hero-carousel__slide">
                    <img src="/img/home/hero-slide1.png" alt="" class="/img-fluid">
                    <a href="{{ route('shop-category') }}" class="hero-carousel__slideOverlay">
                        <h3>Wireless Headphone</h3>
                        <p>Accessories Item</p>
                    </a>
                </div>
                <div class="hero-carousel__slide">
                    <img src="/img/home/hero-slide2.png" alt="" class="/img-fluid">
                    <a href="{{ route('shop-category') }}" class="hero-carousel__slideOverlay">
                        <h3>Wireless Headphone</h3>
                        <p>Accessories Item</p>
                    </a>
                </div>
                <div class="hero-carousel__slide">
                    <img src="/img/home/hero-slide3.png" alt="" class="/img-fluid">
                    <a href="{{ route('shop-category') }}" class="hero-carousel__slideOverlay">
                        <h3>Wireless Headphone</h3>
                        <p>Accessories Item</p>
                    </a>
                </div>
            </div>
        </section>
        <!--================ Hero Carousel end =================-->

        <!-- ================ trending product section start ================= -->
        <section class="section-margin calc-60px">
            <div class="container">
                <div class="section-intro pb-60px">
                    <p>Трендовые продукты магазина</p>
                    <h2>Популярные <span class="section-intro__style">Товары</span></h2>
                </div>
                <div class="row">

                    @foreach ($relatedProducts as $product)
                    @php
                        $image = $product->image ? $product->image : 'no-image.png';
                    @endphp
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="card text-center card-product">
                                <div class="card-product__img">
                                    <img class="card-img" src="{{ Storage::url($image) }}" alt="{{$product->title}}">
                                    <ul class="card-product__imgOverlay">
                                        <li><button><i class="ti-search"></i></button></li>
                                        <li><button><i class="ti-shopping-cart"></i></button></li>
                                        <li><button><i class="ti-heart"></i></button></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <p>Accessories</p>
                                    <h4 class="card-product__title"><a href="{{route('index')}}">{{$product->title}}</a></h4>
                                    <p class="card-product__price">${{$product->price}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
        <!-- ================ trending product section end ================= -->


        <!-- ================ offer section start ================= -->
        <section class="offer" id="parallax-1" data-anchor-target="#parallax-1"
            data-300-top="background-position: 20px 30px" data-top-bottom="background-position: 0 20px">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5">
                        <div class="offer__content text-center">
                            <h3>Скидка 50%</h3>
                            <h4>Весенние распродажи</h4>
                            <p>Приходите, мы работаем каждый день с 10:00 до 22:00</p>
                            <a class="button button--active mt-3 mt-xl-4" href="{{route('shop')}}">Перейти в магазин</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ================ offer section end ================= -->

        <!-- ================ Best Selling item  carousel ================= -->
        <section class="section-margin calc-60px">
            <div class="container">
                <div class="section-intro pb-60px">
                    <p>Популярные товары</p>
                    <h2>Хиты <span class="section-intro__style">Продаж</span></h2>
                </div>
                <div class="owl-carousel owl-theme" id="bestSellerCarousel">

                    @foreach ($relatedProducts as $product)
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="img-fluid" src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
                                <ul class="card-product__imgOverlay">
                                    <li><button><i class="ti-search"></i></button></li>
                                    <li><button><i class="ti-shopping-cart"></i></button></li>
                                    <li><button><i class="ti-heart"></i></button></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <p>{{ $product->category->name }}</p>
                                <h4 class="card-product__title"><a href="{{ route('shop') }}">{{ $product->name }}</a></h4>
                                <p class="card-product__price">${{ $product->price }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- ================ Best Selling item  carousel end ================= -->

        <!-- ================ Blog section start ================= -->
        <section class="blog">
            <div class="container">
                <div class="section-intro pb-60px">
                    <p>Популярные новости</p>
                    <h2>Последние <span class="section-intro__style">Новости</span></h2>
                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                        <div class="card card-blog">
                            <div class="card-blog__img">
                                <img class="card-img rounded-0" src="/img/blog/blog1.png" alt="">
                            </div>
                            <div class="card-body">
                                <ul class="card-blog__info">
                                    <li><a href="#">Алексей Скоморохов</a></li>
                                    <li><a href="#"><i class="ti-comments-smiley"></i> 2 Комментария</a></li>
                                </ul>
                                <h4 class="card-blog__title"><a href="single-blog.html">Еженедельная распродажа в шоппинг центре Майами</a></h4>
                                <p>Повседневная практика показывает, что реализация намеченных плановых заданий требуют от нас анализа модели развития.</p>
                                <a class="card-blog__link" href="#">Подробнее <i class="ti-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                        <div class="card card-blog">
                            <div class="card-blog__img">
                                <img class="card-img rounded-0" src="/img/blog/blog2.png" alt="">
                            </div>
                            <div class="card-body">
                                <ul class="card-blog__info">
                                    <li><a href="#">Алексей Скоморохов</a></li>
                                    <li><a href="#"><i class="ti-comments-smiley"></i> 3 Комментария</a></li>
                                </ul>
                                <h4 class="card-blog__title"><a href="single-blog.html">Еженедельная распродажа в шоппинг центре Южное Бутово</a></h4>
                                <p>Задача организации, в особенности же сложившаяся структура организации позволяет оценить значение новых предложений.</p>
                                <a class="card-blog__link" href="#">Подробнее <i class="ti-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                        <div class="card card-blog">
                            <div class="card-blog__img">
                                <img class="card-img rounded-0" src="/img/blog/blog3.png" alt="">
                            </div>
                            <div class="card-body">
                                <ul class="card-blog__info">
                                    <li><a href="#">Алексей Скоморохов</a></li>
                                    <li><a href="#"><i class="ti-comments-smiley"></i> 2 Комментария</a></li>
                                </ul>
                                <h4 class="card-blog__title"><a href="single-blog.html">Сельский магазин дарит скидки на покупку сахара</a></h4>
                                <p>Товарищи! сложившаяся структура организации позволяет оценить значение форм развития.</p>
                                <a class="card-blog__link" href="#">Подробнее <i class="ti-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ================ Blog section end ================= -->

        <!-- ================ Subscribe section start ================= -->
        @include('layouts.subscribe')
        <!-- ================ Subscribe section end ================= -->
    </main>
@endsection

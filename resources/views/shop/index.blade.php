@extends('layouts.main')

@section('title', 'Aroma Shop - Магазин')

@section('custom_css')
    <link rel="stylesheet" href="/vendors/nouislider/nouislider.min.css">
@endsection

@section('content')
    @include('layouts.breadcrumbs', ['title' => 'Интернет Магазин'])

    <!-- ================ category section start ================= -->
    <section class="section-margin--small mb-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-5">
                    <div class="sidebar-categories">
                        <div class="head">Категории</div>
                        <ul class="main-categories">
                            <li class="common-filter">
                                <ul class="category-filter">
                                    <form action="{{ route('shop-category') }}" method="POST">
                                        <li class="filter-list">
                                            <input class="pixel-radio" type="submit" style="display: none;" id="0"
                                                name="all" {{ session()->get('category_id') == '0' ? ' checked' : '' }} />
                                            <input class="pixel-radio" type="radio" id="0" name="all"
                                                {{ session()->get('category_id') == '0' ? 'checked' : '' }} />
                                            @csrf
                                            <label for="0">Все<span> ({{ $products_count }})</span></label>
                                        </li>
                                    </form>
                                    @foreach ($categories as $category)
                                        <li class="filter-list">
                                            <form action="{{ route('shop-category', $category->code) }}" method="POST">
                                                <input class="pixel-radio" type="submit" id="{{ $category->id }}"
                                                    name="{{ $category->code }}"
                                                    {{ session()->get('category_id') == $category->id ? ' checked' : '' }}
                                                    style="display: none;" />
                                                <input class="pixel-radio" type="radio" id="{{ $category->id }}"
                                                    name="{{ $category->code }}"
                                                    {{ session()->get('category_id') == $category->id ? ' checked' : '' }} />
                                                <label for="{{ $category->id }}">{{ $category->name }}<span>
                                                        ({{ $category->products->count() }})</span></label>
                                                @csrf
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="sidebar-filter">
                        <div class="top-filter-head">Фильтр товаров</div>

                        <div class="common-filter">
                            <div class="price-range-area">
                                <form method="GET" action="{{route("shop")}}" class="value-wrapper d-flex row" style="">
                                    <div class="head">Цена</div>
                                    <div class="col-md-12">
                                        <label for="price_from">от </label>
                                        <input type="text" name="price_from" id="price_from" size="6" value="{{ request()->price_from}}">
                                        <label for="price_to">до
                                            <input type="text" name="price_to" id="price_to" size="6"  value="{{ request()->price_to }}">
                                        </label>
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <button type="submit" class="btn btn-outline-secondary">Фильтр</button>
                                        <a href="{{ route("shop") }}" class="btn btn-outline-secondary">Сбросить</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-9 col-lg-8 col-md-7">
                    <!-- Start Filter Bar -->
                    <div class="filter-bar" style="display: flex; justify-content: space-between;">
                        <div>
                            <form class="d-flex flex-wrap align-items-center" action="{{ route('shop-category', 'sortBy') }}"
                                method="POST">
                                <select class="sorting sorting__products" name="sortBy" onchange="getVal(this);">
                                    <option value="default" data-order="default">По умолчанию</option>
                                    <option value="price-asc" data-order="price-asc">Цена (по возрастанию)</option>
                                    <option value="price-desc" data-order="price-desc">Цена (по убыванию)</option>
                                    <option value="title-asc" data-order="title-asc">По названию</option>
                                </select>

                                <div class="sorting show__products mr-auto">
                                    @csrf
                                    <input class="btn btn-outline-secondary" type="submit" value="Показать">
                                </div>
                            </form>
                        </div>
                        <div>
                            <form action="{{ route('shop') }}" method="GET">
                                <div class="input-group filter-bar-search">
                                    <input type="text" name="search" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit"><i class="ti-search"></i></button>
                                    </div>
                                </div>
                                @csrf
                            </form>
                        </div>
                    </div>
                    <!-- End Filter Bar -->

                    <!-- Start Best Seller -->
                    <section class="lattest-product-area pb-40 category-list">
                        <div class="row product-row">

                            @foreach ($products as $product)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card text-center card-product">
                                        <div class="card-product__img">
                                            <img class="card-img" src="{{ Storage::url($product->image) }}" alt="">
                                            <ul class="card-product__imgOverlay">
                                                <li><a href="{{ route('shop-product', [$product->category->code, $product->code]) }}"><button><i class="ti-search"></i></button></a></li>
                                                <li>
                                                    <form action="{{ route('basket-add', $product) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class=""><i class="ti-shopping-cart"></i></button>
                                                    </form>
                                                </li>
                                                <li><a href=""><button><i class="ti-heart"></i></button></a></li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <p>{{ $product->name }}</p>
                                            <h4 class="card-product__title"><a
                                                    href="{{ route('shop-product', [$product->category->code,$product->code]) }}">{{ $product->name }}</a>
                                            </h4>
                                            <p class="card-product__price">${{ $product->price }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="cl " style="display: flex; justify-content: center;">
                            {{ $products->links('pagination::bootstrap-4') }}
                        </div>
                    </section>
                    <!-- End Best Seller -->
                </div>
            </div>
        </div>
    </section>
    <!-- ================ category section end ================= -->

    <!-- ================ Subscribe section start ================= -->
    @include('layouts.subscribe')
    <!-- ================ Subscribe section end ================= -->
@endsection

@section('custom_js')
    <script src="/vendors/nouislider/nouislider.min.js"></script>
@endsection

@extends('layouts.main')

@section('title', 'Aroma Shop - Корзина покупок')

@section('custom_css')
    <link rel="stylesheet" href="/vendors/linericon/style.css">
@endsection

@section('content')
    @include('layouts.breadcrumbs', ['title' => 'Корзина покупок'])

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                @if (!empty($order->products))
                    @isset($order->products)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Товар {{$order->getOrderCount()}}</th>
                                        <th scope="col">Цена</th>
                                        <th scope="col">Количество</th>
                                        <th scope="col">Общая сумма</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($order->products as $product)
                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="d-flex">
                                                        <a href="{{route('shop-product', [$product->category->code, $product->code])}}">
                                                            <img style="max-width: 100px;" src="{{ Storage::url($product->image) }}" alt="{{$product->name}}">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <p>{{ $product->name }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5>${{ $product->price }}</h5>
                                            </td>
                                            <td>
                                                <div class="product_count">
                                                    <input type="text" name="qty"
                                                        id="{{ $product->code . $product->id }}" maxlength="12"
                                                        value="{{ $product->pivot->count }}" title="Quantity:"
                                                        class="input-text qty">
                                                    <form action="{{ route('basket-add', $product) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="increase items-count">
                                                            <i class="lnr lnr-chevron-up"></i>
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('basket-remove', $product) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="reduced items-count">
                                                            <i class="lnr lnr-chevron-down"></i>
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                            <td>
                                                <h5>${{ $product->price * $product->pivot->count }}</h5>
                                            </td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            <h5>Товаров на общую сумму:</h5>
                                        </td>
                                        <td>
                                            <h5>$ {{ $order->getFullPrice() }}</h5>
                                        </td>
                                    </tr>

                                    <tr class="out_button_area">
                                        <td class="d-none-l">

                                        </td>
                                        <td class="">

                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            <div class="checkout_btn_inner d-flex align-items-center">
                                                <a class="gray_btn" href="{{ route('shop') }}">Перейти в магазин</a>
                                                <a class="primary-btn ml-2" href="{{route('basket-place')}}">Оформить заказ</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endisset
                @else
                    <h3>Корзина пуста</h3>
                @endif
                </div>
            </div>
        </section>
        <!--================End Cart Area =================-->
    @endsection

@section('custom_js')
    <script>
        $(document).ready(function() {
            var sst;
            $(".increase.items-count").on('click', function(e) {
                e.preventDefault();
                increase();
            });
            $(".reduced.items-count").on('click', function(e) {
                e.preventDefault();
                decrease();
            });
        });

        function increase() {
            var result = document.getElementById('$product->attributes->alias . $product->id');
            var sst = result.value;
            if (!isNaN(sst)) result.value++;
            changeCountOnCart(sst);
            return false;
        }

        function decrease() {
            var result = document.getElementById('$product->attributes->alias . $product->id');
            var sst = result.value;
            if (!isNaN(sst)) result.value--;
            changeCountOnCart(sst);
            return false;
        }

        function changeCountOnCart(newCount) {
            let id = "$product->id";
            let qty = parseInt(newCount).val());
        let totalQty = parseInt($(".nav-shop__circle").text());
        totalQty += qty;
        $(".nav-shop__circle").text(totalQty);

        $.ajax({
            url: "route('addToCart')",
            type: "POST",
            data: {
                id: id,
                qty: qty,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log(data);
            },
            error: function(e) {
                console.log(e.message);
            }
        })
        }
    </script>
@endsection

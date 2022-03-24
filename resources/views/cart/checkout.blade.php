@extends('layouts.main')

@section('title', 'Aroma Shop - Оформление заказа')

@section('content')

<!-- ================ start banner area ================= -->
@include('layouts.breadcrumbs', ['title' => 'Платежные реквизиты'])
<!-- ================ end banner area ================= -->

<!--================Checkout Area =================-->
<section class="checkout_area section-margin--small">
<div class="container">
    <div class="billing_details">
        <div class="row">
            <div class="col-lg-8">
                <h3>Платежные реквизиты</h3>
                <form class="row contact_form" action="{{route('basket-confirm')}}" method="POST" novalidate="novalidate">
                    <div class="col-md-6 form-group p_star">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Имя" />
                        <span class="placeholder" data-placeholder="First name"></span>
                    </div>
                    <div class="col-md-6 form-group p_star">
                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Фамилия" />
                        <span class="placeholder" data-placeholder="Last name"></span>
                    </div>
                    <div class="col-md-6 form-group p_star">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Электронная почта">
                        <span class="placeholder" data-placeholder="Email Address"></span>
                    </div>
                    <div class="col-md-6 form-group p_star">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Номер телефона" />
                        <span class="placeholder" data-placeholder="Phone number"></span>
                    </div>
                    @csrf
                    <button class="button button-paypal" type="submit">Оплатить покупку</button>
                </form>
            </div>
            <div class="col-lg-4">
                <div class="order_box">
                    <h2>Ваш заказ</h2>
                    <ul class="list">
                        <li><a href="#"><h4>Товар <span>Цена</span></h4></a></li>
                        @foreach ($order->products as $product)
                            <li><a href="#">{{$product->name}} <span class="middle">x {{$product->pivot->count}}</span> <span class="last">${{$product->price * $product->pivot->count}}</span></a></li>
                        @endforeach
                    </ul>
                    <ul class="list list_2">
                        <li><a href="#">Общая цена <span>${{$order->getFullPrice()}}</span></a></li>
                    </ul>
                    <div class="payment_item">
                        <div class="radion_btn">
                            <input type="radio" id="f-option5" name="selector">
                            <label for="f-option5">Check payments</label>
                            <div class="check"></div>
                        </div>
                        <p>Please send a check to Store Name, Store Street, Store Town, Store State / County,
                            Store Postcode.</p>
                    </div>
                    <div class="payment_item active">
                        <div class="radion_btn">
                            <input type="radio" id="f-option6" name="selector">
                            <label for="f-option6">Paypal </label>
                            <img src="img/product/card.jpg" alt="">
                            <div class="check"></div>
                        </div>
                        <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal
                            account.</p>
                    </div>
                    <div class="creat_account">
                        <input type="checkbox" id="f-option4" name="selector">
                        <label for="f-option4">I’ve read and accept the </label>
                        <a href="#">terms & conditions*</a>
                    </div>
                    <div class="text-center">
                        <form action="{{ route('basket-confirm') }}">
                            <button class="button button-paypal" type="submit">Proceed to Paypal</button>
                        </form>
                      {{-- <a class="button button-paypal" href="{{route('basket-confirm')}}">Proceed to Paypal</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!--================End Checkout Area =================-->
@endsection

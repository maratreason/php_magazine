@extends('layouts.main')

@section('title', 'Aroma Shop - Заказ оформлен')

@section('content')

<!-- ================ start banner area ================= -->
@include('layouts.breadcrumbs', ['title' => 'Заказ оформлен'])
<!-- ================ end banner area ================= -->

<!--================Order Details Area =================-->
<section class="order_details section-margin--small">
<div class="container">
  <p class="text-center billing-alert">Спасибо! Ваш заказ в обработке. Дождитесь звонка нашего сотрудника.</p>
  <div class="row mb-5">
    <div class="col-md-12 col-xl-12 mb-12 mb-xl-0">
      <div class="confirmation-card">
        <h3 class="billing-title">Информация заказа</h3>
        <table class="order-rable">
          <tr>
            <td>Номер заказа</td>
            <td>: {{$order->id}}</td>
          </tr>
          <tr>
            <td>Заказчик</td>
            <td>: {{$order->name}} {{$order->surname}}</td>
          </tr>
          <tr>
            <td>Email</td>
            <td>: {{$order->email}}</td>
          </tr>
          <tr>
            <td>Номер телефона</td>
            <td>{{$order->phone}}</td>
          </tr>
          <tr>
            <td>Дата заказа</td>
            <td>: {{$order->updated_at}}</td>
          </tr>
          <tr>
            <td>Сумма заказа</td>
            <td>: ${{$order->getFullPrice()}}</td>
          </tr>
          <tr>
            <td>Payment method</td>
            <td>: Check payments</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div class="order_details_table">
    <h2>Order Details</h2>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Product</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <p>Pixelstore fresh Blackberry</p>
            </td>
            <td>
              <h5>x 02</h5>
            </td>
            <td>
              <p>$720.00</p>
            </td>
          </tr>
          <tr>
            <td>
              <p>Pixelstore fresh Blackberry</p>
            </td>
            <td>
              <h5>x 02</h5>
            </td>
            <td>
              <p>$720.00</p>
            </td>
          </tr>
          <tr>
            <td>
              <p>Pixelstore fresh Blackberry</p>
            </td>
            <td>
              <h5>x 02</h5>
            </td>
            <td>
              <p>$720.00</p>
            </td>
          </tr>
          <tr>
            <td>
              <h4>Subtotal</h4>
            </td>
            <td>
              <h5></h5>
            </td>
            <td>
              <p>$2160.00</p>
            </td>
          </tr>
          <tr>
            <td>
              <h4>Shipping</h4>
            </td>
            <td>
              <h5></h5>
            </td>
            <td>
              <p>Flat rate: $50.00</p>
            </td>
          </tr>
          <tr>
            <td>
              <h4>Total</h4>
            </td>
            <td>
              <h5></h5>
            </td>
            <td>
              <h4>$2210.00</h4>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</section>
<!--================End Order Details Area =================-->
@endsection

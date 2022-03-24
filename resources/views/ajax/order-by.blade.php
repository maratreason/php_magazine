@foreach ($products as $product)
    <div class="col-md-6 col-lg-4">
        <div class="card text-center card-product">
            <div class="card-product__img">
                <img class="card-img" src="/img/product/{{$product->img}}" alt="">
                <ul class="card-product__imgOverlay">
                    <li><button><i class="ti-search"></i></button></li>
                    <li><button><i class="ti-shopping-cart"></i></button></li>
                    <li><button><i class="ti-heart"></i></button></li>
                </ul>
            </div>
            <div class="card-body">
                <p>{{$product->category->title}}</p>
                <h4 class="card-product__title"><a href="#">{{$product->title}}</a></h4>
                <p class="card-product__price">${{$product->price}}</p>
            </div>
        </div>
    </div>
@endforeach

@extends('layout.layout')
@section('title','Product List')
@section('content')

<style>
.carousel-caption {
    position: absolute;
    top: 70%; /* Đặt phần trên của văn bản ở giữa */
    left: 20%; /* Đặt phần trái của văn bản ở giữa */
    transform: translate(-50%, -50%); /* Dịch chuyển văn bản ngược lại 50% kích thước của nó */
    background-color:rgba(243, 159, 159, 0.236) ; /* Tạo nền mờ cho văn bản để làm nổi bật */
    color: rgba(0, 0, 0, 0.5); /* Màu văn bản */
    padding: 50px; /* Khoảng cách từ viền nền đến văn bản */
    width: 300px;
    height:200px;
       
}



</style>    

@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
 @endif

 @if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
 @endif

 @if (session('error'))
 <div class="alert alert-danger">
     {{ session('error') }}
 </div>
  @endif


<!-- !Carousel/Slider -->
<div id="slider" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#slider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"><div class="indicator"></div></button>
        <button type="button" data-bs-target="#slider" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#slider" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100"  src="fontend/Image/monstera-slider1.jpg" alt="First slide">
          <div class="carousel-caption">
            <a href="product-details-default.html" class="btn btn-lg btn-pink" style=" text-align:justify ;font-size: 45px; font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">Shop now </a>
        </div>
        </div>
                <div class="carousel-item">
          <img class="d-block w-100"  src="fontend/Image/xuong rong-slider2.jpg" alt="Second slide">
          <div class="carousel-caption">
            <a href="product-details-default.html" class="btn btn-lg btn-pink" style=" text-align:justify ;font-size: 45px; font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">Shop now </a>
        </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="fontend/Image/senda-slider3.jpg" alt="Third slide">
          <div class="carousel-caption">
            <a href="product-details-default.html" class="btn btn-lg btn-pink" style=" text-align:justify ;font-size: 45px; font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">Shop now </a>
        </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev">
        <span aria-hidden="true"><div class="btn-circle"><i class="fa-solid fa-chevron-left" id="btn-prev"></i></div></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next">
        <span aria-hidden="true"><div class="btn-circle"><i class="fa-solid fa-chevron-right" id="btn-next"></i></div></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<section class="category">
    <div id="category-title">Our Partners</div>
    <div class="category-container">
        <div class="row py-3 justify-content-center align-items-end" style="margin: 0;">
            @foreach($brands as $brand)
            <div class="col-sm-3">
                <div class="category-wrapper" style="width: 18rem;">
                    <img src="{{ asset('fontend/Image/' . $brand->image)}}"
                            alt="{{ 'fontend/Image/' . $brand->image}}  " data-image="{{ 'fontend/Image/' . $brand->image }}"
                             width="70%" height="200vw"><br>
                    <a href="{{ URL::to('/brand-product/' . $brand->id) }}" name="name" style="color: black; font-size: 25px ;font-weight: 700" >{{ $brand->name }}</a><br>
                </div>
            </div>
            @endforeach
            
</section>

<section class="product">
    <!-- !att1.5 -->
        <div class="col-lg-12 pt-5 m-auto text-center">
        <h1 style="text-align: left">Top Selling</h1><hr class="product-title" style="float:left" >
    </div>
    <div class="products-container">
        <div id="card-slider0" class="carousel carousel-dark slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="row justify-content-center">
                @foreach ($topSellingProducts as $top)
                  <div class="col-lg-4" ng-repeat="top in slist">
                      <div class="card border-0 bg-light mb-2">
                          <div class="card-body">
                            <a href="{{ route('product.detail', ['id' => $top->product_id]) }}">
                            <img src="{{ 'fontend/Image/' . $top->image->first()->path}}"
                            width="250px" height="250px" alt="{{ 'fontend/Image/' . $top->name}}" href="{{ route('product.detail', ['id' => $top->product_id]) }}">
                            {{-- <a href="{{URL::to('/nuts')}}"> --}}
                                <a href="{{ route('product.detail', ['id' => $top->product_id]) }}">

                              <div class="card-info">
                                {{ $top->name }}<br>
                         
                             
                                    <div class="rating">
                                        @php
                                            $rating = $top->avgrating(); // Retrieve the rating value from the database
                                            $fullStars = floor($rating); // Get the number of full stars
                                            $halfStar = ceil($rating - $fullStars); // Check if there is a half star
                                            $emptyStars = 5 - ($fullStars + $halfStar); // Calculate the number of empty stars
                                        @endphp
                                                      @if( $rating > 0)
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="fa-solid fa-star"></i>
                                        @endfor
                                        @if ($halfStar)
                                            <i class="fa-regular fa-star-half-stroke"></i>
                                        @endif
                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <i class="fa-regular fa-star"></i>
                                        @endfor
                                        @endif
                                    </div>
                                  <div class="price">
                                   Pice:  {{ $top->prices->price}} đ <br>
                                   Weight: {{ $top->weight->weight}} g <br>
                                   
                                  </div>
                                  <br>
                              </div>
                            </a>
                            {{-- add to cart --}}
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <div class="buy-action">
                                    <div class="quantity">
                                       <span style="color: rgb(8, 27, 240)">Stock:{{ $top->quantity}} </span>    <input type="number" class="cart-quantity" min="1" value="1" max="100" name="quantity">
                                    </div>

                                    <input type="hidden" name="product_id" value="{{ $top->product_id }}">

                                    <div class="wishlist">
                                        <a href="#!wishlist"><i class="fa-regular fa-heart"></i></a>
                                    </div>

                                    <div class="add-to-cart">
                                        <button type="submit"  >Add to cart</button>
                                    </div>
                                </div>
                            </form>
                            {{-- add to cart --}}
                          </div>
                      </div>
                  </div>
                  @endforeach
              </div>
            </div>
        </div>
    </div>
    </div>

      <!-- !att2 -->
      <div class="col-lg-12 pt-5 m-auto text-center">
        <h1 style="text-align: left">New Arrival</h1><hr class="product-title" style="float:left" >
    </div>
     

    <div class="products-container">
        <div id="card-slider" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
                {{-- show san pham thieu chieu ngang --}}
              <div class="row justify-content-center">
                @foreach ($products as $product)

                  <div class="col-lg-4" >
                      <div class="card border-0 bg-light mb-2">
                          <div class="card-body">
                            <a href="{{ route('product.detail', ['id' => $product->product_id]) }}">
                            {{-- src="{{ url('images/'.$p->image) }}" --}}
                            <img src="{{ 'fontend/Image/' . $product->image->first()->path }}"
                            width="250px" height="250px" href="{{ route('product.detail', ['id' => $top->product_id]) }}" >
                            </a>
                            <a href="{{ route('product.detail', ['id' => $product->product_id]) }}">
                              <div class="card-info">
                                {{ $product->name }} <br>
                                    <div class="rating">
                                        @php
                                            $rating = $product->avgrating(); // Retrieve the rating value from the database
                                            $fullStars = floor($rating); // Get the number of full stars
                                            $halfStar = ceil($rating - $fullStars); // Check if there is a half star
                                            $emptyStars = 5 - ($fullStars + $halfStar); // Calculate the number of empty stars
                                        @endphp
                                        @if( $rating > 0)
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="fa-solid fa-star"></i>
                                        @endfor
                                        @if ($halfStar)
                                            <i class="fa-regular fa-star-half-stroke"></i>
                                        @endif
                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <i class="fa-regular fa-star"></i>
                                        @endfor
                                        @endif
                                    </div>
                                  <div class="price">
                        
                                   Price: {{ $product->prices->price}} đ <br>
                                   Weight: {{ $product->weight->weight}} g <br>

                                </div>
                                  <br>
                              </div>

                            </a>

                            {{-- add to cart --}}
         <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                        <div class="buy-action">
                            <div class="quantity" >
                                <span style="color: rgb(8, 27, 240)">Stock:{{ $product->quantity}} </span>   <input  type="number"  class="cart-quantity" min="1" value="1" name="quantity">
                            </div>

                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">

                            <div class="wishlist">
                                <a href="#!wishlist"><i class="fa-regular fa-heart"></i></a>
                            </div>

                            <div class="add-to-cart">
                                <button type="submit"  >Add to cart</button>
                            </div>
                        </div>
            </form>

                          </div>
                      </div>
                  </div>

                  @endforeach
              </div>
            </div>
        </div>
        </div>
    </div>
       
 <!-- !att3 -->


 <div class="col-lg-12 pt-5 m-auto text-center">
    <h1 style="text-align: left">The Lastest Blogs</h1><hr class="product-title" style="float:left" >
</div>
<div class="products-container">
    <div id="card-slider0" class="carousel carousel-dark slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="row justify-content-center">
             
                <div class="col-lg-4" ng-repeat="top in slist">
                    <div class="card border-0 bg-light mb-2">
                        <div class="card-body">
                          <a href="">
                          <img src="{{ 'fontend/Image/' . $top->image->first()->path}}"
                          width="250px" height="250px" alt="{{ 'fontend/Image/' . $top->name}}" href="{{ route('product.detail', ['id' => $top->product_id]) }}"></a>
                          {{-- <a href="{{URL::to('/nuts')}}"> --}}
                            <div class="content"> 
                            <a href="{{ route('product.detail', ['id' => $top->product_id]) }}">
                        
                            <div class="card-info">
                              {{ $top->name }}<br>
                              </div></a>
                              <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex. Aenean posuere libero eu augue condimentum rhoncus. Praesent</p>
                              <a href="#" class="read-more-btn icon-space-left">Read More <span><i class="fa-solid fa-arrow-right"></i></span></a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4" ng-repeat="top in slist">
                    <div class="card border-0 bg-light mb-2">
                        <div class="card-body">
                          <a href="">
                          <img src="{{ 'fontend/Image/' . $top->image->first()->path}}"
                          width="250px" height="250px" alt="{{ 'fontend/Image/' . $top->name}}" href="{{ route('product.detail', ['id' => $top->product_id]) }}"></a>
                          {{-- <a href="{{URL::to('/nuts')}}"> --}}
                            <div class="content"> 
                            <a href="{{ route('product.detail', ['id' => $top->product_id]) }}">
                        
                            <div class="card-info">
                              {{ $top->name }}<br>
                              </div></a>
                              <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex. Aenean posuere libero eu augue condimentum rhoncus. Praesent</p>
                              <a href="#" class="read-more-btn icon-space-left">Read More <span><i class="fa-solid fa-arrow-right"></i></span></a>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
                            

{{-- End !att3 --}}


</section>




<br>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection


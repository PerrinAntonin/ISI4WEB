@extends('layouts.app')

@section('content')

<!-- Product Details Area Start -->
<div class="single-product-area section-padding-100 clearfix">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mt-50">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('shop',$category->id)}}">{{$category->name}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$Product->name}}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-7">
                <div class="single_product_thumb">
                    <img class="d-block w-100" src="{{$Product->image}}" alt="First slide">
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="single_product_desc">
                    <!-- Product Meta Data -->
                    <div class="product-meta-data">
                        <div class="line"></div>
                        <p class="product-price">{{$Product->price}}€</p>
                        <a href="product-details.html">
                            <h6>{{$Product->name}}</h6>
                        </a>
                        <!-- Ratings & Review -->
                        <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                            <div class="ratings">
                                @foreach(range(0, $Product->review) as $i)
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                @endforeach
                            </div>

                        </div>
                        <!-- Avaiable -->
                        <p class="avaibility"><i class="fa fa-circle"></i> In Stock</p>
                    </div>

                    <div class="short_overview my-5">
                        <p>{{$Product->description}}</p>
                    </div>

                    <!-- Add to Cart Form -->
                    <a href="{{route('addCart',$Product->id)}}" class="btn amado-btn w-100" title="Add to Cart">Add to Cart</a>


                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Details Area End -->
</div>
<!-- ##### Main Content Wrapper End ##### -->
@endsection

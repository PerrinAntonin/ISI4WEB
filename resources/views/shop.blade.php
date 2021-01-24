@extends('layouts.app')

@section('content')

<div class="shop_sidebar_area">
    <!-- ##### Single Widget ##### -->
    <div class="widget catagory mb-50">
        <!-- Widget Title -->
        <h6 class="widget-title mb-30">Catagories</h6>

        <!--  Catagories  -->
        <div class="catagories-menu">
            <ul>
                <li class="active"><a href="{{route('shop', $ActiveCategories->id)}}">{{$ActiveCategories->name}}</a></li>
                @foreach($Categories as $Category)
                <li class=""><a href="{{route('shop', $Category->id)}}">{{$Category->name}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>


</div>

<div class="amado_product_area section-padding-100">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="product-topbar d-xl-flex align-items-end justify-content-between">
                    <!-- Total Products -->
                    <div class="total-products">
                        <p>Showing 1-{{$Products->count()}} 0f {{$Products->total()}}</p>

                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            @foreach($Products as $Product)
            <!-- Single Product Area -->
            <div class="col-12 col-sm-6 col-md-12 col-xl-6">
                <div class="single-product-wrapper">
                    <!-- Product Image -->
                    <div class="product-img">
                        <img src="{{$Product->image}}" alt="">
                    </div>

                    <!-- Product Description -->
                    <div class="product-description d-flex align-items-center justify-content-between">
                        <!-- Product Meta Data -->
                        <div class="product-meta-data">
                            <div class="line"></div>
                            <p class="product-price">{{$Product->price}}</p>
                            <a href="product-details.html">
                                <h6>{{$Product->name}}</h6>
                            </a>
                        </div>
                        <!-- Ratings & Cart -->
                        <div class="ratings-cart text-right">
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>

                            <div class="cart">
                                <a href="{{route('addCart',$Product->id)}}" data-toggle="tooltip" data-placement="left" title="Add to Cart"><i class="fa fa-cart-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{ $Products->links('layouts.pagination.custom') }}

    </div>
</div>
</div>
<!-- ##### Main Content Wrapper End ##### -->

@endsection

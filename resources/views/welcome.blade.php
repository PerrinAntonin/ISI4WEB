@extends('layouts.app')
@section('content')
        <!-- Product Catagories Area Start -->
        <div class="products-catagories-area clearfix">
            <div class="amado-pro-catagory clearfix">
                @foreach($Products as $Product)
            
                <!-- Single Catagory -->
                <div class="single-products-catagory clearfix">
                    <a href="{{route('showProduct',['id' => $Product->id])}}">
                        <img src="{{$Product->image}}" alt="">
                        <!-- Hover Content -->
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>From {{ $Product->price}} €</p>
                            <h4>{{ $Product->name}}</h4>
                        </div>
                    </a>
                </div>
                @endforeach

            </div>
        </div>
        <!-- Product Catagories Area End -->
    </div>
    <!-- ##### Main Content Wrapper End ##### -->
@endsection
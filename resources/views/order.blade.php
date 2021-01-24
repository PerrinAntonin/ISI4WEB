@extends('layouts.app')

@section('content')

<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="cart-title mt-50">
                    <h2>Shopping Cart</h2>
                </div>

                <div class="cart-table clearfix">
                    <form method="POST" action="{{ route('updateCart') }}" id="form-id">
                        @csrf
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Products as $Product)
                                <tr>

                                    <td class="cart_product_img">

                                        <a href="{{route('showProduct',['id' => $Product->id])}}"><img src="{{$Product->image}}" alt="Product"></a>
                                    </td>
                                    <td class="cart_product_desc">
                                        <h5>{{$Product->name}}</h5>
                                    </td>
                                    <td class="price">
                                        <span>{{$Product->price}} €</span>
                                    </td>
                                    @foreach ($order_items as $order_item)
                                    @if ($order_item->product_id === $Product->id)

                                    <td class="qty">
                                        <div class="qty-btn d-flex">
                                            <p>Qty</p>
                                            <div class="quantity">
                                                <span class="qty-minus" onclick="var effect = document.getElementById('qty{{$order_item->id}}'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                                <input type="number" class="qty-text" id="qty{{$order_item->id}}" step="1" min="1" max="300" name="{{$order_item->id}}" value="{{$order_item->quantity}}">
                                                <span class="qty-plus" onclick="var effect = document.getElementById('qty{{$order_item->id}}'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                    </td>

                                    <td><a href="{{route('removeCart',$order_item->id)}}"><i class="fa fa-close"></i></a></td>

                                    @endif
                                    @endforeach
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="cart-btn mt-10">
                            <button form="form-id" type="submit" class="btn amado-btn w-100">Update Cart</button>
                        </div>

                    </form>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="cart-summary">
                    <h5>Cart Total</h5>
                    <ul class="summary-table">
                        <li><span>subtotal:</span> <span>{{$totalPrice}} €</span></li>
                        <li><span>delivery:</span> <span>Free</span></li>
                        <li><span>total:</span> <span>{{$totalPrice}} €</span></li>
                    </ul>
                    <div class="cart-btn mt-100">
                        <a href="{{route('checkout')}}" class="btn amado-btn w-100">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- ##### Main Content Wrapper End ##### -->

@endsection

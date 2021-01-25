@extends('layouts.app')

@section('content')

    <div class="cart-table-area section-padding-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="checkout_details_area mt-50 clearfix">

                        <div class="cart-title">
                            <h2>Checkout</h2>
                        </div>

                        <form action="{{'payment'}}" method="post" id="checkout-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="firstname" id="first_name" value="{{$userinfo->firstname}}" placeholder="First Name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="lastname" id="last_name" value="{{$userinfo->surname}}" placeholder="Last Name" required>
                                </div>

                                <div class="col-12 mb-3">
                                    <select class="w-100" name="country" id="country">
                                        <option value="fra">France</option>
                                        <option value="usa">United States</option>
                                        <option value="uk">United Kingdom</option>
                                        <option value="ger">Germany</option>
                                        <option value="ind">India</option>
                                        <option value="aus">Australia</option>
                                        <option value="bra">Brazil</option>
                                        <option value="can">Canada</option>
                                    </select>
                                </div>

                                <div class="col-12 mb-3">
                                    <input type="text" class="form-control mb-3" name="add1" id="street_address" value="{{$userinfo->add1}}" placeholder="Address" required>
                                </div>

                                <div class="col-12 mb-3">
                                    <input type="text" class="form-control mb-3" name="add2" id="street_address" value="{{$userinfo->add2}}" placeholder="Add2" >
                                </div>

                                <div class="col-12 mb-3">
                                    <input type="text" class="form-control" name="city" id="city" placeholder="Town" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="zipCode" id="zipCode" value="{{$userinfo->postcode}} "placeholder="Zip Code" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <input type="number" class="form-control" name="phone_number" id="phone_number" value="{{$userinfo->phone}}" min="0" placeholder="Phone No" required>
                                </div>

                                <div class="col-12 mb-3">
                                    <input type="email" class="form-control" name="email" id="email" value="{{$userinfo->email}}" placeholder="Email" required>
                                </div>

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

                        <div class="payment-method">
                            <label for="paymentmethod">Choose a payment method:</label>
                                <select form="checkout-form" id="paymentmethod" class="w-100" name="paymentmethod">
                                    <option value="paypal">Pay with Paypal</option>
                                    <option value="cheque">Cheque</option>
                                </select>
                        </div>

                        <div class="cart-btn mt-100">
                            <button class="btn amado-btn w-100" form="checkout-form" type="submit">Pay</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

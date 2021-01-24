@extends('layouts.app')

@section('content')


    <div class="cart-table-area section-padding-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="checkout_details_area clearfix">

                        <form method="POST" action="{{ route('register') }}" id="form-id">
                            @csrf

                            <div class="cart-title">
                                <h2>Créez votre compte pour accéder a nos fonctionnalités</h2>
                            </div>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" id="first_name" value="" placeholder="First Name" required
                                           autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control @error('surname') is-invalid @enderror"
                                           name="surname" id="surname" value="" placeholder="Last Name" required
                                           autocomplete="family-name" autofocus>
                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password" placeholder="Password" required autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>

                                <div class="col-12 mb-3">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <input type="text" class="form-control mb-3" name="add1" id="street_address"
                                           placeholder="Address" required>
                                </div>

                                <div class="col-12 mb-3">
                                    <input type="text" class="form-control mb-3" name="add2" id="street_address"
                                           placeholder="Address2">
                                </div>

                                <div class="col-6 mb-3">
                                    <input type="text" class="form-control mb-3" name="postcode" id="post_code"
                                           placeholder="PostCode" required>
                                </div>

                                <div class="col-6 mb-3">
                                    <input type="text" class="form-control mb-3" name="phone" id="phone"
                                           placeholder="Phone" required>
                                </div>


                            </div>

                        </form>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="cart-summary">

                        <div class="cart-btn mt-10">
                            <button form="form-id" type="submit"
                                    class="btn amado-btn w-100">{{ __('Register') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>








@stop

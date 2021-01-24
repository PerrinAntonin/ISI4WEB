@extends('layouts.app')

@section('content')
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="cart-title">
                        <h2>Se connecter</h2>
                    </div>


                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row">
                            <label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6 mb-3">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="password" class="sr-only">{{ __('Password') }}</label>

                            <div class="col-md-6 mb-3">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn amado-btn w-100">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="cart-summary">
                    <h5>Vous n'avez pas encore de compte?</h5>


                    <div class="cart-btn mt-100">
                        <p>Vous pouvez vous en créer un juste ici.</p>
                        <i class="fa fa-angle-down d-flex justify-content-center "></i>
                        <a href="{{  route('register') }}" class="btn amado-btn w-100">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@extends('layouts.app')

@section('content')

    <div class="cart-table-area section-padding-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="checkout_details_area mt-50 clearfix">

                        <div class="cart-title">
                            <h3>{{ $status }}</h3>
                            <p>Vous allez être redirigé vers le panier dans quelques secondes.</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        window.onload = function(){
            setInterval(function(){
                window.location.href = "{{route('cart')}}";
            }, 3000); // Redirection après 3 secondes vers le panier
        };

    </script>

@endsection

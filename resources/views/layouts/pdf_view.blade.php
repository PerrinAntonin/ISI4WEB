<html>
<header>
    {{--    <link rel="preconnect" href="https://fonts.gstatic.com">--}}
    {{--    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">--}}
    <link rel="stylesheet" href="{{url('css/core-style.css')}}">
</header>
<body>

<div class="container">
    <div class="invoice">
        <div class="row">
            <div class="col-7 logo">
                <svg width="100%" height="100%">
                    <g>
                        <path
                            d="M47.598 20.018c-3.214 0-4.963 2.482-3.891 5.513L46.354 33l.305.857.275.791.328.925.886 2.5 5.04 14.225h20.05c1.737 0 3.146 1.202 3.146 2.685s-1.409 2.687-3.146 2.687H55.089l1.967 5.556h26.438c1.738 0 3.147 1.203 3.147 2.684 0 1.486-1.409 2.688-3.147 2.688H58.957l.72 2.029c1.074 3.03 4.581 5.509 7.796 5.509h42.962c3.216 0 6.727-2.479 7.8-5.509l15.97-45.093c1.073-3.03-.681-5.513-3.896-5.513h-16.021C112.641 8.632 105.183 0 96.234 0S79.823 8.632 78.183 20.018H67.541c1.493-9.227 7.262-16.125 14.136-16.125.745 0 1.479.082 2.19.237a19.673 19.673 0 013.483-2.926A14.08 14.08 0 0081.677 0c-8.947 0-16.41 8.632-18.052 20.018H47.598zm20.531 13.557a3.978 3.978 0 013.859-3.015 3.98 3.98 0 013.976 3.979c0 1.265-.604 2.378-1.524 3.106 1.148 6.306 7.426 11.146 14.997 11.146 7.487 0 13.712-4.734 14.957-10.938a3.976 3.976 0 012.194-7.294 3.98 3.98 0 013.976 3.979c0 1.741-1.13 3.207-2.694 3.743-1.45 7.936-9.152 14.015-18.433 14.015-9.244 0-16.924-6.031-18.421-13.914-1.69-.429-2.955-1.926-3.003-3.735h-.004a4.325 4.325 0 01.12-1.072zm42.242-13.557H99.729c-.813-5.642-3.06-10.607-6.201-14.182-1.282.403-2.438 1.059-3.468 1.895 2.847 2.906 4.937 7.25 5.754 12.287H82.098c1.493-9.227 7.263-16.125 14.137-16.125s12.643 6.898 14.136 16.125z"
                            id="PATH_3_0" fill="#fbb710"></path>
                        <path
                            d="M68.013 92.228a7.96 7.96 0 00-7.959 7.963 7.959 7.959 0 007.959 7.959c4.396 0 7.963-3.563 7.963-7.959a7.963 7.963 0 00-7.963-7.963zm39.259 0a7.96 7.96 0 00-7.959 7.963 7.959 7.959 0 007.959 7.959 7.959 7.959 0 007.959-7.959 7.96 7.96 0 00-7.959-7.963zM122.197 89.697H51.914a3.804 3.804 0 01-3.583-2.53L24.806 20.823H3.799a3.798 3.798 0 110-7.597h23.693a3.796 3.796 0 013.579 2.529l23.525 66.343h67.601a3.8 3.8 0 110 7.599z"
                            id="PATH_3_1" fill="#333333"></path>
                    </g>
                </svg>
            </div>
            <div class="col-5">
                <h1 class="document-type display-4">FACTURE</h1>
                <p class="text-right"><strong>N°90T-17-01-0123</strong></p>
            </div>
        </div>
        <div class="row">
            <div class="col-7">
                <p>
                    <strong>ISI4WEB SAS</strong><br>
                    6B Rue Aux-Saussaies-Des-Dames<br>
                    57950 MONTIGNY-LES-METZ
                </p>
            </div>
            <div class="col-5">
                <br><br><br>
                <p>
                    <strong>Energies54</strong><br>
                    Réf. Client <em>C00022</em><br>
                    12 Rue de Verdun<br>
                    54250 JARNY
                </p>
            </div>
        </div>
        <br>
        <br>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Product</th>
                <th>Quantité</th>
                <th>PU</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($Products as $Product)
                <tr>
                    <td>{{$Product->name}}</td>
                    @foreach ($order_items as $order_item)
                        @if ($order_item->product_id === $Product->id)
                            <td>{{$order_item->quantity}}</td>
                        @endif
                    @endforeach
                    <td>{{$Product->price}}</td>
                </tr>

            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-8">
            </div>
            <div class="col-4">
                <table class="table table-sm text-right">
                    <tr>
                        <td><strong>Total HT</strong></td>
                        <td class="text-right">{{$totalPrice}}€</td>
                    </tr>
                    <tr>
                        <td>TVA 0%</td>
                        <td class="text-right">0€</td>
                    </tr>
                    <tr>
                        <td><strong>Total TTC</strong></td>
                        <td class="text-right">{{$totalPrice}}€</td>
                    </tr>
                </table>
            </div>
        </div>

        <p class="conditions">
            En votre aimable règlement
            <br>
            Et avec nos remerciements.
            <br><br>
            Conditions de paiement : paiement à réception de facture, à 15 jours.
            <br>
            Aucun escompte consenti pour règlement anticipé.
            <br>
            Règlement par virement bancaire.
            <br><br>
            En cas de retard de paiement, indemnité forfaitaire pour frais de recouvrement : 40 euros (art. L.4413 et
            L.4416 code du commerce).
        </p>

        <br>
        <br>
        <br>
        <br>

        <p class="bottom-page text-right">
            ISI4WEB SAS - N° SIRET 80897753200015 RCS METZ<br>
            6B, Rue aux Saussaies des Dames - 57950 MONTIGNY-LES-METZ 03 55 80 42 62 - <br>
            IBAN FR76 1470 7034 0031 4211 7882 825 - SWIFT CCBPFRPPMTZ
        </p>
    </div>
</div>
</body>
<style>
    body {
        font-family: 'Roboto', sans-serif;
        background: #ccc;
        padding: 30px;
    }

    .container {
        width: 21cm;
        min-height: 29.7cm;
    }

    .invoice {
        background: #fff;
        width: 100%;
        padding: 50px;
    }

    .logo {
        width: 2.5cm;
    }

    .document-type {
        text-align: right;
        color: #444;
    }

    .conditions {
        font-size: 0.7em;
        color: #666;
    }

    .bottom-page {
        font-size: 0.7em;
    }

</style>
</html>




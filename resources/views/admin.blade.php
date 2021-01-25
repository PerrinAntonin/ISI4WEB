@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-12">
                <div class="cart-title mt-50">
                    <h2>Pannel Admin</h2>
                </div>
                <div class="cart-table clearfix">
                    <table class="table" style="overflow: visible !important;">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Payement type</th>
                            <th>Add</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Products</th>
                            <th>total Price</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($orders as $order)
                            @if($order->getClient()!= null)
                                <tr>
                                    <td class="id">
                                        <span>{{$order->id}}</span>
                                    </td>
                                    <td class="customer_id">
                                        <p>{{$order->getClient()->firstname}} {{$order->getClient()->surname}}</p>
                                    </td>

                                    <td class="payement_type">
                                        <p>{{$order->payment_type}}</p>
                                    </td>
                                    <td class="delivery_add_id">
                                        @if($order->getDeliveryAdd() == null)
                                            <p>Unknow</p>
                                        @else
                                            <p>{{$order->getDeliveryAdd()->add1}}</p>
                                            <p>{{$order->getDeliveryAdd()->city}} {{$order->getDeliveryAdd()->zipCode}} {{$order->getDeliveryAdd()->country}}</p>
                                        @endif

                                    </td>
                                    <td class="date">
                                        <p>{{$order->date}}</p>
                                    </td>
                                    <td>
                                        <select id="status-{{$order->id}}">
                                            <option value="noPayment"
                                                    @if($order->status == "noPayment") selected @endif>No
                                                payment
                                            </option>
                                            <option value="waitCheque"
                                                    @if($order->status == "waitCheque") selected @endif>
                                                Wait cheque
                                            </option>
                                            <option value="payementOk"
                                                    @if($order->status == "payementOk") selected @endif>
                                                Payement receive
                                            </option>
                                            <option value="productSend"
                                                    @if($order->status == "productSend") selected @endif>Products send
                                            </option>
                                            <option value="productReceive"
                                                    @if($order->status == "productReceive") selected @endif>Products
                                                receive
                                            </option>
                                        </select>
                                    </td>
                                    <td class="products">

                                        @foreach($order->getProduct() as $product)
                                            @foreach($order->getItems() as $item)
                                                @if($item->product_id == $product->id)
                                                    <p>{{$item->quantity}}x<a class=""
                                                                              href="{{route("showProduct",$product->id)}}">
                                                            {{$product->name}}</a>
                                                    </p>
                                                @endif
                                            @endforeach

                                        @endforeach
                                    </td>
                                    <td class="total">
                                        <p>{{$order->quantity}} {{$order->total}} €</p>
                                    </td>
                                    <td class="delete">
                                        <a href="{{route('admin.deleteOrder',$order->id)}}"><i class="fa fa-close"></i></a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        @foreach($orders as $order)
            @if($order->getClient()!= null)
                var select{{$order->id}} = document.getElementById('status-{{$order->id}}');
                select{{$order->id}}.onchange = function () {
                    var url = '{{ route("admin.updateOrder", ['id'=>':id', 'value'=>':value']) }}';
                    url = url.replace(':value', select{{$order->id}}.value);
                    url = url.replace(':id', {{$order->id}});
                    window.location.href = url;
                };
            @endif
        @endforeach
    </script>
@endsection

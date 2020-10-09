@extends('main-layout.template')

@section('content')
<div class="container mb-4 mt-4">
    <div class="site-section-heading pt-3 mb-4 text-center">
        <strong>Order History</strong>
    </div>
    <div class="row">
        <div class="col-lg-12 pb-5">
            <!-- Item-->
            @if($transactioncount == 0)
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-body cart">
                        <div class="col-sm-12 empty-cart-cls text-center"> <img src="{{ asset('assets/Icon/empty-box.png') }}" width="130" height="130" class="img-fluid mb-4 mr-3">
                            <h3><strong>Your Order is Empty</strong></h3>
                            <h4>Add something to make me happy :)</h4> <a href="{{ route('Product.All') }}" class="btn btn-primary cart-btn-transform m-3" data-abc="true">continue shopping</a>
                        </div>
                    </div>
                </div>
            </div>
            @else
            @foreach ($all_order as $item)
            <div class="cart-item d-md-flex justify-content-between">
                <div class="px-3 my-3">
                    <a class="cart-item-product" href="#">
                        <div class="cart-item-product-thumb">
                            <img src="https://adminphoenixjewellery.com/{{$item->Product_img_1}}" alt="Product">
                        </div>
                        <div class="cart-item-product-info">
                            <h4 class="cart-item-product-title">Order ID : {{$item->code}}</h4>
                            <h4 class="cart-item-product-title">{{$item->Product_Name}}</h4>
                            <h4 class="cart-item-product-title">Quantity : {{$item->quantity}}</h4>
                            <div class="text-lg text-body font-weight-medium pb-1">@currency($item->grand_total)</div>
                                <span>Shipping Cost: <span class="text-success font-weight-medium"> {{$item->shipping_cost}}</span></span>
                                <span>Order Date: <span class="text-success font-weight-medium">{{$item->order_date}}</span></span>
                        </div>
                    </a>
                </div>
                @if($item->payment_status == "pending")
                    <div class="pull-right text-center"><span class="badge badge-warning" style="font-size:14px;">{{$item->payment_status}}</span> </div>
                @else
                    <div class="pull-right text-center"><span class="badge badge-success" style="font-size:14px;">{{$item->payment_status}}</span> </div>
                @endif
            </div>
            @endforeach
            @endif
            <!-- End Item-->
        </div>
    </div>
</div>
@endsection
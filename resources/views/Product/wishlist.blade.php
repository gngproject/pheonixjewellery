@extends('main-layout.template')

@section('content')
<div class="container mb-4 mt-4">
    @if(session("error"))
        <div class="alert alert-danger">
            {{ session("error") }}
        </div>
    @endif

    @if(session("success"))
        <div class="alert alert-success">
            {{ session("success") }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 text-center pt-4 title mt-2">
            <img src="{{ url('assets/Icon/Title/wishlistlogo.png') }}" class="img-fluid rounded" alt="" srcset="">
        </div>
        <div class="col-lg-12 pb-5">
            <!-- Item-->
            @if($wishlistcount == 0)
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-body cart">
                        <div class="col-sm-12 empty-cart-cls text-center"> <img src="{{ asset('assets/Icon/wishlist.png') }}" width="130" height="130" class="img-fluid mb-4 mr-3">
                            <h3><strong>Your Wishlist is Empty</strong></h3>
                            <h4>Add something to make me happy :)</h4> <a href="{{ route('Product.All') }}" class="btn btn-primary cart-btn-transform m-3" data-abc="true">continue shopping</a>
                        </div>
                    </div>
                </div>
            </div>
            @else
            @foreach ($wishlist_item as $item)
            <div class="cart-item d-md-flex justify-content-between">
                <div class="px-3 my-3">
                    <a class="text-white" href="/wishlist-delete/{{$item->id}}">
                        <button  type="submit"><span class="remove-item"><i class="icon icon-times"></i></span></button>
                      </a>
                    <a class="cart-item-product" href="#">
                        <div class="cart-item-product-thumb">
                            <img src="https://gngdesainproject.com/{{$item->Product_img_1}}" alt="Product">
                        </div>
                        <div class="cart-item-product-info">
                            <h4 class="cart-item-product-title">{{$item->Product_Name}}</h4>
                        @if($item->stock < 1)
                            <div class="text-lg text-body font-weight-medium pb-1">@currency($item->Price)</div>
                                <span>Availability: <span class="text-warning font-weight-medium">Empty Stock</span></span>
                        @else
                            <div class="text-lg text-body font-weight-medium pb-1">@currency($item->Price)</div>
                                <span>Availability: <span class="text-success font-weight-medium">In Stock</span></span>
                        @endif
                        </div>
                    </a>
                </div>
                @if ($item->stock < 1)
                <form action="{{ route('Product.All') }}" class="form-inline">
                    <button class="btn btn-warning btn-block" type="submit" onclick="window.location='{{ route("Product.All") }}'"><i class="icon icon-sign-out"></i> Kembali Belanja</button>
                </form>
                @else
                <form method="POST" action="{{route('cart.add')}}" class="form-inline" >
                    @csrf
                    <input name="productID" type="hidden" value="{{$item->productID}}">
                    <button class="btn btn-success btn-block" type="submit"><i class="icon icon-cart-plus"></i> Add to cart</button>
                </form>
                @endif
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
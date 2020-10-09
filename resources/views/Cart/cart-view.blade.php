@extends('main-layout.template')

@section('content')
<div class="row justify-content-center mt-5" id="title">
    <img src="{{ url('assets/Icon/Title/shoppingCart.png') }}" class="img-fluid rounded" alt="" srcset="">
</div>
<div class="site-wrap">
    <div class="site-section">
        @if(session("error"))
            <div class="alert alert-danger">
                {{ session("error") }}
            </div>
        @endif
        @if(session("success"))
            <div class="alert alert-primary">
                {{ session("success") }}
            </div>
        @endif

        <div class="alert alert-primary d-none" id="msg_div">
            <span id="res_message"></span>
        </div>

        <div class="row" style="background: #fff">
            <div class="site-blocks-table wider shadow col-md-9" style="background: #fff">
                <table class="table">
                    <thead>
                        <td class = "text-center">PRODUK IMAGE</td>
                        <td class = "text-center">DESCRIPTION</td>
                        <td class = "jumlah">QUANTITY</td>
                        <td class = "text-center">PRICE</td>
                        <td class = "text-center">TOTAL</td>
                        <td class = "total"></td>
                    </thead>
                    @if(Cart::isEmpty())
                    <tr>
                        <td colspan="6">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body cart">
                                        <div class="col-sm-12 empty-cart-cls text-center"> <img src="{{ asset('assets/Icon/shopping-cart.png') }}" width="130" height="130" class="img-fluid mb-4 mr-3">
                                            <h3><strong>Your Cart is Empty</strong></h3>
                                            <h4>Add something to make me happy :)</h4> <a href="{{ route('Product.All') }}" class="btn btn-primary cart-btn-transform m-3" data-abc="true">continue shopping</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @else
                    @foreach(Cart::getContent() as $item)
                    <tr class="text-center">
                        <td>
                            <div class="productWrap">
                                <div class="imgWrap">
                                    <img src="https://adminphoenixjewellery.com/{{$item->image}}" class="img-fluid" style="width:200px; height:auto;" alt="" srcset="">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="productDesciption">
                                <p>{{$item->name}}</p>
                                {{-- <div>{{$item->emas_karat}}</div> --}}
                                {{-- <div>Weight : {{$item->weight}} Gram</div> --}}
                                <p><input type="hidden" value="{{$item->quantity}}" id="quantity" name="quantity"></p>
                            </div>
                        </td>
                        <td class="text-left" id="jumlah">
                            <form class="text-left" id="qtyForm" action="javascript:void(0)" method="POST">
                                @csrf
                                <div class="input-group mb-2" style="max-width: 130px;">
                                    {{-- <button type="submit" id="minus_form" class="btn btn-outline-primary">&minus;</button> --}}
                                    <input type="hidden" value="{{$item->id}}" id="id" name="id">
                                    <input type="text" class="form-control text-center" name="quantity" id="quantity" placeholder="1" autocomplete="off" min="1" max="3"/>
                                    <button type="submit" id="plusForm" class="btn btn-outline-primary">&plus;</button>
                                </div>
                            </form>
                        </td>
                        <td class="harga" id="harga">
                            @currency($item->price)
                        </td>
                        <td class="total" id="amount">
                            @currency(\Cart::get($item->id)->getPriceSum())
                        </td>
                        &nbsp;
                        <td>
                            <form action="{{route('cart.remove')}}" method="POST">
                                @csrf
                                <div>
                                    <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                    <button type="submit" class="btn btn-danger"><i class="icon icon-trash"></i></button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </table>

                <table class="table">
                    <tr>
                        <td class="point" name="point" id="point">
                            Anda mendapatkan
                            @if(Cart::getSubTotal() < 1000000)
                                <strong> 0 </strong> point &nbsp;
                            @elseif(Cart::getSubTotal() == 1000000)
                                <strong> 1 </strong> point &nbsp;
                            @elseif(Cart::getSubTotal() > 1000000)
                                <strong> {{ round((Cart::getSubTotal()) / 1000000) }} </strong> point &nbsp;
                            @endif
                        </td>
                        <td class="totalHargaText">
                            <strong>TOTAL : @currency(Cart::getSubTotal())</strong>
                        </td>
                        {{-- <td class="totalHargaText totalHargaInt" id="totalan">
                        </td> --}}
                        <td>
                            <div class="">*Harga Sudah Termasuk Biaya Kirim</div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="card card-cascade card-ecommerce col-md-3">
                <!--Card Body-->
                <div class="card-body card-body-cascade">
                    <!--Card Description-->
                    <div class="card2decs">
                        <p class="quantity">Qty <span class="float-right text1">{{Cart::getTotalQuantity()}} Pcs</span></p>
                        <p class="subtotal">Subtotal<span class="float-right text1">@currency(Cart::getSubTotal())</span></p>
                        <hr/>
                        <p class="vcrcode">Discount<span class="float-right text1"><strong>
                            @foreach($cartConditions as $item)
                                {{ $item->getName() }} ({{ $item->getValue() }})
                            @endforeach
                        </strong></span></p>
                        <p class="total">Total<span class="float-right text1"><strong>@currency(Cart::getTotal())</strong></span></p>
                    </div>
                    @if (!session()->has('voucher'))
                    <div class="card mt-3">
                        <div class="card-body">
                            <form action="{{ route('cart.voucher') }}" method="get">
                                @csrf
                                <div class="form-group"><label>Have coupon?</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control coupon" name="voucherCode" id="voucherCode" placeholder="Coupon code">
                                        <span class="input-group-append">
                                            <button type="submit" class="btn btn-primary btn-apply coupon">Apply</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                    <hr/>
                    @if(Cart::getSubTotal() == 0)
                    <div class="col-md-12 mb-2">
                        {{-- <div class="row">
                            <div class="col-md-12">
                            <button class="btn btn-warning btn-md" onclick="window.location='{{ route('Product.All') }}'">Continue Shopping</button>
                            </div>
                        </div> --}}
                    @else
                        <div class="row">
                            <div class="col-md-12">
                            <button class="btn btn-primary btn-md" onclick="window.location='{{ route('cart.checkout') }}'">Proceed To Checkout</button>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script type="text/javascript">
    if($("#qtyForm").length > 0) {
        $("#qtyForm").validate({
            rules: {
                quantity: {
                    required: true,
                    digits:true,
                    maxlength:3,
                },
            },

            messages: {
                quantity: {
                    required: "Please enter Qty",
                    digits: "Please enter only numbers",
                    maxlength: "Quantity should be 3",
                },
            },

        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#plusForm').html('Sending...');
            $.ajax({
                url: '/Cart-Update',
                type: 'POST',
                data: $('#qtyForm').serialize(),
                success: function( response ){
                    $('#plusForm').html('&plus;');
                    $('#res_message').show();
                    $('#res_message').html(response.msg);
                    $('#msg_div').removeClass('d-none');

                    document.getElementById("qtyForm").reset();
                    setTimeout(function(){
                        $('#res_message').hide();
                        $('#msg_div').hide();
                    }, 10000);
                }
            });
        }
    })
    }
</script>

<script type="text/javascript">
    document.getElementById('jumlah').style.textAlign = "center";
</script>

@endsection
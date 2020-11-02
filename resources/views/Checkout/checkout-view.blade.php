@extends('main-layout.template')

@section('content')

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

<div class="site-section">
    <div class="container" style="background-color: white;">
        <form action="{{ route('checkout.payment') }}" id="payment_form" method="POST" novalidate onsubmit="return checkForm(this);">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-md-12 mb-5 mb-md-0 mt-5">
                    <h2 class="h3 mb-3 text-black">Billing Details</h2>
                    <div class="p-3 p-lg-5 border">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="hidden" class="form-control" id="user_id" name="user_id" placeholder="" value="{{ Sentinel::getUser()->id}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="customer_first_name" class="text-black">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="customer_first_name" name="customer_first_name">
                                <span class="text-danger">{{ $errors->first('customer_first_name') }}</span>
                            </div>
                            <div class="col-md-6">
                                <label for="customer_last_name" class="text-black">Last Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="customer_last_name" name="customer_last_name">
                                <span class="text-danger">{{ $errors->first('customer_last_name') }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="customer_email" class="text-black">Email Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="customer_email" name="customer_email">
                                <span class="text-danger">{{ $errors->first('customer_email') }}</span>
                            </div>
                            <div class="col-md-6">
                                <label for="customer_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="customer_phone" name="customer_phone" placeholder="Phone Number">
                                <span class="text-danger">{{ $errors->first('customer_phone') }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="customer_address" class="text-black">Address <span class="text-danger">*</span></label>
                                <textarea type="text" class="form-control" id="customer_address" name="customer_address" placeholder="Alamat/Jalan" rows="3"></textarea>
                                <span class="text-danger">{{ $errors->first('customer_address') }}</span>
                            </div>
                            <div class="col-md-6">
                                <label for="customer_postcode" class="text-black">Postcode</label>
                                <input type="text" class="form-control" id="customer_postcode" name="customer_postcode" placeholder="Post code">
                                <span class="text-danger">{{ $errors->first('customer_postcode') }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="provinsi" class="text-black">Province</label>
                                <select id='customer_province_id' name="customer_province_id" class="form-control">
                                    <option value="">--Province--</option>
                                    @foreach ($provinces as $province => $value)
                                        <option id='customer_province_id' name='customer_province_id' value="{{ $province }}"> {{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="kota" class="text-black">City</label>
                                <select id="customer_city_id" name="customer_city_id" class="form-control">
                                    <option id="customer_city_id" name="customer_city_id" value="">--City--</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="note" class="text-black">Order Notes</label>
                            <textarea name="note" id="note" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
                            <span class="text-danger">{{ $errors->first('note') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-5">
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Your Order</h2>
                            <div class="p-3 p-lg-5 border">
                                <table class="table site-block-order-table mb-5">
                                    <thead>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody>
                                        @foreach(Cart::getContent() as $item)
                                        <tr>
                                            <td class="cart-item-product-thumb"><img src="https://adminphoenixjewellery.com/{{$item->image}}" style="width:100px; heigt:auto;">
                                                <br/>
                                                {{$item->name}} <strong class="mx-2"> x </strong> {{$item->quantity}}
                                            </td>
                                            <td>@currency($item->price)</td>
                                            <td>
                                                <input type="hidden" class="form-control" id="ProductID" name="ProductID" placeholder="" value="{{$item->id}}" readonly>
                                                <input type="hidden" class="form-control" id="quantity" name="quantity" placeholder="" value="{{$item->quantity}}" readonly>
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                                            <td class="text-black" id="base_total_price" name="base_total_price" value="@currency(Cart::getSubTotal())">@currency(Cart::getSubTotal())</td>
                                            <td><input type="hidden" class="form-control" id="base_total_price" name="base_total_price" placeholder="" value="{{ (Cart::getSubTotal()) }}" readonly></td>
                                        </tr>
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Code Coupon</strong></td>
                                            <td class="text-black"><span class="text-success font-weight-large">
                                                <strong>
                                                    @foreach($cartConditions as $item)
                                                        {{ $item->getName() }} ({{ $item->getValue() }})
                                                    @endforeach
                                                </strong></span>
                                                <input type="hidden" class="form-control" id="code_discount" name="code_discount" value="TEST1234"/>
                                                <input type="hidden" class="form-control" id="discount_amount" name="discount_amount" value="500000"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Biaya Pengiriman</strong></td>
                                            <td class="text-black font-weight-bold"><strong>0</strong></td>
                                            <input type="hidden" class="form-control" id="shipping_cost" name="shipping_cost" value="0"/>
                                        </tr>
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                            <td class="text-black font-weight-bold"><strong>@currency(Cart::getTotal())</strong></td>
                                            <td><input type="hidden" class="form-control" id="grand_total" name="grand_total" placeholder="" value="{{ $cartTotal }}" readonly></td>
                                        </tr>
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Anda akan mendapatkan point : </strong></td>
                                            <td class="text-black font-weight-bold">
                                                <i class="icon icon-diamond"></i>
                                                <strong>
                                                    @if(Cart::getTotal() < 1000000)
                                                        <i class='icon icon-diamond'></i>
                                                            <input type="text" id="customer_point" name="customer_point" style="border:0px; background:none; width:20px; text-align:center;" value="0" readonly> Point
                                                        <p class="text-muted small"> Point Berdasarkan Pembelian.</p>
                                                        @elseif(Cart::getTotal() == 1000000)
                                                        <i class='icon icon-diamond'></i>
                                                            <input type="text" id="customer_point" name="customer_point" style="border:0px; background:none; width:20px; text-align:center;" value="1" readonly> Point
                                                        <p class="text-muted small"> (Point Berdasarkan Pembelian).</p>
                                                        @elseif(Cart::getTotal() > 1000000)
                                                        <i class='icon icon-diamond'></i>
                                                            <input type="text" id="customer_point" name="customer_point" style="border:0px; background:none; width:20px; text-align:center;" value="{{ round((Cart::getTotal()) / 1000000) }}" readonly> Point
                                                        <p class="text-muted small"> (Point Berdasarkan Pembelian).</p>
                                                    @endif
                                                </strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                {{-- <div class="border p-3 mb-3">
                                <h3 class="h6 mb-0">
                                    <a class="d-block" data-toggle="collapse" href="#collapsepilih" role="button" aria-expanded="false" aria-controls="collapsepilih">Pilih Pembayaran</a>
                                </h3>

                                <div class="collapse" id="collapsepilih">
                                    <div class="embed-responsive mb-2">
                                        <div class="row mt-4">
                                            <div class="col-sm-6 p-4 border mb-3" data-toggle="collapse" href="#collapseatm" role="button" aria-expanded="false" aria-controls="collapseatm">
                                                <span><img src="{{ asset('assets/Icon/banktransfer.png') }}" style="width:100px; height:auto;"></span>
                                                <span class="d-block text-primary h6 text-uppercase">ATM/Bank Transfer</span>
                                                <p class="mb-0">Pay From ATM Bersama,Prima or Alto</p>
                                            </div>
                                            <div class="col-sm-6 p-4 border mb-3" data-toggle="collapse" href="#collapsecredit" role="button" aria-expanded="false" aria-controls="collapsecredit">
                                                <span><img src="{{ asset('assets/Icon/mastercard.webp') }}" style="width:100px; height:auto;"></span>
                                                <span class="d-block text-primary h6 text-uppercase">Credit/Debit Card</span>
                                                <p class="mb-0 sprite bca-klikbca">Pay with Visa,MasterCard,JCB or Amex</p>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                {{-- <div class="collapse" id="collapseatm">
                                    <div class="embed-responsive mb-2">
                                        <div class="p-3 p-lg-5 mt-4 border">
                                            <table class="table site-block-order-table mb-5">
                                                <thead>
                                                    <th>Nama Bank</th>
                                                </thead>
                                                <tbody>
                                                    @foreach ($results as $espaybca)
                                                    <tr>
                                                        <td>{{ $espaybca['productName'] }}</td>
                                                        <td>{{ $espaybca['productCode'] }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="collapse" id="collapsecredit">
                                    <div class="embed-responsive mb-2">
                                        <div class="p-3 p-lg-5 mt-4 border">
                                            <table class="table site-block-order-table mb-5">
                                                <thead>
                                                    <th>Bank</th>
                                                </thead>
                                                <tbody>
                                                    @foreach ($results as $espaycc)
                                                    <tr>
                                                        <td>{{ $espaycc['productName'] }}</td>
                                                        <td>{{ $espaycc['productCode'] }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- </div> --}}
                                <div class="col-md-12 text-center">
                                    <form>
                                      <input type="checkbox" name="terms" value="check" id="agree" required/>
                                      <b> Saya Setuju dengan <a href="/Syarat-Ketentuan" target="_blank" style="text-decoration: underline;">Syarat & Ketentuan</a></b>
                                    </form>
                                    <hr/>
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="form_submit_checkout" name="form_submit_checkout" class="btn btn-primary btn-lg py-3 btn-block">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script type="text/javascript">
    if($("#payment_form").length > 0) {
        $("#payment_form").validate({
            rules: {
                customer_first_name: {
                    required: true,
                    minlength:3,
                    maxlength: 50,
                },
                customer_last_name: {
                    required: true,
                    maxlength:50,
                },
                customer_email: {
                    required: true,
                    email:true,
                    maxlength:50,
                },
                customer_phone: {
                    required: true,
                    digits:true,
                    minlength:10,
                    maxlength:12,
                },
                customer_address: {
                    required: true,
                    minlength:10,
                },
                note: {
                    required: true,
                    minlength:10,
                },
            },

            messages: {
                customer_first_name: {
                    required: "<span class='text-danger'>Please enter First Name</span>",
                    minlength: "<span class='text-danger'>The name should be 3 characters</span> ",
                    maxlength: "<span class='text-danger'>Your last name maxlength should be 50 characters long.</span>",
                },
                customer_last_name: {
                    required: "<span class='text-danger'>Please enter Last Name</span>",
                    maxlength: "<span class='text-danger'>Your last name maxlength should be 50 characters long.</span>",
                },
                customer_email: {
                    required: "<span class='text-danger'>Please enter valid email.</span>",
                    email: "<span class='text-danger'>Please enter valid email.</span>",
                    maxlength: "<span class='text-danger'>The email name should less than or equal to 50 characters.</span>",
                },
                customer_phone: {
                    required: "<span class='text-danger'>Please enter contact number</span>",
                    minlength: "<span class='text-danger'>The contact number should be 10 digits</span> ",
                    digits: "<span class='text-danger'>Please enter only numbers</span>",
                    maxlength: "<span class='text-danger'>The contact number should be 12 digits</span> ",
                },
                customer_address: {
                    required: "<span class='text-danger'>Please enter address valid</span> ",
                    minlength: "<span class='text-danger'>Address should be 10 characters</span> ",
                },
                note: {
                    required: "<span class='text-danger'>Please enter order notes</span> ",
                    minlength: "<span class='text-danger'>Address should be 10 characters</span> ",
                },
            },

        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#form_submit_checkout').html('Sending...');
            $.ajax({
                url: '/Checkout-Payment',
                type: 'POST',
                data: $('#payment_form').serialize(),
                success: function( response ){
                    $('#form_submit').html('Submit');
                    $('#res_message').show();
                    $('#res_message').html(response.msg);
                    $('#msg_div').removeClass('d-none');
                    location.assign("https://phoenixjewellery.id/Payment-Inquiry");
                }
            });
        }
    })
    }
</script>

<script>
    $(document).ready(function(){
      $('select[name="customer_province_id"]').on('change', function(){
        let provinceId = $(this).val();
        if(provinceId) {
          jQuery.ajax({
            url: '/province/'+provinceId+'/cities',
            type: "GET",
            dataType:"json",
            success:function(data) {
              $('select[name="customer_city_id"]').empty();
              $.each(data, function(key, value){
                $('select[name="customer_city_id"]').append('<option value="'+ key +'">' + value + '</option>');
              });
            },
          });
        } else {
          $('select[name="customer_city_id"]').empty();
        }
      });
    });
</script>

<script>
    function checkForm(form)
    {
      if(!form.terms.checked) {
        alert("Harap ceklis/tunjukkan bahwa Anda menerima Syarat dan Ketentuan");
        form.terms.focus();
        return false;
      }
      return true;
    }
</script>

@endsection
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

<section class="content">
  {{-- @include("errors/messages") --}}
  <!-- Default box -->
    @foreach ($getData as $dtlitem)
    <div class="card card-solid">
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-sm-6 gallery">
            <h3 class="d-inline-block d-sm-none">{{$dtlitem->Product_Name}}</h3>
            <div class="col-12">
              <img src="https://adminphoenixjewellery.com/{{$dtlitem->Product_img_1}}" class="product-image" alt="Product Image">
            </div>
            <div class="col-12 product-image-thumbs">
              <div class="product-image-thumb">
                <a href="https://adminphoenixjewellery.com/{{$dtlitem->Product_img_2}}" data-lightbox="mygallery">
                  <img src="https://adminphoenixjewellery.com/{{$dtlitem->Product_img_2}}">
                </a>
              </div>
              <div class="product-image-thumb">
                <a href="https://adminphoenixjewellery.com/{{$dtlitem->Product_img_3}}" data-lightbox="mygallery">
                  <img src="https://adminphoenixjewellery.com/{{$dtlitem->Product_img_3}}" alt="Product Image">
                </a>
              </div>
              <div class="product-image-thumb">
                <a href="https://adminphoenixjewellery.com/{{$dtlitem->Product_img_4}}" data-lightbox="mygallery">
                  <img src="https://adminphoenixjewellery.com/{{$dtlitem->Product_img_4}}" alt="Product Image">
                </a>
              </div>
              <div class="product-image-thumb">
                <a href="https://adminphoenixjewellery.com/{{$dtlitem->Product_img_5}}" data-lightbox="mygallery">
                  <img src="https://adminphoenixjewellery.com/{{$dtlitem->Product_img_5}}" alt="Product Image">
                </a>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6">
            <h3 class="my-3">{{$dtlitem->Product_Name}} - {{$dtlitem->productID_view}}</h3>
            <p class="text-small"><strong>Code</strong> : {{$dtlitem->productID_view}}</p>
            {{-- <p class="text-small"> <strong> {{ $Stocklevel }}</strong></p> --}}
            <p class="text-blue small">
              <i class="icon icon-tag"> Pasti Ori</i>
              &nbsp;
                &nbsp;
              <i class="icon icon-archive"> Pasti Ready</i>
              &nbsp;
                &nbsp;
            </p>
            <hr>
            <div class="p-0">
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <p class="text-muted">Type</p>
                </div>
                <div class="col-sm-4 invoice-col">
                  <p><strong>
                    @if($dtlitem->Product_type == '0')
                    {{ $dtlitem->Product_type = 'Diamond Ring' }}

                    @elseif($dtlitem->Product_type == '1')
                    {{ $dtlitem->Product_type = 'Wedding Ring'}}

                    @elseif($dtlitem->Product_type == '2')
                    {{ $dtlitem->Product_type = 'GIA'}}

                    @elseif($dtlitem->Product_type == '3')
                    {{ $dtlitem->Product_type = 'Liontin'}}

                    @elseif($dtlitem->Product_type == '4')
                    {{ $dtlitem->Product_type = 'Anting'}}

                    @elseif($dtlitem->Product_type == '5')
                    {{ $dtlitem->Product_type = 'Cincin'}}

                    @elseif($dtlitem->Product_type == '6')
                    {{ $dtlitem->Product_type = 'Bundle'}}

                    @endif
                  </strong></p>
                </div>
              </div>
            </div>
            <hr>
            <div class="p-0">
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <p class="text-muted">Gender</p>
                </div>
                <div class="col-sm-4 invoice-col">
                  <p><strong>
                    @if($dtlitem->Gender == '3' )
                    {{ $dtlitem->Gender = 'Children' }}

                    @elseif($dtlitem->Gender == '2')
                      {{$dtlitem->Gender = 'Universal'}}

                    @elseif($dtlitem->Gender == '1')
                      {{$dtlitem->Gender = 'Man'}}

                    @elseif($dtlitem->Gender == '0')
                      {{ $dtlitem->Gender = 'Women' }}
                    @endif
                  </strong></p>
                </div>
              </div>
            </div>
            <hr>
            <div class="p-0">
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <p class="text-muted">Stocks</p>
                </div>
                <div class="col-sm-4 invoice-col">
                  <p name="Price" id="Price"><strong>
                    {!! $stockLevel !!}
                  </strong></p>
                </div>
              </div>
            </div>
            <hr>
            <div class="p-0">
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <p class="text-muted">Price</p>
                </div>
                <div class="col-sm-4 invoice-col">
                  <p name="Price" id="Price"><strong>
                    @currency($dtlitem->Price)
                  </strong></p>
                    <i class="icon icon-money text-blue small"> Garansi harga termurah</i>
                </div>
              </div>
            </div>
            <hr>
            <div class="p-0">
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <p class="text-muted">Gold</p>
                </div>
                <div class="col-sm-4 invoice-col">
                  <p name="emas" id="emas"><strong>
                    {{$dtlitem->emas_karat}}
                  </strong></p>
                </div>
              </div>
            </div>
            <div class="p-0">
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <p class="text-muted">Weight</p>
                </div>
                <div class="col-sm-4 invoice-col">
                  <p name="emas" id="emas"><strong>
                    {{$dtlitem->weight}} gram
                  </strong></p>
                </div>
              </div>
            </div>
            <hr>
            <div class="p-0">
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <p class="text-muted">Diamond</p>
                </div>
                <div class="col-sm-4 invoice-col">
                  <p name="berlian1" id="berlian1"><strong>
                    {{$dtlitem->berlian_karat1}} Carats x {{$dtlitem->quantity_berlian1}} Pc(s)
                  </strong></p>
                  @if ($dtlitem->berlian_karat2 != 0.0000)
                  <hr>
                    <p name="berlian2" id="berlian2"><strong>
                      {{$dtlitem->berlian_karat2}} Carats x {{$dtlitem->quantity_berlian2}} Pc(s)
                    </strong></p>
                  @endif
                  @if ($dtlitem->berlian_karat3 != 0.0000)
                    <hr>
                    <p name="berlian3" id="berlian3"><strong>
                      {{$dtlitem->berlian_karat3}} Carats x {{$dtlitem->quantity_berlian3}} Pc(s)
                    </strong></p>
                  @endif
                  @if ($dtlitem->berlian_karat4 != 0.0000)
                    <hr>
                    <p name="berlian4" id="berlian4"><strong>
                      {{$dtlitem->berlian_karat4}} Carats x {{$dtlitem->quantity_berlian4}} Pc(s)
                    </strong></p>
                 @endif
                </div>
              </div>
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <p class="text-muted">Total Carats</p>
                </div>
                <div class="col-sm-4 invoice-col">
                  <p name="total" id="total"><strong>
                    {{$total_berlian}} Carats
                  </strong></p>
                </div>
              </div>
            </div>
            <hr>
            <div class="p-0">
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <p class="text-muted">Diamond Type</p>
                </div>
                @foreach ($gettype as $dtltype)
                <div class="col-sm-4 invoice-col">
                  <p name="colour" id="colour"><strong>
                    Colour : {{$dtltype->colour}}
                  </strong></p>
                  <hr>
                  <p name="clarity" id="clarity"><strong>
                    Clarity : {{$dtltype->clarity}}
                  </strong></p>

                </div>
                @endforeach
              </div>
            </div>
            <hr>
            <!-- /Button -->
            @if(Sentinel::check())
            @if($dtlitem->stock >= 1)
            <div class="btn-group mt-12">
              <div class="row">
                <div class="ml-2">
                  <form method="POST" action="{{route('cart.add')}}" class="form-inline" >
                    @csrf
                    <input name="productID" type="hidden" value="{{$dtlitem->productID}}">
                    <button class="btn btn-success btn-block" type="submit"><i class="icon icon-cart-plus"></i> Add to cart</button>
                  </form>
                </div>
                <div class="ml-2">
                  <a class="text-white" href="/wishlist/{{$dtlitem->productID}}">
                    <button class="btn btn-primary btn-block" type="submit"><i class="icon icon-heart-o"></i> Wishlist</button>
                  </a>
                </div>
              </div>
            </div>
            @elseif($dtlitem->stock <= 1)
              <div class="ml-2">
                <a class="text-white" href="/wishlist/{{$dtlitem->productID}}">
                  <button class="btn btn-primary btn-block" type="submit"><i class="icon icon-heart-o"></i> Wishlist</button>
                </a>
              </div>
            @endif
            @else
            <div class="alert alert-warning" wfd-id="29">
              <strong> Silahkan <a href="{{ url('/login') }}">Masuk</a>
                atau <a href="{{ url('/register') }}">Daftar</a> untuk membeli produk ini.
              </strong>
            </div>
            @endif
            <!-- /End Button -->
            <div class="mt-5 product-share">
              <a href="https://m.facebook.com/ask.phoenixjewel/?tsid=0.8357089745281052&source=result" class="mr-2">
                <i class="icon icon-facebook-square" style="font-size: 40px"></i>
              </a>
              <a href="https://www.instagram.com/phoenixjewelleryid/" class="">
                <i class="icon icon-instagram" style="font-size: 40px"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
</section>
<div class="site-section block-3 site-blocks-2 bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7 site-section-heading text-center pt-4">
        <h2>Featured Products</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="nonloop-block-3 owl-carousel">
          @foreach ($getproducts as $items)
          <div class="item">
            <div class="block-4 text-center">
              <figure class="block-4-image">
                <img src="https://adminphoenixjewellery.com/{{$items->Product_img_1}}" alt="Image placeholder" class="img-fluid">
              </figure>
              <div class="block-4-text p-4">
                <h3><a href="{{ route('Product.Detail',$items->productID) }}">{{$items->Product_Name}}</a></h3>
                <p class="mb-0">{{$items->emas_karat}}</p>
                <p class="text-primary font-weight-bold">@currency($items->Price)</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
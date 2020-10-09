@extends('main-layout.template')

@section('content')

<div id="carouselExampleControls" class="carousel slide mt-0" data-ride="carousel">
    <ol class="carousel-indicators">
    @foreach ($item_carousel as $item)
        <li data-target="#carouselExampleIndicators" data-slide-to="{{$item->advertiseID}}" class="active"></li>
        <!--<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>-->
        <!--<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>-->
    @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach ($item_carousel as $key => $item)
      <div class="carousel-item {{ $key == 0 ? ' active' : '' }}">
        <img class="d-block w-100" style="margin:0;" src="https://adminphoenixjewellery.com/{{ $item->advertise_img}}" alt="First slide">
      </div>
      @endforeach
      <!--<div class="carousel-item">-->
      <!--  <img class="d-block w-100" src="{{ url('/assets/ContentSlider/slider2.png')}}" alt="Second slide">-->
      <!--</div>-->
      <!--<div class="carousel-item">-->
      <!--  <img class="d-block w-100" src="{{ url('/assets/ContentSlider/slider3.png')}}" alt="Third slide">-->
      <!--</div>-->
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>

<div class="site-section">
    <div class="container">
        <div class="row justify-content-center mb-6">
            <div class="col-md-7 text-center pt-4 title">
                <img src="{{ url('assets/Icon/Title/product.png') }}" class="img-fluid rounded" alt="" srcset="">
            </div>
        </div>
        <div class="mt-4">
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
        </div>
        <div class="row mb-6" style="background-color: #fff;">
            <div class="col-md-12 order-2">
                <div class="row">
                    <div class="col-md-12 mb-5 mt-5">
                        <div class="float-md-left mb-4"><h2 class="text-black h5">Ring Product</h2></div>
                        <div class="d-flex">
                            <div class="dropdown mr-1 ml-md-auto">
                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuReference" data-toggle="dropdown">Reference</button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                    <li class="dropdown-item">@sortablelink('Product_Name','Name, A to Z')</li>
                                    <li class="dropdown-item">@sortablelink('Product_Name','Name, Z to A')</li>
                                    <div class="dropdown-divider"></div>
                                    <li class="dropdown-item">@sortablelink('Price', 'Price, Low to High')</li>
                                    <li class="dropdown-item">@sortablelink('Price', 'Price, High to Low')</li>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    @foreach ($items as $item)
                    <div class="col-sm-6 col-lg-4 mb-5 mt-5" data-aos="fade-up">
                        <figure class="block-4-image text-center">
                            <a href="#"><img src="{{ url('assets/logo/LogoBlackText.png') }}" alt="Image placeholder"
                                class="img-fluid" style="width: 150px; height: auto;">
                            </a>
                        </figure>
                        <div class="block-4 text-center border">
                            <figure class="block-4-image">
                                <a href="{{ route('Product.Detail',$item->productID) }}"><img src="https://adminphoenixjewellery.com/{{$item->Product_img_1}}" alt="Image placeholder" class="img-fluid"></a>
                            </figure>
                            <div class="block-4-text p-4">
                                <h3>
                                    <a href="{{ route('Product.Detail',$item->productID) }}">{{$item->Product_Name}}</a>
                                </h3>
                                <p class="mb-0">{{$item->emas_karat}}</p>
                                <p class="text-primary font-weight-bold">@currency($item->Price)</p>
                                @if($item->stock >=1 )
                                <form method="POST" action="{{route('cart.add')}}" class="form-inline">
                                    @csrf
                                    <input name="productID" type="hidden" value="{{$item->productID}}">
                                    <div class="col">
                                        <div class="row">
                                            <button type="submit" class="col-sm-12 buy-now btn btn-sm btn-primary">Add To Cart</button>
                                        </div>
                                    </div>
                                </form>
                                @elseif($item->stock <= 1)
                                    <div class="alert alert-warning col-sm-12">Stock Kosong</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="row text-center" data-aos="fade-up">
                    <div class="col-12 text-center">
                        {{ $items->links() }}
                        Displaying {{$items->count()}} of {{ $items->total() }} product(s).
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
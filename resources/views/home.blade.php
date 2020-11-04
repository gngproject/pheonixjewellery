@extends('main-layout.template')

<style type="text/css">
.title img{
    width:auto;
    height: 200px;
    margin-bottom: 3%;
}

.title {
 justify-content: center;
 text-align: center;
}

.responsive {
    position: center;
    max-width: 100%;
    display: block;
    height: 100%;
}

</style>



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
        <img class="d-block w-100" style="margin:0; width:720px; height:500px" src="https://adminphoenixjewellery.com/{{ $item->advertise_img}}" alt="First slide">
      </div>
      @endforeach
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

 <div class="container">
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


<div class="site-section block-3 site-blocks-2 bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="mx-auto title">
            <img src="{{ asset('assets/Icon/Title/try something new.png') }}" class="responsive" alt="" srcset="">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 ">
            <div id="slider" class="nonloop-block-3 owl-carousel">
                @foreach ($item_slider as $item)
                <div class="slides">
                    <div class="box">
                        <div class="innerTop" >
                            <div >
                                <img  src="{{ asset('assets/logo/LogoBlackText.png') }}" alt="">
                            </div>
                        </div>
                        <br/>
                        @if($item->Product_img_1==NULL)
                            <div class="fotoProduct">
                                <img src="{{ asset('assets/Product/default.png') }}" alt="" srcset="">
                            </div>
                        @else
                            <div class="fotoProduct">
                                <a href="{{ route('Product.Detail',$item->productID) }}">
                                    <img class="img-fluid" src="https://adminphoenixjewellery.com/{{ $item->Product_img_1}}" alt="" style="width:70%; height:auto;">
                                </a>
                            </div>
                        @endif
                        <div class="keterangan">
                            <div class="namaProduct">{{$item->Product_Name}}</div>
                            <div class="hargaProduct">
                                <Strong>@currency($item->Price)</Strong>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
      </div>
    </div>
</div>

<div class="site-section site-blocks-2">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="mx-auto title">
                <img src="{{ url('assets/Icon/Title/product.png') }}" alt="" srcset="">
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-sm-3" data-aos="fade" data-aos-delay="100">
                <a href="{{ url('/Product-All') }}">
                    <figure class="image">
                        <img src="{{ asset('assets/Product/product (1).png') }}" class="img-fluid">
                    </figure>
                </a>
            </div>
            <div class="col-sm-3" data-aos="fade" data-aos-delay="100">
                <a href="{{ url('/Product-Bundle') }}">
                    <figure class="image">
                        <img src="assets/Product/product (2).png" class="img-fluid">
                    </figure>
                </a>
            </div>
            <div class="col-sm-3" data-aos="fade" data-aos-delay="100">
                <a href="{{ url('/Customize-Product') }}">
                    <figure class="image">
                        <img src="assets/Product/product (3).png" class="img-fluid">
                    </figure>
                </a>
            </div>
            <div class="col-sm-3" data-aos="fade" data-aos-delay="100">
                <a href="{{ url('/Special-Product') }}">
                    <figure class="image">
                        <img src="assets/Product/product (4).png" class="img-fluid">
                    </figure>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="mx-auto title row justify-content-center mb-5">
    <a href="{{ url('/How-To-Use') }}">
        <img src="assets/Icon/Buton-tutor.png" class="responsive"/>
    </a>
</div>


<script src="{{ url('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ url('js/sliderTrySomeNew.js') }}"></script>

@endsection
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

<div class="site-section site-blocks-2">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center pt-4 title">
                <img src="{{ url('assets/Icon/Title/product.png') }}" class="img-fluid rounded" alt="" srcset="">
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-sm-3" data-aos="fade" data-aos-delay="100">
                <a href="{{ url('/TrySomethingNew/Ring') }}">
                <figure class="image">
                    <img src="{{ url('assets/TrySomeNew/try (1).png') }}" class="img-fluid" style="box-shadow: 10px 10px 8px #888888;">
                </figure>
                </a>
            </div>
            <div class="col-sm-3" data-aos="fade" data-aos-delay="100">
                <a href="{{ url('/TrySomethingNew/Liontin') }}">
                <figure class="image">
                    <img src="{{ url('assets/TrySomeNew/try (2).png') }}" class="img-fluid" style="box-shadow: 10px 10px 8px #888888;">
                </figure>
                </a>
            </div>
            <div class="col-sm-3" data-aos="fade" data-aos-delay="100">
                <a href="#">
                <figure class="image">
                    <img src="{{ url('assets/TrySomeNew/try (3).png') }}" class="img-fluid" style="box-shadow: 10px 10px 8px #888888;">
                </figure>
                </a>
            </div>
            <div class="col-sm-3" data-aos="fade" data-aos-delay="100">
                <a href="#">
                <figure class="image">
                    <img src="{{ url('assets/TrySomeNew/try (4).png') }}" class="img-fluid" style="box-shadow: 10px 10px 8px #888888;">
                </figure>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
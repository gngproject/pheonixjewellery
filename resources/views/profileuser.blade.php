@extends('main-layout.template')

@section('content')
<div class="container mb-4 mt-4">
    <div class="row">
        <div class="col-lg-12 pb-5">
            <!-- Account Sidebar-->
            <div class="author-card pb-3">
                <div class="author-card-cover" style="background-image: url(https://bootdey.com/img/Content/flores-amarillas-wallpaper.jpeg);"></div>
                <div class="author-card-profile">
                    <div class="author-card-avatar">
                        <div class="author-card-avatar"><img src={{ Sentinel::getUser()->photo}} alt="Daniel Adams"></div>
                    </div>
                    <div class="author-card-details">
                        <h5 class="author-card-name text-lg mt-2">{{ Sentinel::getUser()->name }}</h5>
                        <span class="author-card-position">{{ Sentinel::getUser()->userID }}</span>
                        <span class="author-card-position">Joined {{ Sentinel::getUser()->created_at }}</span>
                    </div>
                </div>
                <span class="ml-4"><button type="submit" class="btn btn-primary" onclick="window.location='{{ route('profile.update',Sentinel::getUser()->id) }}'">Edit Profile</button></span>
            </div>
            <div class="wizard">
                <nav class="list-group list-group-flush">
                    <a class="list-group-item" href="#">
                        <i class="icon icon-map-marker text-muted"></i>Address
                        <p class="list-group-item">{{ Sentinel::getUser()->alamat}}</p>
                    </a>
                    <a class="list-group-item" href="#">
                        <i class="icon icon-phone text-muted"></i>Phone
                        <p class="list-group-item">{{ Sentinel::getUser()->telp}}</p>
                    </a>
                    <a class="list-group-item" href="#">
                        <i class="icon icon-mail_outline text-muted"></i>Email
                        <p class="list-group-item">{{ Sentinel::getUser()->email}}</p>
                    </a>
                    <a class="list-group-item" href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><i class="icon icon-diamond mr-1 text-muted"></i>
                                <div class="d-inline-block font-weight-medium text-uppercase">My Point</div>
                            </div><span class="badge badge-success" style="font-size:14px;">{{ $pointcount }}</span>
                        </div>
                    </a>
                    <a class="list-group-item" href="{{ url('/Order-History') }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><i class="icon icon-shopping-bag mr-1 text-muted"></i>
                                <div class="d-inline-block font-weight-medium text-uppercase">Orders</div>
                            </div><span class="badge badge-primary" style="font-size:14px;">{{ $transactioncount }}</span>
                        </div>
                    </a>
                    <a class="list-group-item" href="{{ url('/Wishlist') }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><i class="icon icon-heart mr-1 text-muted"></i>
                                <div class="d-inline-block font-weight-medium text-uppercase">My Wishlist</div>
                            </div><span class="badge badge-danger" style="font-size:14px;">{{ $wishlistcount }}</span>
                        </div>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
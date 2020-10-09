@extends('main-layout.template')

@section('content')
<div class="site-section">
    <div class="container" style="background-color: white;">
        <div class="row">
            <div class="col-md-12">
                <div class="p-3 p-lg-5">
                    <div class="border p-4 rounded mb-5" role="alert">
                        Your Email : {{ $user->email }}
                        Please Reset Your Password.
                    </div>
                    <div class="col-md-12 mb-4 text-center">
                        <h2 class="h3 mb-3 text-black">Reset Password</h2>
                    </div>

                    @if(count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        {{-- <div class="alert alert-danger">
                            {{ session("error") }}
                        </div> --}}
                    @endif

                    <form class="mt-2" action="{{ url('/reset-password/'.$user->email.'/'.$code) }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="password" class="text-black">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="confrim_password" class="text-black">Confrim Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-primary btn-lg btn-block" value="RESET">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

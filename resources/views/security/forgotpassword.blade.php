@extends('main-layout.template')

@section('content')
<div class="site-section">
    <div class="container" style="background-color: white;">
        <div class="row">
            <div class="col-md-12">
                <div class="p-3 p-lg-5">
                    <div class="col-md-12 mb-4 text-center">
                        <h2 class="h3 mb-3 text-black">Forgot Password</h2>
                    </div>
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

                    <form action="{{ url('/forgot_password') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="email" class="text-black">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-primary btn-lg btn-block" value="SUBMIT">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
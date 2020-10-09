@extends('main-layout.template')

@section('content')

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <span class="login100-form-title p-b-49">
                Login
            </span>
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
            <form class="login100-form validate-form" action="{{ url('/login') }}" method="post">
                @csrf
                <div class="wrap-input100 validate-input m-b-23" data-validate = "Email is required">
                    <span class="label-input100">Email <span class="text-danger">*</span></span>
                    <input class="input100" type="text" id="email" name="email" placeholder="Type your email" required>
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <span class="label-input100">Password <span class="text-danger">*</span></span>
                    <input class="input100" type="password" id="password" name="password" placeholder="Type your password" required>
                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                </div>
                <div class="text-right p-t-8 p-b-31">
                    <a href="{{ url('/forgot_password') }}">
                        Forgot password?
                    </a>
                </div>
                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <input type="submit" class="btn login100-form-btn" value="LOGIN">
                    </div>
                </div>
            </form>
            <div class="txt1 text-center p-t-54 p-b-20">
                <span>
                    Or Sign Up Using
                </span>
            </div>
            <div class="flex-c-m">
                <div class="wrap-login100-form-btn">
                    <div class="login100-form-bgbtn"></div>
                    <button class="login100-form-btn" onclick="window.location.href='{{ url('/register') }}'">
                        Register
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>



    @if(session()->has('message'))
        <script>
            alert('{{session('message')}}');
        </script>
    @endif

    <script src="{{ url('js/userRegisterValidation.js') }}"></script>

@endsection
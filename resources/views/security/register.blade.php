@extends('main-layout.template')

@section('content')

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <span class="login100-form-title p-b-49">
                Register
            </span>
            <form id="register" class="login100-form validate-form" action="{{ url('/register') }}" method="post">
                @csrf
                <div class="wrap-input100 validate-input m-b-23" data-validate = "Name is required">
                    <span class="label-input100">Full Name <span class="text-danger">*</span></span>
                        <input class="input100" type="text" id="name" name="name" placeholder="Your Full Name" required>
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-23" data-validate = "Email is required">
                    <span class="label-input100">Email <span class="text-danger">*</span></span>
                        <input class="input100" type="text" id="email" name="email" placeholder="Type your email" required>
                    <span class="focus-input100" data-symbol="&#xf15a;"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-23" data-validate="Password is required">
                    <span class="label-input100">Password <span class="text-danger">*</span></span>
                        <input class="input100" type="password" id="password" name="password" placeholder="Type your password" required>
                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-23" data-validate = "address is required">
                    <span class="label-input100">Address <span class="text-danger">*</span></span>
                    <input class="input100" type="text" id="alamat" name="alamat" placeholder="Your Valid Address" required>
                    <span class="focus-input100" data-symbol="&#xf175;"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-23" data-validate = "Number Phone is required">
                    <span class="label-input100">Phone <span class="text-danger">*</span></span>
                    <input class="input100" type="text" id="telp" name="telp" placeholder="Your Valid Number Phone" required>
                    <span class="focus-input100" data-symbol="&#xf2cc;"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-23" data-validate = "Gender is required">
                    <span class="label-input100">Gender</span>
                    <div class="col-md-12 mb-2 mt-2 d-flex">
                        <div class="mr-3">
                            <input type="radio" name="gender" id="Male" value="1">
                            <span class="label-input100">Male</span>
                        </div>
                        <div>
                            <input type="radio" name="gender" id="Female" value="2">
                            <span class="label-input100">Female</span>
                        </div>
                    </div>
                </div>

                <div class="txt1 text-center p-t-54 p-b-20"></div>
                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <input type="submit" class="btn login100-form-btn" value="REGISTER" onclick="return confirm('Are you sure this data?')">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script type="text/javascript">
    if($("#register").length > 0) {
        $("#register").validate({
            rules: {
                name: {
                    required: true,
                    minlength:3,
                    maxlength: 50,
                },
                email: {
                    required: true,
                    email:true,
                    maxlength:50,
                },
                password: {
                    required: true,
                    minlength:6,
                },
                telp: {
                    required: true,
                    digits:true,
                    minlength:10,
                    maxlength:12,
                },
                alamat: {
                    required: true,
                    minlength:10,
                },
            },

            messages: {
                name: {
                    required: "<span class='text-danger'>Please enter Name</span>",
                    minlength: "<span class='text-danger'>The name should be 3 characters</span> ",
                    maxlength: "<span class='text-danger'>Your last name maxlength should be 50 characters long.</span>",
                },
                email: {
                    required: "<span class='text-danger'>Please enter valid email.</span>",
                    email: "<span class='text-danger'>Please enter valid email.</span>",
                    maxlength: "<span class='text-danger'>The email name should less than or equal to 50 characters.</span>",
                },
                password: {
                    required: "<span class='text-danger'>Please enter valid password.</span>",
                    email: "<span class='text-danger'>Please enter valid password.</span>",
                    maxlength: "<span class='text-danger'>The password should be Min:6 characters.</span>",
                },
                telp: {
                    required: "<span class='text-danger'>Please enter phone number</span>",
                    minlength: "<span class='text-danger'>The phone number should be 10 digits</span> ",
                    digits: "<span class='text-danger'>Please enter only numbers</span>",
                    maxlength: "<span class='text-danger'>The phone number should be 12 digits</span> ",
                },
                alamat: {
                    required: "<span class='text-danger'>Please enter address valid</span> ",
                    minlength: "<span class='text-danger'>Address should be 10 characters</span> ",
                },
            },

        })
    }
</script>


    @if(session()->has('message'))
        <script>
            alert('{{session('message')}}');
        </script>
    @endif

    <script src="{{ url('js/userRegisterValidation.js') }}"></script>

@endsection
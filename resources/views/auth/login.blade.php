@extends('layouts.frontend.app')

@section('title', 'Login')

@push('css')

    <!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="{{ asset('assets/frontend/css/auth/styles.css') }}" rel="stylesheet">



    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">


    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href="{{ asset('assets/frontend/css/auth/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/auth/custom.css') }}" rel="stylesheet">

    <!-- fonts.google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;400&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #fff;
        }


        @media (min-width: 1200px) {
            /* footer {
            position: fixed;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1030; */
        }
        }

    </style>
    <!-- <style>
                html,
                body {
                    background-image: url('https://images.unsplash.com/photo-1545529468-42764ef8c85f?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1173&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1080&fit=max');
                    background-size: cover;
                    background-repeat: no-repeat;
                    height: 100%;
                }

                .container {
                    height: 100%;
                    align-content: center;
                }

                .card {
                    height: 370px;
                    margin-top: auto;
                    margin-bottom: auto;
                    width: 400px;
                    background-color: rgba(185, 185, 185, 0.5) !important;
                }

                .social_icon span {
                    font-size: 60px;
                    margin-left: 10px;
                    color: #FFC312;
                }

                .btn {
                    background-color: #ffd900c5;
                    color: rgb(255, 255, 255);
                    width: 100px;
                    margin-right: 10px;

                }

                .social_icon span:hover {
                    color: white;
                    cursor: pointer;
                }

                .card-header h3 {
                    color: white;
                }

                .social_icon {
                    position: absolute;
                    right: 20px;
                    top: -45px;
                }

                .input-group-prepend span {
                    width: 100px;
                    background-color: #FFC312;
                    color: black;
                    border: 0 !important;
                }

                input:focus {
                    outline: 0 0 0 0 !important;
                    box-shadow: 0 0 0 0 !important;

                }

                .remember {
                    color: white;
                }

                .remember input {
                    width: 20px;
                    height: 20px;
                    margin-left: 15px;
                    margin-right: 5px;
                }

                .login_btn {
                    color: black;
                    background-color: #3995eb;
                    width: 100px;
                }

                .login_btn:hover {
                    color: black;
                    background-color: white;
                }

                .links {
                    color: #e6e6ee;
                }

                .links a {
                    margin-left: 4px;
                   
                }
              

            </style> -->
@endpush

@section('content')

    <!-- <div class="slider display-table center-text">
            <h1 class="title display-table-cell"><b>LOGIN</b></h1>
        </div>slider -->

    <body>

        <div class="login">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-12 col-sm-6">
                        <img src="{{ asset('assets/frontend/images/undraw_friends_r511.svg') }}" alt="" srcset="">
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="text-center my-5">

                        </div>
                        <div class="card mb-5 mx-auto">

                            <div class="card-body">
                                <h3 class="h3 text-center">Sign In</h3>
                                <form method="POST" class="my-3 login-form" action="{{ route('login') }}"
                                    aria-label="{{ __('Login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="Email">Email address</label>
                                        <input id="email" type="email" placeholder="E-mail Address"
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="email" value="{{ old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="Password">Password</label>
                                        <span toggle="#password"
                                            class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        <input id="password" type="password" placeholder="password"
                                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password" required>
                                        

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif

                                    </div>


                                    <div class="form-group row">
                                        <div class="col-12 col-md-6 ">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 text-right">
                                            <a class="color2 a-signin" href="{{ route('password.request') }}">Forgot your
                                                password?</a>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <button type="submit" class="btn btn-first w-100">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                </form>

                                <div class="col-md-12 ">
                                    <div class="d-flex justify-content-center links">
                                        Don't have an account? <a class="color2 a-signin"
                                            href="{{ route('register') }}">Sign Up</a>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        </div>
    </body><!-- section -->


@endsection

@push('js')

    <script>
        $(".toggle-password").click(function() {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
@endpush

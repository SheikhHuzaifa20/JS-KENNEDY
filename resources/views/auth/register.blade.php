@extends('layouts.app')
@section('content')
    <style>
        /* Banner Section */
        .banner {
            background: linear-gradient(120deg, #1a1a1a, #333);
            color: #fff;
            text-align: center;
            padding: 80px 20px;
            border-radius: 0 0 30px 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .banner h1 {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .banner p {
            font-size: 16px;
            color: #e0e0e0;
            max-width: 650px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Form Section */
        .login-pg-forms {
            padding: 80px 0;
            background: #f9f9f9;
        }

        .rgster-login-form {
            background: #fff;
            border-radius: 12px;
            padding: 40px 50px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .rgster-login-form:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .rgster-login-form h2 {
            font-weight: 700;
            font-size: 26px;
            margin-bottom: 10px;
            color: #1a1a1a;
            text-align: center;
        }

        .rgster-login-form p {
            text-align: center;
            color: #777;
            font-size: 15px;
            margin-bottom: 30px;
        }

        /* Input Fields */
        .rgster-login-form input[type="text"],
        .rgster-login-form input[type="email"],
        .rgster-login-form input[type="password"] {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .rgster-login-form input:focus {
            outline: none;
            border-color: #080d11;
            background: #fff;
            box-shadow: 0 0 5px rgba(255, 213, 0, 0.4);
        }

        /* Error Messages */
        .invalid-feedback {
            color: #d33;
            font-size: 13px;
            margin-top: -10px;
            margin-bottom: 10px;
            display: block;
        }

        /* Submit Button */
        .form-btn {
            width: 100%;
            background: #1a1a1a;
            color: #fff;
            border: none;
            padding: 12px 0;
            font-weight: 600;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            text-transform: uppercase;
            transition: 0.3s ease;
        }

        .form-btn:hover {
            background: #004c17;
            color: white;
        }

        /* Return Link */
        .rgster-login-form a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #1a1a1a;
            font-weight: 500;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .rgster-login-form a:hover {
            color: #004c17;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .rgster-login-form {
                padding: 30px 25px;
            }

            .banner h1 {
                font-size: 32px;
            }

            .banner p {
                font-size: 14px;
            }
        }

        .login {
            display: flex;
            align-items: baseline;
            gap: 10px;
        }
    </style>


    <main class="my-cart">
        <!-- banner start -->
        <section class="hm-banner inner-banners" id="registerbanner">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="main-book-sldier">
                            <div class="inner-banner-heading">
                                <h1>Register</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- banner end -->

        <div class="login-pg-forms">
            <div class="container">
                <div class="col-md-12">
                    <div class="row" style="justify-content: center">
                        <div class="col-md-6 col-sm-offset-3">
                            <div class="rgster-login-form">
                                <h2>Create Account</h2>
                                <form class="loginForm" method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <input type="text" name="name" placeholder="First name" required>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                    <input type="text" name="email" placeholder="Email" required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif

                                    <input type="password" name="password" placeholder="Password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif

                                    <input type="password" name="password_confirmation" placeholder="Confirm Password"
                                        required>

                                    <button class="form-btn" type="submit">create my Account</button>
                                </form>

                                <hr>
                                <div class="login"> If you have an account <a href="{{ url('login') }}">Login</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('css')
        <style type="text/css">

        </style>
    @endsection
    @section('js')
        <script type="text/javascript">
            $(document).on('click', ".btn1", function(e) {
                $('.loginForm').submit();
            });
        </script>
        <script>
            const images = [
                "asset/images/banner-back-1.png",
                "asset/images/banner-back-2.png",
                "asset/images/banner-back-3.png",
            ];

            const registerbanner = document.getElementById("registerbanner");
            let i = 0;


            registerbanner.style.backgroundImage = `url(${images[i]})`;

            setInterval(() => {
                i = (i + 1) % images.length;
                registerbanner.style.backgroundImage = `url(${images[i]})`;
            }, 6000);
        </script>
    @endsection

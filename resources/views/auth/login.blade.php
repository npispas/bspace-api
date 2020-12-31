@extends('layouts.app')

@section('content')
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div class="db-wrapper">

        <!-- pagheader start -->
        <div class="pageheader">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="pageheader-caption">
                            <h1 class="pageheader-caption-title">Dashboard Login Form</h1>
                            <p class="pageheader-caption-text">Bootstrap Login Examples. Nunc varius nibh nisl, ut rhoncus quam efficitur quis. Donec viverra tellus antonvallis eu. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- pagheader close -->

        <div class="space-lg space-md space-xs">
            <div class="container">
                <div class="row">
                    <div class="offset-xl-3 col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                        <!-- login form start -->
                        <div class="login-form">
                            <div class="login-form-body">
                                <h4 class="login-form-title">Login</h4>
                                <form method="POST" action="login">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" aria-describedby="email" placeholder="example@gmail.com" required="">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="*************">
                                        <span toggle="#password" class="fa fa-fw fa-eye password-hide-icon showhidepassword"></span>
                                        <small>Must be 8-20 characters long.</small>

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                                </form>
                                <div class="login-remember-password-block">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="rememberme">
                                        <label class="custom-control-label" for="rememberme">Remember Me</label>
                                    </div>
                                    <div class="forgot-password-link">
                                        <a href="forget-password-page.html"> Forgot Password?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- login form close -->
                    </div>
                </div>
            </div>
        </div>

        <!-- footer start -->
        <div class="db-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="db-footer-copyright">
                            <p class="db-footer-copyright-text">2020 &nbsp;©&nbsp; <a href="index.html"> Spacely</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer close -->

    </div>
@endsection

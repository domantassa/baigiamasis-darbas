@extends('layouts.auth')

@section('content')
<div class="bg-image" style="background-image: url('{{ asset('media/photos/photo6@2x.jpg')}}');">
<div class="hero-static bg-white-90">
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <!-- Sign Up Block -->
                <div class="block block-themed block-fx-shadow mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">Create Account</h3>
                        <div class="block-options">
                            <a class="btn-block-option font-size-sm" href="" data-toggle="modal" data-target="#one-signup-terms"></a>
                            <a class="btn-block-option" href="{{ route('login') }}" data-toggle="tooltip" data-placement="left" title="Sign In">
                                <i class="fa fa-sign-in-alt"></i>
                            </a>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="p-sm-3 px-lg-4 py-lg-5">
                            <h1 class="mb-2">Hello</h1>
                            <p>Please fill the following details to create a new account.</p>

                            <!-- Sign Up Form -->
                            <!-- jQuery Validation (.js-validation-signup class is initialized in js/pages/op_auth_signup.min.js which was auto compiled from _es6/pages/op_auth_signup.js) -->
                            <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            <form class="js-validation-signup" action="{{ route('register') }}" method="POST">
                                <div class="py-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg form-control-alt {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-lg form-control-alt {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="password" type="password" class="form-control form-control-lg form-control-alt {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="Password" >
                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        
                                        <input type="password" type="password" class="form-control form-control-lg form-control-alt {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password-confirmation" name="password_confirmation" placeholder="Repeat password">
                                        
                                    </div>
                                    
                                    
                                        
                                        
                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 col-xl-5">
                                        <button type="submit" class="btn btn-block btn-primary">
                                             Sign Up
                                        </button>
                                    </div>
                                </div>
                                @csrf
                            </form>
                            <!-- END Sign Up Form -->
                        </div>
                    </div>
                </div>
                <!-- END Sign Up Block -->
            </div>
        </div>
    </div>
    
</div>
@endsection
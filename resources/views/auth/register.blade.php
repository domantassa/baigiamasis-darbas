@extends('layouts.auth')

@section('content')

<div class="bg-image login-bg" style="background-image: url('{{ asset('media/photos/photo6@2x.jpg')}}');" >
    <div class="hero-static bg-white-90">
        
            <div class="row cont justify-content-center m-0">
            <div class="col-7 p-0 login-cover hide-md" style=";background-image: url('{{ asset('media/photos/vector.png')}}');">
            a
            </div>
                <div class="col-md-5 p-0 m-0  block block-themed align-items-center" style="background: #FFFFFF">
                    <!-- Sign In Block -->
                    <div class="row m-0 align-items-center">
                    <div class="col-12 p-0">
                    <div class=" mb-0" >
                       <!-- <div class="block-header">
                            <h3 class="block-title">Log In</h3>
                            <div class="block-options">
                                <a class="btn-block-option font-size-sm" href="{{ route('password.request') }}">Forgot Password?</a>
                                <a class="btn-block-option" href="{{ route('register') }}" data-toggle="tooltip" data-placement="left" title="New Account">
                                    <i class="fa fa-user-plus"></i>
                                </a>
                            </div>
                        </div>
                        -->
                        <div class="block-content" >
                            <div class="p-sm-3 px-lg-4 py-lg-5">
                                <h1 class="mb-2" style="text-align: center; font-family: 'Poppins', sans-serif;">Registracija</h1>
                                <!--<p>Welcome, please login.</p>-->

                                <!-- Sign In Form -->
                                <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js) -->
                                <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                <form class="js-validation-signup" action="{{ route('register') }}" method="POST">
                                <div class="py-3">
                                    <div class="form-group">
                                        <input type="text" style="text-align: center;" class="mx-auto form-control login-input  {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert" style="text-align: center">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="email" style="text-align: center;" class="mx-auto form-control login-input  {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert" style="text-align: center">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="password" type="password" style="text-align: center;" class="mx-auto form-control login-input  {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="Password" >
                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert" style="text-align: center">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        
                                        <input type="password" type="password" style="text-align: center;" class="mx-auto form-control login-input  {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password-confirmation" name="password_confirmation" placeholder="Repeat password">
                                        
                                    </div>
                                    

                                    <div class="custom-form-group" style="text-align: center;" >
                                        <select name="plan"  class=" minimal btn-round form-btn" style="width:auto" >
                                        <option> 8 darbai</option > 
                                        <option> Hidrosfera</option >   
                                        <option> Ekosfera</option >   
                                        <option> Atmosfera</option >   
                                                     
                                        </select>
                                    </div>
                                    
                                    
                                    
                                        
                                        
                                    
                                </div>
                                <div class="form-group row">
                                        <div class="col-md-6 col-xl-5 mx-auto" style='text-align:center;border: grey'>
                                            <button type="submit" class=" btn btn-round btn-primary btn-green ">
                                                Priregistruoti
                                            </button>
                                        </div>
                                    </div>
                                    
                                @csrf
                            </form>
                                <!-- END Sign In Form -->
                            </div>
</div>
</div>
                        </div>
                    </div>
                    <!-- END Sign In Block -->
                </div>
            </div>
        
        
    </div>
</div>

@endsection
@extends('layouts.auth')

@section('content')

<div class="bg-image login-bg" style="background-image: url('{{ asset('media/photos/photo6@2x.jpg')}}');" >
    <div class="hero-static bg-white-90">
        
            <div class="row cont justify-content-center m-0">
            <div class="col-7 p-0 login-cover hide-md" style=";background-image: url('{{ asset('media/vectors/Login-amico.svg')}}');">
            <div style='padding:25px'><img class="brand-logo " src="{{asset('media/logos/reklamos-ekosistema-logo.png')}}"></div>
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
                                <h1 class="mb-2" style="text-align: center; font-family: 'Poppins', sans-serif;">Prisijungimas</h1>
                                <!--<p>Welcome, please login.</p>-->

                                <!-- Sign In Form -->
                                <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js) -->
                                <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                <form class="js-validation-signin" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="pt-3">
                                        <div class="form-group" >
                                            <!--form-control form-control-alt form-control-lg -->
                                            <input type="text" style="text-align: center;" class="mx-auto form-control login-input {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="Email" value="{{  old('email') }}">
                                            @if ( $errors->has('email'))
                                            <span class="invalid-feedback" style="text-align: center">
                                                <strong>{{ $errors->first('email') ?: $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="password" style="text-align: center;" class=" mx-auto form-control login-input " id="password" name="password" placeholder="Password">
                                            @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert" style="text-align: center">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                        

                                        <!-- <div class="form-group"> -->
                                        <!--     <div class="custom-control custom-checkbox"> -->
                                        <!--         <input type="checkbox" class="custom-control-input" id="login-remember" name="login-remember"> -->
                                        <!--         <label class="custom-control-label font-w400" for="login-remember">Remember Me</label> -->
                                        <!--     </div> -->
                                        <!-- </div> -->
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 col-xl-5 mx-auto" style='text-align:center'>
                                            <button type="submit" class=" btn btn-round btn-primary btn-green ">
                                                Jungtis
                                            </button>
                                        </div>
                                    </div>
                                    
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
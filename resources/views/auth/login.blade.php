@extends('layouts.auth')

@section('content')

<div class="bg-image login-bg" style="background-image: url('{{ asset('media/photos/photo6@2x.jpg')}}');" >
    <div class="hero-static bg-white-90">
        
            <div class="row cont justify-content-center m-0">
            <div class="col-7 p-0 login-cover hide-md" style=";background-image: url('{{ asset('media/vectors/Login-amico.svg')}}');">
            <div style='padding:25px'><img class="brand-logo " src="{{asset('media/logos/reklamos-ekosistema-logo.png')}}"></div>
            </div>
                <div class="col-md-5 p-0 m-0  block block-themed align-items-center" style="background: #FFFFFF">
                    <div class="row m-0 align-items-center">
                    <div class="col-12 p-0">
                    <div class=" mb-0" >
                        <div class="block-content" >
                            <div class="p-sm-3 px-lg-4 py-lg-5">
                                <h1 class="mb-2" style="text-align: center; font-family: 'Poppins', sans-serif;">{{__('Prisijungimas')}}</h1>
                                <form class="js-validation-signin" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="pt-3">
                                        <div class="form-group" >
                                            <input type="text" style="text-align: center;" class="mx-auto form-control login-input {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="{{__('Email')}}" value="{{  old('email') }}">
                                            @if ( $errors->has('email'))
                                            <span class="invalid-feedback" style="text-align: center">
                                                <strong>{{ __('Įvesti duomenys nėra teisingi') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="password" style="text-align: center;" class=" mx-auto form-control login-input " id="password" name="password" placeholder="{{__('Password')}}">

                                        </div>

                                
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 col-xl-5 mx-auto" style='text-align:center'>
                                            <button type="submit" class=" btn btn-round btn-primary btn-green ">
                                                {{__('Prisijungti')}}
                                            </button>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
</div>
</div>
                        </div>
                    </div>
                </div>
            </div>
        
        
    </div>
</div>

@endsection
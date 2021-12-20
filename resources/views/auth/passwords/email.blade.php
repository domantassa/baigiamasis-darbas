@extends('layouts.auth')

@section('content')
<div class="bg-image" style="background-image: url('{{ asset('media/photos/photo6@2x.jpg')}}');">
    <div class="hero-static bg-white-50">
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <!-- Reminder Block -->
                    <div class="block block-themed block-fx-shadow mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Password Reminder</h3>
                            <div class="block-options">
                                <a class="btn-block-option" href="{{ route('login') }}" data-toggle="tooltip" data-placement="left" title="Sign In">
                                    <i class="fa fa-sign-in-alt"></i>
                                </a>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="p-sm-3 px-lg-4 py-lg-5">
                                <h1 class="mb-2">REKO</h1>
                                <p>Please provide your account’s email and we will send you your password.</p>

                                <!-- Reminder Form -->
                                <!-- jQuery Validation (.js-validation-reminder class is initialized in js/pages/op_auth_reminder.min.js which was auto compiled from _es6/pages/op_auth_reminder.js) -->
                                <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                <form class="js-validation-reminder" action="{{ route('password.email') }}" method="POST">
                                    <div class="form-group py-3">
                                        <input type="text" class="form-control form-control-lg form-control-alt {{ $errors->has('reminder') ? ' is-invalid' : '' }}" id="reminder" name="reminder" placeholder="Username or Email">
                                        @if ($errors->has('reminder'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('reminder') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 col-xl-5">
                                            <button type="submit" class="btn btn-block btn-primary ">
                                                <i class="fa fa-fw fa-envelope mr-1"></i> Send
                                            </button>
                                        </div>
                                    </div>
                                    @csrf
                                </form>
                                <!-- END Reminder Form -->
                            </div>
                        </div>
                    </div>
                    <!-- END Reminder Block -->
                </div>
            </div>
        </div>
        <div class="content content-full font-size-sm text-muted text-center">
            
        </div>
    </div>
</div>
@endsection
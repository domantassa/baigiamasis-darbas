@extends('layouts.backend', ['user' => $user, 'users' => $users, 'notif' => $notif])

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full" >
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h2 my-2 invisible" data-toggle="appear"
                data-class="animated fadeInUp"
                data-timeout="250"
                data-offset="-100">
                Žinutės </h1>
            </div>

            <div id="messages">
                
            </div>

            <form id="message-form">
                <input type="text">
            </form>
            
        </div>
    </div>
    <!-- END Page Content -->
@endsection

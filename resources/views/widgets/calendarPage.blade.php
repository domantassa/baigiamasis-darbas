@extends('layouts.layout', ['user' => $user, 'users' => $users, 'notif' => $notif])

@section('content')
<div class="calendar-cont">
@include('widgets.calendar',['Y'=>2022,'M'=>4,'events'=>[] ]);
</div>
@endsection




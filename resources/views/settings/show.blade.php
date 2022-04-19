@extends('layouts.layout', ['user' => $user, 'users' => $users, 'notif' => $notif])

@section('content')
<div>{{$setting->id}}</div>
<div>{{$setting->attribute}}</div>
<div>{{$setting->value}}</div>
@endsection
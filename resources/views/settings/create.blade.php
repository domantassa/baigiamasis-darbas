@extends('layouts.layout', ['user' => $user, 'users' => $users, 'notif' => $notif])

@section('content')
<form method="POST" action="{{route('settings.store')}}" style="padding: 20px;">
<label for="attribute">
{{__('Attribute')}}
<input id="attribute" type="text" name="attribute" class="form-control" placeholder="{{__('attribute')}}">
</label>
<label for="value">
{{__('Value')}}
<input id="value"  type="text" name="value" class="form-control" placeholder="{{__('value')}}" >
</label>
<button class="btn btn-primary" type="submit" >{{__('Išsaugoti')}}</button>
@csrf
</form>
@endsection
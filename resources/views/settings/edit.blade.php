@extends('layouts.layout', ['user' => $user, 'users' => $users, 'notif' => $notif])

@section('content')
<form method="POST" action="{{route('settings.update',$setting->id)}}">
<label for="attribute">
{{__('Attribute')}}
<input id="attribute" type="text" name="attribute" class="form-control" placeholder="{{__('attribute')}}" value="{{$setting->attribute}}">
</label>
<label for="value">
{{__('Value')}}
<input id="value"  type="text" name="value" class="form-control" placeholder="{{__('value')}}" value="{{$setting->value}}">
</label>
<button class="btn btn-primary" type="submit" >{{__('Submit')}}</button>
@csrf
<input type="hidden" name="_method" value="Put">
</form>
@endsection


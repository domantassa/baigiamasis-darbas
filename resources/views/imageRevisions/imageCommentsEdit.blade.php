@extends('layouts.layout', ['user' => $user, 'users' => $users, 'notif' => $notif])

@section('content')

<form id="file_edit" action="{{route('imageComment.store', 1)}}" method="post">
    @csrf
    <input value="{{$image_revision->id}}" name="image_revision_id" type="hidden">
<div id="cont" class="d-flex justify-content-between">
<div id="con" class="con">
    <img class="image" src="{{asset('storage/'.$image_revision->path.'/'.$image_revision->name)}}">
</div>
<div id="inputs">
    <div class="comments-page-inputs-container">
    <a href="{{route('orders.show-results', $image_revision->order_id)}}" class="m-auto"><div class="dots-back btn-primary btn btn-round order-btn-primary">{{__('Grįžti')}}</div></a> 
    <label for="dots-submit" class=" dots-submit btn-primary btn btn-round order-btn-primary">{{__('Išsaugoti')}}</label>
    </div>
@php
$i=0;
@endphp

@foreach($image_revision->imageComments()->get() as $dot)
@php
$i++;
@endphp
@include('imageRevisions/elements/input_card',['number'=>$i,'user'=>$user,'text'=>$dot->comment,'x'=>$dot->x,'y'=>$dot->y])


@endforeach
</div>
@php
$i=0;
@endphp

@foreach($image_revision->imageComments()->get() as $dot)
@php
$i++;
@endphp
@include('imageRevisions/elements/card',['number'=>$i,'user'=>$user,'text'=>$dot->comment,'x'=>$dot->x,'y'=>$dot->y])

<?php /* <div class="dotcont" id="dotcont-{{$i}}" style="top:{{$dot->y}}px;left:{{$dot->x}}px">
    <div class="dot" id="dot-{{$i}}">{{$i}}</div>
    <textarea name="text-{{$i}}" class="hidinput d-none" id="hidinput-{{$i}}" placeholder="Pateikite savo įžvalgą">{{$dot->text}}</textarea>
    <input type="hidden" name="x-{{$i}}" value="{{$dot->x}}"><input type="hidden" name="y-{{$i}}" value="{{$dot->y}}"></div>*/?>
@endforeach
</div>
<input id="dots-submit" type="submit" class="d-none">
</form>

<div class="example d-none">
@include('imageRevisions/elements/card',['number'=>0,'user'=>$user,'text'=>'','x'=>0,'y'=>0])
@include('imageRevisions/elements/input_card',['number'=>0,'user'=>$user,'text'=>'','x'=>0,'y'=>0])
</div>
<script src="{{asset('js/custom/imageComments.js')}}"></script>
@endsection

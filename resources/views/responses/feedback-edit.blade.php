@extends('layouts.layout')
@section('content')
<div class="contentShadowInset">
        
        <div class="row justify-content-center dashboardas">
            
            <div class="col-md-12 col-xl-12 my-5" style="text-align: center">
                <img class="vector filteris" src="{{asset('media/vectors/Problem solving-amico.svg')}}">
                <div style="max-width:700px" class='m-auto'>
                    <h1 class="h4 m-0 mb-3  " >{{__('Jūsų pataisymą užfiksavome. Jei turėsite papildomų klausimų - kreipkitės bet kada.')}}</h1>
                </div>
            <a href="{{route('files')}}">
                   <div class=" btn btn-round btn-primary btn-green mt-2 ">{{ __('Grįžti į pradžia') }}</div></a>
</div>
        </div>
</div>
@stop
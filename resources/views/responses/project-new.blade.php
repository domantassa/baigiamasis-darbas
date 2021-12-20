@extends('layouts.backend')
@section('content')
<div class="contentShadowInset">
        
        <div class="row justify-content-center dashboardas">
            
            <div class="col-md-12 col-xl-12 " style="text-align: center">
                <img class="vector filteris" src="{{asset('media/vectors/Calendar-amico.svg')}}" style="max-width:500px">
                <h1 class="h4 m-0 mb-3">Dėkojame už Jūsų užsakymą! Per 24 valandas gausite pranešimą apie pirminius rezultatus.</h1>
                <a href="{{route('orders.dashboard')}}">
                   <div class=" btn btn-round btn-primary btn-green mt-2 ">Grįžti į pradžia</div></a>
             </div>
                
        </div>
</div>

</div>
@stop
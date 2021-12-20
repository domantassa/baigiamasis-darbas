@extends('layouts.backend')
@section('content')
<div class="contentShadowInset">
        
        <div class="row justify-content-center dashboardas">
            
            <div class="col-md-12 col-xl-12 my-5" style="text-align: center">
                <img class="vector filteris" src="{{asset('media/vectors/Ok-amico.svg')}}">
                <h1 class="h4 m-0 mb-3">Projektas sėkmingai pabaigtas. Lauksime Jūsų sekančio užsakymo.</h1>
                <form action="{{route('orders.feedback.finished',$order->id)}}" method="POST">
                    @csrf
                <div class="custom-form-group">
                             <textarea rows="5" name="feedback" class="placeholder btn-round order-btn-grey form-btn" placeholder="Palikti atsiliepimą dizaineriui:"   style='max-width: 700px;'></textarea>
                </div>
                <button class=" btn btn-round btn-primary btn-green mt-2 mr-2">Siųsti atsiliepimą</button>
            <a href="{{route('orders.dashboard')}}">
                   <div class=" btn btn-round btn-red btn-green mt-2 mr-2">Grįžti į pradžia</div></a>
                </form>
                       </div>
            
        </div>
                
</div>
@stop
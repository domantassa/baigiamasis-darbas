@extends('layouts.layout', ['user' => $user, 'users' => $users, 'notif' => $notif])
@section('content')
<!-- Hero -->
<div class="bg-body-light">
        <div class="content content-full pt-2 pb-0" >
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-start">
                <h1 class="flex-sm-fill h2 my-2 invisible" data-toggle="appear"
                data-class="animated fadeInUp"
                data-timeout="250"
                data-offset="-100">
                {{__('Aktyvūs projektai')}}</h1>
                <div class="d-flex" id="calendar">
 <?php
 //$user->ordersFiltered();
 $y=date('Y');
 $m= date('m');
 ?>

    @include('widgets.calendar',['Y'=>$y,'M'=>$m,'events'=>$orders])

    
                </div>
    </div>
                
           
       </div>
    </div>
    <!-- END Hero -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Page Content -->

    <div style="margin-bottom: 25px" class="contentShadowInset">
        
        <div class="row justify-content-center dashboardas">
            
            <div class="col-md-12 col-xl-12">
                <div class="col-12 " style="padding-left:1.875rem">

                    
                        @include('widgets.filters',['class'=>'Order', 'attributes'=>[
                    'name',
                    'type',
                    'expected_at',
                    'created_at'
                    ]])
                        
                    
                    @foreach($users as $userr)
                    @if($userr->position != 'admin')

                        <h4 class="my-3">{{$userr->name}}</h4>
                        
                        @if($userr->orders()->where('state','=','Projektas kuriamas')->get()->count() > 0)
                        
                         <table style="overflow:scroll;width:1400px; padding-right: 10px">
                            <thead style="margin-right:15px !important">
                                
                            <th style="width:400px"><h1 class="h4 m-0">{{__('Peržiūrėti')}}</h1></th>
                            <th style="width:250px"><h1 class="h4 m-0">{{__('Užsakymo data')}}</h1></th>
                            <th style="width:280px"><h1 class="h4 m-0">{{__('Užsakymo tipas')}}</h1></th>
                            <th style="width:190px"><h1 class="h4 m-0">{{__('Tikėtina už')}}:</h1></th>
                            <th style="width:272px"><h1 class="h4 m-0">{{__('Būsena')}}</h1></th>
                            <th><h1 class="h4 m-0">{{__('Veiksmai')}}</h1></th>
                            <th><h1 class="h4 m-0">{{__('Rezultatai')}}</h1></th>

                            </thead>
                            <tbody>
                            @foreach($orders->where('owner_id',$userr->id)->where('state','Projektas kuriamas') as $order)
                            <tr>
                            
                        
                                <td class="p-1"><a href="{{route('orders.edit',$order->id)}}"><div class="  btn-round btn-primary  order-btn-primary">{{$order->name}}</div></a></td>
                                <td class="p-1"><div class="btn-round order-btn-grey" >{{$order->created_at}}</div></td>
                                <td class="p-1"><div class="btn-round order-btn-grey" >{{ __($order->type) }}</div></td>
                                <td class="p-1"> <div style="width: 190px;" class="btn-round order-btn-grey expected" data-time="{{$order->expected_at}}">{{$order->expected_at}}</div></a></td>

                                <td class="p-1"><div class=" btn-round order-btn-grey" >{{ __($order->state) }} </div></td>
                                <td class="p-1"> <a href="{{route('orders.edit',$order->id)}}"><div class="btn-primary btn btn-round order-btn-primary">{{__('Redaguoti')}}</div></a></td>
                                @if(count($order->revisions()->get())==0)
                                <td class="p-1"><div style="width:auto" class=" btn-round order-btn-grey d-inline-block">0</div></td>
                                @endif   
                                @if(count($order->revisions()->get())>0)
                                <td class="p-1"> <a href="{{route('orders.show-results',$order->id)}}"><div style="width:auto" class="d-inline-block btn-primary btn btn-round order-btn-primary">{{count($order->revisions()->get())}}</div></a></td>
                                @endif   
                            
                            
                            </tr>
                            @endforeach
                            </tbody>
                            </table>
                        @else
                            <h1 class="h4 m-0">{{__('Klientas neturi aktyvių užsakymų')}}</h1>  
                            @endif
                        @endif
                        @endforeach
                        <script>
                         $('.expected').each(function(){
                                var now = new Date().getTime();
                                if($(this).attr('data-time') !="0000-00-00 00:00:00")
                                {
                                    var countDownDate = new Date($(this).attr('data-time')).getTime();
                                    var distance = countDownDate - now;
                                    if(distance>0)
                                    {
                                    var days= Math.floor(distance/(1000*60*60*24));
                                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                    if(minutes <10) minutes='0'+minutes;
                                    if(seconds <10) seconds='0'+seconds;
                                    if(hours <10) hours='0'+hours;
                                    $(this).html(days + "d " + hours + ":"+ minutes + ":" + seconds);
                                    }
                                    else{
                                        $(this).html('{{ __("Labai greitai") }}');
                                    }
                                }
                                else{
                                    $(this).html('{{ __("Labai greitai") }}');
                                }
                                  
                                    
                            
                            });
                        setInterval(function(){
                            var now = new Date().getTime();
                            $('.expected').each(function(){
                            
                                
                                if($(this).attr('data-time') !="0000-00-00 00:00:00")
                                {
                                    var countDownDate = new Date($(this).attr('data-time')).getTime();
                                    var distance = countDownDate - now;
                                    if(distance>0)
                                    {
                                    var days= Math.floor(distance/(1000*60*60*24));
                                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                    if(minutes <10) minutes='0'+minutes;
                                    if(seconds <10) seconds='0'+seconds;
                                    if(hours <10) hours='0'+hours;
                                    $(this).html(days + "d " + hours + ":"+ minutes + ":" + seconds);
                                    }
                                    else{
                                        $(this).html('{{ __("Labai greitai") }}');
                                    }
                                }
                                else{
                                    $(this).html('{{ __("Labai greitai") }}');
                                }
                                   
                            
                            });

                        },1000);
                    
                        

                        </script>

                        
                </div>
            </div>
        </div>
    </div>
</div>
@stop


@section('js_after')
<script src="{{asset('js/custom/calendar.js')}}"></script>
<script >
    calendar();
</script>

@endsection
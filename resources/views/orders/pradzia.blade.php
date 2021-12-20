@extends('layouts.backend', ['user' => $user, 'users' => $users, 'notif' => $notif])
@section('content')
<!-- Hero -->
<div class="bg-body-light">
        <div class="content content-full pt-2" >
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h2 my-2 invisible" data-toggle="appear"
                data-class="animated fadeInUp"
                data-timeout="250"
                data-offset="-100">
                Aktyvūs projektai</h1>
            </div>
                
            
       </div>
    </div>
    <!-- END Hero -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Page Content -->

    <div class="contentShadowInset">
        
        <div class="row justify-content-center dashboardas">
            
            <div class="col-md-12 col-xl-12">
                <div class="col-12 " style="padding-left:1.875rem">
                @if($user->position!="admin")
                <table style="overflow:scroll; width:1400px">
                    <thead >
                        
                         <th style="width:516px"><h1 class="h4 m-0">Pavadinimas</h1></th>
                        <th style="width:293px"><h1 class="h4 m-0">Užsakymo data</h1></th>
                        <th style="width:259px"><h1 class="h4 m-0">Užsakymo tipas</h1></th>
                        <th style="width:293px"><h1 class="h4 m-0">Tikėtina už:</h1></th>
                        <th style="width:293px"><h1 class="h4 m-0">Būsena</h1></th>

                        <th><h1 class="h4 m-0">Peržiūrėti</h1></th>
                    </thead>
                <tbody>
                    
                    @foreach($orders->where('owner_id',$user->id)->where('state', '!=' ,'Projektas uždarytas')  as $order)
                        <tr>
                        
                       
                            <td class="p-1"><div class="  btn-round btn-primary  order-btn-primary">{{$order->name}}</div></td>
                            <td class="p-1"><div class="btn-round order-btn-grey" >{{$order->created_at}}</div></td>
                            <td class="p-1"><div class="btn-round order-btn-grey" >{{$order->type}}</div></td>
                            <td class="p-1"> <div class="btn-primary btn btn-round order-btn-primary expected" data-time="{{$order->expected_at}}">{{$order->expected_at}}</div></a></td>
                            @if($order->state=="Projektas atliktas") 
                            <td class="p-1"><div class="  btn-round btn-primary order-btn-primary" >{{$order->state}}</div></td>
                            <td class="p-1"> <a href="{{route('orders.show',$order->id)}}"><div class="btn-primary btn btn-round order-btn-primary">Peržiūrėti</div></a></td>
                            @elseif($order->state=="Projektas uždarytas")
                            <td class="p-1"><div class="  btn-round btn-primary order-btn-primary" >{{$order->state}}</div></td>
                            <td class="p-1"><a href="{{route('download',$order->file()->orderby('id','desc')->first()->id)}}"><div class="btn-primary btn btn-round order-btn-primary">Atsisiųsti</div></a></td>
                            @else
                             <td class="p-1"><div class=" btn-round order-btn-grey" >{{$order->state}}</div></td>
                                @if( $order->state=="Projektas kuriamas")
                                <td class="p-1"> <a href="{{route('orders.edit',$order->id)}}"><div class="btn-primary btn btn-round order-btn-primary">Atidaryti</div></a></td>
                                @else
                                <td></td>
                                @endif
                            @endif

                          
                        
                        </tr>
                    @endforeach
                   
                        
                    
                    </tbody> 
                    </table>
                    @else
                    
                    @foreach($users as $userr)
                    @if($userr->position != 'admin')
                        
                        <h4 class="my-3">{{$userr->name}}</h4>
                        @if($orders->where('owner_id',$userr->id)->count() > 0)
                            <table style="overflow:scroll;width:1400px">
                            <thead>
                                
                            <th style="width:400px"><h1 class="h4 m-0">Pavadinimas</h1></th>
                            <th style="width:230px"><h1 class="h4 m-0">Užsakymo data</h1></th>
                            <th style="width:280px"><h1 class="h4 m-0">Užsakymo tipas</h1></th>
                            <th style="width:190px"><h1 class="h4 m-0">Tikėtina už:</h1></th>
                            <th style="width:272px"><h1 class="h4 m-0">Būsena</h1></th>
                            <th><h1 class="h4 m-0">Peržiūrėti</h1></th>
                            
                            </thead>
                            <tbody>
                            @foreach($orders->where('owner_id',$userr->id)->where('state', '!=' ,'Projektas uždarytas') as $order)
                            <tr>
                            
                        
                                <td class="p-1"><div class="  btn-round btn-primary  order-btn-primary">{{$order->name}}</div></td>
                                <td class="p-1"><div class="btn-round order-btn-grey" >{{$order->created_at}}</div></td>
                                <td class="p-1"><div class="btn-round order-btn-grey" >{{$order->type}}</div></td>
                                <td class="p-1"> <div class="btn-primary btn btn-round order-btn-primary expected no-click" data-time="{{$order->expected_at}}">{{$order->expected_at}}</div></a></td>
                                @if($order->state=="Projektas atliktas") 
                                <td class="p-1"><div class="  btn-round btn-primary order-btn-primary" >{{$order->state}}</div></td>
                                <td class="p-1"> <a href="{{route('orders.show',$order->id)}}"><div class="btn-primary btn btn-round order-btn-primary">Peržiūrėti</div></a></td>
                                @elseif($order->state=="Projektas uždarytas")
                                <td class="p-1"><div class="  btn-round btn-primary order-btn-primary" >{{$order->state}}</div></td>
                                <td class="p-1"><a href="{{route('download',$order->file()->orderby('id','desc')->first()->id)}}"><div class="btn-primary btn btn-round order-btn-primary">Atsisiųsti</div></a></td>
                                @else
                                <td class="p-1"><div class=" btn-round order-btn-grey" >{{$order->state}}</div></td>
                                    @if( $order->state=="Projektas kuriamas")
                                    <td class="p-1"> <a href="{{route('orders.edit',$order->id)}}"><div class="btn-primary btn btn-round order-btn-primary">Koreguoti</div></a></td>
                                    @else
                                    <td></td>
                                    @endif
                                @endif

                            
                            
                            </tr>
                            @endforeach
                            </tbody>
                            </table>
                            @else
                            <h1 class="h4 m-0">Klientas užsakymų dar nepadarė</h1>
                        @endif
                            @endif
                        @endforeach
                        
                        @endif

                        <script>
                         $('.expected').each(function(){
                                var now = new Date().getTime();
                                if($(this).attr('data-time') !="0000-00-00 00:00:00")
                                {
                                    var countDownDate = new Date($(this).attr('data-time')).getTime();
                                    var distance = countDownDate - now;
                                    if(distance>0)
                                    {
                                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                    if(minutes <10) minutes='0'+minutes;
                                    if(seconds <10) seconds='0'+seconds;
                                    if(hours <10) hours='0'+hours;
                                    $(this).html(hours + ":"+ minutes + ":" + seconds);
                                    }
                                    else{
                                        $(this).html('Laikas baigėsi');
                                    }
                                }
                                else{
                                    $(this).html('Laikas baigėsi');
                                }
                                  
                                    
                            
                            });
                        setInterval(function(){
                            var now = new Date().getTime();
                            $('.expected').each(function(){
                                
                                //alert($(this).attr('data-time'));
                                
                                if($(this).attr('data-time') !="0000-00-00 00:00:00")
                                {
                                    var countDownDate = new Date($(this).attr('data-time')).getTime();
                                    var distance = countDownDate - now;
                                    if(distance>0)
                                    {
                                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                    if(minutes <10) minutes='0'+minutes;
                                    if(seconds <10) seconds='0'+seconds;
                                    if(hours <10) hours='0'+hours;
                                    $(this).html(hours + ":"+ minutes + ":" + seconds);
                                    }
                                    else{
                                        $(this).html('Laikas baigėsi');
                                    }
                                }
                                else{
                                    $(this).html('Laikas baigėsi');
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
@extends('layouts.layout', ['user' => $user, 'users' => $users, 'notif' => $notif])

@section('content')

<!--PA19-->

    <div class="bg-body-light">
        <div class="content content-full pt-2" >
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h2 my-2 invisible" data-toggle="appear"
                data-class="animated fadeInUp"
                data-timeout="250"
                data-offset="-100">
                {{__('Užsakymų istorija')}} </h1>
                <div class="d-flex" id="calendar">
                <?php
                    $y=date('Y');
                    $m= date('m');
                ?>
                    @include('widgets.calendarOrders',[
                                                        'Y'=>$y,
                                                        'M'=>$m,
                                                        'events'=>$user
                                                                ->orders()
                                                                ->get()
                                                        ])   
                </div>
            </div>
                
            
       </div>
    </div>


    <div class="contentShadowInset">
        
        <div class="row justify-content-center dashboardas">
            
            <div class="col-md-12 col-xl-12">
                <div class="col-12 " style="padding-left:1.875rem">
                @if(count($orders->where('owner_id',$user->id)->where('state','Projektas atliktas'))>0)

                <table style="overflow:scroll;width:1200px">
                    <thead>
                        
                         <th style="width:516px"><h1 class="h4 m-0">{{__('Pavadinimas')}}</h1></th>
                        <th style="width:273px"><h1 class="h4 m-0">{{__('Užsakymo data')}}</h1></th>
                        <th style="width:259px"><h1 class="h4 m-0">{{__('Užsakymo tipas')}}</h1></th>
                        <th style="width:160px"><h1 class="h4 m-0">{{__('Peržiūrėti')}}</h1></th>
                    </thead>
                <tbody>
                    
                    @foreach($orders->where('owner_id',$user->id)->where('state','Projektas atliktas') as $order)
                        <tr>
                        
                       
                            <td class="p-1"><a href="{{route('orders.edit',$order->id)}}"><div class=" btn-round  order-btn-primary">{{ $order->name }}</div></a></td>
                            <td class="p-1"><div class="  btn-round order-btn-grey" >{{ $order->created_at }}</div></td>
                            <td class="p-1"><div class="  btn-round order-btn-grey" >{{ __($order->type) }}</div></td>
                            <td class="p-1"> <a href="{{route('orders.edit',$order->id)}}"><div class=" btn btn-round order-btn-black">{{__('Peržiūrėti')}}</div></a></td>
                        
                        </tr>
                    @endforeach
                    </tbody> 
                </table>
                @endif

                    @if(count($orders->where('state','Projektas atliktas'))==0)
                    <a href="{{route('orders.create')}}" class=" btn-round btn btn-primary">{{__('Pradėti užsakymą')}} </a>
                    @endif
                {{$orders->appends($_GET)->links()}}
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
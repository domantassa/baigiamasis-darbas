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
                    @include('widgets.calendarOrders',['Y'=>$y,'M'=>$m,'events'=>$orders])

                </div>
            </div>
                
            
       </div>
    </div>


    <div class="contentShadowInset">
        
        <div class="row justify-content-center dashboardas">
            
            <div class="col-md-12 col-xl-12">
                <div class="col-12 " style="padding-left:1.875rem">
              

                    <h1 class="my-3">{{__('Visi užsakymai')}}</h1>

                    @include('widgets.filters',['class'=>'Order', 'attributes'=>[
                    'name',
                    'type',
                    'expected_at',
                    'created_at'
                    ]])
                    
                    @if(count($orders)>0)
              
                    @foreach($users as $user1)
                        @if(count($orders->where('owner_id',$user1->id))>0)
                            @if($user1->position != 'admin')
                           
                                <h4 class="my-3">{{$user1->name}}</h4>
                                
                                <table style="overflow:scroll;width:1600px; padding-right: 10px">
                                    <thead>
                                        
                                        <th style="width:300px"><h1 class="h4 m-0">{{__('Pavadinimas')}}</h1></th>
                                        <th style="width:220px"><h1 class="h4 m-0">{{__('Užsakymo data')}}</h1></th>
                                        <th style="width:250px"><h1 class="h4 m-0">{{__('Užsakymo tipas')}}</h1></th>
                                        <th style="width:200px"><h1 class="h4 m-0">{{__('Peržiūrėti')}}</h1></th>
                                    
                                    </thead>
                                    <tbody>
                                        @foreach($orders->where('owner_id',$user1->id) as $order)
                                        
                                            <tr>
                                                
                                                <td class="p-1"><a href="{{route('orders.edit',$order->id)}}"><div class="btn-primary  btn-round  order-btn-primary">{{ $order->name }}</div></a></td>
                                                <td class="p-1"><div class="  btn-round order-btn-grey" >{{ $order->created_at }}</div></td>
                                                <td class="p-1"><div class="  btn-round order-btn-grey" >{{ __($order->type) }}</div></td>
                                                <td class="p-1"> <a href="{{route('orders.edit',$order->id)}}"><div style="width: auto" class="btn-primary btn btn-round order-btn-primary">{{ __('Peržiūrėti') }}</div></a></td>
                                        
                                            </tr>
                                            
                                        @endforeach
                                    </tbody>
                                </table> 
                            @endif
                        @else
                        @if($user1->position != 'admin')
                        <h4 class="my-3">{{$user1->name}}</h4>
                        <h5 class="my-3">{{__('Nėra uždarytų projektų')}}</h5>   
                        @endif
                        @endif
                    @endforeach
                    @else
                        <h3 class="my-3">{{__('Nėra uždarytų projektų')}}</h3>
                    @endif
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
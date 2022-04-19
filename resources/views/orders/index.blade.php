@extends('layouts.layout', ['user' => $user, 'users' => $users, 'notif' => $notif])

@section('content')
<!-- Hero -->
<div class="bg-body-light">
        <div class="content content-full pt-2" >
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h2 my-2 invisible" data-toggle="appear"
                data-class="animated fadeInUp"
                data-timeout="250"
                data-offset="-100">
                {{__('Užsakymų istorija')}} </h1>
            </div>
                
            
       </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->

    <div class="contentShadowInset">
        
        <div class="row justify-content-center dashboardas">
            
            <div class="col-md-12 col-xl-12">
                <div class="col-12 " style="padding-left:1.875rem">
                @if(count($orders->where('owner_id',$user->id)->where('state','Projektas atliktas'))>0)
                @include('widgets.filter')
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
                        
                       
                            <td class="p-1"><div class=" btn-round  order-btn-primary">{{ $order->name }}</div></td>
                            <td class="p-1"><div class="  btn-round order-btn-grey" >{{ $order->created_at }}</div></td>
                            <td class="p-1"><div class="  btn-round order-btn-grey" >{{ __($order->type) }}</div></td>
                            <td class="p-1"> <a href="{{route('orders.edit',$order->id)}}"><div class=" btn btn-round order-btn-black">{{__('Peržiūrėti')}}</div></a></td>
                        
                        </tr>
                    @endforeach
                    </tbody> 
                </table>
                @endif
                @if((Auth::user()->position == 'admin'))	
                    <h1 class="my-3">{{__('Visi užsakymai')}}</h1>
                    @if(count($orders->where('state','Projektas atliktas'))>0)
                    
                    @foreach($users as $user1)
                    @if(count($orders->where('owner_id',$user1->id)->where('state','Projektas atliktas'))>0)
                    @if($user1->position != 'admin')
                    <h4 class="my-3">{{$user1->name}}</h4>
                    
                    <table style="overflow:scroll;width:1400px">
                    <thead>
                        
                        <th style="width:250px"><h1 class="h4 m-0">{{__('Pavadinimas')}}</h1></th>
                        <th style="width:200px"><h1 class="h4 m-0">{{__('Užsakymo data')}}</h1></th>
                        <th style="width:250px"><h1 class="h4 m-0">{{__('Užsakymo tipas')}}</h1></th>
                        <th style="width:150px"><h1 class="h4 m-0">{{__('Versijų skaičius')}}</h1></th>
                        <th style="width:150px"><h1 class="h4 m-0">{{__('Peržiūrėti')}}</h1></th>
                    
                    </thead>
                    <tbody>
                        @foreach($orders->where('owner_id',$user1->id)->where('state','Projektas atliktas') as $order)
                        
                            <tr>
                            
                        
                            <td class="p-1"><div class="btn-primary  btn-round  order-btn-primary">{{ $order->name }}</div></td>
                            <td class="p-1"><div class="  btn-round order-btn-grey" >{{ $order->created_at }}</div></td>
                            <td class="p-1"><div class="  btn-round order-btn-grey" >{{ __($order->type) }}</div></td>
                            <td class="p-1"><div class="  btn-round order-btn-grey" >{{ __($order->number_of_revisions) }}</div></td>
                            <td class="p-1"> <a href="{{route('orders.edit',$order->id)}}"><div style="width: auto" class="btn-primary btn btn-round order-btn-primary">{{ __('Peržiūrėti') }}</div></a></td>
                        
                            </tr>
                        @endforeach
                    </tbody>
                    </table> 
                    @endif
                    @endif
                    @endforeach
                    @else
                        <h3 class="my-3">{{__('Nėra uždarytų projektų')}}</h3>
                    @endif
                    @endif
                    @if((Auth::user()->position != 'admin'))
                    @if(count($orders->where('state','Projektas atliktas'))==0)
                    <a href="{{route('orders.create')}}" class=" btn-round btn btn-primary">{{__('Pradėti užsakymą')}} </a>
                    @endif
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop
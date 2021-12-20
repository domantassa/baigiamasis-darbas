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
                Užsakymų istorija </h1>
            </div>
                
            
       </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->

    <div class="contentShadowInset">
        
        <div class="row justify-content-center dashboardas">
            
            <div class="col-md-12 col-xl-12">
                <div class="col-12 " style="padding-left:1.875rem">
                @if(count($orders->where('owner_id',$user->id)->where('state','Projektas uždarytas'))>0)
                <table style="overflow:scroll;width:1200px">
                    <thead>
                        
                         <th style="width:516px"><h1 class="h4 m-0">Pavadinimas</h1></th>
                        <th style="width:273px"><h1 class="h4 m-0">Užsakymo data</h1></th>
                        <th style="width:259px"><h1 class="h4 m-0">Užsakymo tipas</h1></th>
                        <th style="width:160px"><h1 class="h4 m-0">Peržiūrėti</h1></th>
                    </thead>
                <tbody>
                    
                    @foreach($orders->where('owner_id',$user->id)->where('state','Projektas uždarytas') as $order)
                        <tr>
                        
                       
                            <td class="p-1"><div class=" btn-round  order-btn-primary">{{$order->name}}</div></td>
                            <td class="p-1"><div class="  btn-round order-btn-grey" >{{$order->created_at}}</div></td>
                            <td class="p-1"><div class="  btn-round order-btn-grey" >{{$order->type}}</div></td>
                            <td class="p-1"> <a href="{{route('orders.preview',$order->id)}}"><div class=" btn btn-round order-btn-black">Peržiūrėti</div></a></td>
                        
                        </tr>
                    @endforeach
                    </tbody> 
                </table>
                @endif
                    @if((Auth::user()->position == 'admin'))	
                    <h1 class="my-3">Visi užsakymai</h1>
                    @if(count($orders->where('state','Projektas uždarytas'))>0)
                    
                    @foreach($users as $user1)
                    @if(count($orders->where('owner_id',$user1->id)->where('state','Projektas uždarytas'))>0)
                    @if($user1->position != 'admin')
                    <h4 class="my-3">{{$user1->name}}</h4>
                    <table style="overflow:scroll;width:1200px">
                    <thead>
                        
                        <th style="width:516px"><h1 class="h4 m-0">Pavadinimas</h1></th>
                        <th style="width:273px"><h1 class="h4 m-0">Užsakymo data</h1></th>
                        <th style="width:259px"><h1 class="h4 m-0">Užsakymo tipas</h1></th>
                        <th style="width:160px"><h1 class="h4 m-0">Peržiūrėti</h1></th>
                    
                    </thead>
                    <tbody>
                        @foreach($orders->where('owner_id',$user1->id)->where('state','Projektas uždarytas') as $order)
                        
                            <tr>
                            
                        
                            <td class="p-1"><div class="btn-primary  btn-round  order-btn-primary">{{$order->name}}</div></td>
                            <td class="p-1"><div class="  btn-round order-btn-grey" >{{$order->created_at}}</div></td>
                            <td class="p-1"><div class="  btn-round order-btn-grey" >{{$order->type}}</div></td>
                            <td class="p-1"> <a href="{{route('orders.preview',$order->id)}}"><div class=" btn btn-round order-btn-black">Peržiūrėti</div></a></td>
                        
                            </tr>
                        @endforeach
                    </tbody>
                    </table> 
                    @endif
                    @endif
                    @endforeach
                    @else
                        <h3 class="my-3">Nėra uždarytų projektų</h3>
                    @endif
                    @endif
                    @if((Auth::user()->position != 'admin'))
                    @if(count($orders->where('state','Projektas uždarytas'))==0)
                    <a href="{{route('orders.create')}}" class=" btn-round btn btn-primary">Pradėti užsakymą </a>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop
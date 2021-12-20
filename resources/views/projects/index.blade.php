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
                Aktyvūs projektai </h1>
            </div>
                
            
       </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->

    <div class="contentShadowInset">
        
        <div class="row justify-content-center dashboardas">
            
            <div class="col-md-12 col-xl-12">
            <div class="col-12 " style="padding-left:1.875rem">
                    <div class="row pb-2 m-0" >
                        <div class="col-4 px-1"><h1 class="h4 m-0">Pavadinimas</h1></div>
                        <div class="col-2 px-1"><h1 class="h4 m-0">Užsakymo data</h1></div>
                        <div class="col-2 px-1"><h1 class="h4 m-0">Užsakymo tipas</h1></div>
                        <div class="col-2 px-1"><h1 class="h4 m-0">Užsakymo būsena</h1></div>
                        <div class="col"><h1 class="h4 m-0">Peržiūrėti</h1></div>
                    </div>
                @foreach($projects as $project)


                    <div class="row pb-2 m-0" >
                        <div class="col-4 px-1"><div class=" btn btn-primary btn-round  order-btn-primary">{{$project->title}}</div></div>
                        <div class="col-3 px-1"><div class=" btn btn-primary btn-round order-btn-primary" >{{$project->created_at}}</div></div>
                        <div class="col-3 px-1"><div class=" btn btn-primary btn-round order-btn-primary" >{{$project->type}}</div></div>
                        <div class="col-3 px-1"><div class=" btn btn-primary btn-round order-btn-primary" >{{$project->status}}</div></div>
                        <div class="col"><div class=" btn btn-primary btn-round order-btn-primary">Atsisiusti</div></div>
                    </div>

                @endforeach 
                    <div class="row pb-2 m-0" >
                        <div class="col-4 px-1"><div class=" btn btn-primary btn-round  order-btn-primary">Logo pataisymas</div></div>
                        <div class="col-3 px-1"><div class=" btn btn-primary btn-round order-btn-primary" >2020-06-14</div></div>
                        <div class="col-3 px-1"><div class=" btn btn-primary btn-round order-btn-primary" >Kita</div></div>
                        <div class="col-3 px-1"><div class=" btn btn-primary btn-round order-btn-primary" >Aktyūs</div></div>
                        <div class="col px-1" ><div class=" btn btn-primary btn-round order-btn-primary">Atsisiusti</div></div>
                    </div>
                    <div class="row pb-2 m-0" >
                        <div class="col-4 px-1"><div class=" btn btn-primary btn-round  order-btn-primary">Logo pataisymas</div></div>
                        <div class="col-3 px-1"><div class=" btn btn-primary btn-round order-btn-primary" >2020-06-14</div></div>
                        <div class="col-3 px-1"><div class=" btn btn-primary btn-round order-btn-primary" >Kita</div></div>
                        <div class="col-3 px-1"><div class=" btn btn-primary btn-round order-btn-primary" >Aktyūs</div></div>
                        <div class="col px-1" ><div class=" btn btn-primary btn-round order-btn-primary">Atsisiusti</div></div>
                    </div>
            </div>
            </div>
        </div>
    </div>
</div>
@stop
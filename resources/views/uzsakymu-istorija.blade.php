@section('content')
<!-- Hero -->
<div class="bg-body-light">
        <div class="content content-full pt-2" >
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h2 my-2 invisible" data-toggle="appear"
                data-class="animated fadeInUp"
                data-timeout="250"
                data-offset="-100">
                Mano failai </h1>
            </div>
                
                        <label class="custom-file-upload btn btn-round btn-primary btn-green" >
                            
                        <input type="file"/>
                        Prisegti failą
                    </label>
            
       </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->

    <div class="contentShadowInset">
        
        <div class="row justify-content-center dashboardas">
            
            <div class="col-md-12 col-xl-12">
            <div class="col-12 " style="padding-left:1.875rem">
                    <div class="row pb-2 m-0" >
                        <div class="col">Pavadinimas</div>
                        <div class="col">Užsakymo data</div>
                        <div class="col">Užsakymo tipas</div>
                        <div class="col">Peržiūrėti</div>
                    </div>
                @foreach($orders as $order)


                <div class="row pb-2 m-0" >
                        <div class="col">{{$order->title}}</div>
                        <div class="col">{{$order->created_at}}</div>
                        <div class="col">{{$order->type}}</div>
                        <div class="col">Atsisiusti</div>
                    </div>

                @endforeach 
            </div>
            </div>
        </div>
    </div>
</div>
@stop
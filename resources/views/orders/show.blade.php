@extends('layouts.backend', ['user' => $user, 'users' => $users, 'notif' => $notif])

@section('content')
<div class="bg-body-light">
        <div class="content content-full pt-2" >
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h2 my-2 invisible" data-toggle="appear"
                data-class="animated fadeInUp"
                data-timeout="250"
                data-offset="-100">
                Projekto peržiūra </h1>
            </div>
                
            
       </div>
    </div>
   <!-- Page Content -->
   <div class="contentShadowInset">
        <div class="row justify-content-center dashboardas">
        <div class="col-md-12 col-xl-12">
            <div class="col-12 " style="padding-left:1.875rem">

                      
                       
                        @csrf
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">Prisegti failai</h1>
                            <table>
                            @foreach($order->file()->get()->where('owner_id',1) as $file)
                        <tr>
                        
                        <td class='p-1'><div  class="btn-round btn-grey" style="text-align:left">{{$file->name}}</div></td>
                        <td class='p-1'><a href="{{route('download',$file->id)}}"><div class=" btn btn-round btn-primary btn-green ">Parsisiusti</div></a></td>
                        <td class='p-1 m-l-2'><a href="{{route('deleteFile',$file->id)}}"><div class="  btn-round btn-trash file-input-trash"><i class="fa fa-trash trash"></i></div></a></td>
                        
                        </tr>
                        
                        @endforeach
                        </table>
                        </div>  

                    <form method="post" action="{{route('orders.feedback', $order->id)}}">
                        @csrf
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">Palikti komentarus dizaineriui</h1>
                            <textarea class=" btn-round order-btn-grey form-btn placeholder" name="feedback" placeholder="Įrašykite, kas turėtų būti pakoreguota" style="max-width:1295px;width:100%;min-height:138px">{{$order->feedback}}</textarea>
                            
                        </div>
                        <div class="custom-form-group pt-3">
                            <label class="d-inline btn-round  order-btn-red m-1 click"  for="submitfeed">Siųsti komentarą</label>
                            <label class="d-inline  btn-round  order-btn-primary m-1 click"  for="submit">Fiksuoti darbo pabaigą</label>
                        </div>
                        <input class="d-none" id="submitfeed" type="submit">
                        
                        </form>
                        <form action="{{route('orders.finished', $order->id)}}" method="post">
                             @csrf
                            <input  id="submit" type="submit" class='d-none '>
                        </form>
                        </div>
                   </div>
                   </div>
                   </div>
    <!-- END Page Content -->
@endsection

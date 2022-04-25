@extends('layouts.layout', ['user' => $user, 'users' => $users, 'notif' => $notif])

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <div class="content content-full pt-2">
                    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                        <h1 class="flex-sm-fill h2 my-2 invisible" data-toggle="appear" data-class="animated fadeInUp"
                            data-timeout="250" data-offset="-100">
                            {{ __('Pranešimai') }} </h1>
                    </div>


                </div>


            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-9 col-xl-9">
                <div class="block">

                    <div class="block-content">
                        



                        
                            <div class="table-responsive table-wrapper-scroll-x my-custom-scrollbar ">
                            @include('widgets.filters',['class'=>'FileNotification', 'attributes'=>[
                            'message',
                            'created_at'
                            ]
                                ])  
                                <table class="table table-hover ">
                                    <thead>
                                    <tr>
                                      
                                    </tr>
                                    <tr>
                                        <th>{{__('Žinutė')}}</th>
                                        
                                        <th>{{__('Data')}}</th>
                                        <th scope="col"><i class="fas fa-trash"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $notifications as $notification)
                                        <tr>
                                            <td><a href="/dashboard/{{$notification->link}}">{{$notification->message}}</a></td>

                                            <td>{{$notification->created_at}}</td>
                                            <td>    
                                                <form method="post" action="{{route('notifications.destroy',$notification->id)}}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                @csrf    
                                                <a href="{{ route('notifications.destroy',$notification->id) }} "><i
                                                            class="fas fa-trash"></i></a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <?php /* {{$settings->links()}}*/?>
                            </div>
                    </div>
                </div>
                <div class="block-header">
                    <h3 class="block-title"></h3>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- END Page Content -->
@endsection

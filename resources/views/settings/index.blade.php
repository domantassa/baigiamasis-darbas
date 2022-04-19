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
                            {{ __('Puslapio nustatymai') }} </h1>
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
                        
                        <p class="font-size-sm text-muted">
                            <strong></strong>
                        </p>
                        <p class="font-size-md font-italic">

                        </p>


                        @if ($settings->count())
                            <div class="table-responsive table-wrapper-scroll-x my-custom-scrollbar ">
                            @include('widgets.filters')  
                                <table class="table table-hover ">
                                    <thead>
                                    <tr>
                                      
                                    </tr>
                                    <tr>
                                        <th>Id</th>    
                                        <th>Attribute</th>
                                        <th>Value</th>
                                        <th>edit</th>
                                        <th>delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $settings as $setting)
                                        <tr>
                                            <td>{{$setting->id}}</td>
                                            <td>{{$setting->attribute}}</td>
                                            <td>{{$setting->value}}</td>
                                            <td><a href="{{route('settings.edit',$setting->id)}}" class="btn btn-primary">edit</a></td>
                                            <td>    
                                                <form method="post" action="{{route('settings.destroy',$setting->id)}}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                @csrf    
                                                <button class="btn btn-primary">delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
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

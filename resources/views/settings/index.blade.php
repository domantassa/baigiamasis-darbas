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
            <div style="margin-left:30px">
                <a href="{{route('settings.create')}}" style="color:white;" class=" btn btn-round btn-primary btn-green"  >
                                
                {{__('Sukurti naują atributą')}}
                            
                                
                </a>
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
                        



                        @if ($settings->count())
                            <div class="table-responsive table-wrapper-scroll-x my-custom-scrollbar ">
                            @include('widgets.filters',['class'=>'Setting','attributes'=>[
                                'attribute',
                                'value'
                                ]
                                ])  
                                <table class="table table-hover ">
                                    <thead>
                                    <tr>
                                      
                                    </tr>
                                    <tr>
                                        <th>{{__('Attribute')}}</th>
                                        <th>{{__('Value')}}</th>
                                        <th scope="col"><i class="fas fa-edit"></i></th>
                                        <th scope="col"><i class="fas fa-trash"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $settings as $setting)
                                        <tr>
                                            <td>{{$setting->attribute}}</td>
                                            <td>{{$setting->value}}</td>
                                            <td><a href="{{route('settings.edit',$setting->id)}}" ><i
                                                            class="fas fa-edit"></i></a></a></td>
                                            <td> 
                                                <form method="post" action="{{route('settings.destroy',$setting->id)}}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                @csrf    
                                                <label for="form-delete-{{$setting->id}}" syle="cursor:pointer"><i class="fas fa-trash"></i></label>
                                                <input id="form-delete-{{$setting->id}}" type="submit" class="d-none">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$settings->links()}}
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

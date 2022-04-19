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
                @if((Auth::user()->name === $user->name))
                {{__('Mano ')}}
                @else
                {{__('Kliento ')}}
                @endif
                {{__('failai')}}
                </h1>
            </div>
                
                        <label class="custom-file-upload btn btn-round btn-primary btn-green" for="file-upload" >
                            
                        {{__('Prisegti failą')}}
                       
                        
                    </label>
                    
                    <form action="{{ route('upload', ['user' => $user]) }}" method="post" role="form" class="file-form" enctype="multipart/form-data">
                             @csrf    

                            <input id="file-upload" type="file" name="file" />
                            <button type="submit" class="file-custom btn " data-toggle="tooltip" data-placement="top" title="Press to submit" >
                                <span style="font-size: 17px;">
                                    <i class="fas fa-upload"></i>
                                </span>    
                            </button>
                        </form>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                            <script>
                                $("#file-upload").change(function(){
                                   $(".file-form").addClass("d-inline-block");
                                });
                            </script>
            
       </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->


    <div class="contentShadowInset">
        
        <div class="row justify-content-center dashboardas">
            
            <div class="col-md-12 col-xl-12">
            <div class="col-12 " style="padding-left:1.875rem">
            <table>
                <tbody>
                        @foreach ($files->where('order_id',null) as $file)
                            
                           <tr>
                            
                                <td style="width:100%"><div  class=" col btn-round btn-grey mr-2" style="text-align:left">{{$file->name}}</div></td>
                                <td style="width:100px"><a href="{{route('download',$file->id)}}"><div  class=" btn btn-round btn-primary btn-green">{{__('Parsisiųsti')}}</div></a></td>
                                <td  style="width:30px"><div  class="  btn-round btn-trash"><a href="{{ route('deleteFile', ['file' => $file->id]) }}"><i class="fa fa-trash trash"></i></a></div></td>
                            
                            </tr>
                            @endforeach
                </tbody>
            </table>
            </div>
                
                <div class=" {{ $files->count() ? 'blockWithTopMargin' : '' }}">

                    <div class="block-content">
                        <p class="font-size-sm text-muted">
                            
                        </p>
                        <p class="font-size-sm text-muted">
                             <strong></strong>
                        </p>

                        <form action="{{ route('upload', ['user' => $user]) }}" method="post" role="form" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" id="file" aria-label="File browser example">
                            
                            
                        </form>

                        <div class="text-center">

                        @if ($files->first() && Auth::user()->position == 'admin')

                        <form action="{{ route('deleteDir', ['user' => $user]) }}">
                            <input type="submit" class="btn btn-primary" value="{{__('Delete')}} {{ __('all')}}" />
                            
                        </form>
                        @endif 
                           
                        
                    </div>
                            
                        
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection

@extends('layouts.backend', ['user' => $user, 'users' => $users, 'notif' => $notif])

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2 invisible" data-toggle="appear"
                data-class="animated fadeInUp"
                data-timeout="250"
                data-offset="-100">
                YOUR PERSONAL FILES </h1>
                

            </div>
                
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{'/'}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">{{$user->name}}</a>
                        </li>
                    </ol>
                </nav>
            
       </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="contentShadowInset">
        <div class="row justify-content-center dashboardas">
            <div class="col-md-8 col-xl-8">
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

                        

                        

                        

                        <p class="font-size-md font-italic">
                            
                       </p>

                       

                       

                       
                    
                    <div id="tableDiv" style="display:none" class="table-responsive table-wrapper-scroll-x my-custom-scrollbar">
                    <table id="FileTable" class="table table-hover .table-responsive">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <td colspan="8">Download</td>
                            <th scope="col">Updated at</th>
                            <th scope="col"><i class="fas fa-folder-minus"></i></th>
                            
                          </tr>
                        </thead>
                        <tbody>
                        
                        
                        @foreach ($files as $file)
                            
                        <tr>
                            <th scope="col">{{$file->id}}</th>
                            <td colspan="8"><a href="{{ route('download', ['file' => $file->id]) }}">{{$file->name}}</a></td>
                            <td colspan="col">{{$file->created_at}}</td>
                            <td colspan="col"><a href="{{ route('deleteFile', ['file' => $file->id]) }}"><i class="fas fa-folder-minus"></i></a></td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                    </div>
                    
                    
                       



                        <div class="text-center">
                            
                        <form action="{{ route('upload', ['user' => $user]) }}" method="post" role="form" enctype="multipart/form-data">
                             @csrf    
                            <label for="file-upload" class="custom-file-upload border-0" data-toggle="tooltip" data-placement="top" title="Press to upload a file">
                                <span style="font-size: 16px; color: Dodgerred;">
                                    <i class="fas fa-file mt-1"></i>
                                </span>    
                                
                            </label>
                            <input id="file-upload" type="file" name="file" />

                            <button type="submit" class="file-custom btn " data-toggle="tooltip" data-placement="top" title="Press to submit" >
                                <span style="font-size: 17px;">
                                    <i class="fas fa-upload"></i>
                                </span>    
                                    
                            </button>
                        </form>

                        
                        @if ($files->first() && Auth::user()->position == 'admin')

                        <form action="{{ route('deleteDir', ['user' => $user]) }}">
                            <input type="submit" class="btn btn-primary" value="Delete all" />
                            
                        </form>
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

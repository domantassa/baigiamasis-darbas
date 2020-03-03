@extends('layouts.backend', ['user' => $user, 'users' => $users, 'notif' => $notif])

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">ALL USERS </h1>
                
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{'/'}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="{{'/'}}">Users</a>
                        </li>
                    </ol>
                </nav>
            </div>
       </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-8 col-xl-8">
                <div class=" {{ $files->count() ? 'block' : '' }}">

                    <div class="block-content">
                        <p class="font-size-sm text-muted">
                            
                        </p>
                        <p class="font-size-sm text-muted">
                             <strong></strong>
                        </p>

                        

                        

                        

                        

                        <p class="font-size-md font-italic">
                            
                       </p>

                       
                    @if($users->count())
                    <div class="table-responsive table-wrapper-scroll-x my-custom-scrollbar ">
                    <table class="table table-hover .table-responsive">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <td colspan="8">Name & Lastname</td>
                            <th scope="col">Registered at</th>
                            <th scope="col"><i class="fas fa-user-minus"></i></th>
                            
                          </tr>
                        </thead>
                        <tbody>
                            
                        
                        @foreach ($users as $user)
                        
                        <tr>
                            <th scope="col">{{$user->id}}</th>
                            <td colspan="8"><a href="{{ url('dashboard/'.$user->id)}}">{{$user->name}}</a></td>
                            <td colspan="col">{{$user->created_at}}</td>
                            <td colspan="col"><a href="{{ route('deleteUser', ['user' => $user->id]) }} " data-toggle="tooltip" data-placement="top" title="Remove User"><i class="fas fa-user-minus"></i></a></td>
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

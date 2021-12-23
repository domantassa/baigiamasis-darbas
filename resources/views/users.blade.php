@extends('layouts.backend', ['user' => $user, 'users' => $users, 'notif' => $notif])

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <div class="content content-full pt-2" >
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h2 my-2 invisible" data-toggle="appear"
                data-class="animated fadeInUp"
                data-timeout="250"
                data-offset="-100">
                Visos aktyvios paskyros </h1>
            </div>
                
            
       </div>
                
                
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
                            <td colspan="8">Vardas & Pavardė</td>
                            <th scope="col">Užsiregistravo</th>
                            <th scope="col">Planas</th>
                            <th scope="col"><i class="fas fa-user-minus"></i></th>
                            <th scope="col"><i class="fas fa-user-edit"></i></th>
                            
                          </tr>
                        </thead>
                        <tbody>
                            
                        
                        @foreach ($users as $user1)
                        
                        <tr>
                            <td colspan="8"><a href="{{ url('dashboard/'.$user1->id)}}">{{$user1->name}}</a></td>
                            <td colspan="col">{{$user1->created_at}}</td>
                            <td colspan="col">{{$user1->plan}}</td>
                            <td colspan="col"><a href="{{ route('deleteUser', ['user' => $user1->id]) }} " data-toggle="tooltip" data-placement="top" title="Remove User"><i class="fas fa-user-minus"></i></a></td>
                            <td colspan="col"><a href="{{ route('user.show', ['user' => $user1->id]) }} " ><i class="fas fa-user-edit"></i></a></td>
                            
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

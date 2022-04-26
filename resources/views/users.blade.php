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
                            {{ __('Visos aktyvios paskyros') }} </h1>
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
                <div>

                    <div class="block-content">
                        
                        <p class="font-size-sm text-muted">
                            <strong></strong>
                        </p>
                        <p class="font-size-md font-italic">

                        </p>


                        
                       
                            <div class="table-responsive table-wrapper-scroll-x my-custom-scrollbar ">
                            @include('widgets.filters',[
                            'class'=>'User',
                            "attributes"=>['name','created_at','plan']
                            ])
                                <table class="table table-hover ">
                                    <thead>
                                        <tr>
                                            <th colspan="8">{{ __('Vardas') }} & {{ __('Pavardė') }}</th>
                                            <th scope="col">{{ __('Užsiregistravo') }}</th>
                                            <th scope="col">{{ __('Planas') }}</th>
                                            <th scope="col"><i class="fas fa-user-minus"></i></th>
                                            <th scope="col"><i class="fas fa-user-edit"></i></th>

                                        </tr>
                                    </thead>
                                    <tbody>


                                        @foreach ($users as $user1)

                                            <tr>
                                                <td colspan="8"><a
                                                        href="{{ url('dashboard/' . $user1->id) }}">{{ $user1->name }}</a>
                                                </td>
                                                <td colspan="col">{{ $user1->created_at }}</td>
                                                <td colspan="col">{{ __($user1->plan) }}</td>
                                                <td colspan="col"><a
                                                        href="{{ route('deleteUser', ['user' => $user1->id]) }} "
                                                        ><i
                                                            class="fas fa-user-minus"></i></a></td>
                                                <td colspan="col"><a
                                                        href="{{ route('user.show', ['user' => $user1->id]) }} "><i
                                                            class="fas fa-user-edit"></i></a></td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{$users->links()}}
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

    <script>
        $("select.filter-input option").each(function(){
            //alert($(this).html());
            if($(this).prop('value')=="name") $(this).html("{{__('Vardas')}}");
        });
        $("select.order-input option").each(function(){
            //alert($(this).html());
            if($(this).prop('value')=="name") $(this).html("{{__('Vardas')}}");
        });
    </script>
@endsection

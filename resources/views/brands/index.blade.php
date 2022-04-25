@extends('layouts.layout', ['user' => $user, 'users' => $users, 'notif' => $notif])

@section('content')
<div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <div class="content content-full pt-2">
                    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                        <h1 class="flex-sm-fill h2 my-2 invisible" data-toggle="appear" data-class="animated fadeInUp"
                            data-timeout="250" data-offset="-100">
                            {{ __('Brands') }} </h1>
                    </div>


                </div>


            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-10 col-xl-10">
                <div class="block">

                    <div class="block-content">
                        
                        <p class="font-size-sm text-muted">
                            <strong></strong>
                        </p>
                        <p class="font-size-md font-italic">

                        </p>



<div class="table-responsive table-wrapper-scroll-x my-custom-scrollbar ">
@include('widgets.filters',['class'=>'brand',
'attributes'=>[
    'name',
    'user_id',
    'industry',
    'website',
    'created_at'
    ]
    ])

<table class="table table-hover ">
    <thead>
            <tr>
                <th scope="col">{{ __('name') }}</th>
                <th scope="col">{{ __('vartotojas') }}</th>
                <th scope="col">{{ __('industry') }}</th>
                <th scope="col">{{ __('website') }}</th>
                <th scope="col"><i class="fas fa-edit"></i></th>
                <th scope="col"><i class="fas fa-trash"></i></th>
            </tr>
    </thead>
    <tbody>
        @foreach($brands as $brand)
            <tr>
                <td><a href="{{route('brand.edit',$brand->id)}}">{{$brand->name}}</a></td>
                <td>{{$brand->user()->first()->name}}</td> 
                <td>{{$brand->industry}}</td> 
                <td>{{$brand->website}}</td>

                <td><a href="{{route('brand.edit',$brand->id)}}"><i
                                                            class="fas fa-edit"></i></a></td>
                <td><a href="{{route('brand.delete',$brand->id)}}"><i class="fas fa-trash"></i></a></td> 
            </tr>
        @endforeach
    </tbody>
</table>
                {{$brands->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
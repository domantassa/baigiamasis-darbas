@extends('layouts.backend', ['user' => $user, 'users' => $users, 'notif' => $notif])

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div style="padding-left: 0px; padding-bottom: 0px" class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <div style="padding-left: 0px; padding-bottom: 0px" class="content content-full pt-2">
                    <div style="padding-left: 0px; padding-bottom: 0px" class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                        <h1 class="flex-sm-fill h2 invisible" data-toggle="appear" data-class="animated fadeInUp"
                            data-timeout="250" data-offset="-100">
                            {{ __('Užsakymo rezultatai') }} </h1>
                    </div>


                </div>
            </div>
            <div class="custom-form-group">
                            <h1 class="h4 m-0" style="display:inline-block;"> {{ __('Dizainerio komentaras') }}</h1>
                            <a style="color:white: display: inline-block; color: white; margin-bottom: 5px;" class="custom-file-upload btn btn-round btn-primary btn-green" >        
                                {{__('Atsisiųsti rezultatus ')}}        
                            </a>
                            <textarea class=" btn-round order-btn-grey form-btn placeholder" name="comment" placeholder="{{ __('Komentaras klientui') }}" style="max-width:1295px;width:100%;min-height:138px" readonly></textarea>
            </div>
            
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->

    <button class="btn btn-primary" id="reg-toggle" data-bs-toggle="modal" data-bs-target="#reg-modal">
        Open modal
    </button>

    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-8 col-xl-8">
                <div class="block">

                    <div class="block-content">



                        
                            <div class="table-responsive table-wrapper-scroll-x my-custom-scrollbar ">
                                <table class="table table-hover .table-responsive">
                                    <thead>
                                    <tr>
                                        
                                        @if($user->position == 'admin')
                                            <th colspan="13" style="text-align: center">{{$order->name}}</th>
                                        @else
                                            <th colspan="12" style="text-align: center">{{$order->name}}</th>
                                        @endif
                                        

                                    </tr>
                                        <tr>
                                            <th colspan="7">{{ __('Pavadinimas') }}</th>
                                            <th scope="col">{{ __('Atnaujinta') }}</th>
                                            <th scope="col">{{ __('Komentarai') }}</th>
                                            <th scope="col"><i class="fas fa-comment"></i></th>
                                            <th scope="col"><i class="fas fa-trash-alt"></i></th>
                                            <th scope="col"><i class="fas fa-file-download"></i></th>
                                            @if($user->position == 'admin')
                                            <th scope="col"><i class="fas fa-upload"></i></th>
                                            @endif
                                            
                                            

                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if ($imageRevisions->count())

                                        @foreach ($imageRevisions as $imageRevision)


                                            <?php
                                            $secondaryRevisions = 0;
                                            foreach ($imageRevisions as $secondaryImageRevision) {
                                                if($secondaryImageRevision->original_id == $imageRevision->id 
                                                && $secondaryImageRevision->id != $imageRevision->id) {
                                                    $secondaryRevisions = $secondaryRevisions + 1;
                                                }
                                            }
                                            ?>

                                            <tr>
                                                
                                                <td colspan="7">
                                                    @if($secondaryRevisions > 0)
                                                    <a href="{{ url('dashboard/1') }}">{{ $imageRevision->name }}</a>
                                                    @else
                                                    {{ $imageRevision->name }}
                                                    @endif
                                                </td>
                                                <td colspan="col">{{ $imageRevision->updated_at }}</td>
                                                <td colspan="col">{{ $imageRevision->comments_count ? $imageRevision->comments_count : '0' }}</td>
                                                <td colspan="col">
                                                    <a href="{{ route('imageComment.edit',$imageRevision->id) }} ">
                                                        <i class="fas fa-comment"></i>
                                                    </a> 
                                                </td>
                                                <td colspan="col">
                                                     <a href="{{ route('imageRevision.destroy', ['orderId' => $order->id, 'imageRevisionId' => $imageRevision->id]) }} ">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a> 
                                                </td>
                                                <td colspan="col">
                                                     <a  href="{{ route('imageRevision.download', ['orderId' => $order->id, 'imageRevisionId' => $imageRevision->id]) }} ">
                                                        <i class="fas fa-file-download"></i>
                                                    </a> 
                                                </td>
                                                @if($user->position == 'admin')
                                                <td colspan="col">
                                                     <a  href="{{ route('imageRevision.download', ['orderId' => $order->id, 'imageRevisionId' => $imageRevision->id]) }} ">
                                                        <i class="fas fa-upload"></i>
                                                    </a> 
                                                </td>
                                                @endif


                                            </tr>
                                        @endforeach


                                    @else
                                    <tr><td style="text-align: center;" colspan="12">{{ __('Užsakymas vykdomas, sugrįžti vėliau ') }}</td></tr>

                                    @endif

                                    </tbody>
                                </table>
                            </div>
                        
                        
                        
                    </div>
                </div>
                

                
            </div>
            
        </div>
        
    </div>
    </div>

    
    <!-- START OF MODAL  -->

    <div class="modal fade" style="text-align: center;" id="reg-modal" tabindex="-1" aria-labelledby="model-title" aria-hidden="true">
        <div style="max-width: 100%; width: auto !important; display: inline-block;"  class="modal-dialog modal-dialog-centered modal-dialog-scrollable" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">{{ __('Skirtingų versijų palyginimas')}}</h5>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div style="border: red" class="col-md-6 ">
                            <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dropdown
                            </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item" type="button">Action</button>
                                    <button class="dropdown-item" type="button">Another action</button>
                                    <button class="dropdown-item" type="button">Something else here</button>
                                </div>
                            </div>
                            
                                <div class="resource">
                                    <img src="{{asset('media/vectors/Problem solving-amico.svg')}}">
                                    <div id="fadein-overlay">
                                    <p class="fa fa-check fa-4x img-icon"></p>
                                </div>
                            </div>
                        </div>
                        <div style="border: red" class="col-md-6 ">
                            <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dropdown
                            </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item" type="button">Action</button>
                                    <button class="dropdown-item" type="button">Another action</button>
                                    <button class="dropdown-item" type="button">Something else here</button>
                                </div>
                            </div>
                            
                                <div class="resource">
                                    <img src="{{asset('media/vectors/Problem solving-amico.svg')}}">
                                    <div id="fadein-overlay">
                                    <p class="fa fa-check fa-4x img-icon"></p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <a style="margin-top: 5px;" href="http://127.0.0.1:8000/register" class="btn btn-sm btn-dual  btn-round btn-white mr-2 d-none d-lg-inline-block">
                                Patvirtinti
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
    $('#reg-toggle').on('click',function(){
        $('#reg-modal').modal('toggle');
    });
    </script>


    <!-- END OF MODAL -->
@endsection

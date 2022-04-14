@extends('layouts.layout', ['user' => $user, 'users' => $users, 'notif' => $notif])

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
                                {{__('Atsisiųsti rezultatus')}}        
                            </a>
                            <textarea style="display:block;" class=" btn-round order-btn-grey form-btn placeholder" name="comment" placeholder="{{ __('Komentaras klientui') }}" style="max-width:1295px;width:100%;min-height:138px" readonly>{{$order->comment}}</textarea>
            </div>
            
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->

    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-8 col-xl-8">
                <div class="block">

                    <div class="block-content">



                        
                            <div class="table-responsive table-wrapper-scroll-x my-custom-scrollbar ">
                                <table style="display: table"  class="table table-hover table-responsive">
                                    <thead>
                                    <tr class="w-100">
                                        
                                        @if($user->position == 'admin')
                                            <th colspan="13" style="text-align: center">{{$order->name}}</th>
                                        @else
                                            <th colspan="12" style="text-align: center">{{$order->name}}</th>
                                        @endif
                                        

                                    </tr>
                                        <tr class="w-100">
                                            <th colspan="7">{{ __('Pavadinimas') }}</th>
                                            <th scope="col">{{ __('Versijų skaičius') }}</th>
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

                                            <tr <?php echo"id='tr-image-revision-$imageRevision->id'" ?> <?php if($imageRevision->original_id != $imageRevision->id) echo "style='display: none;'" ?>>
                                                
                                                <td colspan="7">
                                                    @if($secondaryRevisions > 0)
                                                    <a class="reg-toggle" data-bs-toggle="modal" data-bs-target="#reg-modal" data_id="{{$imageRevision->id}}" href="#">{{ $imageRevision->name }}</a> <i style="padding-left: 5px; padding-right: 5px;" data-toggle="tooltip" data-placement="right" title="{{__('Pasirinkti aktyvią versiją')}}"  class="si si-info"></i>
                                                    @else
                                                    {{ $imageRevision->name }}
                                                    @endif
                                                </td>
                                                <td colspan="col">{{ $imageRevision->imageRevisions()->count() }}</td>
                                                <td colspan="col">{{ $imageRevision->comment_count }}</td>
                                                <td colspan="col">
                                                    <a rev_id="{{ $imageRevision->id }}" class="edit" href="{{ route('imageComment.edit',$imageRevision->id) }} ">
                                                        <i class="fas fa-comment"></i>
                                                    </a> 
                                                </td>
                                                <td colspan="col">
                                                     <a rev_id="{{ $imageRevision->id }}" class="destroy"  href="{{ route('imageRevision.destroy', ['orderId' => $order->id, 'imageRevisionId' => $imageRevision->id]) }} ">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a> 
                                                </td>
                                                <td colspan="col">
                                                     <a rev_id="{{ $imageRevision->id }}" class="download"   href="{{ route('imageRevision.download', ['orderId' => $order->id, 'imageRevisionId' => $imageRevision->id]) }} ">
                                                        <i class="fas fa-file-download"></i>
                                                    </a> 
                                                </td>
                                                @if($user->position == 'admin')
                                                <td colspan="col">
                                                     <a rev_id="{{ $imageRevision->id }}" class="upload"   href="{{ route('imageRevision.createNewUpload', $imageRevision->id) }} ">
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
                                {{ __('Paruoštos skirtingos versijos')}}
                            </button>
                                <div class="dropdown-menu prev-sel-1" aria-labelledby="dropdownMenu2">
                                @foreach ($imageRevisions as $imageRevision)
                                    <button original_id="{{$imageRevision->original_id}}" id="dropdown-image-revision-{{$imageRevision->id}}" revision_id="{{$imageRevision->id}}" class="dropdown-item img-src" type="button" data_src='{{asset("storage/".$imageRevision->path."/".$imageRevision->name)}}'> {{ $imageRevision->name }} </button>
                                    @endforeach
                                </div>
                            </div>
                            
                                <div class="resource">
                                    <img style="object-fit: cover;" id="prev-1" src="{{asset('media/vectors/Problem solving-amico.svg')}}" revision_id="0">
                                    <div id="fadein-overlay" class="prev-1" data_target="#prev-1">
                                    <p class="fa fa-check fa-4x img-icon"></p>
                                </div>
                            </div>
                        </div>
                        <div style="border: red" class="col-md-6 ">
                            <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ __('Paruoštos skirtingos versijos')}}
                            </button>
                                <div class="dropdown-menu  prev-sel-2" aria-labelledby="dropdownMenu2">
                                @foreach ($imageRevisions as $imageRevision)
                                    <button original_id="{{$imageRevision->original_id}}" id="dropdown-image-revision-{{$imageRevision->id}}" revision_id="{{$imageRevision->id}}" class="dropdown-item img-src" type="button" data_src='{{asset("storage/".$imageRevision->path."/".$imageRevision->name)}}'> {{ $imageRevision->name }} </button>
                                    @endforeach
  
                                </div>
                            </div>
                            
                                <div class="resource">
                                    <img style="object-fit: cover;" id="prev-2" src="{{asset('media/vectors/Problem solving-amico.svg')}}" revision_id="0">
                                    <div id="fadein-overlay" class="prev-2" data_target="#prev-2">
                                    <p class="fa fa-check fa-4x img-icon"></p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <button id="apply-revision" type="button" class=" btn btn-sm btn-dual  btn-round btn-white mr-2 d-none d-lg-inline-block">Patvirtinti</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var selected_revision_id=0;
        var original_id;

        $('.reg-toggle').on('click',function(){
        $('.img-selected').removeClass('img-selected');
        $('#prev-1').prop('src',old_src);
        $('#reg-modal').modal('show');
         original_id=$(this).attr('data_id');
        var new_src = $(this).attr('data_src');
    
        $('[original_id]').removeClass('d-block');
        $('[original_id='+original_id+']').addClass('d-block');
        var new_src = $('[revision_id='+original_id+'].img-src').attr('data_src');
    
        $('#prev-1').prop('src',new_src);
        $('#prev-1').attr('revision_id',original_id);


     
        $('[original_id='+original_id+']').each(function(){
            if($(this).attr('revision_id') != original_id){
                $('#prev-2').prop('src',$(this).attr('data_src'));
                $('#prev-2').attr('revision_id',$(this).attr('revision_id'));
            }
        });
     

    });
    var old_src = $('#prev-1').prop('src');
    $('.prev-sel-1 .img-src').on('click',function(){
        $('.img-selected').removeClass('img-selected');
        var new_src = $(this).attr('data_src');
        $('#prev-1').prop('src',new_src);
        $('#prev-1').attr('revision_id',$(this).attr('revision_id'));
    });
    $('.prev-sel-2 .img-src').on('click',function(){
        $('.img-selected').removeClass('img-selected');
        var new_src = $(this).attr('data_src');
        $('#prev-2').prop('src',new_src);
        $('#prev-2').attr('revision_id',$(this).attr('revision_id'));
    });
    
    $('.prev-1 , .prev-2').on('click',function(){
        
        selected_revision_id=$($(this).attr('data_target')).attr('revision_id');
        if(!$(this).hasClass('img-selected')){
            $('.img-selected').removeClass('img-selected');
            $(this).addClass('img-selected');
        }
        else $('.img-selected').removeClass('img-selected');
        console.log('selected:', selected_revision_id);
    });
    $('#apply-revision').on('click',function(){
        var new_elem= $('[revision_id='+selected_revision_id+'].img-src');
        var elem = $('[data_id='+ original_id+'].reg-toggle');
        $(elem).attr('data_id',$(new_elem).attr('revision_id'));
        $(elem).html($(new_elem).html());
        var domain = document.location.origin;
            domain= domain+'/dashboard';

        $('[rev_id='+original_id+']').attr('rev_id', selected_revision_id);
        $('[rev_id='+selected_revision_id+'].edit').prop('href',domain+ '/edit/image-revision/'+selected_revision_id );
        $('[rev_id='+selected_revision_id+'].destroy').prop('href',domain+ '/destroy/image-revision/'+selected_revision_id );
        $('[rev_id='+selected_revision_id+'].download').prop('href',domain+ '/download/image-revision/'+selected_revision_id );
        $('[rev_id='+selected_revision_id+'].upload').prop('href',domain+ '/upload/image-revision/'+selected_revision_id );

    
    $('[original_id='+original_id+']').attr('original_id',selected_revision_id);
    
    
    
        $.ajax({
                url: domain+ '/select/image-revision/'+selected_revision_id ,
                data:{}
                }).done(function(data) {
                ;
        });
    
        $('#reg-modal').modal('hide');
    
    
    
    
    });
    </script>

    


    <!-- END OF MODAL -->
@endsection

<!--<script src="{{asset('js/custom/order-result-pageBlade.js')}}"></script> identical code (for easier calculation of js) -->
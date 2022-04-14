@extends('layouts.layout', ['user' => $user, 'users' => $users, 'order' => '$order', 'imageRevision'=>$imageRevision, 'notif' => $notif])

@section('content')
<div class="bg-body-light">
        <div class="content content-full pt-2" >
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h2 my-2 invisible" data-toggle="appear"
                data-class="animated fadeInUp"
                data-timeout="250"
                data-offset="-100">
                {{ __('Įkelti rezultato naują versiją') }} </h1>
            </div>
                
            
       </div>
    </div>
   <!-- Page Content -->
   <div class="contentShadowInset">
        <div class="row justify-content-center dashboardas">
        <div class="col-md-12 col-xl-12">
            <div class="col-12 " style="padding-left:1.875rem">

                      
                       
                        
                    <form method="post" action="{{route('imageRevision.storeNewUpload', $imageRevision->id)}}" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="custom-form-group">
                            
                        <input type="file" name="files[]" id="fileToUpload" multiple><label for="fileToUpload" id="label-fileToUpload" class="btn btn-round order-btn-grey form-btn form-btn2 mt-2" style="width:auto"><diva id="btn-text" >{{ __('Prisegti failus') }} </diva>
                        <i class="fas fa-check-circle file-form"></i></label><div class=" mt-2 btn-round btn-trash file-input-trash hide click"><i class="fa fa-trash trash"></i></div>
                        </div>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                        <div class="img-preview-container">
                            <img style="width: 100%;" class="img-preview-container-item hide" id="preview-revision-image-1" src="#">
                            <img style="width: 100%;" class="img-preview-container-item hide" id="preview-revision-image-2" src="#">
                            <img style="width: 100%;" class="img-preview-container-item hide" id="preview-revision-image-3" src="#">
                            <img style="width: 100%;" class="img-preview-container-item hide" id="preview-revision-image-4" src="#">
                        </div>

                        <input id="input-1" type="submit" class="d-none">

                        <div class="custom-form-group pt-3">
                            <label class="d-inline  btn btn-green btn-primary btn-round  order-btn-primary m-1 click disable"  for="input-1">{{ __('Patvirtinti') }}</label> 
                            <a style="color:white; margin-bottom: 7px;" href="{{route('orders.show-results',$order->id)}}" style="display: inline-block" value="{{ __('Įkelti rezultatus') }}" class="mt-2 btn btn-green btn-primary btn-round"> {{ __('Rodyti rezultatus') }}</a>
                        </div>
                        

                        
                        </form>

                        </div>
                   </div>
                   </div>
                   </div>

                   <script type="text/javascript">
                        $('#fileToUpload').change(function(){

                        if(this.files[0] !== undefined) {
                            let reader = new FileReader();
                            reader.onload = (e) => { 
                            $('#preview-revision-image-1').attr('src', e.target.result); 
                            }
                            $('#preview-revision-image-1').removeClass("hide");
                            reader.readAsDataURL(this.files[0]); 
                        }

                        if(this.files[1] !== undefined) {
                            let reader = new FileReader();
                            reader.onload = (e) => { 
                            $('#preview-revision-image-2').attr('src', e.target.result); 
                            }
                            $('#preview-revision-image-2').removeClass("hide");
                            reader.readAsDataURL(this.files[1]); 
                        }

                        if(this.files[2] !== undefined) {
                            let reader = new FileReader();
                            reader.onload = (e) => { 
                            $('#preview-revision-image-3').attr('src', e.target.result); 
                            }
                            $('#preview-revision-image-3').removeClass("hide");
                            reader.readAsDataURL(this.files[2]); 
                        }

                        if(this.files[3] !== undefined) {
                            let reader = new FileReader();
                            reader.onload = (e) => { 
                            $('#preview-revision-image-4').attr('src', e.target.result); 
                            }
                            $('#preview-revision-image-4').removeClass("hide");
                            reader.readAsDataURL(this.files[3]); 
                        }

                    });
                    </script>

                   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                            <script>
                                $("#fileToUpload").change(function(){
                                    //alert(1);
                                    $(".file-input-trash").removeClass("hide");
                                    
                                    $(".file-form").addClass("d-inline-block");
                                   $(" #label-fileToUpload").addClass("btn-primary");
                                   $(" #label-fileToUpload").removeClass("order-btn-grey");
                                   $("#btn-text").text("{{ __('Failai prisegti') }}");
                                });
                                $(".file-input-trash").click(function(){
                                    $(".file-input-trash").addClass("hide");
                                    $('#preview-revision-image-1').addClass("hide");
                                    $('#preview-revision-image-2').addClass("hide");
                                    $('#preview-revision-image-3').addClass("hide");
                                    $('#preview-revision-image-4').addClass("hide");
                                    document.getElementById("fileToUpload").value = "";
                                    $(".file-form").removeClass("d-inline-block");
                                   $(" #label-fileToUpload").removeClass("btn-primary");
                                   $(" #label-fileToUpload").addClass("order-btn-grey");
                                   $("#btn-text").text("{{ __('Prisegti failus') }}");
                                });
                                </script>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- END Page Content -->
@endsection

<!--<script src="{{asset('js/custom/order-result-upload-revisionBlade.js')}}"></script> identical code (for easier calculation of js) -->
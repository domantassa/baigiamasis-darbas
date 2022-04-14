@extends('layouts.layout', ['user' => $user, 'users' => $users, 'notif' => $notif])

@section('content')
<style >


</style>




<div class="contentShadowInset">

    <button class="btn btn-primary" id="reg-toggle" data-bs-toggle="modal" data-bs-target="#reg-modal">
        Open modal
    </button>

    <div class="modal fade" style="text-align: center;" id="reg-modal" tabindex="-1" aria-labelledby="model-title" aria-hidden="true">
        <div style="max-width: 100%; width: auto !important; display: inline-block;"  class="modal-dialog modal-dialog-centered modal-dialog-scrollable" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">{{ __('Results comparison and selection')}}</h5>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div style="border: red" class="col-md-6 ">
                        <div class="dropdown">
                            <button class="btn  dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dropdown
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <button class="dropdown-item" type="button">Action</button>
                                <button class="dropdown-item" type="button">Another action</button>
                                <button class="dropdown-item" type="button">Something else here</button>
                            </div>
                        </div>
                        
                        <div class="resource">
                            <img class="vector filteris" src="{{asset('media/vectors/Problem solving-amico.svg')}}">
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

                    <a href="http://127.0.0.1:8000/register" class="btn btn-sm btn-dual  btn-round btn-white mr-2 d-none d-lg-inline-block">
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
    <!-- Button trigger modal -->


<!-- Modal -->


            <div style="margin-right: 10px; margin-left: 10px" class="row">
                <div style="border: red" class="col-md-6 "></div>
                <div style="border: red" class="col-md-6 "></div>

            </div>

</div>
@endsection

<!--<script src="{{asset('js/custom/image-comparerBlade.js')}}"></script> identical code (for easier calculation of js) -->
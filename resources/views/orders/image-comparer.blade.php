@extends('layouts.backend', ['user' => $user, 'users' => $users, 'notif' => $notif])

@section('content')
<style >

</style>



<div class="contentShadowInset">

    <button class="btn btn-primary" id="reg-toggle" data-bs-toggle="modal" data-bs-target="#reg-modal">
        Open modal
    </button>

    <div class="modal fade" id="reg-modal" tabindex="-1" aria-labelledby="model-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Get latest</h5>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div style="border: red" class="col-md-6 "><img class="vector filteris" src="{{asset('media/vectors/Problem solving-amico.svg')}}"></div>
                        <div style="border: red" class="col-md-6 "><img class="vector filteris" src="{{asset('media/vectors/Problem solving-amico.svg')}}"></div>

                    </div>
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
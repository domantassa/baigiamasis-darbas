@extends('layouts.layout', ['user' => $user, 'users' => $users, 'notif' => $notif])

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full" >

            
            
            <div class="message-field">
                <div class="messages">


                @foreach ($messages as $message)

                    @if ($message->sender_user_id === 1 && $message->receiver_user_id === $user->id && Auth::user()->id === 1)
                        <p class="message-received">{{ $message->message }}</p>
                    @elseif ($message->sender_user_id === 1 && $message->receiver_user_id === $user->id && Auth::user()->id !== 1)
                        <p class="message-sent">{{ $message->message }}</p>
                    @elseif ($message->sender_user_id === $user->id && $message->receiver_user_id === 1 && Auth::user()->id === 1)
                        <p class="message-sent">{{ $message->message }}</p>
                    @elseif ($message->sender_user_id === $user->id && $message->receiver_user_id === 1 && Auth::user()->id !== 1)
                        <p class="message-received">{{ $message->message }}</p>
                    @endif


                @endforeach
                </div>

                <form id="message-form" class="message-form" >
                    <div class="row">
                        <div class="col-10">
                    <input required type="text" name="message" id="message" class="form-control message_input" placeholder="Write a message...">
                        </div>
                        <div class="col-2">
                            <button type="submit" id="send-message" class="message_send btn btn-primary"><span class="show-on-monitor">{{__('Siųsti žinutę')}}</span ><span class="show-on-phone">></span></button>
                            
                        </div>
                    </div>
                </form>

                <script>
                    
                </script>
                
            </div>
            
        </div>
    </div>

    

    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>

    <script> 
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
    $receiverId = 0;
    $senderId = 0;
    if({{Auth::user()->id}} == 1) {
        $receiverId = {{$user->id}};
        $senderId = 1;
    } else {
        $receiverId = 1;
        $senderId = {{$user->id}};
    }

    $('#message-form').on('submit',function(event){
        event.preventDefault();
        $object=document.createElement('p');
        $($object).html($('#message').val());
        $msg=$('#message').val();
        $('#message').val('');
        $($object).addClass('message-received');
        $('.messages').append($object); 

        $.ajax({
               type:'POST',
               url:'{{route("postmsg")}}',
               data: {sender_id: $senderId, receiver_id: $receiverId, _token:"<?php echo csrf_token()?>",msg: $msg },
               success:function(data) {
                    
               }
            });
    
    });

    function appendMessageLive($message, $senderId) {
        if($senderId != null) {
            if({{$user->id}} == $senderId) {
                $newMessage=document.createElement('p');
                $($newMessage).html($message);

                $($newMessage).addClass('message-sent');
                $('.messages').append($newMessage); 
            }
        } else {
            $newMessage=document.createElement('p');
            $($newMessage).html($message);

            $($newMessage).addClass('message-sent');
            $('.messages').append($newMessage); 
        }
    }



    </script>

    <!--<script src="{{asset('js/custom/chatting.js')}}"></script> identical code (for easier calculation of js) -->
    
      
    <!-- END Page Content -->
@endsection
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
      $receiverId = 0;
      $senderId = 0;
      if($user == 1) {
          $receiverId = $userid;
          $senderId = 1;
      } else {
          $receiverId = 1;
          $senderId = $user;
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
              if($user == $senderId) {
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
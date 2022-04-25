
$(function(){
    $(".heading-compose").click(function() {
    $(".side-two").css({
        "left": "0"
    });
    });

    $(".newMessage-back").click(function() {
    $(".side-two").css({
        "left": "-100%"
    });
    });
}) 

function snackBarShow(message) {
var x = document.getElementById("snackbar-new");
    x.className = "show";
    x.innerHTML = message;
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}

var pusher = new Pusher('9457793ed2d8ec121ebf', {
cluster: 'eu'
});


var channel = pusher.subscribe('new-order-channel');
channel.bind('new-order-channel', function(data) {

    if($user == data.receiverUserId) {
        if(data.message === '{{ __("Įkeltas failas naujas failas!") }}')
            snackBarShow(data.message);
        else {
            if(document.getElementById('message') === null) {

                snackBarShow('{{ __("Gauta nauja žinutė!") }}');
            }
            if($user == data.receiverUserId) {
                appendMessageLive(data.message);
            }
            if($user == data.senderUserId) {
                appendMessageLive(data.message);
            } else if($user === 1) {
                appendMessageLive(data.message, data.senderUserId);
            }
            
        }
    }
    
        
        
});
        
            
        function myFunction() {
            
            var x = document.getElementById("FileTable").rows.length;
            if(x > 1)
                document.getElementById("tableDiv").style.display = "block";
        }

        function messageAsideToZero()
        {
            document.getElementById("messageCount").innerHTML = "";
        }

        
          
        


            function codeAddress() {
            $(document).ajaxComplete(function() {
                $('table').each(function(){
                    if($('tbody:empty',this))
                        $(this).hide();
                    else $(this).show();
                });
            });
            }

        window.onload = codeAddress;

        function imagefun() {
            var Image_Id = document.getElementById('getImage');
            if (Image_Id.src.match("imageName1.jpg")) {
                Image_Id.src = "imageName2.jpg";
            }
            else {
                Image_Id.src = "imageName1.jpg";
            }
        }   

$('#profile-button').on('click',function(){
    $('#profile-dropdown').toggle();
});

let currentAvatarNumber = $user;
$('#profile-avatar').on('click',function(){
        
    currentAvatarNumber = currentAvatarNumber + 1;

    $("#save-avatar-button").toggleClass("disabled", currentAvatarNumber === $user);

    if(currentAvatarNumber > 15) {
        currentAvatarNumber = 0;
    }

    $(this).attr('src',`{{ asset('media/avatars/avatar${currentAvatarNumber}.png') }}`);
    $('#small-profile-avatar').attr('src',`{{ asset('media/avatars/avatar${currentAvatarNumber}.png') }}`);
    
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

        $('#save-avatar-button').on('click',function(event){
            event.preventDefault();

            
            $.ajax({
                type:'POST',
                url:'{{route("postavatar")}}',
                data: {currentAvatarNumber: currentAvatarNumber,id: "<?php echo $user->id?>",_token:"<?php echo csrf_token()?>"},
                success:function(data) {
                        
                },
            });
        });

$('#help-button').on('click',function(e){
    e.preventDefault();
    $('.cus-tooltip-container').css('visibility','hidden');
    $('.cus-tooltip-container').first().css('visibility','visible');
});
$('.cus-tooltip-hide-steps-text').on('click', function(e){
    e.preventDefault();
    var ele=$(this).parents('.cus-tooltip-container');
    $(ele).css('visibility','hidden');
});
$('.cus-tooltip-next-step-button').on('click',function(e){
    e.preventDefault();
    var ele=$(this).parents('.cus-tooltip-container');
    var id = $(ele).attr('data_id');
    $(ele).css('visibility','hidden');
    id++;
    $('#cus-tooltip-container-'+id).css('visibility','visible');
});
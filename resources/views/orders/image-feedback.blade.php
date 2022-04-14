@extends('layouts.layout', ['user' => $user, 'users' => $users, 'notif' => $notif])

@section('content')
<style >
.con{
    display:block;
    height:280px;
    width:500px;
    background:red;
    position:relative;
    top:0;
    left:0;
}
#cont{
    position:relative;
    top:0;
    left:0;

}
#inputs{
    display:inline-block;
    
}
#inputs input{
        margin:5px;
    }
.dot{
    color:#fff;
    display:block;
    position: absolute;
    background: orange;
    width: 22px;
    height:22px;
    cursor:pointer;
    border-radius:10px;
    font-size: 14px;
    text-align: center;
}
.line{
    position:absolute;
}
</style>
<div id="cont" class="d-flex">
<div id="con" class="con">

</div>
<div id="inputs">
</div>

</div>
<script>
    var id=1;
    var position = $('#cont').position();
       

   $('#con').on('click',function(event){

       offsetX=event.pageX-position.left;
       offsetY=event.pageY-position.top;


  var $dotElement = $('<div class="dot" style="top:'+offsetY+'px;left:'+offsetX+'px">'+id+'</div>');
  var $input = $('<input type="text" class="d-block" id="input-'+id+'" >');
  var $textarea = $('<textarea id="w3review" name="w3review" rows="4" cols="50"></textarea>');

 
  $($dotElement).attr('id','dot-'+id);
  $($dotElement).on('click',function(e){

        $($input).css('width','200px');
        $input.select();
        });
    $($input).on('blur',function(e){
        $(this).css('width','inherit');
    });
    $($input).on('focus',function(e){
        $(this).css('width','200px');
    });
   
   $('#inputs').append(id);
   
   $('#inputs').append($input);
   $input.select(); 
    $('#cont').append($($dotElement));
    id++;
    });

</script>
@endsection

<!--<script src="{{asset('js/custom/image-feedbackBlade.js')}}"></script> identical code (for easier calculation of js) -->
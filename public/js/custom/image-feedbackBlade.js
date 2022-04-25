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
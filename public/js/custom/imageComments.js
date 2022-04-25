
function last_empty_input(){ 
    var last=$('.input-card .text-input[data_id='+id+']');
    console.log($(last).attr('data_id'));
    if($(last).val()=='' && id != 0){

        var $data_id = $(last).attr('data_id');
        $(last).parents('.dotcont').remove();
        $('[data_id='+$data_id+']').remove();
        id--;
    }

}

function hide_last(){
    $('.input-card').removeClass('d-block');
    $('.input-card').addClass('d-none');
}

function new_comment(id,e){
    var new_card =$(card).clone();
    var new_input_card = $(input_card).clone();
    position = $('#cont').position();
    var offsetX=e.pageX-position.left;
    var offsetY=e.pageY-position.top;
    
    
    $(new_card).attr('data_id',id);
    $(new_card).find('[data_id]').attr('data_id',id);
    $(new_card).find('.dot-style').html(id);
    
    $(new_input_card).prop('id','dotcont-'+id);
    $(new_input_card).find('[data_id]').attr('data_id',id);
    $(new_input_card).find('.dot').html(id);
    $(new_input_card).find('.dot').prop('id','dot-'+id);
    
    $(new_input_card).css('top',offsetY);
    $(new_input_card).css('left',offsetX);
    
    $(new_input_card).find('.y').val(offsetY);
    $(new_input_card).find('.x').val(offsetX);

    $(new_input_card).find('.y').attr('name','y-'+id);
    $(new_input_card).find('.x').attr('name','x-'+id);
    $(new_input_card).find('.text').attr('name','text-'+id);

    $(new_input_card).find('.input-card').toggleClass('d-block');
    $(new_input_card).find('.input-card').toggleClass('d-none');

    $('#cont').append(new_input_card);
    $('#inputs').append(new_card);
    
}

function refresh_nr(){
var i = 0;
$('.card').each(function(){
    i++;
    $(this).attr('data_id',i);
    $(this).find('[data_id]').attr('data_id',i);
    $(this).find('.dotcont').prop('id','dotcont-'+i);
    $(this).find('.dot-style').html(i);
    
});
 i = 0;

$('.dotcont').each(function(){
    i++;
    $(this).attr('data_id',i);
    $(this).find('[data_id]').attr('data_id',i);
    $(this).find('.dotcont').prop('id','dotcont-'+i);
    $(this).find('.dot').html(i);
    
});
nr=i;
id=i;
console.log(id,i);
}

 // new yra examle elementas 
var card = $('.example').find('.card').clone();
var input_card = $('.example').find('.dotcont').clone();
$('.example').remove();
var nr=$('.dot').length;
var id=nr;
var position = $('#cont').position();

    $(document).on('click','.dot , .dot-style ',function(){
        var $data_id = $(this).attr('data_id');
    

        $('.input-card:not([data_id='+$data_id+'])').removeClass('d-block');
        $('.input-card:not([data_id='+$data_id+'])').addClass('d-none');

        $('[data_id='+$data_id+'].input-card').toggleClass('d-block');
        $('[data_id='+$data_id+'].input-card').toggleClass('d-none');
    });   

    $(document).on('click','.delete',function(){
        var $data_id = $(this).parents('.input-card').attr('data_id');
        $(this).parents('.dotcont').remove();
        $('[data_id='+$data_id+']').remove();
       
    });
    $(document).on('click','.close',function(){
        var $data_id = $(this).parents('.input-card').attr('data_id');
        $('[data_id='+$data_id+'].input-card').toggleClass('d-block');
        $('[data_id='+$data_id+'].input-card').toggleClass('d-none');
       
    });
    $(document).on('keyup','.text-input',function(){
        var $data_id = $(this).parents('.input-card').attr('data_id');
        $('[data_id='+$data_id+']').find('.card-input').html($(this).val());
    });

$('.image').on('click',function(e){
    hide_last();
    last_empty_input();
    refresh_nr();
    id++;
    new_comment(id,e);
    
});

$('#file_edit').on('submit',function(e){
    e.preventDefault();
    var i = 1;
    $('.dotcont').each(function(){
        $(this).find('.x').attr('name','x-'+i);;
        $(this).find('.y').attr('name','y-'+i);;
        $(this).find('.text-input').attr('name','text-'+i);
        i++;
    });
    document.getElementById("file_edit").submit(); 
});
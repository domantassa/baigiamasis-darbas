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
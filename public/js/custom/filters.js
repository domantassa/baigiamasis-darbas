
if($('#filter-check').is(':checked')){
    $('.filter-group').addClass('active');
    $('.filter-check-group').addClass('active');
}

if($('#order-check').is(':checked')){
    $('.order-group').addClass('active');
    $('.order-check-group').addClass('active');
}
$('#filter-check').on('change',function(){
    $('.filter-group').toggleClass('active');
    $('.filter-check-group').toggleClass('active');

});
$('#order-check').on('change',function(){
    $('.order-group').toggleClass('active');
    $('.order-check-group').toggleClass('active');
});

$('.filter-input').on('input',function(){ 
    $('.filter-order-submit').removeClass('d-none');
});
$('selection.filter-input').on('input',function(){ 
    $('.filter-order-submit').removeClass('d-none');
});
$('.order-input').on('input',function(){ 
    $('.filter-order-submit').removeClass('d-none');
});


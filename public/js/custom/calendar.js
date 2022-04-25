var _token= $('meta[name="csrf-token"]').attr('content');
function calendar(){
$("[class^='event-']").on('click',function(){
    if($(this).hasClass('day_displayed'))
    {
            $('.active-eve').removeClass('active-eve');
            $("[id^=event-]").removeClass("inactive-eve");
            $("[id^=event-]").addClass("inactive-eve");
            $('.day_displayed').removeClass('day_displayed');
            $('.event_description').hide();
    }
    else{
        $('.event_description').show();
            $('.day_displayed').removeClass('day_displayed');
            $(this).addClass('day_displayed');
            $('.active-eve').removeClass('active-eve');
            $("[id^=event-]").removeClass("inactive-eve");
            $("[id^=event-]").addClass("inactive-eve");
            var $class=$(this).prop('class').split(" ");
            var length = $class.length;
            for(var i=0;i<length-1;i++)
            {
            $('#'+$class[i]).removeClass("inactive-eve");
            $('#'+$class[i]).addClass("active-eve");
            }
        }
      
});
$('#event_close').on('click',function(){
    $('.active-eve').removeClass('active-eve');
    $("[id^=event-]").removeClass("inactive-eve");
    $("[id^=event-]").addClass("inactive-eve");
    $('.day_displayed').removeClass('day_displayed');
    $('.event_description').hide();
});
}


function update($M,$Y,url )
{
    $('#calendar').addClass('cal-load');
    if($M==13){
        $M=1;
        $Y++;
    }
    if($M==0){
        $M=12;
        $Y--;
    }
    $.ajax({
                type : 'post',
                url : url,
                data:{'_token' : _token,'M':$M,'Y':$Y},
                success:function(data){
                    $('#calendar').html(data);
                    $('#calendar').removeClass('cal-load');
                    calendar();
                },
                

            });
}
$(document).on('click','.cal-buttons',function(){
    var m=parseInt($(this).attr('data_M'));
    var y=parseInt($(this).attr('data_Y'));
    var url= $(this).attr('data_url');
    update(m,y,url);
});
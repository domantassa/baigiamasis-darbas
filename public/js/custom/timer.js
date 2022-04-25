
function timer(){
        var now = new Date().getTime();
        
            $('.expected').each(function(){
                if($(this).attr('data-time') !="0000-00-00 00:00:00"){
                var countDownDate = new Date($(this).attr('data-time')).getTime();
                var distance = countDownDate - now;
                if(distance>0)
                {
                var days= Math.floor(distance/(1000*60*60*24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                if(minutes <10) minutes='0'+minutes;
                if(seconds <10) seconds='0'+seconds;
                if(hours <10) hours='0'+hours;
                $(this).html(days + "d " + hours + ":"+ minutes + ":" + seconds);
                }
                else{
                    $(this).html('{{ __("Labai greitai") }}');
                }
            }
            else{
                $(this).html('{{ __("Labai greitai") }}');
            }
               
        
        });
        setInterval(timer(),1000);
    }
                        


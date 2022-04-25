                            
                            
                            $('.color-trash-icon').on("click",function(){
                                $(this).parent().remove(); 
                    }); 
                    $('form').submit(function(){
                            $b=false;
                                $('input.form-btn').each(function(){
                                   
                                    if($(this).val() == "")
                                    {
                                        $b=true;
                                        $(this).addClass('invalid');
                                    }
                                });
                                $('textarea.form-btn2').each(function(){
                                   
                                   if($(this).val() == "")
                                   {
                                       $b=true;
                                       $(this).addClass('invalid');
                                   }
                               });
                            if($b){
                                return false;
                            }
                    });
                    $('input.form-btn').change(function(){

                                       $(this).removeClass('invalid');        
                               });
                    $('textarea.form-btn2').change(function(){
                                       $(this).removeClass('invalid');
                    });
                            
                            var hex="FF0000";
                                var RGB=[];
                                RGB['R']=255;
                                RGB['G']=0;
                                RGB['B']=0;
                                RGB['%']=100;
                                function dec_to_hex(dec){
                                    var liek = dec%16;
                                    var dal =  (dec-liek)/16;
                                    dal=dal.toString();
                                    liek=liek.toString(); 
                                    if(dal==10) dal="A";
                                    if(dal==11) dal="B";
                                    if(dal==12) dal="C";
                                    if(dal==13) dal="D";
                                    if(dal==14) dal="E";
                                    if(dal==15) dal="F";
                                    if(liek==10) liek="A";
                                    if(liek==11) liek="B";
                                    if(liek==12) liek="C";
                                    if(liek==13) liek="D";
                                    if(liek==14) liek="E";
                                    if(liek==15) liek="F";
                                    return dal+liek;
                                }
                                function hex_to_dec(Hex){
                                    var Hex1= Hex.substring(0,1);
                                    var Hex2= Hex.substring(1,2);
                                    if(Hex1=='A' || Hex1=='a') Hex1=10;
                                    if(Hex1=='B' || Hex1=='b') Hex1=11;
                                    if(Hex1=='C' || Hex1=='c') Hex1=12;
                                    if(Hex1=='D' || Hex1=='d') Hex1=13;
                                    if(Hex1=='E' || Hex1=='e') Hex1=14;
                                    if(Hex1=='F' || Hex1=='f') Hex1=15;
                                    if(Hex2=='A' || Hex2=='a') Hex2=10;
                                    if(Hex2=='B' || Hex2=='b') Hex2=11;
                                    if(Hex2=='C' || Hex2=='c') Hex2=12;
                                    if(Hex2=='D' || Hex2=='d') Hex2=13;
                                    if(Hex2=='E' || Hex2=='e') Hex2=14;
                                    if(Hex2=='F' || Hex2=='f') Hex2=15;
                                    Hex1=parseInt(Hex1);
                                    Hex2=parseInt(Hex2);
                                    return Hex1*16+Hex2;
                                }
                                $(function(){
                                    //$('.hex-select').val(hex);
                                    //$('.hexcube').css('background',"#"+hex);
                                    //$('.hex-range').each(function(){
                                    //    var id = $(this).attr('role');
                                    //    $(this).val(RGB[id]);
                                    //});
                                });

                                $(document).on('click','.editor-color-picker',function(){ 
                                    var bool=false;
                                    $parent=$(this).parent();
                                    $child=$($parent).find(".hex-dropdown");
                                    if($($child).hasClass('d-none')) bool=true; 
                                    $(".hex-dropdown").removeClass('d-block');
                                    $(".hex-dropdown").addClass('d-none');
                                    if(bool){
                                    $($child).toggleClass('d-block');
                                    $($child).toggleClass('d-none');
                                    }
                                });

                                function range(x){
                                    $('#editor-color-picker-container-'+x+' .hex-range').on('input',function(){
                                    $parent=$(this).parents('#editor-color-picker-container-'+x).find('.editor-color-picker');
                                    
                                    $('#editor-color-picker-container-'+x+' .hex-range').each(function(){
                                        var id = $(this).attr('role');
                                        RGB[id]=$(this).val();
                                    });
                                    //$('#hex-select-'+x).val(1);
                                    if(RGB['%']!=100)   $('#hex-select-'+x).val(dec_to_hex(RGB['R'])+dec_to_hex(RGB['G'])+dec_to_hex(RGB['B'])+dec_to_hex(RGB['%']));
                                    else                $('#hex-select-'+x).val(dec_to_hex(RGB['R'])+dec_to_hex(RGB['G'])+dec_to_hex(RGB['B']));
                                    $('#hexcube-'+x).css('background',"rgb("+RGB['R']+","+RGB['G']+","+RGB['B']+", "+RGB['%']/100+")");
                                    
                                    if(RGB['%']==100) hex=dec_to_hex(RGB['R'])+dec_to_hex(RGB['G'])+dec_to_hex(RGB['B']);
                                    else  hex=dec_to_hex(RGB['R'])+dec_to_hex(RGB['G'])+dec_to_hex(RGB['B'])+dec_to_hex(RGB['%']);
                                    $('#hexcube-'+x).css('background',"rgb("+RGB['R']+","+RGB['G']+","+RGB['B']+", "+RGB['%']/100+")");
                                    $('#hex-select-'+x).val(hex);
                                });



                                $('#editor-color-picker-container-'+x+' .hex-select').on('input',function(){
                                    hex=$(this).val();
                                    var Hex1=hex.substring(0,2);
                                    var Hex2=hex.substring(2,4);
                                    var Hex3=hex.substring(4,6);
                                    
                                    if(hex.length==8 || hex.length==6 ){
                                        RGB['R']=hex_to_dec(Hex1);
                                        RGB['G']=hex_to_dec(Hex2);
                                        RGB['B']=hex_to_dec(Hex3);
                                    }
                                    if(hex.length==8){
                                    var Hex4=hex.substring(6,8);        
                                    RGB['%']=hex_to_dec(Hex4);
                                    }
                                    if(hex.length==6 || hex.length==8 ){
                                        $('#editor-color-picker-container-'+x+' .hex-range').each(function(){
                                            var id = $(this).attr('role');
                                            $(this).val(RGB[id]);
                                        });
                                    }

                                    $('#editor-color-picker-container-'+x).find('.hexcube').css('background',"#"+hex);
                                });

                                }


                                $i=0;
                                for(var i = 0 ; i < $i ; i++)
                                {
                                    range(i);
                                }
                                
                                $('#hex-add').on('click',function(){
                                    $deleteIcon = $('#color-trash');
                                    $($deleteIcon).prop('id','color-trash-'+$i);
                                    $ob=$('#editor-color-picker-container-0').clone();
                                    $i++;
                                    $($ob).prop('id','editor-color-picker-container-'+$i);
                                    $($ob).find('*').each(function(){ // max 10 spalvu
                                       var temp= $(this).prop('id');
                                        temp= temp.substr(0,temp.length-1);
                                       $(this).prop('id',temp+$i);
                                    });
                                    $($ob).find('.hex-select').attr('name','hex-select-'+$i);
                                    
                                    $( $ob ).appendTo( "#hex-all" );
                                    range($i);

                                    $('#color-trash-'+$i).on('click',function(){
                                        $(this).parent().remove(); 

                                    });
                                });

                                $("#fileToUpload").change(function(){
                                    $(".file-input-trash").removeClass("hide");
                                    $(".file-form").addClass("d-inline-block");
                                   $(" #label-fileToUpload").addClass("btn-primary");
                                   $(" #label-fileToUpload").removeClass("order-btn-grey");
                                   $("#btn-text").text("{{ __('Failai prisegti') }}");
                                });
                                $(".file-input-trash").click(function(){
                                    $(".file-input-trash").addClass("hide");
                                    document.getElementById("fileToUpload").value = "";
                                    $(".file-form").removeClass("d-inline-block");
                                   $(" #label-fileToUpload").removeClass("btn-primary");
                                   $(" #label-fileToUpload").addClass("order-btn-grey");
                                   $("#btn-text").text("{{ __('Prisegti failus') }}");
                                });
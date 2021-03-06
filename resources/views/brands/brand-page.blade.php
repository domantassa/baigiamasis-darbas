@extends('layouts.backend', ['user' => $user, 'users' => $users, 'notif' => $notif])

@section('content')
<!-- Hero -->
<div class="bg-body-light">
        <div class="content content-full pt-2" >
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h2 my-2 invisible" data-toggle="appear"
                data-class="animated fadeInUp"
                data-timeout="250"
                data-offset="-100">
                {{__('Įmonės prekės ženklas')}}   </h1>
            </div>
                
            
       </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="contentShadowInset">
        <div class="row justify-content-center dashboardas">
        <div class="col-md-12 col-xl-12">
            <div class="col-12 " style="padding-left:1.875rem">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


                      
                        <form  action="{{route('brand.store')}}" method="post" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">1. {{__('Pavadinimas')}}*</h1>
                                <input type="text" value="" placeholder="{{ __('Pavadinimas') }}" name="title" class=" btn-round order-btn-grey form-btn form-btn2" >
                        </div>  
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">2. {{__('Veiklos sritis')}}*</h1>
                            <input type="text" placeholder="{{ __('Veiklos sritis') }}" name="industry" class=" btn-round order-btn-grey form-btn form-btn2" >
                        </div>
                        
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">3. {{__('Aprašymas')}}*</h1>
                            <textarea name="description" rows="6" class=" btn-round order-btn-grey form-btn form-btn2" placeholder="{{__('Pradėti rašyti')}}"></textarea>
                        </div>
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">4. {{__('Svetainė')}}*</h1>
                            <input type="text" placeholder="www.example.com" name="website" class=" btn-round order-btn-grey form-btn form-btn2" >
                        </div>
                        
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">5. {{__('Įmonės prekės ženklo failai / pavyzdžiai')}}:</h1>
                        <input type="file" name="files[]" id="fileToUpload" multiple><label for="fileToUpload" id="label-fileToUpload" class="btn btn-round order-btn-grey form-btn form-btn2 mt-2" style="width:auto"><diva id="btn-text" >{{ __('Prisegti failus') }} </diva>
                        <i class="fas fa-check-circle file-form"></i></label><div class=" mt-2 btn-round btn-trash file-input-trash hide click"><i class="fa fa-trash trash"></i></div>
                        </div>
                        <div class="custom-form-group" id="hex-all">
                            <h1 class="h4 m-0">6. {{__('Spalvos')}}:*</h1>
                            <div id="editor-color-picker-container-0" class="d-block m-2">
                                <button type="button" id="editor-color-picker-0" class="btn btn-primary editor-color-picker" ><div id="hexcube-0" class="hexcube"></div></button>
                                <ul id="hex-dropdown-0"  class="d-none hex-dropdown"> 
                                <div class="d-block">R<input type="range" class="hex-range"  max="255" class="hex-select-R" id="hex-select-R-0" role="R"></div>
                                <div class="d-block">G<input type="range" class="hex-range"  max="255" class="hex-select-G" id="hex-select-G-0" role="G"></div>
                                <div class="d-block">B<input type="range" class="hex-range"  max="255" class="hex-select-B" id="hex-select-B-0" role="B"></div>
                                <div class="d-block">%<input type="range" class="hex-range"  max="100" class="hex-select-%" id="hex-select-%-0" role="%"></div>
                                    #<input type="text" name="hex-select-0" class="hex-select" id="hex-select-0">
                                    
                                </ul>
                                <div class="  btn-round btn-trash color-trash-icon click" id="color-trash"><i class="fa fa-trash trash"></i></div>
                            </div>

                        </div>
                        <div class="  btn-round btn-add-color mt-2" id="hex-add" >{{__('Pridėti spalvą')}}</div>

                        <input type="submit" value="{{ __('Siųsti užklausą') }}" class="mt-3 btn btn-green btn-primary btn-round">

                    <script>


                    </script>    
                </form>
                        <script>
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
                            </script>

                            <script>
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
                                    $('.hex-select').val(hex);
                                    $('.hexcube').css('background',"#"+hex);
                                    $('.hex-range').each(function(){
                                        var id = $(this).attr('role');
                                        $(this).val(RGB[id]);
                                    });
                                });

                                $(document).on('click','.editor-color-picker',function(){ // refresh dom
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
                                /*
                                $('.hex-select').on('input',function(){
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
                                        $('.hex-range').each(function(){
                                            var id = $(this).attr('role');
                                            $(this).val(RGB[id]);
                                        });
                                    }

                                    $('.hexcube').css('background',"#"+hex);
                                });
                                */
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
                                    $($parent).find('.hexcube').css('background',"rgb("+RGB['R']+","+RGB['G']+","+RGB['B']+", "+RGB['%']/100+")");
                                    
                                    if(RGB['%']==100) hex=dec_to_hex(RGB['R'])+dec_to_hex(RGB['G'])+dec_to_hex(RGB['B']);
                                    else  hex=dec_to_hex(RGB['R'])+dec_to_hex(RGB['G'])+dec_to_hex(RGB['B'])+dec_to_hex(RGB['%']);
                                    $($parent).find('.hexcube').css('background',"rgb("+RGB['R']+","+RGB['G']+","+RGB['B']+", "+RGB['%']/100+")");
                                    $($parent).find('.hex-select').val(hex);
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

                                    $('#editor-color-picker-container-'+x+' .hexcube').css('background',"#"+hex);
                                });

                                }



                                range(0);
                                $i=0;
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
                                    /*
                                    $('#editor-color-picker-'+$i).on('click',function(){
                                        $parent=$(this).parent();
                                        $child=$($parent).find(".hex-dropdown");
                                        $($child).toggleClass('d-block');
                                        $($child).toggleClass('d-none');
                                    });
                                    */
                                    $('#color-trash-'+$i).on('click',function(){
                                        $(this).parent().remove(); 

                                    });
                                });
                                </script>

                    <div class="block-content">
                        <p class="font-size-sm text-muted">
                            
                        </p>
                        <p class="font-size-sm text-muted">
                             <strong></strong>
                        </p>

                        <form action="{{ route('upload', ['user' => $user]) }}" method="post" role="form" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" id="file" aria-label="File browser example" >
                            
                            
                        </form>

                        <p class="font-size-md font-italic">
                            
                       </p>

                       

                       
                       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                            <script>
                                $("#fileToUpload").change(function(){
                                    //alert(1);
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
                                </script>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                       
                    
                    <div id="tableDiv" style="display:none" class="table-responsive table-wrapper-scroll-x my-custom-scrollbar">
                    <table id="FileTable" class="table table-hover .table-responsive">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <td colspan="8">{{ __('Atsisiųsti') }}</td>
                            <th scope="col" class="d-none d-md-table-cell"> {{ __('Įkelti') }}</th>
                            <th scope="col"><i class="fas fa-folder-minus"></i></th>
                            
                          </tr>
                        </thead>
                        <tbody>
                    
                        </tbody>
                    </table>
                    </div>    
                    </div>
                    <div class="block-header">
                        <h3 class="block-title"></h3>
                    </div>
                    
                    

                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
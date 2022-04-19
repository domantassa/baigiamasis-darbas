@extends('layouts.layout', ['user' => $user, 'users' => $users, 'notif' => $notif])

@section('content')
    <!-- Hero -->
    
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2 invisible" data-toggle="appear"
                data-class="animated fadeInUp"
                data-timeout="250"
                data-offset="-100">
                {{ __('Užsakymo forma') }} </h1>
               
            
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


                      
                        <form  action="{{route('orders.store')}}" method="post" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">1. {{ __('Užsakymo pavadinimas')}}*</h1>
                                <input type="text" placeholder="{{ __('Pavadinimas') }}" name="title" class=" btn-round order-btn-grey form-btn form-btn2" >
                        </div>  
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">2. {{ __('Pasirinkite sukurtą įmonės prekės ženklą') }}</h1>
                            <select name="brand" class=" minimal btn-round order-btn-grey form-btn form-btn2" style="width:auto" >
                            
                            <option> {{ __('Nepasirinkta') }}</option >

                            @foreach ($allBrands as $oneBrand)
                                @if((Auth::user()->id === $oneBrand->user_id))

                                    <option> {{$oneBrand->name}}</option >

                                @endif	
                            @endforeach	


                            </select>
                        </div>

                        <div class="custom-form-group">
                            <h1 class="h4 m-0">3. {{ __('Pasirinkite užsakymo tipą') }}</h1>
                            <select name="type" class=" minimal btn-round order-btn-grey form-btn form-btn2" style="width:auto" >
                            
                            <option> {{ __('Soc. medijų baneris') }}</option >   
                            <option> {{ __('Vizitinė kortelė') }}</option >
                                <option> {{ __('Nuolaidų kuponas') }}</option >
                                <option> {{ __('Lankstinukas') }}</option >   
                            <option> {{ __('Prezentacija') }}</option >
                                <option> {{ __('Kvietimas') }}</option >
                                <option> {{ __('Ikona') }}</option >   
                            <option> {{ __('Nuotraukų redagavimas') }}</option >
                                <option> {{ __('FB, IG Story dizainas') }}</option >
                                <option> {{ __('Lauko reklama') }}</option >   
                            <option> {{ __('Lipdukas') }}</option >
                                <option> {{ __('Pakuočių dizainas') }}</option >
                                <option> {{ __('Skrajutės') }}</option >   
                            <option> {{ __('Marškinėlių dizainas') }}</option >
                                <option> {{ __('Infografika') }}</option >
                                <option> {{ __('Sąs. faktūrų dizainas') }}</option >
                                <option> {{ __('Etiketė') }}</option >



                            </select>
                        </div>
                        
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">4. {{ __('Kas turi matytis galutiniame rezultate') }}:*</h1>
                            <textarea name="result" rows="6" class=" btn-round order-btn-grey form-btn form-btn2" placeholder="{{ __('Pradėti rašyti') }}"></textarea>
                        </div>
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">5. {{ __('Darbo reikalavimai') }}:*</h1>
                            <textarea rows="6" name="requirements" class=" btn-round order-btn-grey form-btn form-btn2" placeholder="{{ __('Pradėti rašyti') }}"></textarea>
                        </div>
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">6. {{ __('Reikalingi failai / pavyzdžiai')}}:</h1>
                        <input type="file" name="files[]" id="fileToUpload" multiple><label for="fileToUpload" id="label-fileToUpload" class="btn btn-round order-btn-grey form-btn form-btn2" style="width:auto"><diva id="btn-text" >{{ __('Prisegti failus') }} </diva>
                        <i class="fas fa-check-circle file-form"></i></label><div class="  btn-round btn-trash file-input-trash hide click"><i class="fa fa-trash trash"></i></div>
                        </div>
                        
                        <script>

                            </script>
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">7. {{ __('Papildomi komentarai') }}:</h1>
                            <textarea rows="3" name="feedback" class=" btn-round order-btn-grey form-btn " placeholder="{{ __('Pradėti rašyti') }}"></textarea>
                        </div>

                        <input type="submit" value="{{ __('Siųsti užklausą') }}" class="mt-2 btn btn-green btn-primary btn-round">

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
                                   $("#btn-text").text("Failai prisegti");
                                });
                                $(".file-input-trash").click(function(){
                                    $(".file-input-trash").addClass("hide");
                                    document.getElementById("fileToUpload").value = "";
                                    $(".file-form").removeClass("d-inline-block");
                                   $(" #label-fileToUpload").removeClass("btn-primary");
                                   $(" #label-fileToUpload").addClass("order-btn-grey");
                                   $("#btn-text").text("Prisegti failus");
                                });
                                </script>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                       
                    
                    <div id="tableDiv" style="display:none" class="table-responsive table-wrapper-scroll-x my-custom-scrollbar">
                    <table  id="FileTable" class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <td colspan="8">Download</td>
                            <th scope="col" class="d-none d-md-table-cell">Uploaded</th>
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

<!--<script src="{{asset('js/custom/ordersCreateBlade.js')}}"></script> identical code (for easier calculation of js) -->

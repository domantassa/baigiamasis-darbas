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
                Užsakymo forma </h1>
               
            
            </div>
                            
            <!-- parsisiųsti pavyzdį
            <label class="custom-file-upload btn btn-round btn-primary btn-green" >    
                <input type="file"/>
                Parsisiųsti pavyzdį
            </label>
            -->
                
       </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="contentShadowInset">
        <div class="row justify-content-center dashboardas">
        <div class="col-md-12 col-xl-12">
            <div class="col-12 " style="padding-left:1.875rem">

                @if( $user->position == 'admin')
                        <form action="{{route('orders.update',$order->id)}}" method="post" role="form" enctype="multipart/form-data">
                        @csrf
                        
                        <input name="_method" type="hidden" value="PUT">
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">1. {{ __('Užsakymo pavadinimas')}}</h1>
                                <input type="text" placeholder="Pavadinimas" name="title" value="{{$order->name}}"  class=" btn-round order-btn-grey form-btn">
                        </div> 
                         
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">2. {{ __('Pasirinkite užsakymo tipą') }}</h1>
                            <select name="type" class=" minimal btn-round order-btn-grey form-btn" style="width:auto">
                            <option>{{__($order->type)}}</option >   
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
                            <h1 class="h4 m-0">3. {{ __('Kas turi matytis galutiniame rezultate') }} :</h1>
                            <textarea name="result" rows="6" class=" btn-round order-btn-grey form-btn" placeholder="Pradėti rašyti">{{$order->result}}</textarea>
                        </div>
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">4. {{ __('Darbo reikalavimai') }} :</h1>
                            <textarea rows="6" name="requirements" class=" btn-round order-btn-grey form-btn" placeholder="Pradėti rašyti">{{$order->requirements}}</textarea>
                        </div>
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">5. {{ __('Reikalingi failai / pavyzdžiai')}} :</h1>
                            @foreach($order->file()->get() as $file)
                        <div>
                        <a href="{{route('download',$file->id)}}"><label class="btn btn-round order-btn-grey form-btn mr-2" style="width:auto">Atsisiųsti</label></a>
                        {{$file->name}}
                        </div>
                        @endforeach

                        <input type="file" name="files[]" id="fileToUpload" multiple readonly><label for="fileToUpload" id="label-fileToUpload" class="btn btn-round order-btn-grey form-btn" style="width:auto"><diva id="btn-text" >Prisegti failus </diva>
                        <i class="fas fa-check-circle file-form"></i></label><div class="  btn-round btn-trash file-input-trash hide click"><i class="fa fa-trash trash"></i></div>
                        </div>
                        <script>

                            </script>
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">6. {{ __('Papildomi komentarai') }} :</h1>
                            <textarea rows="3" name="feedback" class=" btn-round order-btn-grey form-btn" placeholder="Pradėti rašyti">{{$order->feedback}}</textarea>
                        </div>

                        <div class="custom-form-group">
                            <h1 class="h4 m-0">7. {{ __('Užsakymo būsena')}}:</h1>
                            <select class="minimal btn-round order-btn-grey form-btn" name="state" style="width:auto">
                            <option selected>{{__($order->state)}}</option>
                            <option> {{__('Projektas atliktas')}}</option >   
                            <option> {{__('Projektas kuriamas')}}</option >
                                <option> {{__('Projektas atšauktas')}}</option >
                            </select>
                        </div>
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">8. {{ __('Tikėtina darbo pabaiga') }} :</h1>
                                <input type="text" placeholder="Tikėtina" name="expected_at" value="{{$order->expected_at}}"  class=" btn-round order-btn-grey form-btn">
                        </div> 
                        @else 
                        <form action="{{route('orders.update',$order->id)}}" method="post" role="form" enctype="multipart/form-data">
                        @csrf
                        
                        <input name="_method" type="hidden" value="PUT">
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">1. {{ __('Užsakymo pavadinimas')}} :</h1>
                                <input type="text" placeholder="Pavadinimas" name="title" value="{{$order->name}}"  class=" btn-round order-btn-grey form-btn" >
                        </div>
                        
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">2. {{ __('Pasirinkite sukurtą įmonės prekės ženklą') }}</h1>
                            <select name="brand" class=" minimal btn-round order-btn-grey form-btn form-btn2" style="width:auto"  >
                            
                            <option> {{ __('Nepasirinkta') }}</option >

                            @foreach ($allBrands as $oneBrand)
                                @if((Auth::user()->id === $oneBrand->user_id))

                                    <option> {{$oneBrand->name}}</option >

                                @endif	
                            @endforeach	

                            @if(count($allBrands) == 0)
                                <option> {{ __('Nepasirinkta') }}</option >
                            @endif
                            </select>
                        </div>
                        
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">3. {{ __('Pasirinkite užsakymo tipą') }} :</h1>
                            
                            <input name="type" value='{{$order->type}}' type="hidden">
                            <select  class=" minimal btn-round order-btn-grey form-btn" style="width:auto" >
                            <option>{{__($order->type)}}</option >   
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
                            <h1 class="h4 m-0">4. {{ __('Kas turi matytis galutiniame rezultate') }} :</h1>
                            <textarea name="result" rows="6" class=" btn-round order-btn-grey form-btn" placeholder="Pradėti rašyti" >{{$order->result}}</textarea>
                        </div>
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">5. {{ __('Darbo reikalavimai') }} :</h1>
                            <textarea rows="6" name="requirements" class=" btn-round order-btn-grey form-btn" placeholder="Pradėti rašyti" >{{$order->requirements}}</textarea>
                        </div>
                        @if(count($order->file()->get()) > 0)

                        <div class="custom-form-group">
                            <h1 class="h4 m-0">6. {{ __('Reikalingi failai / pavyzdžiai')}} :</h1>
                            @foreach($order->file()->get() as $file)
                        <div>
                        <a href="{{route('download',$file->id)}}"><label class="btn btn-round order-btn-grey form-btn mr-2" style="width:auto" >{{ __('Atsisiųsti') }}</label></a>
                        {{$file->name}}
                        </div>
                        @endforeach

                        
                        </div>
                        @else
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">7. {{ __('Prisegtų failų nėra') }}</h1>
                        <div>
                        @endif
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                            <script>
                                $("#fileToUpload").change(function(){
                                    //alert(1);
                                    $(".file-form").addClass("d-inline-block");
                                   $(" #label-fileToUpload").addClass("btn-primary");
                                   $(" #label-fileToUpload").removeClass("order-btn-grey");
                                   $("#btn-text").text("Failai prisegti");
                                });
                                </script>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                        <div class="custom-form-group">
                            <h1 class="h4 m-0"> {{ __('7. Papildomi komentarai') }}:</h1>
                            <textarea rows="3" name="feedback" class=" btn-round order-btn-grey form-btn"  placeholder="{{ __('Pradėti rašyti') }}">{{$order->feedback}}</textarea>
                        </div>
                        
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">8. {{ __('Tikėtina darbo pabaiga') }}:</h1>
                                <input type="text" placeholder="{{ __('Tikėtina') }}" name="expected_at" value="{{$order->expected_at}}"  class=" btn-round order-btn-grey form-btn" readonly>
                        </div> 
                        @endif


                            <input id="input-1" type="submit" class="d-none">
                           
                        </form>
                        <label for="input-1" type="submit" class="mt-2 btn btn-green btn-primary btn-round">{{ __('Išsaugoti') }}</label>
                        @if( $user->position == 'admin')
                        <a style="color:white; margin-bottom: 7px;" href="{{route('upload-orders-result',$order->id)}}" style="display: inline-block" value="{{ __('Įkelti rezultatus') }}" class="mt-2 btn btn-green btn-primary btn-round"> {{ __('Įkelti rezultatus') }}</a>
                        @elseif( $order->number_of_revisions > 0)
                        <a style="color:white; margin-bottom: 7px;" href="{{route('orders.show-results',$order->id)}}" style="display: inline-block" value="{{ __('Pamatyti rezultatus') }}" class="mt-2 btn btn-green btn-primary btn-round"> {{ __('Pamatyti rezultatus') }}</a>
                        @endif
                    <div class="block-content">

                        <form action="{{ route('upload', ['user' => $user]) }}" method="post" role="form" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" id="file" aria-label="File browser" >
                            
                            
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
                        </tbody>
                    </table>
                    </div>     
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

<!--<script src="{{asset('js/custom/ordersEditBlade.js')}}"></script> identical code (for easier calculation of js) -->
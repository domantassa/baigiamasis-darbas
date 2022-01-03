@extends('layouts.backend', ['user' => $user, 'users' => $users, 'notif' => $notif])

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

    <!-- Page Content -->
    <div class="contentShadowInset">
        <div class="row justify-content-center dashboardas">
        <div class="col-md-12 col-xl-12">
            <div class="col-12 " style="padding-left:1.875rem">

                      
                        
                        
                        <input name="_method" type="hidden" value="PUT">
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">1. Užsakymo pavadinimas</h1>
                                <input type="text" placeholder="Pavadinimas" name="title" value="{{$order->name}}"  class=" btn-round order-btn-grey form-btn" disabled>
                        </div>  
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">2. Pasirinkite užsakymo tipą</h1>
                            <select class="select btn-round order-btn-grey form-btn" name="type" style="width:auto" disabled>
                            <option>{{$order->type}}</option>
                            <option> Baneriai</option >   
                            <option> Plakatas</option >
                                <option> UI/UX</option >
                                <option> Kiti</option >



                            </select>
                        </div>
                        
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">3. Kas turi matytis galutiniame rezultate :</h1>
                            <textarea name="result" rows="6" class=" btn-round order-btn-grey form-btn" placeholder="Pradėti rašyti" disabled>{{$order->result}}</textarea>
                        </div>
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">4. Darbo reikalavimai :</h1>
                            <textarea rows="6" name="requirements" class=" btn-round order-btn-grey form-btn" placeholder="Pradėti rašyti" disabled>{{$order->requirements}}</textarea>
                        </div>
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">5. Reikalingi failai / pavyzdžiai :</h1>
                            @foreach($order->file()->get() as $file)
                        <div>
                        <a href="{{route('download',$file->id)}}"><label class="btn btn-round order-btn-grey form-btn mr-2" style="width:auto">Atsisiųsti</label></a>
                        {{$file->name}}
                        </div>
                        @endforeach

                        
                        </div>
                        <script>

                            </script>
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">6. Papildomi komentarai :</h1>
                            <textarea rows="3" name="feedback" class=" btn-round order-btn-grey form-btn" placeholder="Pradėti rašyti" disabled>{{$order->feedback}}</textarea>
                        </div>

                        @if( $user->position == 'admin')
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">7. Užsakymo būsena</h1>
                            <select class=" btn-round order-btn-grey form-btn" name="state" style="width:auto" disabled>
                            <option selected>{{$order->state}}</option>
                            <option> Projektas atliktas</option >   
                            <option> Projektas koreguojamas</option >
                                <option> Projektas atšauktas</option >
                            </select>
                        </div>
                        @else 
                        <div class="custom-form-group">
                            <h1 class="h4 m-0">7. Užsakymo būsena</h1>
                            <input type="hidden" name="state" value="{{$order->state}}">
                            <select class=" btn-round order-btn-grey form-btn"  style="width:auto" disabled>
                            <option selected>{{$order->state}}</option>
                            <option> Projektas atliktas</option >   
                            <option> Projektas koreguojamas</option >
                                <option> Projektas atšauktas</option >
                            </select>
                        </div>
                        @endif
                       
                        </form>

                    <div class="block-content">
                        <p class="font-size-sm text-muted">
                            
                        </p>
                        <p class="font-size-sm text-muted">
                             <strong></strong>
                        </p>

                        

                        <p class="font-size-md font-italic">
                            
                       </p>

                       

                       
                       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                            <script>
                                $("#fileToUpload").change(function(){
                                    //alert(1);
                                   $(" #label-fileToUpload").addClass("btn-primary");
                                   $(" #label-fileToUpload").removeClass("order-btn-grey");
                                   order-btn-grey
                                });
                                </script>
                       
                    
                    <div id="tableDiv" style="display:none" class="table-responsive table-wrapper-scroll-x my-custom-scrollbar">

                    </div>
                    
                    
                       



                        <div class="text-center">

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

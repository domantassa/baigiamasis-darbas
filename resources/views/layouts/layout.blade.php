<!doctype html>
<html lang="lt" style="background: #f9f9f9 !important">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>{{__('Rekos užsakymai')}}</title>	
        <meta name="description" content="Rekos užsakymai">	
        <meta name="author" content="DomantasSabaliauskas">
        <meta name="robots" content="noindex, nofollow">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        

        <!-- Icons -->
        <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
        <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">
        <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
         <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>



        <!-- Fonts and Styles -->
        @yield('css_before')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
        <link rel="stylesheet" id="css-main" href="{{ asset('/css/oneui.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        @yield('css_after')

        

        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <script src="//fast.appcues.com/111145.js"></script>
        <script>

            $(function(){
                $(".heading-compose").click(function() {
                $(".side-two").css({
                    "left": "0"
                });
                });

                $(".newMessage-back").click(function() {
                $(".side-two").css({
                    "left": "-100%"
                });
                });
            }) 

            function snackBarShow(message) {
            var x = document.getElementById("snackbar-new");
                x.className = "show";
                x.innerHTML = message;
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
            }

            var pusher = new Pusher('9457793ed2d8ec121ebf', {
            cluster: 'eu'
            });


            var channel = pusher.subscribe('new-order-channel');
            channel.bind('new-order-channel', function(data) {
                console.log('Duomenys')
                console.log({{$user->id}});
                console.log(data.receiverUserId);
                console.log(data.senderUserId);
                if({{Auth::user()->id}} == data.receiverUserId) {
                    if(data.message === '{{ __("Įkeltas failas naujas failas!") }}')
                        snackBarShow(data.message);
                    else {
                        if(document.getElementById('message') === null) {
        
                            snackBarShow('{{ __("Gauta nauja žinutė!") }}');
                        }
                        if({{$user->id}} == data.receiverUserId) {
                            appendMessageLive(data.message);
                        }
                        if({{$user->id}} == data.senderUserId) {
                            appendMessageLive(data.message);
                        } else if({{Auth::user()->id}} === 1) {
                            appendMessageLive(data.message, data.senderUserId);
                        }
                        
                    }
                }
                
                    
                    
            });

        </script>
        <!-- Scripts -->
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        
        
        <script src="{{ asset('js/echo.iife.js') }}"></script>
        <script src="{{ asset('js/echo.js') }}"></script>
        <script>
        
        var APP_URL = {!! json_encode(url('/')) !!}
        
            
        function myFunction() {
            
            var x = document.getElementById("FileTable").rows.length;
            if(x > 1)
                document.getElementById("tableDiv").style.display = "block";
        }

        function messageAsideToZero()
        {
            document.getElementById("messageCount").innerHTML = "";
        }

        
          
        


            function codeAddress() {
            $(document).ajaxComplete(function() {
                $('table').each(function(){
                    if($('tbody:empty',this))
                        $(this).hide();
                    else $(this).show();
                });
            });
            }

        window.onload = codeAddress;

        function imagefun() {
            var Image_Id = document.getElementById('getImage');
            if (Image_Id.src.match("imageName1.jpg")) {
                Image_Id.src = "imageName2.jpg";
            }
            else {
                Image_Id.src = "imageName1.jpg";
            }
        }   

        	
        </script>
                <meta property="og:title" content="Reklamos ekositema klientų sistema" />
        <meta property="og:url" content="http://klientams.reklamosekosistema.lt" />
        <meta property="og:image" content="https://reklamosekosistema.lt/wp-content/uploads/2019/11/reklamos-ekosistema-logo.png" />
    </head>
    <body onload="myFunction()" class="d-body-none">

    

    
    <div id="snackbar-new"></div>
    
        
        <div id="page-container" class="enable-cookies sidebar-o enable-page-overlay sidebar-dark side-scroll page-header-fixed page-header-dark enable-cookies ">
            <aside id="side-overlay" class="font-size-sm" style="background-color: #353847 !important;">
                <div class="content-header" style="background-color: #353847 !important;">

                   
                    <a class="img-link mr-1" href="javascript:void(0)">
                        <img class="img-avatar img-avatar32" src="{{Auth::user()->position == 'admin' ? asset('media/avatars/avatar0.jpg') : asset('media/avatars/avatar1.jpg')}}" alt="">
                    </a>

                    <a class="ml-auto btn btn-round btn-sm btn-dual" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_close">
                        <i class="fa fa-fw fa-times text-primary"></i>
                    </a>
                </div>
                
                <script>	

                    moment.fn.fromNowOrNow = function (a) {
                        if (Math.abs(moment().diff(this)) < 1000) { // 1000 milliseconds
                            return 'just now';
                        }
                        return this.fromNow(a);
                    }
                    	
                    var useris = {!! json_encode(auth()->user(), JSON_HEX_TAG) !!};	
                    var sites = {!! json_encode($user->toArray(), JSON_HEX_TAG) !!};	
                    var admin = {!! json_encode($users->toArray(), JSON_HEX_TAG) !!};	
                    var nowUser;	
                    	
                    </script>	
                	
                <div>

                </div>

            </aside>

            <nav id="sidebar" aria-label="Main Navigation">

                <div class="content-header bg-white-5">

                    <a href="{{route('files')}}"><img class="brand-logo" src="{{asset('media/logos/reklamos-ekosistema-logo.png')}}"></a>

                    <div>

                        <div class="dropdown d-inline-block ml-3">
                            <a class="text-dual font-size-sm" id="sidebar-themes-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                                <i class="si si-drop"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right font-size-sm smini-hide border-0" aria-labelledby="sidebar-themes-dropdown">

                                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="default" href="#">
                                    <span>{{__('Default')}}</span>
                                    <i class="fa fa-circle text-default"></i>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{ asset('css/themes/amethyst.css') }}" href="#">
                                    <span>{{__('Amethyst')}}</span>
                                    <i class="fa fa-circle text-amethyst"></i>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{ asset('css/themes/city.css') }}" href="#">
                                    <span>{{__('City')}}</span>
                                    <i class="fa fa-circle text-city"></i>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{ asset('css/themes/flat.css') }}" href="#">
                                    <span>{{__('Flat')}}</span>
                                    <i class="fa fa-circle text-flat"></i>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{ asset('css/themes/modern.css') }}" href="#">
                                    <span>{{__('Modern')}}</span>
                                    <i class="fa fa-circle text-modern"></i>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{ asset('css/themes/smooth.css') }}" href="#">
                                    <span>{{__('Smooth')}}</span>
                                    <i class="fa fa-circle text-smooth"></i>
                                </a>


                            </div>
                        </div>

                        <a class="d-lg-none text-dual ml-3" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                            <i class="fa fa-times"></i>
                        </a>

                    </div>

                </div>

                <div style="overflow: visible;" class="content-side content-side-full">
                    <ul class="nav-main">
                        <li class="nav-main-item">
                            <a style="padding-left: 20px; padding-right: 0px;" class="nav-main-link" href="/dashboard">
                                <i class="nav-main-link-icon fas fa-user-tie"></i>
                                <span class="nav-main-link-name">{{ Auth::user()->name }}</span>
                            </a>
                        </li>
                       
                        <li class="nav-main-heading">{{__('Meniu')}}</li>
                        <li class="nav-main-item open">	
                                <a class="nav-main-link" href="{{route('orders.dashboard')}}">	
                                    <span class="nav-main-link-name ">{{__('Aktyvūs projektai')}}
                                        </span>
                                </a>
                        </li>
                       
                            <li class="nav-main-item open">	
                                <a class="nav-main-link" href="{{route('files')}}">	
                                    <span class="nav-main-link-name">{{__('Mano failai')}}</span>
                                </a>
                            </li>
                            <li class="nav-main-item open">	
                                <a class="nav-main-link" href="{{route('orders.index')}}">	
                                    <span class="nav-main-link-name">{{__('Užsakymų istorija')}}</span>
                                </a>
                            </li>

                        @if((Auth::user()->position == 'admin'))
                        <li class="nav-main-item">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                                <span class="nav-main-link-name">{{__('Klientų failai')}}</span>	
                            </a>	
	
                            @foreach ($users as $oneUser)
                                
                                <ul class="nav-main-submenu">	
                                    <li class="nav-main-item">	
                                        <a class="nav-main-link" href="{{ url('dashboard/'.$oneUser->id)}}">	
                                        <span class="nav-main-link-name">{{ $oneUser->name}}</span>	
                                        
                                        </a>	
                                    </li>	
                                    	
                                </ul>
                    		
                            @endforeach	
                         @endif	
                        @if((Auth::user()->position == 'admin'))	
                        <li class="nav-main-item open">	
                            <a class="nav-main-link" href="{{route('users')}}">	
                                <span class="nav-main-link-name">{{__('Visos paskyros')}}</span>	
                            </a>
                        </li>
                        @endif
                        	
                        </li>	
                        <li class="nav-main-item open">	
                            <a class="nav-main-link" href="{{route('duk')}}">	
                                <span class="nav-main-link-name">{{__('D.U.K')}}</span>	
                            </a>
                        </li>
                        @if((Auth::user()->position != 'admin'))
                        <li class="nav-main-item open">	
                            <a class="nav-main-link" href="{{route('chatting')}}">
                                @php
                                $messageCount = 0;
                                foreach($messages as $message)
                                    
                                    if($message->receiver_user_id === Auth::user()->id && $message->seen_date === null)
                                        $messageCount = $messageCount + 1;
                        
                                
                                @endphp	
                                <span class="nav-main-link-name">{{__('Žinutės')}} 
                                    @if($messageCount > 0)
                                    <span id="notifCount" style="padding-top: 4px;" class="badge unseen-count-pill badge-pill">
                                    {{$messageCount}}
                                    </span> 
                                    @endif
                                </span>	
                            </a>
                        </li>
                        
                        <li class="nav-main-item">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                                <span class="nav-main-link-name">{{__('Prekės ženklas')}}</span>	
                            </a>
                            

                            @if(Auth::user()->brands->count() < 5)

                            <ul class="nav-main-submenu">	
                                    <li class="nav-main-item">	
                                        <a class="nav-main-link" href="{{ route('brand')}}">	
                                        <span class="nav-main-link-name">{{ __('Sukurti naują')}}</span>	
                                        
                                        </a>	
                                    </li>	
                            </ul>

                            @endif

                            @foreach ($allBrands as $oneBrand)

                                @if((Auth::user()->id === $oneBrand->user_id))
                                
                                    <ul class="nav-main-submenu">	
                                        <li class="nav-main-item">	
                                            <a class="nav-main-link" href="{{ url('dashboard/brand/edit/'.$oneBrand->id)}}">	
                                            <span class="nav-main-link-name">{{ $oneBrand->name}}</span>	
                                            
                                            </a>	
                                        </li>	
                                            
                                    </ul>

                                @endif	
                    		
                            @endforeach	

                            

                        @endif	
                        @if((Auth::user()->position == 'admin'))
                        <li class="nav-main-item">

                                @php
                                $messageCount = 0;
                                foreach($messages as $message)
                                    
                                    if($message->receiver_user_id === Auth::user()->id && $message->seen_date === null)
                                        $messageCount = $messageCount + 1;
                        
                                
                                @endphp	

                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                                <span class="nav-main-link-name">{{__('Žinutės')}}
                                    @if($messageCount > 0)
                                    <span id="notifCount" style="padding-top: 4px;" class="badge unseen-count-pill badge-pill">
                                    {{$messageCount}}
                                    </span> 
                                    @endif
                                </span>	
                            </a>	
	
                            @foreach ($users as $oneUser)

                                @php
                                $userMessageCount = 0;
                                @endphp

                                @foreach($messages as $message)
                                    @if($message->receiver_user_id === Auth::user()->id && $message->sender_user_id === $oneUser->id && $message->seen_date === null)
                                        @php
                                        $userMessageCount = $userMessageCount + 1;
                                        @endphp
                                    @endif
                                @endforeach

                                @if(($oneUser->position != 'admin'))		
                                <ul class="nav-main-submenu">	
                                    <li class="nav-main-item">	
                                        <a class="nav-main-link" href="{{ url('dashboard/chatting/'.$oneUser->id)}}">	
                                        <span class="nav-main-link-name">{{ $oneUser->name}}

                                        @if($userMessageCount > 0)
                                        <span id="notifCount" style="padding-top: 3px;" class="badge unseen-count-pill badge-pill">
                                        {{$userMessageCount}}
                                        </span> 
                                        @endif

                                        </span>	
                                        
                                        </a>	
                                    </li>	
                                    	
                                </ul>
                                @endif	
                            @endforeach	
                         @endif	
                       </ul>
                    <div id="MySidebarBlock" class="sidebar-dark"  style="z-index: -10;width:100%;height:20%; position:fixed; bottom:0px; left:0; border-top:0px solid ;">	
                        	
                        	
                        	
                    </div>
                </div>
            </nav>
            <header id="page-header">
                <div class="content-header">
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-sm btn-dual mr-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                        
                        @if(Auth::user()->position == 'admin')	
                            <a href="{{route('register')}}" class="btn btn-sm btn-dual  btn-round btn-white mr-2 d-none d-lg-inline-block">
                                {{__('Sukurti paskyrą')}}
                            </a>
                        @else
                        @if(Auth::user()->remaining > 0)		
                            <a href="{{route('orders.create')}}" class="btn btn-sm btn-dual  btn-round btn-white mr-2 d-none d-lg-inline-block">
                                {{__('Pradėti užsakymą')}}
                            </a>
                        @else
                        
                        <div data-toggle="tooltip" data-placement="bottom" title="{{ __('Gausite naujų užsakymų prasidėjus naujam mėnesiui') }}"  class="btn btn-sm btn-dual btn-white btn-round  mr-2 d-none d-lg-inline-block  disabled-button cursor">
                            {{__('Užsakymai baigėsi')}}
                        </div>

                        @endif	
                            @if(Auth::user()->remaining > 0)	
                                <a href="{{route('orders.create')}}" data-toggle="tooltip" data-placement="bottom" title="{{ __('Likę užsakymai šiam mėnesiui') }}" class="btn btn-sm btn-dual  btn-round btn-white mr-2 d-none d-lg-inline-block">
                                    {{ Auth::user()->remaining }}
                                </a>
                            @endif	
                        @endif	
                        

                    </div>

                    <div class="d-flex align-items-center">
                            <div class="language-toggle ">
                                <a class="<?php if(Session::get('locale')!='en') echo"my-on ";
                                                else echo"my-off";
                                 ?>" href="{{ route('lang','lt') }}"><div>LT</div></a><a class="<?php if(Session::get('locale')=='en') echo"my-on ";
                                                else echo"my-off";
                                 ?>" href="{{ route('lang','en') }}"><div>EN</div></a>
                        </div>
                        
                        <div class="dropdown d-inline-block ml-2">
                            
                            <button id="profile-button" type="button" class="btn btn-sm btn-dual btn-round btn-white" style="padding:8px 8px">
                                <img id="small-profile-avatar"  class="rounded" src="{{ asset('media/avatars/avatar'.$user->avatar_image_number.'.png') }}" alt="Header Avatar" style="width: 18px;">
                                <span class="d-none d-sm-inline-block ml-1">
                                    @if(Auth::check())	
                                        @if(Auth::user()->position == 'admin')	
                                        {{__('Admin')}} {{__('paskyra')}}	
                                        @else	
                                        {{__('Mano')}} {{__('paskyra')}}
                                        @endif	
                                    @endif
                                </span>
                                <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block"></i>
                            </button>
                            <script>
                            $('#profile-button').on('click',function(){
                                $('#profile-dropdown').toggle();
                            });

                            </script>
                            <div id="profile-dropdown" class="dropdown-menu dropdown-menu-right p-0 border-0 font-size-sm">
                                <div class="p-3 text-center bg-primary">
                                    <img id="profile-avatar" class="img-avatar img-avatar48 img-avatar-thumb" src="{{ asset('media/avatars/avatar'.$user->avatar_image_number.'.png') }}" alt="">
                                </div>
                            <script>
                            let currentAvatarNumber = {{$user->avatar_image_number}};
                            $('#profile-avatar').on('click',function(){
                                	
                                currentAvatarNumber = currentAvatarNumber + 1;

                                $("#save-avatar-button").toggleClass("disabled", currentAvatarNumber === {{$user->avatar_image_number}});

                                if(currentAvatarNumber > 15) {
                                    currentAvatarNumber = 0;
                                }

                                $(this).attr('src',`{{ asset('media/avatars/avatar${currentAvatarNumber}.png') }}`);
                                $('#small-profile-avatar').attr('src',`{{ asset('media/avatars/avatar${currentAvatarNumber}.png') }}`);
                                
                            });
                            </script>
                                <div class="p-2">
                                    <a id="help-button" class=" dropdown-item d-flex align-items-center justify-content-between display-none-on-medium <?php if($user->position=='admin') { echo 'disabled'; } ?> " href="#">
                                        <span>{{__('Pagalba')}}</span>
                                        <i class="si si-info ml-1"></i>
                                    </a>
                                    <a id="save-avatar-button" class="dropdown-item d-flex align-items-center justify-content-between disabled" href="dummy-route">
                                        <span>{{__('Išsaugoti')}}</span>
                                        <i class="si si-check ml-1"></i>
                                    </a>
                                    <a id="save-avatar-button" class="dropdown-item d-flex align-items-center justify-content-between" href="{{route('settings.index')}}">
                                        <span>{{__('Nustatymai')}}</span>
                                        <i class="fa fa-cog ml-1"></i>
                                    </a>

                                    <script> 
                                    $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                    });

                                        $('#save-avatar-button').on('click',function(event){
                                            event.preventDefault();

                                            
                                            $.ajax({
                                                type:'POST',
                                                url:'{{route("postavatar")}}',
                                                data: {currentAvatarNumber: currentAvatarNumber,id: "<?php echo $user->id?>",_token:"<?php echo csrf_token()?>"},
                                                success:function(data) {
                                                        
                                                },
                                            });
                                        });
                                        </script>

                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('logout') }} " onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <span>{{__('Atsijungti')}}</span>
                                        <i class="si si-logout ml-1"></i>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">	
                                        @csrf	
                                    </form>
                                </div>
                            </div>
                        </div>    

                        @if ($notif->count() > 0)
                            <div class="dropdown d-inline-block ml-2">
                                <button type="button" class="btn btn-sm btn-dual badge-notif" style="vertical-align:middle" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="si si-bell"></i>
                                    <span id="notifCount" class="badge badge-dark badge-pill">{{$notif->count()}}</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-notifications-dropdown">
                                    <div class="p-2 bg-primary text-center">
                                        <h5 class="dropdown-header text-uppercase text-white">{{__('Pranešimai')}}</h5>
                                    </div>
                                    <ul id="manoNotifai2" class="nav-items mb-0">
                                        <div style="overflow:auto;max-height:300px">
                                            @foreach ($notif->sortByDesc('id') as $oneNotif)	
                                        
                                        
                                            <form class="" action="/dashboard/deletenotification" method="POST">
                                                @csrf
                                                <li class="">
                                                <label class="click notif-item text-dark media py-2" for="submitas-{{$oneNotif->id}}" id="label-fileToUpload">
                                                <input type="hidden" name="notification" value="{{$oneNotif->id}}" />
                                                <input type="hidden" name="link" value="{{$oneNotif->link}}" />
                                                <input type="submit" id="submitas-{{$oneNotif->id}}" class="d-none" value="">
                                               
                                                <div class="font-w600"><i class=" mr-2 ml-3 fa fa-fw fa-check-circle"></i><small class="text-muted"><?php if(strlen($oneNotif->message) > 27) { echo substr($oneNotif->message, 0, 34); echo "..."; } else { echo $oneNotif->message; } ?></small>
                                                <br><small class=" mr-2 ml-5 text-muted">{{$oneNotif->created_at}}</small>
                                               </div>
                                               </label>
                                               </li>
                                            </form>
                                        
                                        
                                            @endforeach	
                                        </div>
                                        <li class="notif-item">
                                            <a class="" href="{{route('notifications.delete', ['user' => $user->id])}}">

                                            <div class="p-2 text-center">
                                                <h5 class="dropdown-header text-uppercase">{{__('Ištrinti visus pranešimus')}}</h5>
                                            </div>
                                    
                                            </a>
                                        </li>
                        @endif
                    </div>

                </div>

                <div id="page-header-search" class="overlay-header bg-white">
                    <div class="content-header">
                        <form class="w-100" action="/dashboard/sendMessage" method="POST">
                            @csrf
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-danger" data-toggle="layout" data-action="header_search_off">
                                        <i class="fa fa-fw fa-times-circle"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                            </div>
                        </form>
                   </div>
                </div>

                <div id="page-header-loader" class="overlay-header bg-white">
                    <div class="content-header">
                        <div class="w-100 text-center">
                            <i class="fa fa-fw fa-circle-notch fa-spin"></i>
                        </div>
                    </div>
                </div>
            </header>
            <main id="main-container" class="bg-body-light">

            @include('tooltips/cus-tooltip',['title'=>'Pradėti užsakymą','text'=>'Čia galite užpildyti užsakymo informaciją. Užsakymas gali būti tiek viena nuotrauka, tiek visa jų kolekcija. Skaičius šalia simbolizuoja kiek užsakymų liko šiam mėnesiui.','id'=>0, 'left'=>500, 'top'=>8])            

            @include('tooltips/cus-tooltip',['title'=>'Temos pasirinkimas','text'=>'Čia galite pasirinkti vieną iš 6 svetainės spalvų palečių ir pakeisti svetainės išvaizdą.','id'=>1, 'left'=>220, 'top'=>8])

            @include('tooltips/cus-tooltip',['title'=>'Aktyvūs projektai','text'=>'Čia galite matyti aktyvių projektų būseną. Kai užsakymas turės rezultatų paruoštų peržiūrai gausite pranešimą. Nuėjus į rezultatų puslapį prie užsakymo bus galima palikti komentarą arba jeigu viskas tinka atsisiųsti rezultatus ir pakeisti užsakymo būseną į pabaigtą.','id'=>2, 'left'=>210, 'top'=>170])

            @include('tooltips/cus-tooltip',['title'=>'Mano failai','text'=>'Čia galite įkelti diskusijos metu aptartus failus, jie nebūtinai turi priklausyti užsakymui ar įmonės ženklui.','id'=>3, 'left'=>210, 'top'=>210])

            @include('tooltips/cus-tooltip',['title'=>'Užsakymo istorija','text'=>'Čia galite matyti pabaigtus arba atšauktus projektus, galima juos peržiūrėti, redaguoti ir jeigu apsigalvojote pakeisti būseną į redaguojama, kas pavers jį aktyviu.','id'=>4, 'left'=>210, 'top'=>250])

            @include('tooltips/cus-tooltip',['title'=>'D.U.K','text'=>'Čia galite rasti atsakymą į dažniausiai užduodamus klausimus, jeigu atsakymo neradote visada galite tiesiogiai rašyti dizaineriams.','id'=>5, 'left'=>210, 'top'=>290])

            @include('tooltips/cus-tooltip',['title'=>'Žinutės','text'=>'Čia galite aptarti su dizaineriu užsakymo eigą, būseną, iškilusius klausimus bei pastebėjimus, įkelti failus galima "Mano Failai" skiltyje, kad reikiami failai nepasimestų tarp žinučių, kai jų bus labai daug.','id'=>6, 'left'=>210, 'top'=>330])

            @include('tooltips/cus-tooltip',['title'=>'Prekės ženklas','text'=>'Jeigu turėsite užsakymų, kurie turės tą pačią spalvų paletę ar panašią tematiką, galite susikurti įmonės prekės ženklą ir užsakymo kūrimo metu pridėti jį.','id'=>7, 'left'=>210, 'top'=>370])

            

            

            @yield('content')

            </main>


        </div>
        <script src="{{ asset('js/oneui.app.js') }}"></script>


        @yield('js_after')
        

    </body>

    <script>
        $('#help-button').on('click',function(e){
            e.preventDefault();
            $('.cus-tooltip-container').css('visibility','hidden');
            $('.cus-tooltip-container').first().css('visibility','visible');
        });
        $('.cus-tooltip-hide-steps-text').on('click', function(e){
            e.preventDefault();
            var ele=$(this).parents('.cus-tooltip-container');
            $(ele).css('visibility','hidden');
        });
        $('.cus-tooltip-next-step-button').on('click',function(e){
            e.preventDefault();
            var ele=$(this).parents('.cus-tooltip-container');
            var id = $(ele).attr('data_id');
            $(ele).css('visibility','hidden');
            id++;
            $('#cus-tooltip-container-'+id).css('visibility','visible');
        });
        $(function(){
            $('body').removeClass("d-body-none");
        })
    </script>
    
    <!--<script src="{{asset('js/custom/mainLayout.js')}}"></script> identical code (for easier calculation of js) -->
    
    <script>
        window.Laravel = {csrfToken: '{{ csrf_token() }}'};
    </script>
</html>

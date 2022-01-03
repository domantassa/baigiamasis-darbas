<!doctype html>
<html lang="{{ config('app.locale') }}" style="background: #f9f9f9 !important">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>For clients</title>	
        <meta name="description" content="For clients">	
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
        <!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="{{ asset('/css/themes/amethyst.css') }}"> -->
        @yield('css_after')

        

        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
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

            function snackBarShow() {
            var x = document.getElementById("snackbar");
            x.className = "show";
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
            }

            function snackBar1Show() {
            var x = document.getElementById("snackbar-new-user");
                x.className = "show";
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
            }

            function snackBar2Show() {
            var x = document.getElementById("snackbar-new-order");
                x.className = "show";
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
            }

            function snackBar3Show() {
            var x = document.getElementById("snackbar-new-results");
                x.className = "show";
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
            }

            var pusher = new Pusher('9457793ed2d8ec121ebf', {
            cluster: 'eu'
            });

            var channel = pusher.subscribe('new-user-channel');
            channel.bind('new-user-channel', function(data) {
            snackBar1Show();
            });

            var channel = pusher.subscribe('new-order-channel');
            channel.bind('new-order-channel', function(data) {
            snackBar2Show();
            });

            var channel = pusher.subscribe('new-results-channel');
            channel.bind('new-results-channel', function(data) {
            snackBar3Show();
            });
        </script>
        <!-- Scripts -->
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>	
        
        <script src="{{ asset('js/echo.iife.js') }}"></script>
        <script src="{{ asset('js/echo.js') }}"></script>
        <script>
        
        var APP_URL = {!! json_encode(url('/')) !!}
        console.log(APP_URL);
        
            
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

        	
        </script>
                <meta property="og:title" content="Reklamos ekositema klientų sistema" />
        <meta property="og:url" content="http://klientams.reklamosekosistema.lt" />
        <meta property="og:image" content="https://reklamosekosistema.lt/wp-content/uploads/2019/11/reklamos-ekosistema-logo.png" />
    </head>
    <body onload="myFunction()">

    
    <div id="snackbar-new-user">Prisiregistravo naujas vartotojas!</div>
    <div id="snackbar-new-order">Naujas užsakymas!</div>
    <div id="snackbar-new-results">Įkelti užsakymo rezultatai!</div>
    
        
        <div id="page-container" class="enable-cookies sidebar-o enable-page-overlay sidebar-dark side-scroll page-header-fixed page-header-dark enable-cookies ">
            <!-- Side Overlay-->
            <aside id="side-overlay" class="font-size-sm" style="background-color: #353847 !important;">
                <!-- Side Header -->
                <div class="content-header" style="background-color: #353847 !important;">
                    <!-- User Avatar -->
                    <a class="img-link mr-1" href="javascript:void(0)">
                        <img class="img-avatar img-avatar32" src="{{Auth::user()->position == 'admin' ? asset('media/avatars/avatar10.jpg') : asset('storage/CustomerSupport.jpg')}}" alt="">
                    </a>
                    <!-- END User Avatar -->

                    <!-- User Info -->
                    <div class="ml-2">
                        <div class="link-fx text-light font-w600" href="">	
                            @if (Auth::user()->position == 'admin') 	
                            {{$user->name}}	
                            @else	
                            Customer support	
                            @endif	
                        </div>
                    </div>
                    <!-- END User Info -->

                    <!-- Close Side Overlay -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <a class="ml-auto btn btn-round btn-sm btn-dual" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_close">
                        <i class="fa fa-fw fa-times text-primary"></i>
                    </a>
                    <!-- END Close Side Overlay -->
                </div>
                <!-- END Side Header -->

                <!-- Side Content -->
                
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
                <div class="content-side wrapper" id="chatting" style="background-color: #353847 !important; padding-bottom: 250px;">	
                    	
                    <div class="block" style=" background: linear-gradient(90deg, rgba(235,232,232,1) 0%, rgba(255,255,255,1) 100%); box-shadow: -4px 6px 27px -5px rgba(166,159,166,1);">	
                        	
                    </div>	
                    	
                    <form class="SideChatting" action="dashboard/sendMessage" method="post" id="message-form" >	
                        @csrf	
                        <div class="form-group" class="WhiteBox"  >	
                            	
                            	
                            <textarea class="form-control" style="margin:10px; width: 95%" id="message-text" name="message-text" rows="4" placeholder="Textarea content.."></textarea>	
                            <div style="position:relative; text-align:right; margin: 10px;">	
                                <button type="submit" class="btn btn-round btn-sm btn-primary" style="color:white;">	
                                    <i class="fa fa-check mr-1"></i> Send	
                                </button>	
                            </div>	
                        </div>	
                        	
                        	
                    </form>	
                    	
                    	
                    	
                    	
                    	
                	
                    	
                </div>

                <!-- END Side Content -->



            </aside>
            <!-- END Side Overlay -->

            <!-- Sidebar -->
            <nav id="sidebar" aria-label="Main Navigation">
                <!-- Side Header -->
                <div class="content-header bg-white-5">
                    <!-- Logo -->
                    <a href="{{route('files')}}"><img class="brand-logo" src="{{asset('media/logos/reklamos-ekosistema-logo.png')}}"></a>
                    <!-- END Logo -->

                    <!-- Options -->
                    <div>
                        <!-- Color Variations -->
                        <div class="dropdown d-inline-block ml-3">
                            <a class="text-dual font-size-sm" id="sidebar-themes-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                                <i class="si si-drop"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right font-size-sm smini-hide border-0" aria-labelledby="sidebar-themes-dropdown">
                                <!-- Color Themes -->
                                <!-- Layout API, functionality initialized in Template._uiHandleTheme() -->
                                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="default" href="#">
                                    <span>Default</span>
                                    <i class="fa fa-circle text-default"></i>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{ asset('css/themes/amethyst.css') }}" href="#">
                                    <span>Amethyst</span>
                                    <i class="fa fa-circle text-amethyst"></i>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{ asset('css/themes/city.css') }}" href="#">
                                    <span>City</span>
                                    <i class="fa fa-circle text-city"></i>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{ asset('css/themes/flat.css') }}" href="#">
                                    <span>Flat</span>
                                    <i class="fa fa-circle text-flat"></i>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{ asset('css/themes/modern.css') }}" href="#">
                                    <span>Modern</span>
                                    <i class="fa fa-circle text-modern"></i>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{ asset('css/themes/smooth.css') }}" href="#">
                                    <span>Smooth</span>
                                    <i class="fa fa-circle text-smooth"></i>
                                </a>
                                <!-- END Color Themes -->

                            </div>
                        </div>
                        <!-- END Themes -->

                        <!-- Close Sidebar, Visible only on mobile screens -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="d-lg-none text-dual ml-3" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                            <i class="fa fa-times"></i>
                        </a>
                        <!-- END Close Sidebar -->
                    </div>
                    <!-- END Options -->
                </div>
                <!-- END Side Header -->

                <!-- Side Navigation -->
                <div class="content-side content-side-full">
                    <ul class="nav-main">
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('dashboard') ? ' active' : '' }}" href="/dashboard">
                                <i class="nav-main-link-icon fas fa-user-tie"></i>
                                <span class="nav-main-link-name">{{ Auth::user()->name }}</span>
                            </a>
                        </li>
                        <li class="nav-main-heading">Meniu</li>
                        <li class="nav-main-item open">	
                                <a class="nav-main-link" href="{{route('orders.dashboard')}}">	
                                    <span class="nav-main-link-name">Pradžia</span>
                                </a>
                        </li>
                       
                            <li class="nav-main-item open">	
                                <a class="nav-main-link" href="{{route('files')}}">	
                                    <span class="nav-main-link-name">
                                    Mano failai
                                    </span>	
                                </a>
                            </li>
                            <li class="nav-main-item open">	
                                <a class="nav-main-link" href="{{route('orders.index')}}">	
                                    <span class="nav-main-link-name">Užsakymų istorija</span>
                                </a>
                            </li>

                        @if((Auth::user()->position == 'admin'))
                        <li class="nav-main-item{{ request()->is('pages/*') ? ' open' : '' }}">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                              <!--   <i class="nav-main-link-icon fas fa-user"></i>	-->
                                <span class="nav-main-link-name">Pasirinkti paskyrą</span>	
                            </a>	
	
                            @foreach ($users as $oneUser)	
                                <ul class="nav-main-submenu">	
                                    <li class="nav-main-item">	
                                        <a class="nav-main-link{{ request()->is('examples/plugin') ? ' active' : '' }}" href="{{ url('dashboard/'.$oneUser->id)}}">	
                                        <span class="nav-main-link-name">{{ $oneUser->name}}</span>	
                                        
                                        </a>	
                                    </li>	
                                    	
                                </ul>	
                            @endforeach	
                         @endif	
                        @if((Auth::user()->position == 'admin'))	
                        <li class="nav-main-item open">	
                            <a class="nav-main-link" href="{{route('users')}}">	
                                <!-- <i class="nav-main-link-icon fas fa-users"></i>	-->
                                <span class="nav-main-link-name">Visos paskyros</span>	
                            </a>
                        </li>
                        @endif
                        	
                        </li>	
                        <li class="nav-main-item open">	
                            <a class="nav-main-link" href="{{route('duk')}}">	
                                <!-- <i class="nav-main-link-icon fas fa-users"></i>	-->
                                <span class="nav-main-link-name">D.U.K</span>	
                            </a>
                        </li>
                        <li class="nav-main-item open">	
                            <a class="nav-main-link" href="{{route('chatting')}}">	
                                <span class="nav-main-link-name">Žinutės</span>	
                            </a>
                        </li>
                    </ul>
                    <div id="MySidebarBlock" class="sidebar-dark"  style="width:100%;height:20%; position:fixed; bottom:0px; left:0; border-top:0px solid ;">	
                        	
                        	
                        	
                    </div>
                </div>
                <!-- END Side Navigation -->
            </nav>
            <!-- END Sidebar -->

            <!-- Header -->
            <header id="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div class="d-flex align-items-center">
                        <!-- Toggle Sidebar -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                        <button type="button" class="btn btn-sm btn-dual mr-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                        <!-- END Toggle Sidebar -->

                        <!-- Toggle Mini Sidebar -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                        <!-- END Toggle Mini Sidebar -->
                        
                        @if(Auth::user()->position == 'admin')	
                        <a href="{{route('register')}}" class="btn btn-sm btn-dual  btn-round btn-white mr-2 d-none d-lg-inline-block">
                            Sukurti paskyrą
                        </a>
                                        @else
                                        @if(Auth::user()->remaining > 0)		
                                        <a href="{{route('orders.create')}}" class="btn btn-sm btn-dual  btn-round btn-white mr-2 d-none d-lg-inline-block">
                            Pradėti užsakymą
                        </a>
                        @else
                        
                        <div data-toggle="tooltip" data-placement="bottom" title="Gausite naujų užsakymų prasidėjus naujam mėnesiui"  class="btn btn-sm btn-dual btn-white btn-round  mr-2 d-none d-lg-inline-block  disabled-button cursor">
                            Užsakymai baigėsi
                </div>

                        @endif	
                        @if(Auth::user()->remaining > 0)	
                        <a href="{{route('orders.create')}}" data-toggle="tooltip" data-placement="bottom" title="Likę užsakymai šiam mėnesiui" class="btn btn-sm btn-dual  btn-round btn-white mr-2 d-none d-lg-inline-block">
                            {{ Auth::user()->remaining }}
                        </a>
                        @endif	
                                        @endif	
                        
                        <!-- END Search Form -->
                    </div>
                    <!-- END Left Section -->

                    <!-- Right Section -->
                    <div class="d-flex align-items-center">
                        <!-- User Dropdown -->
                        <div class="dropdown d-inline-block ml-2">
                            <button type="button" class="btn btn-sm btn-dual btn-round btn-white" style="padding:8px 8px" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded" src="{{ asset('media/avatars/avatar10.jpg') }}" alt="Header Avatar" style="width: 18px;">
                                <span class="d-none d-sm-inline-block ml-1">
                                    @if(Auth::check())	
                                        @if(Auth::user()->position == 'admin')	
                                            Admin profilis	
                                        @else	
                                            Mano profilis
                                        @endif	
                                    @endif
                                </span>
                                <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block"></i>
                            
                            <div class="dropdown-menu dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-user-dropdown">
                                <div class="p-3 text-center bg-primary">
                                    <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ asset('media/avatars/avatar10.jpg') }}" alt="">
                                </div>
                                <div class="p-2">
                              <!--      <h5 class="dropdown-header text-uppercase">User Options</h5>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                        <span>Inbox</span>
                                        <span>
                                            <span class="badge badge-pill badge-primary">0</span>
                                            <i class="si si-envelope-open ml-1"></i>
                                        </span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                        <span>Profile</span>
                                        <span>
                                            <span class="badge badge-pill badge-success">0</span>
                                            <i class="si si-user ml-1"></i>
                                        </span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                        <span>Settings</span>
                                        <i class="si si-settings"></i>
                                    </a>
                                    <div role="separator" class="dropdown-divider"></div>
                                    <h5 class="dropdown-header text-uppercase">Actions</h5>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                        <span>Lock Account</span>
                                        <i class="si si-lock ml-1"></i>
                                    </a>-->
                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('logout') }} " onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <span>Atsijungti</span>
                                        <i class="si si-logout ml-1"></i>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">	
                                        @csrf	
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- END User Dropdown -->

                        <!-- Notifications Dropdown -->
                       
                        @if ($notif->count() > 0)
                            <div class="dropdown d-inline-block ml-2">
                                <button type="button" class="btn btn-sm btn-dual badge-notif" style="vertical-align:middle" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="si si-bell"></i>
                                    <span id="notifCount" class="badge badge-dark badge-pill">{{$notif->count()}}</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-notifications-dropdown">
                                    <div class="p-2 bg-primary text-center">
                                        <h5 class="dropdown-header text-uppercase text-white">Pranešimai</h5>
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
                                               
                                                <div class="font-w600"><i class=" mr-2 ml-3 fa fa-fw fa-check-circle"></i><small class="text-muted">{{$oneNotif->message}}</small>
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
                                                <h5 class="dropdown-header text-uppercase">Ištrinti visus pranešimus</h5>
                                            </div>
                                    
                                            </a>
                                        </li>
                        @endif
                    </div>
                    <!-- END Right Section -->
                </div>
                <!-- END Header Content -->

                <!-- Header Search -->
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
                <!-- END Header Search -->

                <!-- Header Loader -->
                <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
                <div id="page-header-loader" class="overlay-header bg-white">
                    <div class="content-header">
                        <div class="w-100 text-center">
                            <i class="fa fa-fw fa-circle-notch fa-spin"></i>
                        </div>
                    </div>
                </div>
                <!-- END Header Loader -->
            </header>
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container" class="bg-body-light">
                @yield('content')
            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id="page-footer" class="bg-body-light">
                <div class="content py-3">
                    <div class="row font-size-sm">

                    </div>
                </div>
            </footer>
            <!-- END Footer -->

            <!-- Apps Modal -->
            <!-- Opens from the modal toggle button in the header -->
            <div class="modal fade" id="one-modal-apps" tabindex="-1" role="dialog" aria-labelledby="one-modal-apps" aria-hidden="true">
                <div class="modal-dialog modal-dialog-top modal-sm" role="document">
                    <div class="modal-content">
                        <div class="block block-themed block-transparent mb-0">
                            <div class="block-header bg-primary-dark">
                                <h3 class="block-title">Apps</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                        <i class="si si-close"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="row gutters-tiny">
                                    <div class="col-6">
                                        <!-- CRM -->
                                        <a class="block block-rounded block-themed bg-default" href="javascript:void(0)">
                                            <div class="block-content text-center">
                                                <i class="si si-speedometer fa-2x text-white-75"></i>
                                                <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                                    CRM
                                                </p>
                                            </div>
                                        </a>
                                        <!-- END CRM -->
                                    </div>
                                    <div class="col-6">
                                        <!-- Products -->
                                        <a class="block block-rounded block-themed bg-default" href="javascript:void(0)">
                                            <div class="block-content text-center">
                                                <i class="si si-rocket fa-2x text-white-75"></i>
                                                <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                                    Products
                                                </p>
                                            </div>
                                        </a>
                                        <!-- END Products -->
                                    </div>
                                    <div class="col-6">
                                        <!-- Sales -->
                                        <a class="block block-rounded block-themed bg-default mb-0" href="javascript:void(0)">
                                            <div class="block-content text-center">
                                                <i class="si si-plane fa-2x text-white-75"></i>
                                                <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                                    Sales
                                                </p>
                                            </div>
                                        </a>
                                        <!-- END Sales -->
                                    </div>
                                    <div class="col-6">
                                        <!-- Payments -->
                                        <a class="block block-rounded block-themed bg-default mb-0" href="javascript:void(0)">
                                            <div class="block-content text-center">
                                                <i class="si si-wallet fa-2x text-white-75"></i>
                                                <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                                    Payments
                                                </p>
                                            </div>
                                        </a>
                                        <!-- END Payments -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Apps Modal -->
        </div>
        <!-- END Page Container -->

        <!-- OneUI Core JS -->
        <script src="{{ asset('js/oneui.app.js') }}"></script>

        <!-- Laravel Scaffolding JS -->
        <!-- <script src="{{ asset('/js/laravel.app.js') }}"></script> -->

        @yield('js_after')
        <!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v7.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="107718147275446"
        theme_color="#006A56"
        logged_in_greeting="Sveiki! Turite klausimų?"
        logged_out_greeting="Sveiki! Turite klausimų?">
      </div>

    </body>
    
    <script>
        window.Laravel = {csrfToken: '{{ csrf_token() }}'};
    </script>
</html>

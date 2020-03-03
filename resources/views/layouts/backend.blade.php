<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

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

        <!-- Fonts and Styles -->
        @yield('css_before')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
        <link rel="stylesheet" id="css-main" href="{{ mix('/css/oneui.css') }}">

        <!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="{{ mix('/css/themes/amethyst.css') }}"> -->
        @yield('css_after')

        

        <!-- Scripts -->
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>

        <script src="https://unpkg.com/@pusher/chatkit-client@1/dist/web/chatkit.js"></script>	
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>	
        <script src="https://js.pusher.com/5.0/pusher.min.js"></script>	
        
        
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
            //alert('ok');
            $(document).ajaxComplete(function() {
                $('table').each(function(){
                    if($('tbody:empty',this))
                        $(this).hide();
                    else $(this).show();
                });
            });
            }

        window.onload = codeAddress;
        

        Pusher.logToConsole = true;
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: '9457793ed2d8ec121ebf',
            cluster: 'eu',
            forceTLS: true
        });
        </script>

        <script>

            
            

            Echo.private('pool.{{$user->id}}')
            .listen('EndPool', (e) => {
                
                var new_row = document.createElement('tr');
                var new_col1 = document.createElement('th');
                var new_col2 = document.createElement('td');
                var new_col3 = document.createElement('td');
                var new_col4 = document.createElement('td');
                var new_col2a = document.createElement('a');
                var new_col4a = document.createElement('a');
                var new_col4i = document.createElement('i');
                var tableFileTable = document.getElementById("FileTable");
                new_col1.scope = "col";
                new_col1.innerHTML = e.pool.fileId;
                new_col2.colSpan = "8";
                new_col2a.innerHTML = e.pool.message;
                new_col3.scope = "col";
                new_col3.innerHTML = e.pool.created_at;
                new_col4.scope = "col";
                new_col4i.className = "fas fa-folder-minus";
                new_col2a.href = APP_URL+"/dashboard/download/"+e.pool.fileId; 
                new_col4a.href = APP_URL+"/dashboard/download/"+e.pool.fileId;
                new_col4a.appendChild(new_col4i);
                new_col4.appendChild(new_col4a);
                new_col2.appendChild(new_col2a);
                new_row.appendChild(new_col1);
                new_row.appendChild(new_col2);
                new_row.appendChild(new_col3);
                new_row.appendChild(new_col4);
                
                tableFileTable.appendChild(new_row);
                console.log("pirmas");
                var notifli = document.createElement('li');
                var notifa = document.createElement('a');
                var notifdiv = document.createElement('div');
                var notifi = document.createElement('i');
                var notifdiv2 = document.createElement('div');
                var notifdiv3 = document.createElement('div');
                var notifsmall = document.createElement('small');
                console.log("antras");
                notifa.className = "text-dark media py-2";
                notifdiv.className = "mr-2 ml-3";
                notifi.className = "fa fa-fw fa-check-circle text-success";
                notifdiv2.className = "media-body pr-2";
                notifdiv3.className = "font-w600";
                notifsmall.className = "text-muted";
                notifsmall.innerHTML = e.pool.created_at;
                notifdiv3.innerHTML = "New file: " + e.pool.message;
                notifa.href = APP_URL+"/dashboard/deleteNotif/"+e.pool.user_id;
                console.log("trecias");
                notifdiv2.appendChild(notifdiv3);
                notifdiv2.appendChild(notifsmall);
                notifdiv.appendChild(notifi);
                notifa.appendChild(notifdiv);
                notifa.appendChild(notifdiv2);
                notifli.appendChild(notifa)
                var NotifTable = document.getElementById("manoNotifai2");
                var notifCountSpan = document.getElementById("notifCount");
                var kint = notifCountSpan.innerHTML;
                kint2 = parseInt(kint);
                
                //document.getElementById("tableDiv").style.visibility = "visible";
                notifCountSpan.innerHTML = parseInt(kint2 + 1);
                NotifTable.appendChild(notifli);
                console.log("ketvirtas");
                console.log(NotifTable);
                
                
                

                
                
            });
        </script>

        <script>	
        	
        	
        	
        </script>

    </head>
    <body onload="myFunction()">
        
        <!-- Page Container -->
        <!--
            Available classes for #page-container:

        GENERIC

            'enable-cookies'                            Remembers active color theme between pages (when set through color theme helper Template._uiHandleTheme())

        SIDEBAR & SIDE OVERLAY

            'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
            'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
            'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
            'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
            'sidebar-dark'                              Dark themed sidebar

            'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
            'side-overlay-o'                            Visible Side Overlay by default

            'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

            'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

        HEADER

            ''                                          Static Header if no class is added
            'page-header-fixed'                         Fixed Header

        HEADER STYLE

            ''                                          Light themed Header
            'page-header-dark'                          Dark themed Header

        MAIN CONTENT LAYOUT

            ''                                          Full width Main Content if no class is added
            'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
            'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)
        -->
        <div id="page-container" class="sidebar-o enable-page-overlay sidebar-dark side-scroll page-header-fixed enable-cookies">
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
                    <a class="ml-auto btn btn-sm btn-dual" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_close">
                        <i class="fa fa-fw fa-times text-primary"></i>
                    </a>
                    <!-- END Close Side Overlay -->
                </div>
                <!-- END Side Header -->

                <!-- Side Content -->
                
                <script src="https://js.pusher.com/5.1/pusher.min.js"></script>
                <script>	

                    moment.fn.fromNowOrNow = function (a) {
                        if (Math.abs(moment().diff(this)) < 1000) { // 1000 milliseconds
                            return 'just now';
                        }
                        return this.fromNow(a);
                    }

                    var pusher = new Pusher('9457793ed2d8ec121ebf', {
                    cluster: 'eu',
                    forceTLS: true
                    });
                    	
                    	
                    const tokenProvider = new Chatkit.TokenProvider({	
                        url: "https://us1.pusherplatform.io/services/chatkit_token_provider/v1/ec529a06-e34c-4515-88ac-966a42488d21/token"	
                    });	
                    	
                    var useris = {!! json_encode(auth()->user(), JSON_HEX_TAG) !!};	
                    var sites = {!! json_encode($user->toArray(), JSON_HEX_TAG) !!};	
                    var admin = {!! json_encode($users->toArray(), JSON_HEX_TAG) !!};	
                    var nowUser;	
                    console.log("auth user", useris);	
                    console.log("siunciamas user ", sites);	
                    console.log("Admino acc ", admin[0]);	
                    	
                        	
                        const chatManager = new Chatkit.ChatManager({	
                            instanceLocator: "v1:us1:ec529a06-e34c-4515-88ac-966a42488d21",	
                            userId: useris.username,	
                            tokenProvider: tokenProvider,	
                        });	
                        	
                    	
                        var channel = pusher.subscribe('my-channel');
                        channel.bind('my-event', function(data) {
                            //alert(JSON.stringify(data));
                        });
                    		
                	
                          	
                        //currentUser.rooms[0]	
                        chatManager	
                            .connect()	
                            .then(currentUser => {	
                            currentUser.subscribeToRoomMultipart({	
                                roomId: sites.roomID,	
                                hooks: {	
                                onMessage: message => {	
                                    
                                    console.log("Dabartinio userio kambariai", currentUser.rooms);	
                                    console.log("currentRoom:", currentUser.rooms[0]);	
                                    console.log("sites room ID",sites.roomID);	
                                    const divas = document.getElementById("chatting");	
                                    const div1 = document.createElement("div");	
                                    const div2 = document.createElement("div");	
                                    const div2Their = document.createElement("div");	
                                    const h3as = document.createElement("span");	
                                    const smallas = document.createElement("small");	
                                    const div3 = document.createElement("div");	
                                    const pas = document.createElement("p");	
                                    const imgas = document.createElement("img");	
                                    	
                                    div1.className = "block block-bordered";	
                                    div2.className = "block-header";	
                                    h3as.className = "block-title";	
                                    div3.className = "block-content";	
                                    imgas.className = "rounded";	
                                    imgas.src = "{{asset('storage/CustomerSupport.jpg')}}";	
                                    //imgas.src = "{{asset('media/avatars/avatar66.jpg')}}";	
                                    	
                                    if(message.senderId == 'admin')	
                                        div1.style.background = "linear-gradient(90deg, rgba(235,232,232,1) 0%, rgba(255,255,255,1) 100%)";	
                                    div1.style.boxShadow = "0px 0px 5px 6px rgba(156,145,156,1)";	
                                    div2.style.borderBottom = "1px solid rgba(224,220,224,1)";	
                                    if(message.senderId == 'admin')	
                                        h3as.style.textAlign = "right";	
                                    h3as.style.position = "relative";	
                                    	
                                    if(message.senderId == 'admin')	
                                        div3.style.textAlign = "right";	
                                    div3.style.position = "relative";	
                                    pas.style.marginTop = "-10px";	
                                    pas.style.wordWrap = "break-word";	
                                    pas.style.lineHeight= "1.2";	
                                    pas.style.fontSize= "19px";	
                                    	
                                    imgas.style.width ="40px";	
                                    	
                                    smallas.innerHTML =  moment(message.createdAt).fromNow();	
                                    if(message.senderId == 'admin')	
                                        h3as.appendChild(document.createTextNode(`Customer support`));	
                                    else	
                                        h3as.appendChild(document.createTextNode(`${sites.name}`));	
                                    h3as.appendChild(document.createElement("br"));	
                                    h3as.appendChild(smallas);	
                                	
                                    	
                                    pas.appendChild(	
                                    document.createTextNode(`${ message.parts[0].payload.content}`));	
                                    if(message.senderId == 'admin')	
                                        div2.appendChild(imgas);	
                                    div2.appendChild(h3as);	
                                    div3.appendChild(pas);	
                                    div1.appendChild(div2);	
                                    div1.appendChild(div3);	
                                    divas.insertBefore(div1, divas.childNodes[3]);	
                                    document.getElementById("messageCount").innerHTML = "!";
                                    	
                                    	
                                }	
                                }	
                            });	
                            	
                            const form = document.getElementById("message-form");	
                            form.addEventListener("submit", e => {	
                                e.preventDefault();	

                                const input = document.getElementById("message-text");	
                                currentUser.sendSimpleMessage({	
                                text: input.value,	
                                roomId: sites.roomID	
                                	
                                });	
                                	
                                	
                                	
                                input.value = "";	
                            });	
                            })	
                            .catch(error => {	
                            console.error("error:", error);	
                            }); 	
                    	
                    	
                    	
                    	
                    </script>	
                	
                <div>

                </div>
                <div class="content-side wrapper" id="chatting" style="background-color: #353847 !important; padding-bottom: 250px;">	
                    	
                    	
                    <div class="block" style=" background: linear-gradient(90deg, rgba(235,232,232,1) 0%, rgba(255,255,255,1) 100%); box-shadow: -4px 6px 27px -5px rgba(166,159,166,1);">	
                        	
                    </div>	
                    	
                    <form action="dashboard/sendMessage" method="post" id="message-form"  style="width:100%;height:20%; position:fixed; bottom:0px; left:0; border-top:0px solid ; background-color: #353847 !important">	
                        @csrf	
                        <div class="form-group" class="WhiteBox"  >	
                            	
                            	
                            <textarea class="form-control" style="margin:10px; width: 95%" id="message-text" name="message-text" rows="4" placeholder="Textarea content.."></textarea>	
                            <div style="position:relative; text-align:right; margin: 10px;">	
                                <button type="submit" class="btn btn-sm btn-primary" style="color:white;">	
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
            <!--
                Sidebar Mini Mode - Display Helper classes

                Adding 'smini-hide' class to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
                Adding 'smini-show' class to an element will make it visible (opacity: 1) when the sidebar is in mini mode
                    If you would like to disable the transition animation, make sure to also add the 'no-transition' class to your element

                Adding 'smini-hidden' to an element will hide it when the sidebar is in mini mode
                Adding 'smini-visible' to an element will show it (display: inline-block) only when the sidebar is in mini mode
                Adding 'smini-visible-block' to an element will show it (display: block) only when the sidebar is in mini mode
            -->
            <nav id="sidebar" aria-label="Main Navigation">
                <!-- Side Header -->
                <div class="content-header bg-white-5">
                    <!-- Logo -->
                    <a class="font-w600 text-dual" href="/">
                        <i class="fa fa-circle-notch text-primary"></i>
                        <span class="smini-hide">
                            <span class="font-w700 font-size-h5">Menu</span>
                        </span>
                    </a>
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
                                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{ mix('css/themes/amethyst.css') }}" href="#">
                                    <span>Amethyst</span>
                                    <i class="fa fa-circle text-amethyst"></i>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{ mix('css/themes/city.css') }}" href="#">
                                    <span>City</span>
                                    <i class="fa fa-circle text-city"></i>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{ mix('css/themes/flat.css') }}" href="#">
                                    <span>Flat</span>
                                    <i class="fa fa-circle text-flat"></i>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{ mix('css/themes/modern.css') }}" href="#">
                                    <span>Modern</span>
                                    <i class="fa fa-circle text-modern"></i>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{ mix('css/themes/smooth.css') }}" href="#">
                                    <span>Smooth</span>
                                    <i class="fa fa-circle text-smooth"></i>
                                </a>
                                <!-- END Color Themes -->

                                <div class="dropdown-divider"></div>

                                <!-- Sidebar Styles -->
                                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                <a class="dropdown-item" data-toggle="layout" data-action="sidebar_style_light" href="#">
                                    <span>Sidebar Light</span>
                                </a>
                                <a class="dropdown-item" data-toggle="layout" data-action="sidebar_style_dark" href="#">
                                    <span>Sidebar Dark</span>
                                </a>
                                <!-- Sidebar Styles -->

                                <div class="dropdown-divider"></div>

                                <!-- Header Styles -->
                                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                <a class="dropdown-item" data-toggle="layout" data-action="header_style_light" href="#">
                                    <span>Header Light</span>
                                </a>
                                <a class="dropdown-item" data-toggle="layout" data-action="header_style_dark" href="#">
                                    <span>Header Dark</span>
                                </a>
                                <!-- Header Styles -->
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
                                <span class="nav-main-link-name">{{$user->name}}</span>
                            </a>
                        </li>
                        <li class="nav-main-heading">Various</li>
                        @if((Auth::user()->position == 'admin'))
                        <li class="nav-main-item{{ request()->is('pages/*') ? ' open' : '' }}">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                                <i class="nav-main-link-icon fas fa-user"></i>	
                                <span class="nav-main-link-name">Select user</span>	
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
                            <li class="nav-main-item open">	
                                <a class="nav-main-link" href="{{'/'}}">	
                                    <i class="nav-main-link-icon fas fa-folder-open"></i>	
                                    <span class="nav-main-link-name">Files</span>
                                </a>
                            </li>

                        
                        @if((Auth::user()->position == 'admin'))	
                        <li class="nav-main-item open">	
                            <a class="nav-main-link" href="{{'users'}}">	
                                <i class="nav-main-link-icon fas fa-users"></i>	
                                <span class="nav-main-link-name">All users</span>	
                            </a>
                        </li>
                        @endif	
                        </li>	
                        	
                        @if(Auth::user()->position == 'admin')
                        <li class="nav-main-heading">More</li>
                        <li class="nav-main-item open">
                            <a class="nav-main-link" href="/">
                                <i class="nav-main-link-icon si si-globe"></i>
                                <span class="nav-main-link-name">Landing</span>
                            </a>
                        </li>
                        @else	
                        <li class="nav-main-heading">Pages</li>	
                        <li class="nav-main-item open">	
                            <a class="nav-main-link" href="/">	
                                <i class="nav-main-link-icon si si-globe"></i>	
                                <span class="nav-main-link-name">Refresh</span>	
                            </a>	
                        </li>	
                        <li class="nav-main-item open">	
                            <a class="nav-main-link" href="https://reklamosekosistema.lt/">	
                                <i class="nav-main-link-icon si si-globe"></i>	
                                <span class="nav-main-link-name">Main page</span>	
                            </a>	
                        </li>	
                        @endif
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
                        <button type="button" class="btn btn-sm btn-dual mr-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
                            <i class="fa fa-fw fa-ellipsis-v"></i>
                        </button>
                        <!-- END Toggle Mini Sidebar -->

                        <!-- Apps Modal -->
                        <!-- Opens the Apps modal found at the bottom of the page, after footer’s markup -->
                        <button type="button" class="btn btn-sm btn-dual mr-2" data-toggle="modal" data-target="#one-modal-apps">
                            <i class="si si-grid"></i>
                        </button>
                        <!-- END Apps Modal -->

                        <!-- Open Search Section (visible on smaller screens) -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-sm btn-dual d-sm-none" data-toggle="layout" data-action="header_search_on">
                            <i class="si si-magnifier"></i>
                        </button>
                        <!-- END Open Search Section -->

                        <!-- Search Form (visible on larger screens) -->
                        <form class="d-none d-sm-inline-block" action="/dashboard" method="POST">
                            @csrf
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-alt" placeholder="Search.." id="page-header-search-input2" name="page-header-search-input2">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-body border-0">
                                        <i class="si si-magnifier"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <!-- END Search Form -->
                    </div>
                    <!-- END Left Section -->

                    <!-- Right Section -->
                    <div class="d-flex align-items-center">
                        <!-- User Dropdown -->
                        <div class="dropdown d-inline-block ml-2">
                            <button type="button" class="btn btn-sm btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded" src="{{ asset('media/avatars/avatar10.jpg') }}" alt="Header Avatar" style="width: 18px;">
                                <span class="d-none d-sm-inline-block ml-1">
                                    @if(Auth::check())	
                                        @if(Auth::user()->position == 'admin')	
                                            Admin	
                                        @else	
                                            User	
                                        @endif	
                                    @endif
                                </span>
                                <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-user-dropdown">
                                <div class="p-3 text-center bg-primary">
                                    <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ asset('media/avatars/avatar10.jpg') }}" alt="">
                                </div>
                                <div class="p-2">
                                    <h5 class="dropdown-header text-uppercase">User Options</h5>
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
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('logout') }} " onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <span>Log Out</span>
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
                       
                        
                            <div class="dropdown d-inline-block ml-2">
                                <button type="button" class="btn btn-sm btn-dual" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="si si-bell"></i>
                                    <span id="notifCount" class="badge badge-primary badge-pill">{{$notif->count()}}</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-notifications-dropdown">
                                    <div class="p-2 bg-primary text-center">
                                        <h5 class="dropdown-header text-uppercase text-white">Notifications</h5>
                                    </div>
                                    <ul id="manoNotifai2" class="nav-items mb-0">
                                        @if ($user->position == 'admin')	
                                        @foreach ($notif as $oneNotif)	
                                        
                                        <li>
                                            <a class="text-dark media py-2" href="{{route('deleteNotif', ['user' => 1])}}">
                                                <div class="mr-2 ml-3">
                                                    <i class="fa fa-fw fa-check-circle text-success"></i>
                                                </div>
                                                <div class="font-w600">New user: {{$oneNotif->message}}</div>	
                                                    <small class="text-muted">{{$oneNotif->created_at}}</small>
                                                </div>
                                            </a>
                                        </li>
                                        @endforeach	
                                        @else
    
                                        @foreach ($notif as $oneNotif)	
                                                
                                            <li>	
                                                    
                                                <a class="text-dark media py-2" href="{{route('deleteNotif', ['user' => $user->id])}}">	
                                                    <div class="mr-2 ml-3">	
                                                        <i class="fa fa-fw fa-check-circle text-success"></i>	
                                                    </div>	
                                                    <div class="media-body pr-2">	
                                                        <div class="font-w600">New file: {{$oneNotif->message}}</div>	
                                                        <small class="text-muted">{{$oneNotif->created_at}}</small>	
                                                    </div>	
                                                        
                                                        
                                                </a>	
                                            </li>	
                                            @endforeach	
                                        
                                            
                                            
                                            
                                        <!-- 
                                        <li>
                                            <a class="text-dark media py-2" href="javascript:void(0)">
                                                <div class="mr-2 ml-3">
                                                    <i class="fa fa-fw fa-plus-circle text-info"></i>
                                                </div>
                                                <div class="media-body pr-2">
                                                    <div class="font-w600">1 new sale, keep it up</div>
                                                    <small class="text-muted">22 min ago</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="text-dark media py-2" href="javascript:void(0)">
                                                <div class="mr-2 ml-3">
                                                    <i class="fa fa-fw fa-times-circle text-danger"></i>
                                                </div>
                                                <div class="media-body pr-2">
                                                    <div class="font-w600">Update failed, restart server</div>
                                                    <small class="text-muted">26 min ago</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="text-dark media py-2" href="javascript:void(0)">
                                                <div class="mr-2 ml-3">
                                                    <i class="fa fa-fw fa-plus-circle text-info"></i>
                                                </div>
                                                <div class="media-body pr-2">
                                                    <div class="font-w600">2 new sales, keep it up</div>
                                                    <small class="text-muted">33 min ago</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="text-dark media py-2" href="javascript:void(0)">
                                                <div class="mr-2 ml-3">
                                                    <i class="fa fa-fw fa-user-plus text-success"></i>
                                                </div>
                                                <div class="media-body pr-2">
                                                    <div class="font-w600">You have a new subscriber</div>
                                                    <small class="text-muted">41 min ago</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="text-dark media py-2" href="javascript:void(0)">
                                                <div class="mr-2 ml-3">
                                                    <i class="fa fa-fw fa-check-circle text-success"></i>
                                                </div>
                                                <div class="media-body pr-2">
                                                    <div class="font-w600">You have a new follower</div>
                                                    <small class="text-muted">42 min ago</small>
                                                </div>
                                            </a>
                                        </li>
                                         -->
                                    </ul>
                                    <!--
                                    <div class="p-2 border-top">
                                        <a class="btn btn-sm btn-light btn-block text-center" href="javascript:void(0)">
                                            <i class="fa fa-fw fa-arrow-down mr-1"></i> Load More..
                                        </a>
                                    </div>
                                     -->
                                </div>
                            </div>
                        
                        @endif
                        
                        <!-- END Notifications Dropdown -->

                        <!-- Toggle Side Overlay -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        @if($user->position != 'admin')
                        <button type="button" onclick="messageAsideToZero()" class="btn btn-sm btn-dual ml-2" data-toggle="layout" data-action="side_overlay_toggle">
                            <i class="far fa-comment-alt"></i>
                            <span id="messageCount" class="badge badge-primary badge-pill">!</span>
                        </button>
                        @endif
                        <!-- END Toggle Side Overlay -->
                    </div>
                    <!-- END Right Section -->
                </div>
                <!-- END Header Content -->

                <!-- Header Search -->
                <div id="page-header-search" class="overlay-header bg-white">
                    <div class="content-header">
                        <form class="w-100" action="/dashboard" method="POST">
                            @csrf
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
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
            <main id="main-container">
                @yield('content')
            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id="page-footer" class="bg-body-light">
                <div class="content py-3">
                    <div class="row font-size-sm">
                        <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-right">
                            Crafted by <a class="font-w600" href="https://reklamosekosistema.lt/" target="_blank">Domantas Sabaliauskas</a>
                        </div>
                        <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-left">
                            <a class="font-w600" href="https://google.com/" target="_blank">Domanto svetainė</a> &copy; <span data-toggle="year-copy">2020</span>
                        </div>
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
        <script src="{{ mix('js/oneui.app.js') }}"></script>

        <!-- Laravel Scaffolding JS -->
        <!-- <script src="{{ mix('/js/laravel.app.js') }}"></script> -->

        @yield('js_after')
    </body>
    
    <script>
        window.Laravel = {csrfToken: '{{ csrf_token() }}'};
    </script>
</html>

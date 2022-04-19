<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>{{__('Rekos užsakymai')}}</title>

        <meta name="description" content="Reklamos ekositema klientų sistema">
        <meta name="author" content="Domantas Sabaliauskas">
        <meta name="robots" content="noindex, nofollow">

        <meta name="csrf-token" content="{{ csrf_token() }}">


        <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
        <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

        @yield('css_before')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
        <link rel="stylesheet" id="css-main" href="{{ asset('/css/oneui.css') }}">

        @yield('css_after')

        <!-- Scripts -->
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
        <meta property="og:title" content="Reklamos ekositema klientų sistema" />
        <meta property="og:url" content="http://klientams.reklamosekosistema.lt" />
        <meta property="og:image" content="https://reklamosekosistema.lt/wp-content/uploads/2019/11/reklamos-ekosistema-logo.png" />
        
    </head>
    <body>

        <div id="page-container" class="">
            <main id="main-container">
                @yield('content')
            </main>
        </div>

        <script src="{{ asset('js/oneui.app.js') }}"></script>

        @yield('js_after')
    </body>
</html>

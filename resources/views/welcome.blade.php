<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        @php   
        $iosFix = '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=0">';
            if(Browser::isMobile()){
                if(Browser::isSafari()){
                    echo $iosFix;
                }
            }
        @endphp

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="app-url" content="{{ url('/') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ env('APP_NAME') }}</title>
        <meta name="description" content="{{ env('APP_NAME') }}">
        @if(config('app.env') === 'production')
        <link rel="stylesheet" href="{{ url('/').mix('css/app.css') }}">
        @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @endif
        <link rel="icon" type="image/png" href="{{ asset('img/cspLogos/cspfavicon.png') }}">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,700,800" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <script src="https://public.tableau.com/javascripts/api/tableau-2.min.js"></script>
    </head>
    <body>
        <div id="app">
            <v-app/>
        </div>
        @if (config('app.env') === 'production')
        <script src="{{ url('/').mix('js/app.js') }}"></script>
        @else
        <script src="{{ asset('js/app.js') }}"></script>
        @endif
        @if(env('GOOGLE_ANALYTICS_TRACKING_ID'))
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GOOGLE_ANALYTICS_TRACKING_ID') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', '{{env('GOOGLE_ANALYTICS_TRACKING_ID')}}');
        </script>
        @endif
        <noscript>
            <h1>Please have JavaScript enabled.</h1>
        </noscript>
    </body>
</html>

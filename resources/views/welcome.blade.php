<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csu-metro-url" content="{{url('/') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>CSU: Metro LA</title>
        <meta name="description" content="Cal State Pays">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        

    </head>
    <body>
       <div id="app"></div>

       <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
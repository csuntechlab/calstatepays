<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="app-url" content="{{ url('/') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>CSU: Metro LA</title>
        
        <meta name="description" content="Cal State Pays">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,700,800" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">        
    </head>
    <body>
       <div id="app">
           <v-app>

           </v-app>
       </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>

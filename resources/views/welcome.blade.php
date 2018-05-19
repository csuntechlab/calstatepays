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
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,700,800" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
        
    </head>
    <body>
       <div id="app">
           <v-app>

           </v-app>
       </div>
       <script src="{{ asset('js/app.js') }}"></script>
       <script src="https://unpkg.com/vuetify/dist/vuetify.js"></script>
    </body>
</html>

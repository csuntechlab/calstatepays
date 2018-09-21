<!DOCTYPE HTML>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        {{-- SOCIAL SHARE --}}
        <meta property="og:title" content="CalStatePays">
        <meta property="og:description" content="Discover Your Earnings after College">
        <meta property="og:image" content="https://www.sandbox.csun.edu/metalab/csumetrola/images/money-pig.jpg">
        <meta property="og:url" content="https://www.sandbox.csun.edu/metalab/csumetrola">
        <meta name="twitter:title" content="CalStatePays">
        <meta name="twitter:description" content=" Discover Your Earnings after College">
        <meta name="twitter:image" content="https://www.sandbox.csun.edu/metalab/csumetrola/images/money-pig.jpg">
        <meta name="twitter:card" content="summary_large_image">
        
            <title>@yield('title') | Project Name</title>
            <meta name="description" content="@yield('description')">
            
        <link rel="icon" href="{!! asset('favicon.png') !!}" type="image/x-icon">
        
            {{-- APP STYLESHEETS --}}
        {!! HTML::style('css/components.css') !!}
        {!! HTML::style('css/app.css') !!}
    </head>
    <body>
        
        {{-- APP CONTENT BEGINS --}}
        @include('layouts.partials.header')
            <div class="wrapper">
                @yield('content')
            </div>
            {{-- MODALS --}}
            @yield('modal')
        @include('layouts.partials.footer')
        {{-- APP CONTENT ENDS --}}
        
        {{-- APP SCRIPTS --}}
        {!! HTML::script('js/app.js') !!}
    </body>
</html>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>{{ config('app.name') }} | Something unexpected happend!</title>
    
        {{-- Styles --}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/errors.css') }}">
    </head>
    <body onload="javascript:loadDomain();">
        {{-- Error Page Content --}}
            @yield('content')
        {{-- End Error Page Content --}}


        {{-- Scripts --}}
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
            function loadDomain() {
                var display = document.getElementById("display-domain");
                display.innerHTML = document.domain;
            }

            function checkSite() {
                var currentSite = window.location.hostname;
                    window.location = "http://" + currentSite;
            }
        </Script>
    </body>
</html>
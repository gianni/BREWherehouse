<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}} :: {{config('app.claim')}}</title>
  
        @vite('resources/css/app.css')

        <script>
        window.appConfig = {
            appName: '{{ config('app.name')}}',
            appClaim: '{{ config('app.claim')}}',
            itemsTotal: '{{ config('proxy.items_total')}}',
            itemsPerPage: '{{ config('proxy.items_per_page')}}',
        };
        </script>
    </head>
    <body class="bg-gray-100">
        <div id="app"></div>
        @vite('resources/js/app.js')
    </body>
</html>
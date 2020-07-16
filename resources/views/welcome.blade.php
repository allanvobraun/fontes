<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <body>
        <div id="app">
            <top-bar></top-bar>
            <example-component></example-component>
        </div>
    <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <livewire:styles />
    </head>
    <body>
        <a href="{{ url('lang/ar') }}">Arabic</a>
        <a href="{{ url('lang/en') }}">English</a>
        <h1>{{ __('messages.welcome') }}</h1>

        <livewire:scripts />
    </body>
</html>

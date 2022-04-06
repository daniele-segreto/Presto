<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? '' }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>


    <body class="antialiased">

        <x-navbar/>

        {{-- Prova JS, da cancellare! --}}
        {{-- <h1 class="text-center mt-4" id="testo">Prova Javascript</h1> --}}
        
        {{$slot}}

        <x-footer/>

        {{-- Script --}}
        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
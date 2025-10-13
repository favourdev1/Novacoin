<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
@php
    $cwd = getcwd();
    $cssName = basename(glob($cwd . '/build/assets/*.css')[0] ?? '', '.css');
    $jsName = basename(glob($cwd . '/build/assets/*.js')[0] ?? '', '.js');
    $css = asset('build/assets/' . $cssName . '.css');
    $js = asset('build/assets/' . $jsName . '.js');
    @endphp
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ $css }}" id="css">
    <script src="{{ $js }}" id="js"></script>
        <!-- Styles -->
        @livewireStyles
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>

        @livewireScripts
    </body>
</html>
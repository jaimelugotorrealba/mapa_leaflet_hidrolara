<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hidrolara - Página no Encontrada</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!--Normalize-->
        <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        <link rel="stylesheet" href="{{asset('css/styles.css')}}">
        @yield('styles')
</head>
<body>

    <div class="container -mt-5 h-screen flex flex-col justify-center items-center">
        <img src="{{asset('img/error404.png')}}" class="h-5/6" alt="Página no encontrada">
        <div class="p-4 md:p-0 w-full flex justify-center">
            <a href="{{route('dashboard')}}" class="block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center w-full md:w-44">{{__('Inicio')}}</a>
        </div>
    </div>
    @stack('modals')
    @livewireScripts
</body>
</html>

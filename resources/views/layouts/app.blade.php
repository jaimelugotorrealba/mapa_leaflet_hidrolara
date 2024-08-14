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
        <!--Normalize-->
        <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
        <!-- Scripts -->
        <link rel="stylesheet" href="{{asset('build/assets/app-3a3b1988.css')}}">
        <script src="{{asset('build/assets/app-dbe23e4c.js')}}"></script>
        <!-- Styles -->
        @livewireStyles
        <link rel="stylesheet" href="{{asset('css/styles.css')}}">
        @yield('styles')
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gradient-gray-nav">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

        </div>

        @stack('modals')
        @livewireScripts
        <script src="{{ asset('js/fontawesome.js') }}"></script>
        @yield('scripts')
    </body>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/theme.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendor.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
        @livewireStyles
    </head>

    <body>

        <main style="min-height: 100vh" class="align-items-center">
            {{--  @yield('content')  --}}
            {{ $slot }}
        </main>
        @livewireScripts
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10">
        </script>
        <x-livewire-alert::scripts />
        <script src="{{ asset('assets/js/theme.min.js') }}" defer></script>
        <script src="{{ asset('assets/js/vendor.min.js') }}" defer></script>

    </body>

</html>

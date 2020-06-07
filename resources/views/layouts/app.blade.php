<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.App = {!! json_encode([
                'csrfToken' => csrf_token(),
                'user' => Auth::User(),
                'signedIn' => Auth::check(),
                'domain' => config('app.url')
            ]) !!}
    </script>


</head>

<body class="antialiased text-black">
    <div id="app">
        @yield('content')
    </div>

    <footer class="text-center py-4 mt-8 border-t border-grey-light">
        <p class="text-sm">
            &copy; {{ date('Y') }}, Cameron Scott
        </p>
    </footer>
    <script src="{{ mix('js/app.js') }}"></script>

</body>

</html>
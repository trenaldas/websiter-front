<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('images/logo2.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('meta')
    <title>{{ $project->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $project->google_analytics }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{ $project->google_analytics }}');
    </script>
</head>
<body>

@yield('app')

@livewireScripts
<script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.8.0/alpine.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

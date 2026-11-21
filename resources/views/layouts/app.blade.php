<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#fff9ee">
    <meta name="description" content="{{ $metaDescription ?? 'Mind Trainer — Unlock the Power of Your Mind. Corporate mind training for focus, memory, leadership and peak performance.' }}">
    <title>@yield('title', 'Mind Trainer') | Unlock the Power of Your Mind</title>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/features.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
    <link rel="stylesheet" href="{{ asset('css/testimonials.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/theme-gold.css') }}">
</head>
<body>
    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="{{ asset('js/site.js') }}" defer></script>
</body>
</html>

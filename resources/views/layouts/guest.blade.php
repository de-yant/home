<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ config('app.name', 'HomeDev') }} - Home Development Tracking
    </title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('asset/image/favicon.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    style="background-image: url('{{ asset('asset/image/bg-3.jpg') }}'); background-size: cover; background-position: center;"
    class="font-sans text-gray-900 antialiased"
>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            {{ $slot }}
    </div>
</body>



</html>

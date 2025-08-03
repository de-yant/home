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

    <!-- Styles dari public -->
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">

    <!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Scripts dari public -->
    <script src="{{ asset('asset/js/script.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Sidebar -->
        {{-- <section id="sidebar">
            <ul class="side-menu top">
                <li class="active">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class='bx bxs-dashboard'></i>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bxs-group'></i>
                        <span class="text">Team</span>
                    </a>
                </li>
            </ul>
            <ul class="side-menu">
                <li>
                    <a href="#">
                        <i class='bx bxs-cog'></i>
                        <span class="text">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="logout">
                        <i class='bx bxs-log-out-circle'></i>
                        <span class="text">Logout</span>
                    </a>
                </li>
            </ul>
        </section> --}}

        <!-- Page Content -->
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>
    </div>
    {{-- <script src="{{ asset('asset/js/script.js') }}"></script> --}}
</body>

</html>

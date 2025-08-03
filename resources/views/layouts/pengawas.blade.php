<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'HomeDev')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('asset/image/favicon.ico') }}" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- jQuery (Wajib) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Inisialisasi Select2 -->
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Pilih atau cari unit rumah...',
                allowClear: true
            });
        });
    </script>

</head>

<body class="bg-gray-100 dark:bg-gray-900 font-sans antialiased">
    <div x-data="{ open: false }" @toggle-sidebar.window="open = !open" class="min-h-screen flex flex-col">

        <!-- Top Navbar -->
        @include('layouts.navigation') <!-- Navigation bar dengan tombol toggle -->

        <div class="flex flex-1">

            <!-- Sidebar -->
            <aside id="adminSidebar" :class="{ '-translate-x-full': !open, 'translate-x-0': open }"
                class="w-64 bg-white dark:bg-gray-800 p-4 space-y-6 shadow-md z-40 transition-transform transform
           fixed inset-y-0 left-0 pt-16 md:pt-0 md:relative md:translate-x-0 md:transform-none">

                <!-- Logo + Panel Title -->
                <div class="text-xl font-bold mb-4 text-gray-800 dark:text-white pl-2">
                    Pengawas Panel
                </div>


                <!-- Navigation Menu -->
                <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                    <li>
                        <a href="{{ route('pengawas.dashboard') }}" @click="open = false"
                            class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700
        {{ request()->routeIs('pengawas.dashboard') ? 'bg-gray-200 dark:bg-gray-700 font-semibold text-gray-900 dark:text-white blink' : '' }}">
                            <i class='bx bxs-dashboard text-xl'></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <a href="{{ route('pengawas.progress.index') }}" @click="open = false"
                        class="flex items-center gap-3 px-3 py-2 rounded-md
   transition duration-200 hover:bg-gray-100 dark:hover:bg-gray-700
   {{ request()->routeIs('pengawas.progress.*') ? 'bg-gray-200 dark:bg-gray-700 font-semibold text-gray-900 dark:text-white blink' : '' }}">
                        <i class='bx bxs-hard-hat text-xl'></i>
                        <span>Progress</span>
                    </a>

                    <li>
                        <a href="{{ route('pengawas.evaluasi.index') }}" @click="open = false"
                            class="flex items-center gap-3 hover:bg-gray-100 dark:hover:bg-gray-700 px-3 py-2 rounded-md
           {{ request()->routeIs('pengawas.evaluasi.*') ? 'bg-gray-200 dark:bg-gray-700 font-semibold text-gray-900 dark:text-white blink' : '' }}">
                            <i class='bx bxs-news text-xl'></i>
                            <span>Evaluasi</span>
                        </a>
                    </li>

                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex items-center gap-3 w-full text-red-600 hover:bg-red-100 dark:hover:bg-gray-700 px-3 py-2 rounded-md">
                                <i class='bx bxs-log-out text-xl'></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </aside>


            <!-- Main Content -->
            <div class="flex-1 flex flex-col transition-all duration-300">

                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white dark:bg-gray-800 shadow p-4">
                        {{ $header }}
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="flex-1 p-6 overflow-y-auto">
                    @yield('content')
                </main>

                <!-- Footer -->
                <footer class="bg-white dark:bg-gray-800 text-center text-sm text-gray-500 dark:text-gray-400 p-4">
                    &copy; {{ date('Y') }} HomeDev. All rights reserved.
                </footer>
            </div>
        </div>
    </div>
    @stack('scripts')
</body>

</html>

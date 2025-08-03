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
                    Admin Panel
                </div>


                <!-- Navigation Menu -->
                <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" @click="open = false"
                            class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700
        {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200 dark:bg-gray-700 font-semibold text-gray-900 dark:text-white blink' : '' }}">
                            <i class='bx bxs-dashboard text-xl'></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li x-data="{ open: {{ request()->is('admin/masterdata*') ? 'true' : 'false' }} }">
                        <!-- Master Data Trigger -->
                        <button @click="open = !open"
                            class="flex items-center justify-between w-full px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700
        {{ request()->is('admin/masterdata*') ? 'bg-gray-200 dark:bg-gray-700 font-semibold text-gray-900 dark:text-white blink' : '' }}">
                            <span class="flex items-center gap-3">
                                <i class='bx bxs-data text-xl'></i>
                                <span>Master Data</span>
                            </span>
                            <i :class="open ? 'bx bx-chevron-up' : 'bx bx-chevron-down'" class="text-xl"></i>
                        </button>

                        <!-- Submenu -->
                        <ul x-show="open" x-collapse
                            class="mt-1 space-y-1 pl-11 text-sm text-gray-600 dark:text-gray-300 transition-all duration-300 ease-in-out">

                            <!-- Daftar Tipe Rumah -->
                            <li>
                                <a href="{{ route('admin.masterdata.unit-rumah.index') }}"
                                    class="flex items-center gap-2 px-3 py-2 rounded-md transition duration-200
        hover:bg-blue-100 dark:hover:bg-gray-700 hover:text-blue-600
        {{ request()->routeIs('admin.masterdata.unit-rumah.index') ? 'bg-blue-50 dark:bg-gray-700 text-blue-700 font-semibold border-l-4 border-blue-500 pl-2 animate-pulse' : '' }}">
                                    <i class='bx bx-home-smile text-lg'></i>
                                    <span>Unit Rumah</span>
                                </a>
                            </li>


                            <!-- Progress -->
                            <li>
                                <a href="{{ route('admin.masterdata.progress.index') }}"
                                    class="flex items-center gap-2 px-3 py-2 rounded-md transition duration-200
                   hover:bg-blue-100 dark:hover:bg-gray-700 hover:text-blue-600 {{ request()->routeIs('admin.masterdata.progress.index') ? 'bg-blue-50 dark:bg-gray-700 text-blue-700 font-semibold border-l-4 border-blue-500 pl-2 animate-pulse' : '' }}">
                                    <i class='bx bx-category text-lg'></i>
                                    <span>Progress</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ route('admin.evaluasi.index') }}" @click="open = false"
                            class="flex items-center gap-3 hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('admin.evaluasi.*') ? 'bg-gray-200 dark:bg-gray-700 font-semibold text-gray-900 dark:text-white blink' : '' }} px-3 py-2 rounded-md">
                            <i class='bx bxs-news text-xl'></i>
                            <span>Evaluasi</span>
                        </a>
                    </li>

                    <li x-data="{ open: {{ request()->is('admin/settings*') ? 'true' : 'false' }} }">
    <!-- Settings Trigger -->
    <button @click="open = !open"
        class="flex items-center justify-between w-full px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700
        {{ request()->is('admin/settings*') ? 'bg-gray-200 dark:bg-gray-700 font-semibold text-gray-900 dark:text-white blink' : '' }}">
        <span class="flex items-center gap-3">
            <i class='bx bxs-cog text-xl'></i>
            <span>Settings</span>
        </span>
        <i :class="open ? 'bx bx-chevron-up' : 'bx bx-chevron-down'" class="text-xl"></i>
    </button>

    <!-- Submenu -->
    <ul x-show="open" x-collapse
        class="mt-1 space-y-1 pl-11 text-sm text-gray-600 dark:text-gray-300 transition-all duration-300 ease-in-out">

        <!-- Manajemen Pengguna -->
        <li>
            <a href="{{ route('admin.settings.users.index') }}"
                class="flex items-center gap-2 px-3 py-2 rounded-md transition duration-200
                hover:bg-blue-100 dark:hover:bg-gray-700 hover:text-blue-600
                {{ request()->routeIs('admin.settings.users.index') ? 'bg-blue-50 dark:bg-gray-700 text-blue-700 font-semibold border-l-4 border-blue-500 pl-2 animate-pulse' : '' }}">
                <i class='bx bx-user-circle text-lg'></i>
                <span>User Management</span>
            </a>
        </li>

        <!-- Tambahan Submenu Lain (opsional) -->
        {{-- <li>
            <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-blue-100 dark:hover:bg-gray-700">
                <i class='bx bx-shield-quarter text-lg'></i>
                <span>Role Setting</span>
            </a>
        </li> --}}
    </ul>
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

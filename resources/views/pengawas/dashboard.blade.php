@extends('layouts.pengawas')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Dashboard Pengawas</h1>
        <p class="text-gray-600 dark:text-gray-300 mt-1">Selamat datang, {{ auth()->user()->name }}!</p>
    </div>

    {{-- Ringkasan Evaluasi --}}
    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Ringkasan Evaluasi</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow flex items-center gap-4">
            <div class="bg-green-100 text-green-600 dark:bg-green-800 dark:text-green-300 p-3 rounded-full">
                <i class="bx bx-check-circle text-2xl"></i>
            </div>
            <div>
                <h2 class="text-sm text-gray-600 dark:text-gray-400">Evaluasi Sesuai</h2>
                <p class="text-xl font-semibold text-green-600 dark:text-green-400">
                    {{ \App\Models\Evaluasi::where('status', 'sesuai')->count() }}
                </p>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow flex items-center gap-4">
            <div class="bg-yellow-100 text-yellow-600 dark:bg-yellow-800 dark:text-yellow-300 p-3 rounded-full">
                <i class="bx bx-error-circle text-2xl"></i>
            </div>
            <div>
                <h2 class="text-sm text-gray-600 dark:text-gray-400">Perlu Revisi</h2>
                <p class="text-xl font-semibold text-yellow-600 dark:text-yellow-400">
                    {{ \App\Models\Evaluasi::where('status', 'perlu revisi')->count() }}
                </p>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow flex items-center gap-4">
            <div class="bg-red-100 text-red-600 dark:bg-red-800 dark:text-red-300 p-3 rounded-full">
                <i class="bx bx-time-five text-2xl"></i>
            </div>
            <div>
                <h2 class="text-sm text-gray-600 dark:text-gray-400">Belum Diperiksa</h2>
                <p class="text-xl font-semibold text-red-600 dark:text-red-400">
                    {{ \App\Models\Evaluasi::where('status', 'belum diperiksa')->count() }}
                </p>
            </div>
        </div>
    </div>

    {{-- Ringkasan Progress --}}
    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Ringkasan Progress</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow flex items-center gap-4">
            <div class="bg-blue-100 text-blue-600 dark:bg-blue-800 dark:text-blue-300 p-3 rounded-full">
                <i class="bx bx-home-circle text-2xl"></i>
            </div>
            <div>
                <h2 class="text-sm text-gray-600 dark:text-gray-400">Total Progress</h2>
                <p class="text-xl font-semibold text-blue-600 dark:text-blue-400">
                    {{ \App\Models\Progress::count() }}
                </p>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow flex items-center gap-4">
            <div class="bg-indigo-100 text-indigo-600 dark:bg-indigo-800 dark:text-indigo-300 p-3 rounded-full">
                <i class="bx bx-loader-circle text-2xl"></i>
            </div>
            <div>
                <h2 class="text-sm text-gray-600 dark:text-gray-400">Sedang Berlangsung</h2>
                <p class="text-xl font-semibold text-indigo-600 dark:text-indigo-400">
                    {{ \App\Models\Progress::where('status', 'proses')->count() }}
                </p>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow flex items-center gap-4">
            <div class="bg-green-100 text-green-600 dark:bg-green-800 dark:text-green-300 p-3 rounded-full">
                <i class="bx bx-check text-2xl"></i>
            </div>
            <div>
                <h2 class="text-sm text-gray-600 dark:text-gray-400">Selesai</h2>
                <p class="text-xl font-semibold text-green-600 dark:text-green-400">
                    {{ \App\Models\Progress::where('status', 'selesai')->count() }}
                </p>
            </div>
        </div>
    </div>

    {{-- Info tambahan --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <p class="text-gray-700 dark:text-gray-100">
            Pantau aktivitas progress pembangunan dan evaluasi secara berkala melalui menu yang tersedia.
        </p>
    </div>
@endsection

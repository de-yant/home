@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Dashboard Admin</h1>
        <p class="text-gray-600 dark:text-gray-300 mt-1">Selamat datang kembali, Admin!</p>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow flex items-center space-x-4">
            <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 10h4l3 10h8l3-10h4"></path>
            </svg>
            <div>
                <h2 class="text-sm font-semibold text-gray-600 dark:text-gray-400">Total Unit Rumah</h2>
                <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                    {{ \App\Models\UnitRumah::count() }}
                </p>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow flex items-center space-x-4">
            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 17v-2a4 4 0 10-8 0v2a4 4 0 008 0zm6-2a4 4 0 10-8 0v2a4 4 0 008 0z" />
            </svg>
            <div>
                <h2 class="text-sm font-semibold text-gray-600 dark:text-gray-400">Total Progress</h2>
                <p class="text-2xl font-bold text-green-600 dark:text-green-400">
                    {{ \App\Models\Progress::count() }}
                </p>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow flex items-center space-x-4">
            <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12l2 2 4-4m2 2a9 9 0 11-6.219-8.485" />
            </svg>
            <div>
                <h2 class="text-sm font-semibold text-gray-600 dark:text-gray-400">Total Evaluasi</h2>
                <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">
                    {{ \App\Models\Evaluasi::count() }}
                </p>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow flex items-center space-x-4">
            <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 8v4l3 3m6 1a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <h2 class="text-sm font-semibold text-gray-600 dark:text-gray-400">Evaluasi Proses</h2>
                <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">
                    {{ \App\Models\Evaluasi::where('status', 'sesuai')->count() }}
                </p>
            </div>
        </div>
    </div>

    {{-- Grafik Evaluasi --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Statistik Evaluasi</h2>
        <canvas id="evaluasiChart" height="100"></canvas>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('evaluasiChart').getContext('2d');
        const evaluasiChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Sesuai', 'Perlu Revisi', 'Belum Diperiksa', 'Proses'],
                datasets: [{
                    label: 'Jumlah Evaluasi',
                    data: [
                        {{ \App\Models\Evaluasi::where('status', 'sesuai')->count() }},
                        {{ \App\Models\Evaluasi::where('status', 'perlu revisi')->count() }},
                        {{ \App\Models\Evaluasi::where('status', 'belum diperiksa')->count() }},
                        {{ \App\Models\Evaluasi::where('status', 'proses')->count() }}
                    ],
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.7)',
                        'rgba(234, 179, 8, 0.7)',
                        'rgba(239, 68, 68, 0.7)',
                        'rgba(59, 130, 246, 0.7)' // Biru untuk proses
                    ],
                    borderColor: [
                        'rgba(34, 197, 94, 1)',
                        'rgba(234, 179, 8, 1)',
                        'rgba(239, 68, 68, 1)',
                        'rgba(59, 130, 246, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
@endsection

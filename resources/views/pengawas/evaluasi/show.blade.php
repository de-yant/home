@extends('layouts.pengawas')

@section('title', 'Detail Evaluasi')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Detail Evaluasi</h1>
        <a href="{{ route('pengawas.evaluasi.index') }}"
            class="inline-block text-sm text-blue-600 hover:underline dark:text-blue-400">← Kembali ke daftar evaluasi</a>
    </div>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400">ID Evaluasi</h2>
                <p class="text-lg text-gray-800 dark:text-white font-semibold">{{ $evaluasi->id_evaluasi }}</p>
            </div>

            <div>
                <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400">ID Progress</h2>
                <p class="text-lg text-gray-800 dark:text-white">{{ $evaluasi->id_progres }}</p>
            </div>

            <div>
                <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</h2>
                <p class="text-lg text-gray-800 dark:text-white capitalize">{{ $evaluasi->status }}</p>
            </div>

            <div>
                <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400">Catatan</h2>
                <p class="text-gray-800 dark:text-white whitespace-pre-line">{{ $evaluasi->catatan }}</p>
            </div>

            <div class="md:col-span-2">
                <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400">Foto</h2>
                @if ($evaluasi->foto)
                    <img src="{{ asset('storage/' . $evaluasi->foto) }}" alt="Foto Evaluasi"
                        class="mt-2 max-w-full h-auto rounded shadow">
                @else
                    <p class="text-gray-500 dark:text-gray-400 mt-2">Tidak ada foto yang tersedia.</p>
                @endif
            </div>
        </div>
    </div>
@endsection

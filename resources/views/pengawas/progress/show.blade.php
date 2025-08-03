@extends('layouts.pengawas')

@section('title', 'Detail Progress')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Detail Progress</h1>
        <a href="{{ route('pengawas.progress.index') }}"
            class="inline-block text-sm text-blue-600 hover:underline dark:text-blue-400">
            ← Kembali ke daftar progress
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Kolom Foto --}}
            <div>
                <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Foto Progress</h2>
                @if ($progress->foto)
                    <img src="{{ asset('storage/' . $progress->foto) }}" alt="Foto Progress"
                        class="w-full rounded shadow">
                @else
                    <p class="text-gray-500 dark:text-gray-400">Tidak ada foto tersedia.</p>
                @endif
            </div>

            {{-- Kolom Detail --}}
            <div class="space-y-4">
                <div>
                    <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400">ID Progress</h2>
                    <p class="text-lg text-gray-800 dark:text-white font-semibold">{{ $progress->id_progres }}</p>
                </div>

                <div>
                    <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400">Unit Rumah</h2>
                    <p class="text-lg text-gray-800 dark:text-white">{{ $progress->unit->no_rumah ?? '-' }}</p>
                </div>

                <div>
                    <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal</h2>
                    <p class="text-lg text-gray-800 dark:text-white">{{ \Carbon\Carbon::parse($progress->tanggal)->translatedFormat('d F Y') }}</p>
                </div>

                <div>
                    <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400">Deskripsi</h2>
                    <p class="text-gray-800 dark:text-white whitespace-pre-line">{{ $progress->deskripsi }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

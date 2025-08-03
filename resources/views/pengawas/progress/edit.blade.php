@extends('layouts.pengawas')

@section('title', 'Edit Progress')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Edit Progress</h1>
        <a href="{{ route('pengawas.progress.index') }}"
            class="inline-block text-sm text-blue-600 hover:underline dark:text-blue-400">
            ← Kembali ke daftar progress
        </a>
    </div>

    <form action="{{ route('pengawas.progress.update', $progress->id_progres) }}" method="POST" enctype="multipart/form-data"
        class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Kolom Foto --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Foto Saat Ini</label>
                @if ($progress->foto)
                    <img src="{{ asset('storage/' . $progress->foto) }}" alt="Foto Progress"
                        class="w-full rounded shadow mb-2">
                @else
                    <p class="text-gray-500 dark:text-gray-400 mb-2">Tidak ada foto yang tersedia.</p>
                @endif

                <label for="foto" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ganti Foto (Opsional)</label>
                <input type="file" name="foto" id="foto"
                    class="w-full mt-1 px-3 py-2 border rounded" accept="image/*">
            </div>

            {{-- Kolom Form --}}
            <div class="space-y-4">
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal"
                        value="{{ old('tanggal', $progress->tanggal) }}"
                        class="w-full mt-1 px-3 py-2 border rounded" required>
                </div>

                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="5"
                        class="w-full mt-1 px-3 py-2 border rounded"
                        required>{{ old('deskripsi', $progress->deskripsi) }}</textarea>
                </div>
            </div>
        </div>

        <div class="mt-6 text-right">
            <button type="submit"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2 rounded shadow">
                Simpan Perubahan
            </button>
        </div>
    </form>
@endsection

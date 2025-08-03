@extends('layouts.pengawas')

@section('title', 'Edit Evaluasi')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Edit Evaluasi</h1>
        <a href="{{ route('pengawas.evaluasi.index') }}"
            class="inline-block text-sm text-blue-600 hover:underline dark:text-blue-400">← Kembali ke daftar evaluasi</a>
    </div>

    <form action="{{ route('pengawas.evaluasi.update', $evaluasi->id_evaluasi) }}" method="POST" enctype="multipart/form-data"
        class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- ID Evaluasi --}}
            <div>
                <label class="text-sm font-medium text-gray-500 dark:text-gray-400">ID Evaluasi</label>
                <input type="text" name="id_evaluasi" value="{{ $evaluasi->id_evaluasi }}"
                    class="w-full mt-1 px-3 py-2 border rounded bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white"
                    readonly>
            </div>

            {{-- ID Progress --}}
            <div>
                <label class="text-sm font-medium text-gray-500 dark:text-gray-400">ID Progress</label>
                <input type="text" name="id_progres" value="{{ $evaluasi->id_progres }}"
                    class="w-full mt-1 px-3 py-2 border rounded bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white"
                    readonly>
            </div>

            {{-- Status --}}
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                <select name="status" id="status" class="w-full mt-1 px-3 py-2 border rounded" required>
                    <option value="">-- Pilih Status --</option>
                    {{-- sesuai', 'perlu revisi', 'belum diperiksa', 'sudah diperiksa' --}}
                    <option value="sesuai" {{ $evaluasi->status == 'sesuai' ? 'selected' : '' }}>Sesuai</option>
                    <option value="perlu revisi" {{ $evaluasi->status == 'perlu revisi' ? 'selected' : '' }}>Perlu Revisi</option>
                    <option value="belum diperiksa" {{ $evaluasi->status == 'belum diperiksa' ? 'selected' : '' }}>Belum Diperiksa</option>
                    <option value="sudah diperiksa" {{ $evaluasi->status == 'sudah diperiksa' ? 'selected' : '' }}>Sudah Diperiksa</option>
                </select>
            </div>

            {{-- Catatan --}}
            <div>
                <label for="catatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Catatan</label>
                <textarea name="catatan" id="catatan" rows="3"
                    class="w-full mt-1 px-3 py-2 border rounded resize-none">{{ $evaluasi->catatan }}</textarea>
            </div>

            {{-- Foto --}}
            <div class="md:col-span-2">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300 block mb-1">Foto Saat Ini</label>
                @if ($evaluasi->foto)
                    <img src="{{ asset('storage/' . $evaluasi->foto) }}" alt="Foto Evaluasi"
                        class="max-w-full h-auto rounded shadow mb-2">
                @else
                    <p class="text-gray-500 dark:text-gray-400 mb-2">Tidak ada foto yang tersedia.</p>
                @endif

                <label for="foto" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ganti Foto (Opsional)</label>
                <input type="file" name="foto" id="foto" accept="image/*"
                    class="w-full mt-1 px-3 py-2 border rounded">
            </div>
        </div>

        {{-- Tombol Update --}}
        <div class="pt-4">
            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded shadow text-sm">
                Update Evaluasi
            </button>
        </div>
    </form>
@endsection

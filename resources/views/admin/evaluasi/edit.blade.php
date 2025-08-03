@extends('layouts.admin')

@section('title', 'Edit Evaluasi')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Evaluasi</h1>

    <form action="{{ route('admin.evaluasi.update', $evaluasi->id_evaluasi) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
            <!-- FOTO DI SEBELAH KIRI -->
            <div class="md:col-span-1">
                <p class="font-semibold mb-2">Foto Evaluasi</p>
                @if ($evaluasi->foto)
                    <img src="{{ asset('storage/' . $evaluasi->foto) }}" alt="Foto Evaluasi"
                        class="rounded shadow w-full h-auto object-cover">
                    <p class="text-sm mt-2 text-gray-500">Ganti jika ingin ubah foto.</p>
                @else
                    <p class="text-gray-500 italic">Belum ada foto.</p>
                @endif

                <input type="file" name="foto" class="mt-3 w-full border px-3 py-2 rounded">
            </div>

            <!-- FORM DI SEBELAH KANAN -->
            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="id_evaluasi" class="block font-semibold">ID Evaluasi</label>
                    <input type="text" name="id_evaluasi" id="id_evaluasi"
                        value="{{ $evaluasi->id_evaluasi }}" class="w-full border px-3 py-2 rounded bg-gray-100" readonly>
                </div>

                <div>
                <label class="text-sm font-medium text-gray-500 dark:text-gray-400">ID Progress</label>
                <input type="text" name="id_progres" value="{{ $evaluasi->id_progres }}"
                    class="w-full mt-1 px-3 py-2 border rounded bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white"
                    readonly>
            </div>

                <div>
                    <label for="status" class="block font-semibold">Status</label>
                    <select name="status" id="status" class="w-full border px-3 py-2 rounded" required>
                        <option value="sesuai" {{ $evaluasi->status == 'sesuai' ? 'selected' : '' }}>Sesuai</option>
                        <option value="perlu revisi" {{ $evaluasi->status == 'perlu revisi' ? 'selected' : '' }}>Perlu Revisi</option>
                        <option value="belum diperiksa" {{ $evaluasi->status == 'belum diperiksa' ? 'selected' : '' }}>Belum Diperiksa</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label for="catatan" class="block font-semibold">Catatan</label>
                    <textarea name="catatan" id="catatan" rows="4"
                        class="w-full border px-3 py-2 rounded">{{ $evaluasi->catatan }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                        Perbarui
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

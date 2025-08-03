@extends('layouts.admin')

@section('title', 'Tambah Evaluasi')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Tambah Evaluasi</h1>

    <form action="{{ route('admin.evaluasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
            <!-- FOTO -->
            <div class="md:col-span-1">
                <p class="font-semibold mb-2">Foto Evaluasi</p>
                <img id="preview" src="https://via.placeholder.com/300x200?text=Preview" class="w-full rounded shadow">
                <input type="file" name="foto" onchange="previewImage(event)"
                    class="mt-3 w-full border px-3 py-2 rounded">
            </div>

            <!-- FORM -->
            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="id_evaluasi" class="block font-semibold">ID Evaluasi</label>
                    <input type="text" name="id_evaluasi" id="id_evaluasi" value="{{ $newId }}"
                        class="w-full border px-3 py-2 rounded bg-gray-100" readonly>
                </div>

                <div>
                    <label for="id_progres" class="block font-semibold">Progress</label>
                    <select name="id_progres" id="id_progres" class="w-full border px-3 py-2 rounded" required>
                        <option value="" disabled selected>Pilih Progress</option>
                        @foreach ($progress as $p)
                            <option value="{{ $p->id_progres }}"
                                {{ old('id_progres') == $p->id_progres ? 'selected' : '' }}>
                                {{ $p->id_progres }} - {{ $p->unit->alamat ?? '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="status" class="block font-semibold">Status</label>
                    <select name="status" id="status" class="w-full border px-3 py-2 rounded" required>
                        <option value="sesuai" {{ old('status') == 'sesuai' ? 'selected' : '' }}>Sesuai</option>
                        <option value="perlu revisi" {{ old('status') == 'perlu revisi' ? 'selected' : '' }}>Perlu Revisi
                        </option>
                        <option value="belum diperiksa" {{ old('status') == 'belum diperiksa' ? 'selected' : '' }}>Belum
                            Diperiksa</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label for="catatan" class="block font-semibold">Catatan</label>
                    <textarea name="catatan" id="catatan" rows="4" class="w-full border px-3 py-2 rounded">{{ old('catatan') }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </form>

    <script>
        function previewImage(event) {
            const [file] = event.target.files;
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    document.getElementById('preview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection

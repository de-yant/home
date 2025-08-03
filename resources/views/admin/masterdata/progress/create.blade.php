@extends('layouts.admin')

@section('title', 'Tambah Progress')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Tambah Progress Pembangunan</h1>

    <form action="{{ route('admin.masterdata.progress.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Foto (Kiri) -->
            <div>
                <label for="foto" class="block font-semibold mb-1">Upload Foto (Opsional)</label>
                <input type="file" name="foto" class="w-full border px-3 py-2 rounded">
            </div>

            <!-- Form 1 -->
            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- id progres autogenerate dari controller --}}
                <div>
                    <label for="id_progres" class="block font-semibold">ID Progres</label>
                    <input type="text" name="id_progres" value="{{ $id_progres }}" class="w-full border px-3 py-2 rounded" readonly>
                </div>

                <div>
                    <label for="id_unit" class="block font-semibold">Unit Rumah</label>
                    <select name="id_unit" id="id_unit" class="select2 w-full" required>
                        <option value="" disabled selected>Pilih Unit Rumah</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id_unit }}">{{ $unit->id_unit }} - {{ $unit->alamat }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="id_pengawas" class="block font-semibold">Pengawas</label>
                    <select name="id_pengawas" class="w-full border px-3 py-2 rounded" required>
                        @foreach ($pengawas as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="tanggal" class="block font-semibold">Tanggal</label>
                    <input type="date" name="tanggal" class="w-full border px-3 py-2 rounded" required>
                </div>

                <div>
                    <label for="status" class="block font-semibold">Status</label>
                    <select name="status" class="w-full border px-3 py-2 rounded" required>
                        <option value="mulai">Mulai</option>
                        <option value="proses">Proses</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>

                <div>
                    <label for="jenis" class="block font-semibold">Jenis</label>
                    <select name="jenis" class="w-full border px-3 py-2 rounded" required>
                        <option value="pembangunan">Pembangunan</option>
                        <option value="perbaikan">Perbaikan</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label for="deskripsi" class="block font-semibold">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="w-full border px-3 py-2 rounded" placeholder="Masukkan deskripsi progress..."></textarea>
                </div>
            </div>
        </div>

        <div>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                Simpan Progress
            </button>
        </div>
    </form>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <script>
            $(document).ready(function () {
                $('.select2').select2({
                    placeholder: 'Pilih atau cari unit rumah...',
                    allowClear: true
                });
            });
        </script>

        <style>
            .select2-container {
                width: 100% !important;
            }
        </style>
    @endpush
@endsection

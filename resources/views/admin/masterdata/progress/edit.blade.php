@extends('layouts.admin')

@section('title', 'Edit Progress')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Progress Pembangunan</h1>

    <form action="{{ route('admin.masterdata.progress.update', $progress->id_progres) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Kolom 1: Foto --}}
            <div class="col-span-1">
                <label class="block font-semibold mb-2">Foto Saat Ini</label>
                @if ($progress->foto)
                    <img src="{{ asset('storage/' . $progress->foto) }}" alt="Foto Progres" class="rounded-lg shadow-md w-full object-cover">
                    <p class="text-sm mt-2 text-gray-500">Klik untuk melihat <a href="{{ asset('storage/' . $progress->foto) }}" target="_blank" class="text-blue-500 underline">lebih besar</a></p>
                @else
                    <p class="text-sm text-gray-500">Belum ada foto</p>
                @endif

                <div class="mt-4">
                    <label for="foto" class="block font-semibold">Ubah Foto</label>
                    <input type="file" name="foto" class="w-full border px-3 py-2 rounded">
                </div>
            </div>

            {{-- Kolom 2 & 3: Form --}}
            <div class="col-span-2 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="id_progres" class="block font-semibold">ID Progress</label>
                        <input type="text" name="id_progres" id="id_progres" value="{{ $progress->id_progres }}" readonly
                            class="w-full border px-3 py-2 rounded bg-gray-100">
                    </div>

                    <div>
                        <label for="id_unit" class="block font-semibold">Unit Rumah</label>
                        <select name="id_unit" id="id_unit" class="select2 w-full">
                            <option value="" disabled>Pilih Unit Rumah</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id_unit }}" {{ $unit->id_unit == $progress->id_unit ? 'selected' : '' }}>
                                    {{ $unit->id_unit }} - {{ $unit->alamat }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="id_pengawas" class="block font-semibold">Pengawas</label>
                        <select name="id_pengawas" class="w-full border px-3 py-2 rounded">
                            @foreach ($pengawas as $p)
                                <option value="{{ $p->id }}" {{ $p->id == $progress->id_pengawas ? 'selected' : '' }}>
                                    {{ $p->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="tanggal" class="block font-semibold">Tanggal</label>
                        <input type="date" name="tanggal" class="w-full border px-3 py-2 rounded" value="{{ $progress->tanggal }}">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="status" class="block font-semibold">Status</label>
                        <select name="status" class="w-full border px-3 py-2 rounded">
                            <option value="mulai" {{ $progress->status == 'mulai' ? 'selected' : '' }}>Mulai</option>
                            <option value="proses" {{ $progress->status == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="selesai" {{ $progress->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div>
                        <label for="jenis" class="block font-semibold">Jenis</label>
                        <select name="jenis" class="w-full border px-3 py-2 rounded">
                            <option value="pembangunan" {{ $progress->jenis == 'pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                            <option value="perbaikan" {{ $progress->jenis == 'perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="deskripsi" class="block font-semibold">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="w-full border px-3 py-2 rounded">{{ $progress->deskripsi }}</textarea>
                </div>

                <div>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                        Update
                    </button>
                </div>
            </div>
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

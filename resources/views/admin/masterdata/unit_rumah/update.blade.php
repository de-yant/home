@extends('layouts.admin')

@section('title', 'Edit Unit Rumah')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Unit Rumah</h1>

    <form action="{{ route('admin.masterdata.unit-rumah.update', $unitRumah->id_unit) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="id_unit" class="block font-semibold">ID Unit</label>
                <input type="text" name="id_unit" id="id_unit" value="{{ $unitRumah->id_unit }}" readonly
                    class="w-full border border-gray-300 px-3 py-2 rounded bg-gray-100">
            </div>

            <div>
                <label for="no_rumah" class="block font-semibold">No Rumah</label>
                <input type="text" name="no_rumah" id="no_rumah" value="{{ old('no_rumah', $unitRumah->no_rumah) }}"
                    required class="w-full border border-gray-300 px-3 py-2 rounded">
            </div>

            <div>
                <label for="type" class="block font-semibold">Tipe</label>
                <input type="text" name="type" id="type" value="{{ old('type', $unitRumah->type) }}"
                    class="w-full border border-gray-300 px-3 py-2 rounded">
            </div>

            <div>
                <label for="alamat" class="block font-semibold">Alamat</label>
                <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $unitRumah->alamat) }}" required
                    class="w-full border border-gray-300 px-3 py-2 rounded">
            </div>

            <div>
                <label for="id_penghuni" class="block font-semibold">ID Penghuni</label>
                <input type="text" name="id_penghuni" id="id_penghuni"
                    value="{{ old('id_penghuni', $unitRumah->id_penghuni) }}"
                    class="w-full border border-gray-300 px-3 py-2 rounded">
            </div>

            <div>
                <label for="status" class="block font-semibold">Status</label>
                <select name="status" id="status"
                    class="w-full border border-gray-300 px-3 py-2 rounded">
                    <option value="Selesai Pembangunan" {{ $unitRumah->status == 'Selesai Pembangunan' ? 'selected' : '' }}>
                        Selesai Pembangunan</option>
                    <option value="Dalam Proses" {{ $unitRumah->status == 'Dalam Proses' ? 'selected' : '' }}>
                        Dalam Proses</option>
                    <option value="Belum Dibangun" {{ $unitRumah->status == 'Belum Dibangun' ? 'selected' : '' }}>
                        Belum Dibangun</option>
                </select>
            </div>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update
            </button>
        </div>
    </form>
@endsection

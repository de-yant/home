@extends('layouts.admin')

@section('title', 'Master Data')

@section('content')
    <!-- Header -->
    @if (session('success') || session('error'))
        <div id="alert"
            class="mb-4 px-4 py-2 rounded border transition-opacity duration-500
            {{ session('success') ? 'bg-green-100 text-green-800 border-green-200' : 'bg-red-100 text-red-800 border-red-200' }}">
            {{ session('success') ?? session('error') }}
        </div>

        <script>
            // Hilangkan setelah 3 detik (3000 ms)
            setTimeout(() => {
                const alert = document.getElementById('alert');
                if (alert) {
                    alert.classList.add('opacity-0');
                    setTimeout(() => alert.remove(), 500); // hapus dari DOM setelah fade out
                }
            }, 3000);
        </script>
    @endif


    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Unit Rumah</h2>
        <a href="{{ route('admin.masterdata.unit-rumah.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow">
            + Tambah Data
        </a>
    </div>

    <!-- Search Form -->
    <form method="GET" action="{{ route('admin.masterdata.unit-rumah.index') }}" class="mb-4">
        <input type="text" name="search" value="{{ request('search') }}"
            class="w-full md:w-1/3 px-4 py-2 border rounded-md" placeholder="Cari berdasarkan no rumah atau alamat...">
    </form>

    <!-- Table -->
    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-md">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-white text-sm">
                <tr>
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">ID Unit</th>
                    <th class="px-4 py-2 text-left">Nomor Rumah</th>
                    <th class="px-4 py-2 text-left">Tipe</th>
                    <th class="px-4 py-2 text-left">Alamat</th>
                    <th class="px-4 py-2 text-left">ID Penghuni</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 dark:text-gray-300">
                @foreach ($units as $unit)
                    <tr>
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $unit->id_unit }}</td>
                        <td class="px-4 py-2">{{ $unit->no_rumah }}</td>
                        <td class="px-4 py-2">{{ $unit->type }}</td>
                        <td class="px-4 py-2">{{ $unit->alamat }}</td>
                        <td class="px-4 py-2">{{ $unit->id_penghuni }}</td>
                        <td class="px-4 py-2">{{ $unit->status }}</td>
                        <td class="px-4 py-2">
                            <div class="flex items-center space-x-2">
                                <!-- Tombol Edit -->
                                <a href="{{ route('admin.masterdata.unit-rumah.edit', $unit->id_unit) }}"
                                    class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700 transition duration-200">
                                    <i class='bx bx-edit-alt mr-1 text-base'></i> Edit
                                </a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('admin.masterdata.unit-rumah.destroy', $unit->id_unit) }}"
                                    method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete(this)" data-id="{{ $unit->id_unit }}"
                                        class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700 transition duration-200">
                                        <i class='bx bx-trash mr-1 text-base'></i> Hapus
                                    </button>

                                </form>
                            </div>

                        </td>
                    </tr>
                @endforeach

        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{-- {{ $units->links() }} --}}
        {{ $units->appends(request()->query())->links() }}
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi Hapus</h2>
            <p class="text-sm text-gray-600 mb-6">Apakah Anda yakin ingin menghapus data ini?</p>
            <div class="flex justify-end space-x-2">
                <button onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(button) {
            const id = button.getAttribute('data-id');
            const form = document.getElementById('deleteForm');
            form.action = `/admin/masterdata/unit-rumah/${id}`;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>


@endsection

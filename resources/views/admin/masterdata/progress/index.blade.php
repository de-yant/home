@extends('layouts.admin')

@section('title', 'Data Progress')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Daftar Progress Pembangunan</h1>
        <a href="{{ route('admin.masterdata.progress.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+
            Tambah Progress</a>
    </div>

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


    <div class="overflow-x-auto bg-white shadow rounded-md">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">ID Progress</th>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Foto</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($progressList as $index => $progress)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $progressList->firstItem() + $index }}</td>
                        <td class="px-4 py-2">{{ $progress->id_progres }}</td>
                         <td class="px-4 py-2">{{ $progress->tanggal }}</td>
                        <td class="px-4 py-2">
                            @if ($progress->foto)
                                <img src="{{ asset('storage/' . $progress->foto) }}" alt="Foto"
                                    class="w-16 h-16 object-cover rounded">
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            {{-- Edit Progress --}}
                            <a href="{{ route('admin.masterdata.progress.edit', $progress->id_progres) }}"
                                class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700 transition duration-200">
                                <i class='bx bx-edit-alt mr-1 text-base'></i> Edit
                            </a>

                            <form
                                action="{{ route('admin.masterdata.progress.destroy', ['progress' => $progress->id_progres]) }}"
                                method="POST" class="inline-block"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus progress ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete(this)" data-id="{{ $progress->id_progres }}"
                                    class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700 transition duration-200">
                                    <i class='bx bx-trash mr-1 text-base'></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-gray-500">Belum ada data progress.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $progressList->links() }}
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
            form.action = `/admin/masterdata/progress/${id}`; // Ubah sesuai route jika berbeda
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>

@endsection

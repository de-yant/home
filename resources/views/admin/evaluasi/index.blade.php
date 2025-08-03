@extends('layouts.admin')

@section('content')
    <h1 class="text-xl font-bold mb-4">Daftar Evaluasi</h1>

    <a href="{{ route('admin.evaluasi.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Evaluasi</a>

    <table class="w-full mt-4 border">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Progress</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Catatan</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($evaluasis as $eval)
                <tr>
                    <td class="px-4 py-2">{{ $eval->id_evaluasi }}</td>
                    <td class="px-4 py-2">{{ $eval->progres->id_progres }}</td>
                    <td class="px-4 py-2">{{ ucfirst($eval->status) }}</td>
                    <td class="px-4 py-2">{{ $eval->catatan }}</td>
                    <td class="px-4 py-2">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.evaluasi.edit', $eval->id_evaluasi) }}"
                                class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700 transition duration-200">
                                <i class='bx bx-edit-alt mr-1 text-base'></i> Edit
                            </a>

                            <form action="{{ route('admin.evaluasi.destroy', $eval->id_evaluasi) }}" method="POST"
                                class="inline-block"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus evaluasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700 transition duration-200">
                                    <i class='bx bx-trash mr-1 text-base'></i> Hapus
                                </button>
                            </form>
                        </div>

                    </td>
                </tr>
            @endforeach

            <!-- Modal Konfirmasi Hapus -->
<div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-sm">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi Hapus</h2>
        <p class="text-sm text-gray-600 mb-6">Apakah Anda yakin ingin menghapus evaluasi ini?</p>
        <div class="flex justify-end space-x-2">
            <button onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script>
    function confirmDelete(actionUrl) {
        const form = document.getElementById('deleteForm');
        form.action = actionUrl;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
@endpush

        </tbody>
    </table>
@endsection

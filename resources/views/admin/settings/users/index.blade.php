@extends('layouts.admin')

@section('title', 'Pengaturan Pengguna')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Pengaturan Pengguna</h1>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="py-3 px-4">Nama</th>
                    <th class="py-3 px-4">Email</th>
                    <th class="py-3 px-4">Role</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-t">
                        <td class="py-2 px-4">{{ $user->name }}</td>
                        <td class="py-2 px-4">{{ $user->email }}</td>
                        <td class="py-2 px-4">
                            <form action="{{ route('admin.settings.users.role', $user->id) }}" method="POST" class="inline-flex items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <select name="role" onchange="this.form.submit()" class="border rounded px-2 py-1 text-sm">
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="pengawas" {{ $user->role == 'pengawas' ? 'selected' : '' }}>Pengawas</option>
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </form>
                        </td>
                        <td class="py-2 px-4">
                            <form action="{{ route('admin.settings.users.toggle', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="px-3 py-1 text-xs rounded
                                        {{ $user->is_active ? 'bg-green-500 text-white hover:bg-green-600' : 'bg-red-500 text-white hover:bg-red-600' }}">
                                    {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </form>
                        </td>
                        <td class="py-2 px-4 text-center space-x-2">
                            <!-- Tombol Edit -->
                            <a href="{{ route('admin.settings.users.edit', $user->id) }}"
                                class="inline-block bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-xs">Edit</a>

                            <!-- Tombol Hapus (pakai modal) -->
                            <button onclick="showDeleteModal('{{ route('admin.settings.users.destroy', $user->id) }}')"
                                class="inline-block bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-xs">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Hapus -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 items-center justify-center">
    <div class="bg-white rounded shadow-lg w-full max-w-md p-6">
        <h2 class="text-lg font-semibold mb-4">Konfirmasi Hapus</h2>
        <p class="text-gray-700 mb-6">Apakah Anda yakin ingin menghapus user ini?</p>
        <div class="flex justify-end space-x-3">
            <button onclick="hideDeleteModal()" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">Batal</button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Hapus</button>
            </form>
        </div>
    </div>
</div>

<script>
    function showDeleteModal(action) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        form.action = action;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function hideDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection

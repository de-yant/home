@extends('layouts.admin')

@section('title', 'Edit Pengguna')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Edit Pengguna</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.settings.users.update', $user->id) }}" method="POST" class="bg-white shadow rounded p-6 max-w-3xl">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium mb-1">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Role</label>
                <select name="role"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="pengawas" {{ $user->role == 'pengawas' ? 'selected' : '' }}>Pengawas</option>
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Status</label>
                <select name="is_active"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                    <option value="1" {{ $user->is_active ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ !$user->is_active ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('admin.settings.users.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                Batal
            </a>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

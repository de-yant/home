@extends('layouts.pengawas')

@section('title', 'Evaluasi Pengawas')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Evaluasi Pengawas</h1>
        <p class="text-gray-600 dark:text-gray-300 mt-1">Berikut adalah daftar evaluasi yang dapat Anda pantau.</p>
    </div>

    {{-- Kolom Pencarian --}}
    <form method="GET" action="{{ route('pengawas.evaluasi.index') }}" class="mb-4">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Cari berdasarkan ID Evaluasi atau Status"
            class="w-full md:w-1/3 border px-4 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
    </form>

    {{-- Tabel Evaluasi --}}
    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded shadow">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-2 text-left">ID Evaluasi</th>
                    <th class="px-4 py-2 text-left">ID Progres</th>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 dark:text-gray-200">
                @forelse ($evaluasiList as $evaluasi)
                    <tr class="border-t border-gray-200 dark:border-gray-700">
                        <td class="px-4 py-2">{{ $evaluasi->id_evaluasi }}</td>
                        <td class="px-4 py-2">{{ $evaluasi->id_progres }}</td>
                        <td class="px-4 py-2">{{ $evaluasi->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-2">
                            <div class="flex space-x-2">
                                <a href="{{ route('pengawas.evaluasi.show', $evaluasi->id_evaluasi) }}"
                                    class="inline-block px-3 py-1 text-sm bg-blue-100 text-blue-700 rounded hover:bg-blue-200 dark:bg-blue-900 dark:text-blue-300 dark:hover:bg-blue-800 transition">
                                    Lihat
                                </a>
                                <a href="{{ route('pengawas.evaluasi.edit', $evaluasi->id_evaluasi) }}"
                                    class="inline-block px-3 py-1 text-sm bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200 dark:bg-yellow-900 dark:text-yellow-300 dark:hover:bg-yellow-800 transition">
                                    Edit
                                </a>
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">Data tidak
                            ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

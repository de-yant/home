@extends('layouts.pengawas')

@section('title', 'Progress Pengawas')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Progress Pembangunan</h1>
        <p class="text-sm text-gray-600 dark:text-gray-300">Daftar progress proyek yang sedang diawasi.</p>
    </div>

    {{-- Form Pencarian --}}
    <form method="GET" action="{{ route('pengawas.progress.index') }}" class="mb-4">
        <div class="flex items-center space-x-2">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari berdasarkan unit atau deskripsi..."
                class="w-full md:w-1/3 px-4 py-2 border rounded shadow-sm dark:bg-gray-700 dark:text-white">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Cari</button>
        </div>
    </form>

    {{-- Tabel --}}
    <div class="bg-white dark:bg-gray-800 rounded shadow overflow-x-auto">
        <table class="min-w-full text-sm border-collapse">
            <thead class="bg-gray-100 dark:bg-gray-700 text-left">
                <tr>
                    <th class="px-4 py-3 border-b">ID</th>
                    <th class="px-4 py-3 border-b">Unit Rumah</th>
                    <th class="px-4 py-3 border-b">Tanggal</th>
                    <th class="px-4 py-3 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($progress as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-4 py-2 border-b">{{ $item->id_progres }}</td>
                        <td class="px-4 py-2 border-b">{{ $item->unit->no_rumah ?? '-' }}</td>
                        <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                        <td class="px-4 py-2 border-b space-x-2">
                            {{-- Show Button --}}
                            <a href="{{ route('pengawas.progress.show', $item->id_progres) }}"
                                class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-blue-500 hover:bg-blue-600 rounded">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
                                </svg>
                                Lihat
                            </a>

                            {{-- Edit Button --}}
                            <a href="{{ route('pengawas.progress.edit', $item->id_progres) }}"
                                class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-yellow-500 hover:bg-yellow-600 rounded">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M15.232 5.232l3.536 3.536M9 11l6-6 3.536 3.536-6 6H9v-3.536z" />
                                    <path d="M13 17h7" />
                                </svg>
                                Edit
                            </a>

                            {{-- Delete Button --}}
                            <form action="{{ route('pengawas.progress.destroy', $item->id_progres) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus progress ini?')"
                                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-red-600 hover:bg-red-700 rounded">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                            Tidak ada data progress ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $progress->appends(request()->query())->links() }}
    </div>
@endsection

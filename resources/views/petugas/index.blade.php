@extends('layouts.app')

@section('title', 'Manajemen Petugas')

@section('content')
    <div class="max-w-5xl mx-auto">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-semibold">Manajemen Petugas</h2>
            <a href="{{ route('petugas.create') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Tambah Petugas</a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <div class="bg-white shadow rounded overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left">#</th>
                        <th class="px-4 py-2 text-left">Nama</th>
                        <th class="px-4 py-2 text-left">Username</th>
                        <th class="px-4 py-2 text-left">Dibuat</th>
                        <th class="px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($petugas as $p)
                        <tr>
                            <td class="px-4 py-3">{{ $loop->iteration + ($petugas->currentPage() - 1) * $petugas->perPage() }}
                            </td>
                            <td class="px-4 py-3">{{ $p->nama_lengkap }}</td>
                            <td class="px-4 py-3">{{ $p->username }}</td>
                            <td class="px-4 py-3 text-sm text-gray-500">{{ $p->created_at->format('Y-m-d H:i') }}</td>
                            <td class="px-4 py-3">
                                <a href="{{ route('petugas.edit', $p) }}" class="text-indigo-600 mr-3">Edit</a>
                                <form action="{{ route('petugas.destroy', $p) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Hapus petugas ini?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-600">Belum ada data petugas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $petugas->links() }}
        </div>
    </div>
@endsection

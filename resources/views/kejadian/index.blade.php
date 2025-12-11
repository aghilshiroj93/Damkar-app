{{-- resources/views/kejadian/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar Kejadian')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-semibold">Daftar Kejadian</h1>
            <a href="{{ route('kejadian.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Buat Kejadian</a>
        </div>

        <form method="GET" class="mb-4">
            <div class="flex gap-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari jenis, lokasi, atau objek"
                    class="border rounded px-3 py-2 w-full" />
                <button class="px-4 py-2 bg-gray-700 text-white rounded">Cari</button>
            </div>
        </form>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full divide-y">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left">#</th>
                        <th class="px-4 py-2 text-left">Jenis</th>
                        <th class="px-4 py-2 text-left">Lokasi</th>
                        <th class="px-4 py-2 text-left">Waktu Kejadian</th>
                        <th class="px-4 py-2 text-left">Berangkat</th>
                        <th class="px-4 py-2 text-left">Tiba</th>
                        <th class="px-4 py-2 text-left">Respon (menit)</th>
                        <th class="px-4 py-2 text-left">Foto</th>
                        <th class="px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($kejadian as $item)
                        <tr>
                            <td class="px-4 py-2">
                                {{ $loop->iteration + ($kejadian->currentPage() - 1) * $kejadian->perPage() }}</td>
                            <td class="px-4 py-2">{{ $item->jenis_kejadian }}</td>
                            <td class="px-4 py-2">{{ Str::limit($item->lokasi, 50) }}</td>
                            <td class="px-4 py-2">
                                {{ $item->waktu_kejadian ? $item->waktu_kejadian->format('Y-m-d H:i') : '-' }}</td>
                            <td class="px-4 py-2">{{ $item->berangkat ? $item->berangkat->format('Y-m-d H:i') : '-' }}</td>
                            <td class="px-4 py-2">
                                {{ $item->tiba_di_lokasi ? $item->tiba_di_lokasi->format('Y-m-d H:i') : '-' }}</td>
                            <td class="px-4 py-2">{{ $item->respon_time !== null ? $item->respon_time . ' menit' : '-' }}
                            </td>
                            <td class="px-4 py-2">
                                @if ($item->foto)
                                    <img src="{{ asset('storage/kejadian/' . $item->foto) }}" class="h-14 rounded"
                                        alt="foto">
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('kejadian.edit', $item) }}" class="text-indigo-600 mr-2">Edit</a>
                                <form action="{{ route('kejadian.destroy', $item) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-6 text-center text-gray-600">Belum ada data kejadian.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $kejadian->links() }}
        </div>
    </div>
@endsection

<form method="POST" action="{{ $action }}">
    @csrf
    @if (isset($method) && strtoupper($method) === 'PUT')
        @method('PUT')
    @endif

    <div class="mb-4">
        <label class="block mb-1 font-medium">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" required value="{{ old('nama_lengkap', $petugas->nama_lengkap ?? '') }}"
            class="w-full border rounded px-3 py-2" />
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-medium">Username</label>
        <input type="text" name="username" required value="{{ old('username', $petugas->username ?? '') }}"
            class="w-full border rounded px-3 py-2" />
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-medium">Password
            @if (isset($petugas))
                <span class="text-sm text-gray-500">(kosongkan jika tidak ingin mengganti)</span>
            @endif
        </label>
        <input type="password" name="password" @if (!isset($petugas)) required @endif
            class="w-full border rounded px-3 py-2" />
    </div>

    <div class="mb-6">
        <label class="block mb-1 font-medium">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" @if (!isset($petugas)) required @endif
            class="w-full border rounded px-3 py-2" />
    </div>

    <div class="flex gap-2">
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Simpan</button>
        <a href="{{ route('petugas.index') }}" class="px-4 py-2 bg-gray-200 rounded">Batal</a>
    </div>
</form>

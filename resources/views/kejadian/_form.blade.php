{{-- resources/views/kejadian/_form.blade.php --}}
<form method="POST" action="{{ $action }}" enctype="multipart/form-data" id="kejadian-form">
    @csrf
    @if (isset($method) && strtoupper($method) === 'PUT')
        @method('PUT')
    @endif

    <div class="mb-4">
        <label class="block mb-1 font-medium">Jenis Kejadian <span class="text-red-500">*</span></label>
        <input type="text" name="jenis_kejadian" required
            value="{{ old('jenis_kejadian', $kejadian->jenis_kejadian ?? '') }}"
            class="w-full border rounded px-3 py-2" />
    </div>

    <div class="mb-4 grid grid-cols-2 gap-4">
        <div>
            <label class="block mb-1 font-medium">Objek</label>
            <input type="text" name="objek" value="{{ old('objek', $kejadian->objek ?? '') }}"
                class="w-full border rounded px-3 py-2" />
        </div>
        <div>
            <label class="block mb-1 font-medium">Lokasi</label>
            <input type="text" name="lokasi" value="{{ old('lokasi', $kejadian->lokasi ?? '') }}"
                class="w-full border rounded px-3 py-2" />
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block mb-1 font-medium">Waktu Kejadian</label>
            <input type="datetime-local" name="waktu_kejadian"
                value="{{ old('waktu_kejadian', isset($kejadian) && $kejadian->waktu_kejadian ? $kejadian->waktu_kejadian->format('Y-m-d\TH:i') : '') }}"
                class="w-full border rounded px-3 py-2" />
        </div>
        <div>
            <label class="block mb-1 font-medium">Terima Berita</label>
            <input type="datetime-local" name="terima_berita"
                value="{{ old('terima_berita', isset($kejadian) && $kejadian->terima_berita ? $kejadian->terima_berita->format('Y-m-d\TH:i') : '') }}"
                class="w-full border rounded px-3 py-2" />
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 mt-4">
        <div>
            <label class="block mb-1 font-medium">Berangkat</label>
            <input type="datetime-local" id="berangkat" name="berangkat"
                value="{{ old('berangkat', isset($kejadian) && $kejadian->berangkat ? $kejadian->berangkat->format('Y-m-d\TH:i') : '') }}"
                class="w-full border rounded px-3 py-2" />
        </div>
        <div>
            <label class="block mb-1 font-medium">Tiba di Lokasi</label>
            <input type="datetime-local" id="tiba_di_lokasi" name="tiba_di_lokasi"
                value="{{ old('tiba_di_lokasi', isset($kejadian) && $kejadian->tiba_di_lokasi ? $kejadian->tiba_di_lokasi->format('Y-m-d\TH:i') : '') }}"
                class="w-full border rounded px-3 py-2" />
        </div>
    </div>

    <div class="mt-4">
        <label class="block mb-1 font-medium">Kembali ke Pos</label>
        <input type="datetime-local" name="kembali_ke_pos"
            value="{{ old('kembali_ke_pos', isset($kejadian) && $kejadian->kembali_ke_pos ? $kejadian->kembali_ke_pos->format('Y-m-d\TH:i') : '') }}"
            class="w-full border rounded px-3 py-2" />
    </div>

    <div class="mt-4">
        <label class="block mb-1 font-medium">Foto (opsional)</label>
        <input type="file" name="foto" accept="image/*" class="block" />
        @if (isset($kejadian) && $kejadian->foto)
            <div class="mt-2">
                <span class="text-sm text-gray-600">Foto saat ini:</span>
                <div class="mt-1">
                    <img src="{{ asset('storage/kejadian/' . $kejadian->foto) }}" alt="foto" class="h-28 rounded">
                </div>
            </div>
        @endif
    </div>

    {{-- Respon time (otomatis tampil di form via JS, server tetap menghitung ulang) --}}
    <div class="mt-4">
        <label class="block mb-1 font-medium">Respon Time (menit)</label>
        <input type="text" id="respon_time_display" readonly
            value="{{ old('respon_time', isset($kejadian) && $kejadian->respon_time !== null ? $kejadian->respon_time . ' menit' : '') }}"
            class="w-full border rounded px-3 py-2 bg-gray-100" />
        {{-- hidden input agar nilai terkirim (server akan menghitung ulang juga) --}}
        <input type="hidden" name="respon_time" id="respon_time"
            value="{{ old('respon_time', $kejadian->respon_time ?? '') }}">
    </div>

    <div class="mt-6 flex gap-2">
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
        <a href="{{ route('kejadian.index') }}" class="px-4 py-2 bg-gray-300 rounded">Batal</a>
    </div>
</form>

{{-- JS kecil untuk hitung otomatis respon_time di client --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const berangkat = document.getElementById('berangkat');
        const tiba = document.getElementById('tiba_di_lokasi');
        const display = document.getElementById('respon_time_display');
        const hidden = document.getElementById('respon_time');

        function hitungRespon() {
            display.value = '';
            hidden.value = '';
            if (!berangkat.value || !tiba.value) return;

            // parse as local Date
            const b = new Date(berangkat.value);
            const t = new Date(tiba.value);
            if (isNaN(b.getTime()) || isNaN(t.getTime())) return;

            const diffMs = t - b;
            const diffMin = Math.round(diffMs / 60000);

            if (diffMin >= 0) {
                display.value = diffMin + ' menit';
                hidden.value = diffMin;
            } else {
                display.value = 'Waktu tiba sebelum berangkat!';
                hidden.value = '';
            }
        }

        berangkat?.addEventListener('change', hitungRespon);
        tiba?.addEventListener('change', hitungRespon);

        // hitung sekali saat load
        hitungRespon();
    });
</script>

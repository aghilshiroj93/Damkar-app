{{-- resources/views/kejadian/_form.blade.php --}}
<form method="POST" action="{{ $action }}" enctype="multipart/form-data" id="kejadian-form" class="space-y-6">
    @csrf
    @if (isset($method) && strtoupper($method) === 'PUT')
        @method('PUT')
    @endif

    {{-- Header --}}
    <div class="border-b pb-4">
        <h3 class="text-lg font-semibold text-gray-800">
            {{ isset($kejadian) ? 'Edit Data Kejadian' : 'Tambah Kejadian Baru' }}
        </h3>
        <p class="text-sm text-gray-600 mt-1">Isi data kejadian dengan lengkap dan akurat</p>
    </div>

    {{-- Jenis Kejadian --}}
    <div class="space-y-2">
        <label class="block text-sm font-medium text-gray-700">
            Jenis Kejadian <span class="text-red-500">*</span>
        </label>
        <input type="text" name="jenis_kejadian" required
            value="{{ old('jenis_kejadian', $kejadian->jenis_kejadian ?? '') }}"
            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
            placeholder="Contoh: Kebakaran Rumah, Kebocoran Gas, dll" />
    </div>

    {{-- Objek & Lokasi --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Objek</label>
            <input type="text" name="objek" value="{{ old('objek', $kejadian->objek ?? '') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                placeholder="Contoh: Rumah Tinggal, Gedung Perkantoran" />
        </div>
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Lokasi</label>
            <input type="text" name="lokasi" value="{{ old('lokasi', $kejadian->lokasi ?? '') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                placeholder="Contoh: Jl. Merdeka No. 123" />
        </div>
    </div>

    {{-- Waktu Kejadian & Terima Berita --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Waktu Kejadian</label>
            <div class="relative">
                <input type="datetime-local" name="waktu_kejadian"
                    value="{{ old('waktu_kejadian', isset($kejadian) && $kejadian->waktu_kejadian ? $kejadian->waktu_kejadian->format('Y-m-d\TH:i') : '') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" />
                <div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Terima Berita</label>
            <div class="relative">
                <input type="datetime-local" name="terima_berita"
                    value="{{ old('terima_berita', isset($kejadian) && $kejadian->terima_berita ? $kejadian->terima_berita->format('Y-m-d\TH:i') : '') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" />
                <div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Berangkat & Tiba di Lokasi --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Berangkat</label>
            <div class="relative">
                <input type="datetime-local" id="berangkat" name="berangkat"
                    value="{{ old('berangkat', isset($kejadian) && $kejadian->berangkat ? $kejadian->berangkat->format('Y-m-d\TH:i') : '') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" />
                <div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Tiba di Lokasi</label>
            <div class="relative">
                <input type="datetime-local" id="tiba_di_lokasi" name="tiba_di_lokasi"
                    value="{{ old('tiba_di_lokasi', isset($kejadian) && $kejadian->tiba_di_lokasi ? $kejadian->tiba_di_lokasi->format('Y-m-d\TH:i') : '') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" />
                <div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Kembali ke Pos --}}
    <div class="space-y-2">
        <label class="block text-sm font-medium text-gray-700">Kembali ke Pos</label>
        <div class="relative">
            <input type="datetime-local" name="kembali_ke_pos"
                value="{{ old('kembali_ke_pos', isset($kejadian) && $kejadian->kembali_ke_pos ? $kejadian->kembali_ke_pos->format('Y-m-d\TH:i') : '') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" />
            <div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
                </svg>
            </div>
        </div>
    </div>

    {{-- Upload Foto dengan Preview --}}
    <div class="space-y-2">
        <label class="block text-sm font-medium text-gray-700">Foto Kejadian (opsional)</label>

        {{-- Input File --}}
        <div class="flex items-center justify-center w-full">
            <label for="foto"
                class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    <p class="mb-2 text-sm text-gray-500">
                        <span class="font-semibold">Klik untuk upload</span> atau drag & drop
                    </p>
                    <p class="text-xs text-gray-500">PNG, JPG, JPEG (Max. 5MB)</p>
                </div>
                <input id="foto" name="foto" type="file" accept="image/*" class="hidden" />
            </label>
        </div>

        {{-- Preview Container --}}
        <div id="preview-container" class="hidden mt-4">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-700">Preview Foto</span>
                <button type="button" id="remove-preview" class="text-sm text-red-600 hover:text-red-800">
                    Hapus
                </button>
            </div>
            <div class="relative">
                <img id="preview-image" class="w-full h-64 object-cover rounded-lg border" />
                <div id="preview-info" class="mt-2 text-xs text-gray-500"></div>
            </div>
        </div>

        {{-- Current Foto --}}
        @if (isset($kejadian) && $kejadian->foto)
            <div class="mt-4 border-t pt-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Saat Ini</label>
                <div class="relative inline-block">
                    <img src="{{ asset('storage/kejadian/' . $kejadian->foto) }}" alt="Foto Kejadian"
                        class="h-48 rounded-lg border shadow-sm">
                    <div class="mt-2 text-xs text-gray-500">
                        <span class="font-medium">Note:</span> Upload foto baru untuk mengganti
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- Respon Time --}}
    <div class="space-y-2">
        <label class="block text-sm font-medium text-gray-700">Waktu Respon</label>
        <div class="relative">
            <input type="text" id="respon_time_display" readonly
                value="{{ old('respon_time', isset($kejadian) && $kejadian->respon_time !== null ? $kejadian->respon_time . ' menit' : 'Menunggu input waktu...') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-gray-50 text-gray-700" />
            <div class="absolute right-3 top-1/2 -translate-y-1/2">
                <span id="respon-status"
                    class="text-sm font-medium px-2 py-1 rounded-full 
                    {{ isset($kejadian) && $kejadian->respon_time <= 10
                        ? 'bg-green-100 text-green-800'
                        : (isset($kejadian) && $kejadian->respon_time <= 20
                            ? 'bg-yellow-100 text-yellow-800'
                            : 'bg-gray-100 text-gray-800') }}">
                    {{ isset($kejadian) && $kejadian->respon_time ? 'Auto' : 'N/A' }}
                </span>
            </div>
        </div>
        <input type="hidden" name="respon_time" id="respon_time"
            value="{{ old('respon_time', $kejadian->respon_time ?? '') }}">
        <p class="text-xs text-gray-500">Waktu respon dihitung otomatis dari Berangkat → Tiba di Lokasi</p>
    </div>

    {{-- Action Buttons --}}
    <div class="flex gap-3 pt-4 border-t">
        <button type="submit"
            class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-medium rounded-lg hover:from-indigo-700 hover:to-purple-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            Simpan Data
        </button>
        <a href="{{ route('kejadian.index') }}"
            class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-3 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            Batal
        </a>
    </div>
</form>

{{-- Enhanced JavaScript --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Elements
        const berangkatInput = document.getElementById('berangkat');
        const tibaInput = document.getElementById('tiba_di_lokasi');
        const displayInput = document.getElementById('respon_time_display');
        const hiddenInput = document.getElementById('respon_time');
        const statusSpan = document.getElementById('respon-status');
        const fotoInput = document.getElementById('foto');
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('preview-image');
        const previewInfo = document.getElementById('preview-info');
        const removePreviewBtn = document.getElementById('remove-preview');

        // 1. Hitung Respon Time
        function hitungRespon() {
            displayInput.value = 'Menunggu input waktu...';
            hiddenInput.value = '';
            statusSpan.textContent = 'N/A';
            statusSpan.className = 'text-sm font-medium px-2 py-1 rounded-full bg-gray-100 text-gray-800';

            if (!berangkatInput.value || !tibaInput.value) return;

            const b = new Date(berangkatInput.value);
            const t = new Date(tibaInput.value);

            if (isNaN(b.getTime()) || isNaN(t.getTime())) return;

            const diffMs = t - b;
            const diffMin = Math.round(diffMs / 60000);

            if (diffMin >= 0) {
                displayInput.value = `${diffMin} menit`;
                hiddenInput.value = diffMin;
                statusSpan.textContent = 'Auto';

                // Update status color based on response time
                if (diffMin <= 10) {
                    statusSpan.className =
                        'text-sm font-medium px-2 py-1 rounded-full bg-green-100 text-green-800';
                } else if (diffMin <= 20) {
                    statusSpan.className =
                        'text-sm font-medium px-2 py-1 rounded-full bg-yellow-100 text-yellow-800';
                } else {
                    statusSpan.className = 'text-sm font-medium px-2 py-1 rounded-full bg-red-100 text-red-800';
                }
            } else {
                displayInput.value = 'Waktu tiba sebelum berangkat!';
                statusSpan.textContent = 'Error';
                statusSpan.className = 'text-sm font-medium px-2 py-1 rounded-full bg-red-100 text-red-800';
            }
        }

        // 2. Foto Preview Functionality
        function setupFotoPreview() {
            if (!fotoInput) return;

            // Preview uploaded image
            fotoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file) return;

                // Validate file type
                if (!file.type.match('image.*')) {
                    alert('Hanya file gambar yang diizinkan!');
                    fotoInput.value = '';
                    return;
                }

                // Validate file size (5MB max)
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file maksimal 5MB!');
                    fotoInput.value = '';
                    return;
                }

                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewInfo.textContent = `${file.name} (${(file.size / 1024).toFixed(1)} KB)`;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            });

            // Remove preview
            if (removePreviewBtn) {
                removePreviewBtn.addEventListener('click', function() {
                    fotoInput.value = '';
                    previewContainer.classList.add('hidden');
                    previewImage.src = '';
                    previewInfo.textContent = '';
                });
            }
        }

        // 3. Date Input Validation
        function setupDateValidation() {
            const dateInputs = document.querySelectorAll('input[type="datetime-local"]');
            dateInputs.forEach(input => {
                input.addEventListener('change', function() {
                    // Set min attribute based on other inputs if needed
                    if (this.id === 'tiba_di_lokasi' && berangkatInput.value) {
                        this.min = berangkatInput.value;
                    }
                });
            });
        }

        // Initialize all functions
        berangkatInput?.addEventListener('change', hitungRespon);
        tibaInput?.addEventListener('change', hitungRespon);

        setupFotoPreview();
        setupDateValidation();

        // Initial calculation
        hitungRespon();
    });
</script>

<style>
    /* Custom styles for better UX */
    input[type="datetime-local"]::-webkit-calendar-picker-indicator {
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
        position: absolute;
        right: 0;
    }

    .border-dashed:hover {
        border-color: #4f46e5;
        background-color: #f8fafc;
    }

    #preview-image {
        transition: transform 0.3s ease;
    }

    #preview-image:hover {
        transform: scale(1.01);
    }
</style>

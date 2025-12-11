{{-- resources/views/auth/login.blade.php --}}
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Login — Damkar App</title>

    {{-- Tailwind CDN untuk development --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* small polish */
        body {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .fade-up {
            transform: translateY(8px);
            opacity: 0;
            animation: fadeUp .5s forwards ease;
        }

        @keyframes fadeUp {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-indigo-50 flex items-center justify-center">
    <main class="w-full max-w-4xl mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            {{-- left: branding / illustration --}}
            <section class="hidden md:flex flex-col gap-6 justify-center px-6 fade-up">
                <div class="flex items-center gap-3">
                    <div
                        class="w-12 h-12 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold">
                        DA</div>
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-800">Damkar Admin Panel</h1>
                        <p class="text-sm text-gray-500">Kelola kejadian & petugas — dashboard cepat dan responsif.</p>
                    </div>
                </div>

                <div class="bg-white/60 p-6 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold text-gray-700">Keamanan & Kecepatan</h3>
                    <p class="text-sm text-gray-600 mt-2">Login menggunakan akun petugas yang sudah terdaftar. Jika
                        belum punya, minta admin membuatkan akun.</p>

                    <ul class="mt-4 space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2"><span class="text-indigo-600 mt-1">•</span> Statistik
                            kejadian real-time</li>
                        <li class="flex items-start gap-2"><span class="text-indigo-600 mt-1">•</span> Upload foto
                            kejadian</li>
                        <li class="flex items-start gap-2"><span class="text-indigo-600 mt-1">•</span> Manajemen petugas
                        </li>
                    </ul>
                </div>

                {{-- decorative --}}
                <div class="mt-4">
                    <img src="https://images.unsplash.com/photo-1556742043-8b5f3a9f6b9f?q=80&w=900&auto=format&fit=crop&ixlib=rb-4.0.3&s=9c0d0a5a3d8d1c1b6b4f2d7c3b2e8f9a"
                        alt="illustration" class="rounded-lg shadow-md">
                </div>
            </section>

            {{-- right: card login --}}
            <section class="bg-white rounded-2xl shadow-xl p-6 md:p-10">
                <div class="max-w-md mx-auto">
                    <div class="text-center mb-6">
                        <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-indigo-50">
                            <div
                                class="w-8 h-8 bg-indigo-600 text-white rounded flex items-center justify-center font-bold">
                                DA</div>
                            <div class="text-left">
                                <div class="text-lg font-semibold">Damkar App</div>
                                <div class="text-xs text-gray-500">Panel Petugas</div>
                            </div>
                        </div>
                    </div>

                    {{-- messages --}}
                    @if (session('success'))
                        <div class="mb-4 p-3 rounded text-sm bg-green-50 text-green-700 border border-green-100">
                            {{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 p-3 rounded text-sm bg-red-50 text-red-700 border border-red-100">
                            {{ session('error') }}</div>
                    @endif

                    {{-- Validation errors --}}
                    @if ($errors->any())
                        <div class="mb-4 p-3 rounded text-sm bg-red-50 text-red-700 border border-red-100">
                            <ul class="list-disc ml-5">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.process') }}" class="space-y-4" autocomplete="off">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                            <input name="username" type="text" value="{{ old('username') }}" required autofocus
                                class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition"
                                placeholder="Masukkan username" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <div class="relative">
                                <input name="password" id="password" type="password" required
                                    class="w-full border rounded-lg px-4 py-2 pr-12 focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition"
                                    placeholder="Masukkan password" />
                                <button type="button" id="togglePassword"
                                    class="absolute right-2 top-2/4 -translate-y-2/4 text-sm text-gray-500 px-2 py-1 rounded hover:bg-gray-100">
                                    Tampilkan
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-2">
                                <input id="remember" name="remember" type="checkbox"
                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                                <label for="remember" class="text-gray-600">Ingat saya</label>
                            </div>
                            <div>
                                <a href="#" class="text-indigo-600 hover:underline">Butuh bantuan?</a>
                            </div>
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition-shadow shadow-sm">
                                Masuk
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>

                        <p class="text-center text-sm text-gray-500">Gunakan akun petugas yang telah didaftarkan. <br
                                class="hidden sm:block">Hubungi admin untuk membuat akun baru.</p>
                    </form>

                    <div class="mt-6 text-center text-xs text-gray-400">
                        © {{ date('Y') }} Damkar App — Bro Agil
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script>
        // toggle show/hide password
        document.getElementById('togglePassword')?.addEventListener('click', function() {
            const pw = document.getElementById('password');
            if (!pw) return;
            if (pw.type === 'password') {
                pw.type = 'text';
                this.textContent = 'Sembunyikan';
            } else {
                pw.type = 'password';
                this.textContent = 'Tampilkan';
            }
        });

        // small UX: focus username if empty, else password
        (function() {
            const user = document.querySelector('input[name="username"]');
            const pw = document.querySelector('input[name="password"]');
            if (user && user.value.trim() !== '') {
                pw?.focus();
            } else {
                user?.focus();
            }
        })();
    </script>
</body>

</html>

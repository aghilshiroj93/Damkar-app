{{-- resources/views/auth/login.blade.php --}}
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Login — Damkar App</title>

    {{-- Tailwind CDN untuk development --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Inter untuk typography yang lebih baik --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
        }

        .login-container {
            animation: fadeInScale 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes fadeInScale {
            0% {
                opacity: 0;
                transform: translateY(20px) scale(0.98);
            }

            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .floating-card {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .gradient-text {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #9333ea 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .brand-glow {
            box-shadow: 0 0 30px rgba(79, 70, 229, 0.3);
            animation: pulse 4s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(79, 70, 229, 0.3);
            }

            50% {
                box-shadow: 0 0 40px rgba(79, 70, 229, 0.5);
            }
        }

        .input-focus-effect:focus {
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            border-color: #4f46e5;
            transform: translateY(-1px);
        }

        .btn-hover-effect {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-hover-effect:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.4);
        }

        .btn-hover-effect::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }

        .btn-hover-effect:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }

        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }

            100% {
                transform: scale(50, 50);
                opacity: 0;
            }
        }
    </style>
</head>

<body
    class="min-h-screen bg-gradient-to-br from-slate-50 via-indigo-50/30 to-white flex items-center justify-center p-4">
    <main class="w-full max-w-6xl mx-auto login-container">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
            {{-- Left: Branding & Information --}}
            <section class="hidden lg:flex flex-col gap-8 justify-center px-4">
                {{-- Brand Header --}}
                <div class="flex flex-col gap-4">
                    <div class="flex items-center gap-4">
                        <div
                            class="brand-glow w-16 h-16 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl flex items-center justify-center text-white">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold gradient-text">Damkar Response System</h1>
                            <p class="text-gray-600 mt-2">Sistem Manajemen Kejadian Kebakaran Terpadu</p>
                        </div>
                    </div>

                    <div class="h-px bg-gradient-to-r from-transparent via-indigo-200 to-transparent"></div>
                </div>

                {{-- Features Card --}}
                <div
                    class="floating-card bg-white/80 backdrop-blur-sm p-8 rounded-2xl shadow-xl border border-white/50">
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-red-500 to-orange-500 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 8v4l3 3" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Sistem Respons Cepat</h3>
                            <p class="text-sm text-gray-600">Penanganan kejadian real-time 24/7</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-start gap-3 group">
                            <div
                                class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mt-0.5 group-hover:scale-110 transition-transform">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Pelaporan Real-time</h4>
                                <p class="text-sm text-gray-600">Laporkan dan pantau kejadian secara langsung</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 group">
                            <div
                                class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mt-0.5 group-hover:scale-110 transition-transform">
                                <svg class="w-4 h-4 text-green-600" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Manajemen Petugas</h4>
                                <p class="text-sm text-gray-600">Kelola tim dan penugasan dengan efisien</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 group">
                            <div
                                class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mt-0.5 group-hover:scale-110 transition-transform">
                                <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Analitik Dashboard</h4>
                                <p class="text-sm text-gray-600">Statistik dan insights untuk pengambilan keputusan</p>
                            </div>
                        </div>
                    </div>

                    {{-- Stats Bar --}}
                    <div class="mt-8 pt-6 border-t border-gray-200/50">
                        <div class="grid grid-cols-3 gap-4 text-center">
                            <div>
                                <div class="text-xl font-bold text-gray-800">99.9%</div>
                                <div class="text-xs text-gray-500">Uptime</div>
                            </div>
                            <div>
                                <div class="text-xl font-bold text-gray-800">&lt;2m</div>
                                <div class="text-xs text-gray-500">Response Time</div>
                            </div>
                            <div>
                                <div class="text-xl font-bold text-gray-800">24/7</div>
                                <div class="text-xs text-gray-500">Monitoring</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Logo Damkar Suggestion --}}
                <div class="text-center mt-6">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-red-50 to-orange-50 rounded-full">
                        <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm text-gray-600">Gunakan logo Damkar resmi untuk branding yang
                            konsisten</span>
                    </div>
                </div>
            </section>

            {{-- Right: Login Form --}}
            <section class="bg-white rounded-3xl shadow-2xl p-6 md:p-10 border border-gray-100">
                <div class="max-w-md mx-auto">
                    {{-- Mobile Brand --}}
                    <div class="lg:hidden flex flex-col items-center mb-8">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl flex items-center justify-center text-white mb-4 brand-glow">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold gradient-text text-center">Damkar App</h2>
                        <p class="text-gray-500 text-sm mt-2 text-center">Panel Administrasi Petugas</p>
                    </div>

                    {{-- Form Header --}}
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold text-gray-900">Selamat Datang Kembali</h3>
                        <p class="text-gray-600 mt-2">Masuk untuk mengakses dashboard manajemen</p>
                    </div>

                    {{-- Messages --}}
                    @if (session('success'))
                        <div
                            class="mb-6 p-4 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 animate-slideDown">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div class="text-sm text-green-700">{{ session('success') }}</div>
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div
                            class="mb-6 p-4 rounded-xl bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 animate-slideDown">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                                <div class="text-sm text-red-700">{{ session('error') }}</div>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div
                            class="mb-6 p-4 rounded-xl bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 animate-slideDown">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.282 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-red-800 mb-1">Terdapat kesalahan:</div>
                                    <ul class="text-xs text-red-700 space-y-1">
                                        @foreach ($errors->all() as $err)
                                            <li class="flex items-start gap-2">
                                                <span class="mt-0.5">•</span>
                                                <span>{{ $err }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Login Form --}}
                    <form method="POST" action="{{ route('login.process') }}" class="space-y-6" autocomplete="off">
                        @csrf

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Username Petugas</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400 group-focus-within:text-indigo-600 transition-colors"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input name="username" type="text" value="{{ old('username') }}" required
                                    autofocus
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3 pl-10 focus:outline-none input-focus-effect transition-all duration-200"
                                    placeholder="cth: agil_123" />
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Password</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400 group-focus-within:text-indigo-600 transition-colors"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input name="password" id="password" type="password" required
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3 pl-10 pr-12 focus:outline-none input-focus-effect transition-all duration-200"
                                    placeholder="Masukkan password" />
                                <button type="button" id="togglePassword"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-sm font-medium text-indigo-600 hover:text-indigo-700 px-2 py-1 rounded-lg hover:bg-indigo-50 transition-colors">
                                    Tampilkan
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input id="remember" name="remember" type="checkbox"
                                    class="h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:ring-offset-0 transition-all group-hover:border-indigo-400" />
                                <span class="text-sm text-gray-600 group-hover:text-gray-800 transition-colors">Ingat
                                    perangkat ini</span>
                            </label>
                            <a href="#"
                                class="text-sm font-medium text-indigo-600 hover:text-indigo-700 hover:underline transition-colors">
                                Lupa password?
                            </a>
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                class="btn-hover-effect w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold py-3 px-4 rounded-xl shadow-lg">
                                <span class="flex items-center justify-center gap-2">
                                    Masuk ke Dashboard
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </span>
                            </button>
                        </div>

                        <div class="text-center pt-4">
                            <p class="text-sm text-gray-500">
                                Pastikan menggunakan akun petugas yang telah terdaftar.
                                <a href="#"
                                    class="font-medium text-indigo-600 hover:text-indigo-700 hover:underline">
                                    Hubungi admin
                                </a>
                                untuk bantuan.
                            </p>
                        </div>
                    </form>

                    {{-- Footer --}}
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div
                            class="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-gray-500">
                            <div>© {{ date('Y') }} Damkar Response System</div>
                            <div class="flex items-center gap-4">
                                <a href="#" class="hover:text-gray-700 transition-colors">Kebijakan Privasi</a>
                                <span class="text-gray-300">•</span>
                                <a href="#" class="hover:text-gray-700 transition-colors">Syarat Layanan</a>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                <span>Sistem Online</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script>
        // Enhanced password toggle
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        if (toggleBtn && passwordInput) {
            toggleBtn.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.textContent = type === 'password' ? 'Tampilkan' : 'Sembunyikan';

                // Add visual feedback
                this.classList.add('active');
                setTimeout(() => this.classList.remove('active'), 200);
            });
        }

        // Auto-focus logic
        (function() {
            const userInput = document.querySelector('input[name="username"]');
            const passInput = document.querySelector('input[name="password"]');

            if (userInput) {
                // Check if there's a saved username
                const savedUser = localStorage.getItem('remembered_username');
                if (savedUser) {
                    userInput.value = savedUser;
                    passInput?.focus();
                } else {
                    userInput.focus();
                }

                // Save on remember me
                const rememberCheckbox = document.getElementById('remember');
                if (rememberCheckbox) {
                    userInput.addEventListener('input', function() {
                        if (rememberCheckbox.checked) {
                            localStorage.setItem('remembered_username', this.value);
                        }
                    });
                }
            }
        })();

        // Add input animations
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('input-focused');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('input-focused');
            });
        });
    </script>
</body>

</html>

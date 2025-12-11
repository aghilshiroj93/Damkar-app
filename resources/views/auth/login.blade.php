{{-- resources/views/auth/login.blade.php --}}
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Login — Damkar App</title>

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .login-container {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            border-color: #4f46e5;
        }

        .btn-login {
            transition: all 0.2s ease;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        }

        .logo-pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.02);
            }
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100 flex items-center justify-center p-4">
    <div class="login-container w-full max-w-md mx-auto">
        {{-- Login Card --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            {{-- Logo Header --}}
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-8 text-center">
                {{-- Logo Damkar --}}
                <div class="flex justify-center mb-4">
                    <div class="logo-pulse bg-white/10 backdrop-blur-sm p-4 rounded-2xl inline-block">
                        <img src="{{ asset('images/logo-damkar.png') }}" alt="Logo Damkar"
                            class="w-20 h-20 mx-auto object-contain"
                            onerror="this.style.display='none'; document.getElementById('logo-fallback').style.display='flex';" />
                        {{-- Fallback jika logo tidak ada --}}
                        <div id="logo-fallback" class="hidden w-20 h-20 mx-auto items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <h1 class="text-2xl font-bold text-white mb-2">Damkar App</h1>
                <p class="text-indigo-100 text-sm">Sistem Manajemen Petugas</p>
            </div>

            {{-- Form Section --}}
            <div class="p-8">
                {{-- Messages --}}
                @if (session('success'))
                    <div class="mb-6 p-3 rounded-lg bg-green-50 border border-green-200 text-sm text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 p-3 rounded-lg bg-red-50 border border-red-200 text-sm text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 p-3 rounded-lg bg-red-50 border border-red-200">
                        <div class="text-sm font-medium text-red-800 mb-1">Terdapat kesalahan:</div>
                        <ul class="text-xs text-red-700 space-y-1">
                            @foreach ($errors->all() as $err)
                                <li class="flex items-start">
                                    <span class="mr-2">•</span>
                                    <span>{{ $err }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.process') }}" class="space-y-6" autocomplete="off">
                    @csrf

                    {{-- Username --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input name="username" type="text" value="{{ old('username') }}" required autofocus
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 pl-10 focus:outline-none input-focus transition"
                                placeholder="Masukkan username" />
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input name="password" id="password" type="password" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 pl-10 pr-12 focus:outline-none input-focus transition"
                                placeholder="Masukkan password" />
                            <button type="button" id="togglePassword"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-xs font-medium text-indigo-600 hover:text-indigo-700">
                                Tampilkan
                            </button>
                        </div>
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input id="remember" name="remember" type="checkbox"
                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                            <span class="text-sm text-gray-600">Ingat saya</span>
                        </label>
                        <a href="#" class="text-sm text-indigo-600 hover:text-indigo-700 hover:underline">
                            Lupa password?
                        </a>
                    </div>

                    {{-- Submit Button --}}
                    <div>
                        <button type="submit"
                            class="btn-login w-full bg-indigo-600 text-white font-medium py-3 px-4 rounded-lg hover:bg-indigo-700">
                            Masuk
                        </button>
                    </div>

                    {{-- Help Text --}}
                    <p class="text-center text-sm text-gray-500 mt-6">
                        Gunakan akun petugas yang telah terdaftar
                    </p>
                </form>
            </div>

            {{-- Footer --}}
            <div class="border-t border-gray-100 p-4 text-center">
                <div class="text-xs text-gray-500">
                    © {{ date('Y') }} Damkar App
                </div>
            </div>
        </div>
    </div>

    <script>
        // Password toggle
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        if (toggleBtn && passwordInput) {
            toggleBtn.addEventListener('click', function() {
                const type = passwordInput.type === 'password' ? 'text' : 'password';
                passwordInput.type = type;
                this.textContent = type === 'password' ? 'Tampilkan' : 'Sembunyikan';
            });
        }

        // Auto-focus username if empty
        document.addEventListener('DOMContentLoaded', function() {
            const usernameInput = document.querySelector('input[name="username"]');
            const passwordInput = document.querySelector('input[name="password"]');

            if (usernameInput && usernameInput.value.trim() === '') {
                usernameInput.focus();
            } else if (passwordInput) {
                passwordInput.focus();
            }
        });
    </script>
</body>

</html>

{{-- resources/views/layouts/app.blade.php --}}
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>@yield('title', 'Aplikasi Damkar') — Bro Agil</title>

    {{-- Tailwind via CDN (cepat untuk development) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <style>
        /* Custom variables dan animations */
        :root {
            --sidebar-width: 280px;
            --transition-smooth: cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Smooth scrollbar untuk sidebar */
        .sidebar-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-scrollbar::-webkit-scrollbar-thumb {
            background: #c7d2fe;
            border-radius: 10px;
        }

        .sidebar-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #a5b4fc;
        }

        /* Animasi untuk menu items */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .menu-item {
            animation: slideIn 0.3s var(--transition-smooth) forwards;
            opacity: 0;
        }

        .menu-item:nth-child(1) {
            animation-delay: 0.1s;
        }

        .menu-item:nth-child(2) {
            animation-delay: 0.15s;
        }

        .menu-item:nth-child(3) {
            animation-delay: 0.2s;
        }

        .menu-item:nth-child(4) {
            animation-delay: 0.25s;
        }

        /* Efek glassmorphism untuk sidebar */
        .sidebar-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-right: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow:
                inset -1px 0 0 rgba(255, 255, 255, 0.1),
                10px 0 30px -10px rgba(99, 102, 241, 0.15);
        }

        /* Hover effect untuk menu items */
        .menu-hover-effect {
            position: relative;
            overflow: hidden;
            transition: all 0.3s var(--transition-smooth);
        }

        .menu-hover-effect::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(99, 102, 241, 0.1), transparent);
            transition: left 0.6s var(--transition-smooth);
        }

        .menu-hover-effect:hover::after {
            left: 100%;
        }

        /* Active state indicator */
        .active-menu-item {
            background: linear-gradient(90deg, rgba(99, 102, 241, 0.1) 0%, rgba(99, 102, 241, 0.05) 100%);
            border-left: 3px solid #4f46e5;
            box-shadow: 0 2px 8px -2px rgba(99, 102, 241, 0.2);
        }

        /* Logo animation */
        .logo-glow {
            animation: pulse 4s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(79, 70, 229, 0.3);
            }

            50% {
                box-shadow: 0 0 30px rgba(79, 70, 229, 0.5);
            }
        }

        /* Avatar hover effect */
        .avatar-hover {
            transition: all 0.3s var(--transition-smooth);
        }

        .avatar-hover:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.3);
        }

        /* Search input animation */
        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            transform: scale(1.02);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 text-gray-800 antialiased">

    <div id="app" class="min-h-screen flex">
        {{-- Overlay dengan blur effect --}}
        <div id="overlay"
            class="fixed inset-0 bg-black/20 backdrop-blur-sm z-40 opacity-0 pointer-events-none transition-all duration-300">
        </div>

        {{-- SIDEBAR --}}
        <aside id="sidebar"
            class="fixed z-50 left-0 top-0 h-full w-[280px] sidebar-glass transform -translate-x-full md:translate-x-0 transition-all duration-300 ease-out"
            aria-label="Sidebar" style="box-shadow: 10px 0 40px -15px rgba(99, 102, 241, 0.2);">

            <div class="h-full flex flex-col">
                {{-- Brand dengan gradient --}}
                <div class="px-6 py-5 border-b border-gray-100">
                    <a class="flex items-center gap-3 group" href="#">
                        <div
                            class="logo-glow w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg transform group-hover:rotate-12 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div class="overflow-hidden">
                            <div
                                class="text-lg font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                Damkar App</div>
                            <div class="text-xs text-gray-500 truncate">Fire Response System</div>
                        </div>
                    </a>
                </div>

                {{-- Navigation --}}
                <nav class="flex-1 overflow-y-auto sidebar-scrollbar px-3 py-6 space-y-1">
                    @php
                        $currentRoute = request()->route()->getName();
                    @endphp

                    {{-- Dashboard --}}
                    <a href="{{ route('dashboard') }}" class="menu-item block">
                        <div
                            class="menu-hover-effect flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300
                            {{ $currentRoute == 'dashboard' ? 'active-menu-item text-indigo-700' : 'text-gray-600 hover:bg-gradient-to-r hover:from-indigo-50/50 hover:to-purple-50/50 hover:text-indigo-600' }}">
                            <div class="relative">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
                                </svg>
                                @if ($currentRoute == 'dashboard')
                                    <div class="absolute -top-1 -right-1 w-2 h-2 bg-green-400 rounded-full"></div>
                                @endif
                            </div>
                            <span class="text-sm font-medium">Dashboard</span>
                            <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </a>

                    {{-- Kejadian --}}
                    <a href="{{ route('kejadian.index') }}" class="menu-item block">
                        <div
                            class="menu-hover-effect flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300
                            {{ str_contains($currentRoute, 'kejadian') ? 'active-menu-item text-indigo-700' : 'text-gray-600 hover:bg-gradient-to-r hover:from-indigo-50/50 hover:to-purple-50/50 hover:text-indigo-600' }}">
                            <div class="relative">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 8v4l3 3" />
                                </svg>
                                @if (str_contains($currentRoute, 'kejadian'))
                                    <div class="absolute -top-1 -right-1 w-2 h-2 bg-red-400 rounded-full animate-ping">
                                    </div>
                                @endif
                            </div>
                            <span class="text-sm font-medium">Kejadian</span>
                            <span class="ml-auto flex items-center gap-1">
                                <span
                                    class="text-xs px-2 py-0.5 bg-gradient-to-r from-red-100 to-pink-100 text-red-600 rounded-full font-semibold">baru</span>
                                <svg class="w-4 h-4 text-indigo-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        </div>
                    </a>

                    {{-- Manajemen User --}}
                    <a href="{{ route('petugas.index') }}" class="menu-item block">
                        <div
                            class="menu-hover-effect flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300
                            {{ str_contains($currentRoute, 'petugas') ? 'active-menu-item text-indigo-700' : 'text-gray-600 hover:bg-gradient-to-r hover:from-indigo-50/50 hover:to-purple-50/50 hover:text-indigo-600' }}">
                            <div class="relative">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H9a6 6 0 010-12h12" />
                                </svg>
                                @if (str_contains($currentRoute, 'petugas'))
                                    <div class="absolute -top-1 -right-1 w-2 h-2 bg-blue-400 rounded-full"></div>
                                @endif
                            </div>
                            <span class="text-sm font-medium">Manajemen User</span>
                            <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </a>

                    {{-- Divider --}}
                    <div class="px-4 py-2">
                        <div class="h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
                    </div>

                    {{-- Logout --}}
                    <div class="menu-item px-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="menu-hover-effect flex items-center w-full gap-3 px-4 py-3 rounded-xl cursor-pointer
            text-red-600 hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 transition-all duration-300 transform hover:scale-[1.02]">

                                {{-- Icon kiri --}}
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7" />
                                </svg>

                                <span class="text-sm font-medium">Logout</span>

                                {{-- Icon kanan muncul saat hover --}}
                                <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </div>
                            </button>
                        </form>
                    </div>

                </nav>

                {{-- User info dengan gradient --}}
                <div class="px-6 py-4 border-t border-gray-100">
                    <div class="flex items-center gap-3 p-3 rounded-xl bg-gradient-to-r from-gray-50 to-indigo-50/30">
                        <img src="https://ui-avatars.com/api/?name=Bro+Agil&background=6366F1&color=fff&bold=true&size=128"
                            alt="avatar" class="w-10 h-10 rounded-full ring-2 ring-white shadow">
                        <div class="flex-1 min-w-0">
                            <div class="font-semibold text-sm text-gray-800 truncate">Bro Agil</div>
                            <div class="text-xs text-gray-500 truncate">Admin Utama</div>
                        </div>
                        <div
                            class="text-xs px-2 py-1 bg-gradient-to-r from-green-100 to-emerald-100 text-green-700 rounded-full font-semibold">
                            Online
                        </div>
                    </div>

                    {{-- Version info --}}
                    <div class="mt-4 flex items-center justify-between text-xs text-gray-500">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span>Sistem Aktif</span>
                        </div>
                        <div class="font-semibold">v1.0.1</div>
                    </div>
                </div>
            </div>
        </aside>

        {{-- MAIN WRAPPER --}}
        <div class="flex-1 min-h-screen flex flex-col md:pl-[280px] transition-all duration-300">
            {{-- Topbar dengan glass effect --}}
            <header class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-gray-200/50 shadow-sm">
                <div class="flex items-center justify-between px-4 md:px-6 h-16">
                    <div class="flex items-center gap-3">
                        {{-- Hamburger button dengan animasi --}}
                        <button id="btn-open-sidebar" aria-label="Open sidebar"
                            class="md:hidden p-2 rounded-lg hover:bg-gray-100/80 transition-all duration-200 active:scale-95 group">
                            <svg class="w-6 h-6 text-gray-700 group-hover:text-indigo-600 transition-colors"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        {{-- Breadcrumb atau title --}}
                        <div class="flex items-center gap-2">
                            <div
                                class="text-lg font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                @yield('title', 'Dashboard')
                            </div>
                            @if (isset($breadcrumb))
                                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                <span class="text-sm text-gray-600">{{ $breadcrumb }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        {{-- Search dengan animasi --}}
                        <div
                            class="hidden sm:flex items-center bg-gray-100/80 rounded-xl px-4 py-2 gap-3 transition-all duration-300 search-input">
                            <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M21 21l-4.35-4.35M9.5 17a7.5 7.5 0 100-15 7.5 7.5 0 000 15z" />
                            </svg>
                            <input type="search" placeholder="Cari sesuatu..."
                                class="bg-transparent outline-none text-sm w-48 placeholder-gray-400 focus:w-56 transition-all duration-300">
                        </div>

                        {{-- Notifikasi badge --}}
                        <button
                            class="relative p-2 rounded-lg hover:bg-gray-100/80 transition-all duration-200 avatar-hover">
                            <svg class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <div
                                class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-[10px] rounded-full flex items-center justify-center font-bold animate-pulse">
                                3
                            </div>
                        </button>

                        {{-- Avatar dengan dropdown effect --}}
                        <div class="relative group">
                            <button
                                class="avatar-hover p-1 rounded-full hover:bg-gray-100/80 transition-all duration-300">
                                <img src="https://ui-avatars.com/api/?name=Bro+Agil&background=6366F1&color=fff&bold=true&size=128"
                                    alt="avatar" class="w-9 h-9 rounded-full ring-2 ring-white shadow-lg">
                            </button>

                            {{-- Dropdown (akan muncul di hover) --}}
                            <div
                                class="absolute right-0 top-full mt-2 w-48 bg-white/95 backdrop-blur-sm rounded-xl shadow-lg border border-gray-200/50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform translate-y-2 group-hover:translate-y-0">
                                <div class="p-4 border-b border-gray-100">
                                    <div class="font-semibold text-gray-800">Bro Agil</div>
                                    <div class="text-xs text-gray-500">admin@damkar.app</div>
                                </div>
                                <div class="p-2">
                                    <a href="#"
                                        class="flex items-center gap-2 px-3 py-2 text-sm text-gray-600 hover:bg-gray-100/50 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Profil Saya
                                    </a>
                                    <a href="#"
                                        class="flex items-center gap-2 px-3 py-2 text-sm text-gray-600 hover:bg-gray-100/50 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Pengaturan
                                    </a>
                                    <div class="h-px bg-gray-100 my-1"></div>
                                    <a href="#"
                                        class="flex items-center gap-2 px-3 py-2 text-sm text-red-600 hover:bg-red-50/50 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7" />
                                        </svg>
                                        Keluar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            {{-- CONTENT AREA --}}
            <main class="flex-1 p-4 md:p-6 transition-all duration-300">
                @yield('content')
            </main>

            {{-- FOOTER --}}
            <footer
                class="bg-white/60 backdrop-blur-sm border-t border-gray-200/50 text-sm text-gray-600 p-4 text-center">
                <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-2">
                    <div class="flex items-center gap-2">
                        <div
                            class="w-6 h-6 bg-gradient-to-r from-indigo-500 to-purple-500 rounded flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <span>© {{ date('Y') }} <span class="font-semibold text-indigo-600">Damkar App</span> —
                            Fire Response System</span>
                    </div>
                    <div class="flex items-center gap-4 text-xs">
                        <span class="text-gray-500">PKL DAMKAR 2025</span>
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span>Status: <span class="font-semibold text-green-600">Online</span></span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    {{-- Enhanced sidebar toggle dengan GSAP animasi --}}
    <script>
        (function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const openBtn = document.getElementById('btn-open-sidebar');
            const mainContent = document.querySelector('main');
            const body = document.body;

            let isSidebarOpen = false;

            function openSidebar() {
                isSidebarOpen = true;

                // Animate sidebar dengan GSAP untuk efek smooth
                gsap.to(sidebar, {
                    x: 0,
                    duration: 0.3,
                    ease: "power2.out"
                });

                // Animate overlay
                overlay.classList.remove('pointer-events-none', 'opacity-0');
                overlay.classList.add('opacity-100');

                // Blur effect untuk konten utama
                gsap.to(mainContent, {
                    filter: 'blur(2px)',
                    duration: 0.3
                });

                body.classList.add('overflow-hidden');
            }

            function closeSidebar() {
                isSidebarOpen = false;

                gsap.to(sidebar, {
                    x: -280,
                    duration: 0.3,
                    ease: "power2.in"
                });

                overlay.classList.add('pointer-events-none', 'opacity-0');
                overlay.classList.remove('opacity-100');

                // Hapus blur effect
                gsap.to(mainContent, {
                    filter: 'blur(0px)',
                    duration: 0.3
                });

                body.classList.remove('overflow-hidden');
            }

            openBtn?.addEventListener('click', function(e) {
                e.stopPropagation();
                if (!isSidebarOpen) {
                    openSidebar();
                } else {
                    closeSidebar();
                }
            });

            overlay?.addEventListener('click', closeSidebar);

            // Close sidebar dengan escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && isSidebarOpen) {
                    closeSidebar();
                }
            });

            // Responsive behavior
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    // Desktop - selalu tampilkan sidebar
                    gsap.to(sidebar, {
                        x: 0,
                        duration: 0.2
                    });
                    overlay.classList.add('pointer-events-none', 'opacity-0');
                    overlay.classList.remove('opacity-100');
                    isSidebarOpen = false;
                    body.classList.remove('overflow-hidden');
                } else {
                    // Mobile - sembunyikan sidebar jika terbuka
                    if (isSidebarOpen) {
                        gsap.to(sidebar, {
                            x: -280,
                            duration: 0.2
                        });
                        isSidebarOpen = false;
                    }
                }
            });

            // Hover effect untuk menu items
            const menuItems = document.querySelectorAll('.menu-hover-effect');
            menuItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    gsap.to(this, {
                        scale: 1.02,
                        duration: 0.2,
                        ease: "power1.out"
                    });
                });

                item.addEventListener('mouseleave', function() {
                    gsap.to(this, {
                        scale: 1,
                        duration: 0.2,
                        ease: "power1.in"
                    });
                });
            });

            // Animate menu items on load
            gsap.from('.menu-item', {
                x: -20,
                opacity: 0,
                stagger: 0.05,
                duration: 0.4,
                delay: 0.2,
                ease: "power2.out"
            });

        })();
    </script>
</body>

</html>

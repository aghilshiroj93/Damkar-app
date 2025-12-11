{{-- resources/views/layouts/app.blade.php --}}
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>@yield('title', 'Aplikasi Damkar') — Bro Agil</title>

    {{-- Tailwind via CDN (cepat untuk development) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Fallback smoothing for sidebar animation */
        .sidebar-transition {
            transition: transform .28s cubic-bezier(.2, .9, .2, 1), opacity .28s ease;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800 antialiased">

    <div id="app" class="min-h-screen flex">
        {{-- Overlay for mobile when sidebar open --}}
        <div id="overlay" class="fixed inset-0 bg-black/40 opacity-0 pointer-events-none transition-opacity"></div>

        {{-- SIDEBAR --}}
        <aside id="sidebar"
            class="fixed z-30 left-0 top-0 h-full w-72 bg-white shadow-lg transform -translate-x-full md:translate-x-0 sidebar-transition"
            aria-label="Sidebar">

            <div class="h-full flex flex-col">
                {{-- Brand --}}
                <div class="px-6 py-5 border-b">
                    <a class="flex items-center gap-3" href="#">
                        {{-- simple logo --}}
                        <div
                            class="w-10 h-10 bg-indigo-600 rounded flex items-center justify-center text-white font-bold">
                            DA</div>
                        <div>
                            <div class="text-lg font-semibold">Damkar App</div>
                            <div class="text-xs text-gray-500">Panel Admin</div>
                        </div>
                    </a>
                </div>

                {{-- Nav --}}
                <nav class="flex-1 overflow-y-auto px-2 py-4 space-y-1">
                    {{-- Dashboard (no href per request) --}}
                    <a href="{{ route('dashboard') }}" class="px-2 block">
                        <div
                            class="flex items-center gap-3 px-3 py-2 rounded-md
        text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition-colors">

                            <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
                            </svg>

                            <span class="text-sm font-medium">Dashboard</span>
                        </div>
                    </a>


                    {{-- Kejadian (ACTIVE link) --}}
                    <a href="{{ route('kejadian.index') }}" class="group block">
                        <div
                            class="flex items-center gap-3 px-3 py-2 rounded-md
                        text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition-colors
                        group-hover:pl-4">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 8v4l3 3" />
                            </svg>
                            <span class="text-sm font-medium">Kejadian</span>
                            <span class="ml-auto text-xs text-indigo-600 bg-indigo-100 px-2 py-0.5 rounded">baru</span>
                        </div>
                    </a>

                    {{-- Manajemen User (no href) --}}
                    <a href="{{ route('petugas.index') }}" class="px-2 block">
                        <div
                            class="flex items-center gap-3 px-3 py-2 rounded-md
        text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition-colors">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M5.121 17.804A9 9 0 1118.879 6.196 9 9 0 015.121 17.804z" />
                            </svg>
                            <span class="text-sm font-medium">Manajemen User</span>
                        </div>
                    </a>


                    {{-- Logout (display only, no href) --}}
                    <div class="px-2">
                        <div
                            class="flex items-center gap-3 px-3 py-2 rounded-md cursor-default
                        text-red-600 hover:bg-red-50 transition-colors">
                            <svg class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7" />
                            </svg>
                            <span class="text-sm font-medium">Logout</span>
                        </div>
                    </div>
                </nav>

                {{-- Footer / small info --}}
                <div class="px-6 py-4 border-t text-xs text-gray-500">
                    <div>Signed in as <span class="font-medium text-gray-700">Bro Agil</span></div>
                    <div class="mt-2">Versi <span class="font-semibold">1.0</span></div>
                </div>
            </div>
        </aside>

        {{-- MAIN WRAPPER --}}
        <div class="flex-1 min-h-screen flex flex-col md:pl-72">
            {{-- Topbar --}}
            <header class="sticky top-0 z-20 bg-white border-b">
                <div class="flex items-center justify-between px-4 md:px-6 h-16">
                    <div class="flex items-center gap-3">
                        {{-- hamburger for mobile --}}
                        <button id="btn-open-sidebar" aria-label="Open sidebar"
                            class="md:hidden p-2 rounded-md hover:bg-gray-100 transition">
                            <svg class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        <div class="text-lg font-semibold">@yield('title', 'Aplikasi Damkar')</div>
                    </div>

                    <div class="flex items-center gap-3">
                        {{-- search (just UI) --}}
                        <div class="hidden sm:flex items-center bg-gray-100 rounded px-3 py-1 gap-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M21 21l-4.35-4.35M9.5 17a7.5 7.5 0 100-15 7.5 7.5 0 000 15z" />
                            </svg>
                            <input type="search" placeholder="Cari..." class="bg-transparent outline-none text-sm" />
                        </div>

                        {{-- simple avatar --}}
                        <button class="p-1 rounded-full hover:bg-gray-100 transition">
                            <img src="https://ui-avatars.com/api/?name=Bro+Agil&background=6366F1&color=fff"
                                alt="avatar" class="w-8 h-8 rounded-full">
                        </button>
                    </div>
                </div>
            </header>

            {{-- CONTENT --}}
            <main class="flex-1 p-6">
                @yield('content')
            </main>

            {{-- FOOTER --}}
            <footer class="bg-white border-t text-sm text-gray-600 p-4 text-center">
                © {{ date('Y') }} Damkar App — dibuat rapi oleh Bro Agil
            </footer>
        </div>
    </div>

    {{-- Small script untuk toggle sidebar & overlay --}}
    <script>
        (function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const openBtn = document.getElementById('btn-open-sidebar');

            function openSidebar() {
                sidebar.style.transform = 'translateX(0)';
                overlay.classList.remove('pointer-events-none', 'opacity-0');
                overlay.classList.add('opacity-100');
                document.body.classList.add('overflow-hidden');
            }

            function closeSidebar() {
                sidebar.style.transform = '';
                overlay.classList.add('pointer-events-none', 'opacity-0');
                overlay.classList.remove('opacity-100');
                document.body.classList.remove('overflow-hidden');
            }

            openBtn?.addEventListener('click', function() {
                // toggle
                const computed = getComputedStyle(sidebar).transform;
                if (sidebar.style.transform && sidebar.style.transform !== '') {
                    closeSidebar();
                } else {
                    openSidebar();
                }
            });

            overlay?.addEventListener('click', closeSidebar);

            // close on escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeSidebar();
            });

            // ensure sidebar visible on resize md+
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    sidebar.style.transform = 'translateX(0)';
                    overlay.classList.add('pointer-events-none', 'opacity-0');
                    overlay.classList.remove('opacity-100');
                } else {
                    sidebar.style.transform = '';
                }
            });
        })();
    </script>
</body>

</html>

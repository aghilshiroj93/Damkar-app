<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Aplikasi Kejadian') - Satpol</title>

    <!-- Tailwind CDN (cepat dan praktis untuk prototyping) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Optional: small inline style for active link -->
    <style>
        .active-link {
            @apply bg-sky-600 text-white;
        }
    </style>

    @yield('head')
</head>

<body class="min-h-screen bg-gray-100 text-gray-800">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r hidden md:block">
            <div class="p-4 border-b">
                <a href="#" class="text-xl font-semibold">Satpol - Kejadian</a>
            </div>

            <nav class="p-4 space-y-1">
                <a href="#"
                    class="block rounded px-3 py-2 text-sm {{ request()->routeIs('dashboard') ? 'active-link' : 'hover:bg-gray-100' }}">Dashboard</a>
                <a href="#"
                    class="block rounded px-3 py-2 text-sm {{ request()->routeIs('incidents.*') ? 'active-link' : 'hover:bg-gray-100' }}">Report
                    (Kejadian)</a>
                <a href="#"
                    class="block rounded px-3 py-2 text-sm {{ request()->routeIs('users.*') ? 'active-link' : 'hover:bg-gray-100' }}">Manajemen
                    User</a>
            </nav>

            <div class="mt-auto p-4 border-t">
                <div class="text-xs text-gray-500">Versi</div>
                <div class="text-sm">1.0</div>
            </div>
        </aside>

        <!-- Main content area -->
        <div class="flex-1 flex flex-col">
            <!-- Topbar -->
            <header class="bg-white border-b px-4 py-3 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <!-- Mobile menu button -->
                    <button id="mobileNavBtn" class="md:hidden p-2 rounded hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <h1 class="text-lg font-semibold">@yield('page_title', 'Dashboard')</h1>
                </div>

                <div class="flex items-center gap-4">
                    <!-- placeholder for notifications -->
                    <div class="text-sm text-gray-600">Halo, {{ auth()->user()->name ?? 'Petugas' }}</div>
                    <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit"
                            class="text-sm text-red-600 hover:underline">Logout</button></form>
                </div>
            </header>

            <!-- Content -->
            <main class="p-6 overflow-auto">
                @yield('content')
            </main>

            <footer class="p-4 text-sm text-gray-500 border-t text-center">
                &copy; {{ date('Y') }} Satpol - Sistem Kejadian
            </footer>
        </div>
    </div>

    <!-- Mobile off-canvas sidebar -->
    <div id="mobileNav" class="fixed inset-0 z-40 hidden">
        <div class="absolute inset-0 bg-black/30" onclick="toggleMobileNav()"></div>
        <aside class="absolute left-0 top-0 bottom-0 w-64 bg-white shadow p-4">
            <div class="mb-4">
                <a href="#" class="text-lg font-semibold">Satpol - Kejadian</a>
            </div>
            <nav class="space-y-1">
                <a href="#" class="block rounded px-3 py-2 text-sm">Dashboard</a>
                <a href="#" class="block rounded px-3 py-2 text-sm">Report</a>
                <a href="#" class="block rounded px-3 py-2 text-sm">Manajemen User</a>
            </nav>
        </aside>
    </div>

    <script>
        function toggleMobileNav() {
            const el = document.getElementById('mobileNav');
            el.classList.toggle('hidden');
        }
        document.getElementById('mobileNavBtn')?.addEventListener('click', toggleMobileNav);
    </script>

    @yield('scripts')
</body>

</html>

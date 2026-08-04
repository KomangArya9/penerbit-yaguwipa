<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel | Yaguwipa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* CSS Tambahan untuk Menyembunyikan Scrollbar secara Cross-Browser */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-gray-100 flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-slate-800 text-white flex-shrink-0 h-screen flex flex-col sticky top-0">
        <!-- Logo Header -->
        <div class="p-5 font-bold text-lg border-b border-slate-700 flex-shrink-0">
            @lang('admin.sidebar_brand')
        </div>

        <!-- Navigation Container (Bisa di-scroll tapi scrollbar disembunyikan) -->
        <nav class="py-4 space-y-1 flex-1 overflow-y-auto no-scrollbar">
            <!-- Dashboard Utama -->
            <a href="{{ route('admin.dashboard') }}"
                class="block px-5 py-2.5 hover:bg-slate-700 transition text-sm text-gray-300 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-700' : '' }}">
                @lang('admin.sidebar_dashboard')
            </a>

            <div class="pt-4 pb-2 px-5 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                @lang('admin.sidebar_content_manager')
            </div>

            <!-- 1. Menu Dropdown Pengaturan -->
            <div x-data="{ open: false }" class="w-full">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-5 py-2.5 text-sm text-gray-300 hover:bg-slate-700 hover:text-white transition-all duration-200 focus:outline-none"
                    :class="open ? 'bg-slate-700' : ''" type="button">
                    <span>@lang('admin.sidebar_pengaturan')</span>
                    <svg :class="open ? 'rotate-180' : ''"
                        class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-transition class="mt-1 pl-4 space-y-1 bg-slate-900/30 py-1" style="display: none;">
                    <a href="{{ route('admin.pengaturan.general') }}"
                        class="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-slate-700/50 rounded-lg transition-colors {{ request()->routeIs('admin.pengaturan.general*') ? 'bg-slate-700/50' : '' }}">
                        @lang('admin.sidebar_general_settings')
                    </a>
                    <a href="{{ route('admin.menu.index') }}"
                        class="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-slate-700/50 rounded-lg transition-colors {{ request()->routeIs('admin.menu*') ? 'bg-slate-700/50' : '' }}">
                        @lang('admin.sidebar_menu_manager')
                    </a>
                </div>
            </div>

            <!-- 2. Menu Dropdown News & Events -->
            <div x-data="{ open: false }" class="w-full">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-5 py-2.5 text-sm text-gray-300 hover:bg-slate-700 hover:text-white transition-all duration-200 focus:outline-none"
                    :class="open ? 'bg-slate-700' : ''" type="button">
                    <span>@lang('admin.sidebar_news_events')</span>
                    <svg :class="open ? 'rotate-180' : ''"
                        class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-transition class="mt-1 pl-4 space-y-1 bg-slate-900/30 py-1" style="display: none;">
                    <a href="{{ route('admin.kategori.index') }}"
                        class="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-slate-700/50 rounded-lg transition-colors {{ request()->routeIs('admin.kategori*') ? 'bg-slate-700/50' : '' }}">
                        @lang('admin.sidebar_kategori_news')
                    </a>
                    <a href="{{ route('admin.blog.index') }}"
                        class="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-slate-700/50 rounded-lg transition-colors {{ request()->routeIs('admin.blog*') ? 'bg-slate-700/50' : '' }}">
                        @lang('admin.sidebar_news_events')
                    </a>
                </div>
            </div>

            <!-- 3. Menu Dropdown Portofolio -->
            <div x-data="{ open: false }" class="w-full">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-5 py-2.5 text-sm text-gray-300 hover:bg-slate-700 hover:text-white transition-all duration-200 focus:outline-none"
                    :class="open ? 'bg-slate-700' : ''" type="button">
                    <span>@lang('admin.sidebar_portofolio')</span>
                    <svg :class="open ? 'rotate-180' : ''"
                        class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-transition class="mt-1 pl-4 space-y-1 bg-slate-900/30 py-1" style="display: none;">
                    <a href="{{ route('admin.kategori-project.index') }}"
                        class="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-slate-700/50 rounded-lg transition-colors {{ request()->routeIs('admin.kategori-project*') ? 'bg-slate-700/50' : '' }}">
                        @lang('admin.sidebar_kategori_portofolio')
                    </a>
                    <a href="{{ route('admin.project.index') }}"
                        class="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-slate-700/50 rounded-lg transition-colors {{ request()->routeIs('admin.project*') ? 'bg-slate-700/50' : '' }}">
                        @lang('admin.sidebar_portofolio')
                    </a>
                </div>
            </div>

            <!-- Menu Biasa: Program -->
            <a href="{{ route('program.index') }}"
                class="block px-5 py-2.5 hover:bg-slate-700 transition text-sm text-gray-300 {{ request()->routeIs('program*') ? 'bg-slate-700' : '' }}">
                @lang('admin.sidebar_program')
            </a>

            <!-- Menu Biasa: Partners & Clients -->
            <a href="{{ route('client.index') }}"
                class="block px-5 py-2.5 hover:bg-slate-700 transition text-sm text-gray-300 {{ request()->routeIs('client*') ? 'bg-slate-700' : '' }}">
                @lang('admin.sidebar_partners_clients')
            </a>

            <!-- 4. Menu Dropdown Gallery -->
            <div x-data="{ open: false }" class="w-full">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-5 py-2.5 text-sm text-gray-300 hover:bg-slate-700 hover:text-white transition-all duration-200 focus:outline-none"
                    :class="open ? 'bg-slate-700' : ''" type="button">
                    <span>@lang('admin.sidebar_gallery')</span>
                    <svg :class="open ? 'rotate-180' : ''"
                        class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-transition class="mt-1 pl-4 space-y-1 bg-slate-900/30 py-1" style="display: none;">
                    <a href="{{ route('admin.album.index') }}"
                        class="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-slate-700/50 rounded-lg transition-colors {{ request()->routeIs('admin.album*') ? 'bg-slate-700/50' : '' }}">
                        @lang('admin.sidebar_foto')
                    </a>
                    <a href="{{ route('admin.video.index') }}"
                        class="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-slate-700/50 rounded-lg transition-colors {{ request()->routeIs('admin.video*') ? 'bg-slate-700/50' : '' }}">
                        @lang('admin.sidebar_video')
                    </a>
                </div>
            </div>

            <!-- Menu Biasa: Review -->
            <a href="{{ route('admin.review.index') }}"
                class="block px-5 py-2.5 hover:bg-slate-700 transition text-sm text-gray-300 {{ request()->routeIs('admin.review*') ? 'bg-slate-700' : '' }}">
                @lang('admin.sidebar_review')
            </a>

            <!-- Menu Biasa: Penulis -->
            <a href="{{ route('admin.authors.index') }}"
                class="block px-5 py-2.5 hover:bg-slate-700 transition text-sm text-gray-300 {{ request()->routeIs('admin.authors*') ? 'bg-slate-700' : '' }}">
                @lang('admin.sidebar_penulis')
            </a>

            <!-- 5. Menu Dropdown Catalog -->
            <div x-data="{ open: false }" class="w-full">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-5 py-2.5 text-sm text-gray-300 hover:bg-slate-700 hover:text-white transition-all duration-200 focus:outline-none"
                    :class="open ? 'bg-slate-700' : ''" type="button">
                    <span>@lang('admin.sidebar_catalog')</span>
                    <svg :class="open ? 'rotate-180' : ''"
                        class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-transition class="mt-1 pl-4 space-y-1 bg-slate-900/30 py-1" style="display: none;">
                    <a href="{{ route('admin.catalog.index') }}"
                        class="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-slate-700/50 rounded-lg transition-colors {{ request()->routeIs('admin.catalog*') ? 'bg-slate-700/50' : '' }}">
                        @lang('admin.sidebar_catalog')
                    </a>
                    <a href="{{ route('admin.ulasan.index') }}"
                        class="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-slate-700/50 rounded-lg transition-colors {{ request()->routeIs('admin.ulasan*') ? 'bg-slate-700/50' : '' }}">
                        @lang('admin.sidebar_ulasan')
                    </a>
                </div>
            </div>

            <!-- 6. Menu Dropdown Ekstra -->
            <div x-data="{ open: false }" class="w-full">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-5 py-2.5 text-sm text-gray-300 hover:bg-slate-700 hover:text-white transition-all duration-200 focus:outline-none"
                    :class="open ? 'bg-slate-700' : ''" type="button">
                    <span>@lang('admin.sidebar_ekstra')</span>
                    <svg :class="open ? 'rotate-180' : ''"
                        class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-transition class="mt-1 pl-4 space-y-1 bg-slate-900/30 py-1" style="display: none;">
                    <a href="{{ route('admin.media.index') }}"
                        class="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-slate-700/50 rounded-lg transition-colors {{ request()->routeIs('admin.media*') ? 'bg-slate-700/50' : '' }}">
                        @lang('admin.sidebar_sosial_media')
                    </a>
                    <a href="{{ route('admin.kontak_kami.index') }}"
                        class="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-slate-700/50 rounded-lg transition-colors {{ request()->routeIs('admin.kontak_kami*') ? 'bg-slate-700/50' : '' }}">
                        @lang('admin.sidebar_contact_us')
                    </a>
                </div>
            </div>
        </nav>

        <!-- Footer / Account Menu di Bagian Bawah -->
        <div class="border-t border-slate-700 p-2 flex-shrink-0 bg-slate-900/40">
            <a href="#"
                class="block px-5 py-2.5 hover:bg-slate-700 transition text-sm text-gray-300 rounded-lg">@lang('admin.sidebar_account')</a>
        </div>
    </aside>

    <!-- MAIN AREA -->
    <main class="flex-1 flex flex-col min-w-0">
        <!-- NAVBAR -->
        <header class="bg-white shadow-sm p-4 flex justify-between items-center">
            <h2 class="font-bold text-gray-700">@yield('title', 'Dashboard')</h2>
            <div class="flex gap-3 items-center">
                <a href="{{ route('admin.password.edit') }}"
                    class="bg-slate-600 hover:bg-slate-700 text-white px-3 py-1.5 rounded text-sm transition">
                    @lang('admin.sidebar_change_password')
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-500 hover:text-red-600 text-sm font-medium">@lang('admin.sidebar_logout')</button>
                </form>
            </div>
        </header>

        <!-- KONTEN -->
        <div class="p-6 flex-1">
            @yield('content')
        </div>
    </main>

</body>

</html>
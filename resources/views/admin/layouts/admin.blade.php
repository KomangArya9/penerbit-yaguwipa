<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') | Penerbit Yaguwipa</title>
    
    <!-- Tailwind & Alpine.js -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Premium Font Stacks: Plus Jakarta Sans & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --font-sans: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
        }
        body {
            font-family: var(--font-sans);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .font-mono {
            font-family: var(--font-mono);
        }
        /* Custom Smooth Cubic Transitions */
        .transition-smooth {
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        /* Active Scale Press effect */
        .pressable {
            transition: transform 0.15s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .pressable:active {
            transform: scale(0.98);
        }
        /* Custom Scrollbar Hide */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        /* Responsive padding for admin content pages */
        @media (max-width: 640px) {
            div.p-8 {
                padding: 1rem !important;
            }
        }
        @media (min-width: 641px) and (max-width: 1024px) {
            div.p-8 {
                padding: 1.5rem !important;
            }
        }
    </style>
</head>

<body class="bg-slate-50 flex min-h-screen text-slate-800 antialiased selection:bg-red-500 selection:text-white"
      x-data="{ sidebarOpen: false }"
      @keydown.escape.window="sidebarOpen = false">

    <!-- Mobile Backdrop Overlay -->
    <div x-show="sidebarOpen" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false" 
         class="fixed inset-0 bg-slate-950/70 backdrop-blur-xs z-40 lg:hidden"
         style="display: none;"></div>

    <!-- SIDEBAR -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
           class="fixed inset-y-0 left-0 z-50 w-64 bg-[#0a0f1d] text-slate-200 flex flex-col border-r border-slate-800/80 shadow-2xl lg:shadow-xl transition-transform duration-300 ease-in-out lg:static lg:h-screen lg:sticky lg:top-0 flex-shrink-0">
        <!-- Logo & Brand Header -->
        <div class="px-5 py-4 border-b border-slate-800/80 flex items-center justify-between flex-shrink-0 bg-[#070b16]">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group min-w-0">
                @if(!empty($setting->logo))
                    <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo" class="h-9 w-9 object-contain shrink-0">
                @else
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-red-600 to-rose-700 flex items-center justify-center text-white font-extrabold text-base shadow-sm ring-1 ring-white/10 shrink-0 group-hover:scale-105 transition">
                        Y
                    </div>
                @endif
                <div class="min-w-0">
                    <h2 class="font-bold text-sm tracking-tight text-white truncate leading-tight">{{ $setting->company ?? 'Yaguwipa' }}</h2>
                    <span class="text-[11px] text-slate-400 block font-normal mt-0.5">Admin Panel</span>
                </div>
            </a>

            <!-- Mobile Close Button (X) -->
            <button @click="sidebarOpen = false" 
                    type="button"
                    class="lg:hidden p-1.5 text-slate-400 hover:text-white hover:bg-slate-800/80 rounded-lg transition-smooth pressable"
                    title="Tutup Menu">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Navigation Container -->
        <nav class="py-4 px-3 space-y-6 flex-1 overflow-y-auto no-scrollbar text-sm">
            
            <!-- 1. UTAMA -->
            <div class="space-y-1">
                <div class="px-3 pb-1.5 text-[10px] font-bold text-slate-500 uppercase tracking-widest font-mono">
                    Overview
                </div>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-smooth pressable {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-red-600 to-rose-600 text-white shadow-md shadow-red-950 font-semibold ring-1 ring-white/20' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-100' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Dashboard</span>
                </a>
            </div>

            <!-- 2. MASTER PENERBITAN -->
            <div class="space-y-1">
                <div class="px-3 pb-1.5 text-[10px] font-bold text-slate-500 uppercase tracking-widest font-mono">
                    Penerbitan
                </div>
                
                <!-- Katalog Buku -->
                <a href="{{ route('admin.catalog.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-smooth pressable {{ request()->routeIs('admin.catalog*') ? 'bg-gradient-to-r from-red-600 to-rose-600 text-white shadow-md shadow-red-950 font-semibold ring-1 ring-white/20' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-100' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span>Katalog Buku</span>
                </a>

                <!-- Ulasan Buku -->
                <a href="{{ route('admin.ulasan.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-smooth pressable {{ request()->routeIs('admin.ulasan*') ? 'bg-gradient-to-r from-red-600 to-rose-600 text-white shadow-md shadow-red-950 font-semibold ring-1 ring-white/20' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-100' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    <span>Ulasan Buku</span>
                </a>

                <!-- Manajemen Penulis -->
                <a href="{{ route('admin.authors.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-smooth pressable {{ request()->routeIs('admin.authors*') ? 'bg-gradient-to-r from-red-600 to-rose-600 text-white shadow-md shadow-red-950 font-semibold ring-1 ring-white/20' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-100' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span>Penulis</span>
                </a>
            </div>

            <!-- 3. PORTOFOLIO & KARYA -->
            <div class="space-y-1" x-data="{ open: {{ (request()->routeIs('admin.project*') || request()->routeIs('admin.kategori-project*') || request()->routeIs('program*') || request()->routeIs('admin.album*') || request()->routeIs('admin.video*')) ? 'true' : 'false' }} }">
                <div class="px-3 pb-1.5 text-[10px] font-bold text-slate-500 uppercase tracking-widest font-mono flex items-center justify-between cursor-pointer select-none" @click="open = !open">
                    <span>Karya & Galeri</span>
                    <svg class="w-3 h-3 text-slate-500 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                
                <div x-show="open" x-collapse class="space-y-1 pl-1">
                    <!-- Program & Layanan -->
                    <a href="{{ route('program.index') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-smooth pressable {{ request()->routeIs('program*') ? 'bg-gradient-to-r from-red-600 to-rose-600 text-white shadow-md shadow-red-950 font-semibold ring-1 ring-white/20' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-100' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <span>Layanan</span>
                    </a>

                    <!-- Kategori Portofolio -->
                    <a href="{{ route('admin.kategori-project.index') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-smooth pressable {{ request()->routeIs('admin.kategori-project*') ? 'bg-gradient-to-r from-red-600 to-rose-600 text-white shadow-md shadow-red-950 font-semibold ring-1 ring-white/20' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-100' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <span>Kategori Portofolio</span>
                    </a>

                    <!-- Portofolio -->
                    <a href="{{ route('admin.project.index') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-smooth pressable {{ request()->routeIs('admin.project*') ? 'bg-gradient-to-r from-red-600 to-rose-600 text-white shadow-md shadow-red-950 font-semibold ring-1 ring-white/20' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-100' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>Portofolio</span>
                    </a>

                    <!-- Galeri Album Foto -->
                    <a href="{{ route('admin.album.index') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-smooth pressable {{ request()->routeIs('admin.album*') ? 'bg-gradient-to-r from-red-600 to-rose-600 text-white shadow-md shadow-red-950 font-semibold ring-1 ring-white/20' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-100' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>Galeri Foto</span>
                    </a>

                    <!-- Galeri Video -->
                    <a href="{{ route('admin.video.index') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-smooth pressable {{ request()->routeIs('admin.video*') ? 'bg-gradient-to-r from-red-600 to-rose-600 text-white shadow-md shadow-red-950 font-semibold ring-1 ring-white/20' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-100' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        <span>Galeri Video</span>
                    </a>
                </div>
            </div>

            <!-- 4. PUBLIKASI & ARTIKEL -->
            <div class="space-y-1" x-data="{ open: {{ (request()->routeIs('admin.blog*') || request()->routeIs('admin.kategori*') || request()->routeIs('admin.review*') || request()->routeIs('client*')) ? 'true' : 'false' }} }">
                <div class="px-3 pb-1.5 text-[10px] font-bold text-slate-500 uppercase tracking-widest font-mono flex items-center justify-between cursor-pointer select-none" @click="open = !open">
                    <span>Publikasi & Mitra</span>
                    <svg class="w-3 h-3 text-slate-500 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                
                <div x-show="open" x-collapse class="space-y-1 pl-1">
                    <!-- Kategori Berita -->
                    <a href="{{ route('admin.kategori.index') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-smooth pressable {{ request()->routeIs('admin.kategori.*') ? 'bg-gradient-to-r from-red-600 to-rose-600 text-white shadow-md shadow-red-950 font-semibold ring-1 ring-white/20' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-100' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <span>Kategori Berita</span>
                    </a>

                    <!-- News & Events -->
                    <a href="{{ route('admin.blog.index') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-smooth pressable {{ request()->routeIs('admin.blog.*') ? 'bg-gradient-to-r from-red-600 to-rose-600 text-white shadow-md shadow-red-950 font-semibold ring-1 ring-white/20' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-100' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        <span>News & Events</span>
                    </a>

                    <!-- Review & Testimoni -->
                    <a href="{{ route('admin.review.index') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-smooth pressable {{ request()->routeIs('admin.review*') ? 'bg-gradient-to-r from-red-600 to-rose-600 text-white shadow-md shadow-red-950 font-semibold ring-1 ring-white/20' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-100' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                        <span>Review & Testimoni</span>
                    </a>

                    <!-- Client / Mitra -->
                    <a href="{{ route('client.index') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-smooth pressable {{ request()->routeIs('client*') ? 'bg-gradient-to-r from-red-600 to-rose-600 text-white shadow-md shadow-red-950 font-semibold ring-1 ring-white/20' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-100' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span>Mitra & Klien</span>
                    </a>
                </div>
            </div>

            <!-- 5. PENGATURAN & SISTEM -->
            <div class="space-y-1">
                <div class="px-3 pb-1.5 text-[10px] font-bold text-slate-500 uppercase tracking-widest font-mono">
                    Sistem
                </div>
                
                <!-- General Settings -->
                <a href="{{ route('admin.pengaturan.general') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-smooth pressable {{ request()->routeIs('admin.pengaturan.general*') ? 'bg-gradient-to-r from-red-600 to-rose-600 text-white shadow-md shadow-red-950 font-semibold ring-1 ring-white/20' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-100' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Pengaturan Umum</span>
                </a>

                <!-- Menu Manager -->
                <a href="{{ route('admin.menu.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-smooth pressable {{ request()->routeIs('admin.menu*') ? 'bg-gradient-to-r from-red-600 to-rose-600 text-white shadow-md shadow-red-950 font-semibold ring-1 ring-white/20' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-100' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                    <span>Menu Manager</span>
                </a>

                <!-- Media Sosial -->
                <a href="{{ route('admin.media.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-smooth pressable {{ request()->routeIs('admin.media*') ? 'bg-gradient-to-r from-red-600 to-rose-600 text-white shadow-md shadow-red-950 font-semibold ring-1 ring-white/20' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-100' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                    <span>Media Sosial</span>
                </a>

                <!-- Kontak Kami -->
                <a href="{{ route('admin.kontak_kami.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-smooth pressable {{ request()->routeIs('admin.kontak_kami*') ? 'bg-gradient-to-r from-red-600 to-rose-600 text-white shadow-md shadow-red-950 font-semibold ring-1 ring-white/20' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-100' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <span>Kontak Kami</span>
                </a>
            </div>

        </nav>
    </aside>

    <!-- MAIN AREA -->
    <main class="flex-1 flex flex-col min-w-0 bg-[#f8fafc]">
        <!-- TOP NAVBAR (Floating Glass Architecture) -->
        <header class="bg-white/80 backdrop-blur-md border-b border-slate-200/80 px-4 sm:px-6 lg:px-8 py-3 flex justify-between items-center sticky top-0 z-20 shadow-xs">
            <div class="flex items-center gap-2.5 sm:gap-3 min-w-0">
                <!-- Hamburger Button (Mobile / Tablet) -->
                <button @click="sidebarOpen = true"
                        type="button"
                        class="lg:hidden p-2 text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-smooth pressable focus:outline-none"
                        aria-label="Buka Menu Navigasi">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <div class="flex items-center gap-2 min-w-0">
                    <span class="hidden sm:inline text-xs font-mono font-semibold uppercase tracking-wider text-slate-400">Backoffice</span>
                    <span class="hidden sm:inline text-slate-300">/</span>
                    <h2 class="font-bold text-slate-800 text-sm tracking-tight truncate">@yield('title', 'Dashboard')</h2>
                </div>
            </div>
            
            <div class="flex items-center gap-1.5 sm:gap-2.5 flex-shrink-0">
                <!-- Tombol Lihat Live Website (Button-in-Button Trailing Icon) -->
                <a href="{{ url('/') }}" target="_blank"
                    class="group inline-flex items-center gap-1.5 sm:gap-2 px-2.5 sm:px-3 py-1.5 text-xs font-semibold text-slate-700 bg-white hover:bg-slate-50 border border-slate-200 rounded-lg shadow-2xs transition-smooth pressable"
                    title="Buka Website Publik di Tab Baru">
                    <span class="hidden md:inline">Lihat Website</span>
                    <span class="md:hidden">Web</span>
                    <span class="w-4 h-4 rounded bg-slate-100 group-hover:bg-slate-200 flex items-center justify-center text-slate-500 transition-smooth text-[10px]">
                        ↗
                    </span>
                </a>

                <!-- Tombol Ganti Password -->
                <a href="{{ route('admin.password.edit') }}"
                    class="inline-flex items-center gap-1.5 bg-slate-900 hover:bg-slate-800 text-white px-2.5 sm:px-3 py-1.5 rounded-lg text-xs font-semibold transition-smooth pressable shadow-2xs"
                    title="Ganti Password">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                    <span class="hidden sm:inline">Ganti Password</span>
                </a>

                <!-- Tombol Logout -->
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-semibold text-rose-600 hover:bg-rose-50 rounded-lg transition-smooth pressable"
                        title="Keluar dari Panel Admin">
                        Keluar
                    </button>
                </form>
            </div>
        </header>

        <!-- KONTEN -->
        <div class="flex-1">
            @yield('content')
        </div>
    </main>

</body>

</html>
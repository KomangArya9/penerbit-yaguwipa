@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="p-8 max-w-7xl mx-auto space-y-6">

    <!-- Page Header (Simple & Bersih) -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Dashboard</h1>
            <p class="text-slate-500 text-sm mt-1">Ringkasan data dan aktivitas penerbitan Yaguwipa.</p>
        </div>
        <div>
            <a href="{{ route('admin.catalog.create') }}"
                class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-medium px-4 py-2 rounded-lg text-sm transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Buku
            </a>
        </div>
    </div>

    <!-- Alert Notifikasi Tindakan (Jika ada data Pending) -->
    @php
        $totalPending = ($data['pendingCatalog'] ?? 0) + ($data['pendingReview'] ?? 0) + ($data['pendingUlasan'] ?? 0);
    @endphp
    @if($totalPending > 0)
        <div class="p-4 bg-amber-50 border border-amber-200 rounded-xl flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-amber-800 shadow-2xs">
            <div class="flex items-center gap-3">
                <span class="p-2 bg-amber-200/60 rounded-lg text-amber-700 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </span>
                <div>
                    <h4 class="font-bold text-sm">Menunggu Persetujuan Admin ({{ $totalPending }} Item)</h4>
                    <p class="text-xs text-amber-700 mt-0.5">
                        @if(($data['pendingCatalog'] ?? 0) > 0)
                            <span class="font-semibold">{{ $data['pendingCatalog'] }}</span> Katalog Buku,
                        @endif
                        @if(($data['pendingReview'] ?? 0) > 0)
                            <span class="font-semibold">{{ $data['pendingReview'] }}</span> Review Website,
                        @endif
                        @if(($data['pendingUlasan'] ?? 0) > 0)
                            <span class="font-semibold">{{ $data['pendingUlasan'] }}</span> Ulasan Buku
                        @endif
                        menunggu ditinjau dan disetujui.
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-2 shrink-0">
                @if(($data['pendingCatalog'] ?? 0) > 0)
                    <a href="{{ route('admin.catalog.index') }}" class="px-3 py-1.5 bg-amber-600 hover:bg-amber-700 text-white rounded-lg text-xs font-semibold transition">
                        Tinjau Katalog &rarr;
                    </a>
                @endif
                @if(($data['pendingReview'] ?? 0) > 0)
                    <a href="{{ route('admin.review.index') }}" class="px-3 py-1.5 bg-amber-600 hover:bg-amber-700 text-white rounded-lg text-xs font-semibold transition">
                        Tinjau Review &rarr;
                    </a>
                @endif
            </div>
        </div>
    @endif

    <!-- Kartu Statistik Utama (Simple & Bersih Tanpa Ikon) -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        <!-- Card 1: Katalog -->
        <div class="bg-white p-5 rounded-xl shadow-2xs border border-slate-200">
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider block">Katalog Buku</span>
            <p class="text-3xl font-bold text-slate-800 mt-2">{{ $data['totalCatalog'] ?? 0 }}</p>
            @if(($data['pendingCatalog'] ?? 0) > 0)
                <span class="inline-flex items-center text-[11px] font-semibold text-amber-700 bg-amber-50 px-2 py-0.5 rounded mt-2">
                    {{ $data['pendingCatalog'] }} Pending
                </span>
            @else
                <span class="text-xs text-slate-400 mt-1 block">Buku terbit</span>
            @endif
        </div>

        <!-- Card 2: Penulis -->
        <div class="bg-white p-5 rounded-xl shadow-2xs border border-slate-200">
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider block">Penulis</span>
            <p class="text-3xl font-bold text-slate-800 mt-2">{{ $data['totalAuthor'] ?? $data['totalAuthors'] ?? 0 }}</p>
            <span class="text-xs text-slate-400 mt-1 block">Penulis terdaftar</span>
        </div>

        <!-- Card 3: Berita & Acara -->
        <div class="bg-white p-5 rounded-xl shadow-2xs border border-slate-200">
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider block">News & Events</span>
            <p class="text-3xl font-bold text-slate-800 mt-2">{{ $data['totalBlog'] ?? 0 }}</p>
            <span class="text-xs text-slate-400 mt-1 block">Artikel berita</span>
        </div>

        <!-- Card 4: Portofolio -->
        <div class="bg-white p-5 rounded-xl shadow-2xs border border-slate-200">
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider block">Portofolio</span>
            <p class="text-3xl font-bold text-slate-800 mt-2">{{ $data['totalProject'] ?? 0 }}</p>
            <span class="text-xs text-slate-400 mt-1 block">Proyek terbit</span>
        </div>

        <!-- Card 5: Review & Testimoni -->
        <div class="bg-white p-5 rounded-xl shadow-2xs border border-slate-200">
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider block">Review & Testimoni</span>
            <p class="text-3xl font-bold text-slate-800 mt-2">{{ $data['totalReview'] ?? $data['totalReviews'] ?? 0 }}</p>
            @if(($data['pendingReview'] ?? 0) > 0)
                <span class="inline-flex items-center text-[11px] font-semibold text-amber-700 bg-amber-50 px-2 py-0.5 rounded mt-2">
                    {{ $data['pendingReview'] }} Pending
                </span>
            @else
                <span class="text-xs text-slate-400 mt-1 block">Testimoni publik</span>
            @endif
        </div>
    </div>

    <!-- Aktivitas Terbaru (2 Kolom) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Panel Katalog Buku Terbaru -->
        <div class="bg-white rounded-xl shadow-2xs border border-slate-200 overflow-hidden">
            <div class="p-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                <h3 class="font-bold text-slate-800 text-sm">Katalog Buku Terbaru</h3>
                <a href="{{ route('admin.catalog.index') }}" class="text-xs text-red-600 hover:underline font-medium">
                    Lihat Semua &rarr;
                </a>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($recentCatalogs ?? [] as $catalog)
                    <div class="p-3.5 flex items-center justify-between gap-4 hover:bg-slate-50/70 transition">
                        <div class="flex items-center gap-3 min-w-0">
                            @if(!empty($catalog->cover))
                                <img src="{{ asset('storage/' . $catalog->cover) }}" alt="Cover" class="w-9 h-12 object-cover rounded border border-slate-200 shadow-2xs shrink-0">
                            @else
                                <div class="w-9 h-12 bg-slate-100 border border-slate-200 rounded flex items-center justify-center text-slate-400 text-[10px] italic shrink-0">
                                    No Cover
                                </div>
                            @endif
                            <div class="min-w-0">
                                <h4 class="font-semibold text-slate-800 text-sm truncate" title="{{ $catalog->judul }}">{{ $catalog->judul }}</h4>
                                <p class="text-xs text-slate-500 truncate">{{ $catalog->penulis ?? 'Penulis belum diisi' }}</p>
                            </div>
                        </div>
                        <div class="shrink-0 flex items-center gap-2">
                            @if($catalog->status === 'Show')
                                <span class="text-xs font-semibold text-emerald-600">Show</span>
                            @elseif($catalog->status === 'Pending')
                                <span class="text-xs font-semibold text-amber-600 animate-pulse">Pending</span>
                            @else
                                <span class="text-xs font-semibold text-slate-500">Hide</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-slate-400 text-xs">
                        Belum ada data buku di katalog.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Panel Review & Testimoni Terbaru -->
        <div class="bg-white rounded-xl shadow-2xs border border-slate-200 overflow-hidden">
            <div class="p-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                <h3 class="font-bold text-slate-800 text-sm">Review & Testimoni Terbaru</h3>
                <a href="{{ route('admin.review.index') }}" class="text-xs text-red-600 hover:underline font-medium">
                    Lihat Semua &rarr;
                </a>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($recentReviews ?? [] as $rev)
                    <div class="p-3.5 flex items-center justify-between gap-4 hover:bg-slate-50/70 transition">
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <span class="font-semibold text-slate-800 text-sm">{{ $rev->nama }}</span>
                                <span class="text-amber-500 text-xs font-bold">★ {{ $rev->starts }}</span>
                            </div>
                            <p class="text-xs text-slate-500 truncate max-w-sm mt-0.5 italic">"{{ $rev->review }}"</p>
                        </div>
                        <div class="shrink-0">
                            @if($rev->status === 'Show')
                                <span class="text-xs font-semibold text-emerald-600">Show</span>
                            @elseif($rev->status === 'Pending')
                                <span class="text-xs font-semibold text-amber-600 animate-pulse">Pending</span>
                            @else
                                <span class="text-xs font-semibold text-slate-500">Hide</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-slate-400 text-xs">
                        Belum ada review yang masuk.
                    </div>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection
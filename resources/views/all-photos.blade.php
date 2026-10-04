@extends('layouts.app')

@section('content')
<div class="py-16">
    <div class="container mx-auto px-6 md:px-12 max-w-6xl">
        <div class="mb-10">
            <a href="{{ route('profile') }}" class="inline-flex items-center gap-2 text-sm font-medium text-stone-600 hover:text-[#B6171E] transition-colors py-2 px-3.5 rounded-xl hover:bg-stone-100 w-fit mb-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Profil
            </a>
            <h1 class="text-3xl md:text-5xl font-bold font-serif text-stone-900 tracking-tight">{{ $setting->all_photos_title ?? 'Semua Foto Album' }}</h1>
        </div>

        <!-- Grid dengan ukuran portrait vertikal -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            @forelse($albums as $album)
                <!-- Kotak album dengan tinggi portrait vertikal dan efek hover gradasi halus -->
                <div class="relative group overflow-hidden rounded-2xl shadow-sm border border-stone-200 h-64 md:h-72">
                    <img src="{{ asset('storage/' . ($album->fotos->first()->img ?? 'default.jpg')) }}" alt="{{ $album->title }}" class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-105">

                    <!-- Overlay Gradasi Halus -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-3.5">
                        <span class="text-white text-xs font-semibold drop-shadow truncate">{{ $album->title }}</span>
                        <span class="text-stone-300 text-[10px] drop-shadow">{{ date('d M Y', strtotime($album->date)) }}</span>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16 text-stone-400 bg-white rounded-2xl border border-stone-200 italic">
                    Belum ada album foto yang ditampilkan.
                </div>
            @endforelse
        </div>

        <!-- Pagination jika albumnya banyak -->
        <div class="mt-10">
            {{ $albums->links() }}
        </div>
    </div>
</div>
@endsection
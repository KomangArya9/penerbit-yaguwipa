@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-6 py-16">
        <!-- Tombol Kembali -->
        <a href="{{ route('portofolio') }}" class="inline-flex items-center gap-2 text-sm font-medium text-stone-600 hover:text-[#B6171E] mb-8 transition-colors py-2 px-3.5 rounded-xl hover:bg-stone-100 w-fit">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Kembali ke Portofolio
        </a>

        <!-- Kategori & Judul -->
        <p class="text-xs font-semibold text-[#B6171E] mb-2 uppercase tracking-wider">
            {{ $project->kategoriProject ? strtoupper($project->kategoriProject->title) : '-' }}
        </p>
        <h1 class="text-3xl md:text-5xl font-bold font-serif text-stone-900 mb-4 tracking-tight leading-tight">{{ $project->title }}</h1>
        
        <!-- Informasi Tambahan (Lokasi, Tanggal, Dilihat) -->
        <div class="flex flex-wrap gap-6 text-sm text-stone-500 mb-8 pb-4 border-b border-stone-200">
            @if($project->lokasi)
                <div><span class="font-medium text-stone-700">Lokasi:</span> {{ $project->lokasi }}</div>
            @endif
            @if($project->date)
                <div><span class="font-medium text-stone-700">Tanggal:</span> {{ $project->date }}</div>
            @endif
            <div><span class="font-medium text-stone-700">Dilihat:</span> {{ $project->hit }} kali</div>
        </div>

        <!-- Galeri / Gambar Utama -->
        <div class="mb-10 space-y-6">
            @foreach($project->fotos as $foto)
                <div class="w-full bg-stone-100 rounded-2xl overflow-hidden border border-stone-200 shadow-md">
                    <img src="{{ asset('storage/' . $foto->img) }}" alt="{{ $project->title }}" class="w-full h-auto object-cover">
                </div>
            @endforeach
        </div>

        <!-- Content -->
        <div class="prose max-w-none text-stone-700 leading-relaxed text-base md:text-lg">
            {!! $project->content !!}
        </div>

        <!-- Tombol Link Eksternal (Opsional jika diisi URL) -->
        @if($project->url)
            <div class="mt-12 pt-6 border-t border-stone-200">
                <a href="{{ $project->url }}" target="_blank" class="inline-block bg-[#B6171E] text-white px-7 py-3 rounded-xl font-medium hover:bg-[#9e141a] transition-all duration-200 shadow-sm hover:shadow-md active:scale-95">
                    Kunjungi Tautan Proyek &rarr;
                </a>
            </div>
        @endif
    </div>
@endsection
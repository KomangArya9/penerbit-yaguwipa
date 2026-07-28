@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-6 py-20">
        <!-- Tombol Kembali -->
        <a href="{{ route('portofolio') }}" class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-[#B6171E] mb-8 transition-colors">
            &larr; Kembali ke Portofolio
        </a>

        <!-- Kategori & Judul -->
        <p class="text-sm font-bold text-[#B6171E] mb-2 tracking-wider">
            {{ $project->kategoriProject ? strtoupper($project->kategoriProject->title) : '-' }}
        </p>
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $project->title }}</h1>
        
        <!-- Informasi Tambahan (Lokasi, Tanggal, Dilihat) -->
        <div class="flex flex-wrap gap-6 text-sm text-gray-500 mb-8 pb-4 border-b border-gray-200">
            @if($project->lokasi)
                <div><span class="font-semibold text-gray-700">Lokasi:</span> {{ $project->lokasi }}</div>
            @endif
            @if($project->date)
                <div><span class="font-semibold text-gray-700">Tanggal:</span> {{ $project->date }}</div>
            @endif
            <div><span class="font-semibold text-gray-700">Dilihat:</span> {{ $project->hit }} kali</div>
        </div>

        <!-- Galeri / Gambar Utama -->
        <div class="mb-10 space-y-4">
            @foreach($project->fotos as $foto)
                <div class="w-full bg-gray-100 rounded-sm overflow-hidden">
                    <img src="{{ asset('storage/' . $foto->img) }}" alt="{{ $project->title }}" class="w-full h-auto object-cover">
                </div>
            @endforeach
        </div>

        <!-- Content (Isi teks dari form admin yang kamu tanyakan tadi) -->
        <div class="prose max-w-none text-gray-700 leading-relaxed">
            {!! $project->content !!}
        </div>

        <!-- Tombol Link Eksternal (Opsional jika diisi URL) -->
        @if($project->url)
            <div class="mt-10 pt-6 border-t border-gray-200">
                <a href="{{ $project->url }}" target="_blank" class="inline-block bg-[#B6171E] text-white px-6 py-3 rounded-sm font-semibold hover:bg-opacity-90 transition-all">
                    Kunjungi Tautan Proyek &rarr;
                </a>
            </div>
        @endif
    </div>
@endsection
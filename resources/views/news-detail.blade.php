@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-6 py-16" x-data="{ shareModal: false }">
        <!-- Tombol Kembali -->
        <div class="mb-8">
            <a href="{{ route('news.index') }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-stone-600 hover:text-[#B6171E] transition-colors py-2 px-3.5 rounded-xl hover:bg-stone-100 w-fit">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Berita
            </a>
        </div>

        <!-- Judul & Metadata -->
        <h1 class="text-3xl md:text-5xl font-bold font-serif text-stone-900 mb-4 tracking-tight leading-tight">{{ $blog->title }}</h1>
        <div class="flex items-center gap-4 text-sm text-stone-500 mb-8 pb-4 border-b border-stone-200">
            <span>{{ \Carbon\Carbon::parse($blog->date)->format('d M Y') }}</span>
            <span class="inline-flex items-center gap-1.5">
                <svg class="w-4 h-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                    </path>
                </svg>
                {{ $blog->hit }} Views
            </span>
        </div>

        <!-- Gambar Utama & Caption -->
        @if($blog->img)
            <div class="mb-10">
                <div class="aspect-video bg-stone-100 overflow-hidden rounded-2xl border border-stone-200 shadow-md">
                    <img src="{{ asset('storage/' . $blog->img) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
                </div>
                @if($blog->caption)
                    <p class="text-xs text-stone-500 italic text-center mt-2.5">{{ $blog->caption }}</p>
                @endif
            </div>
        @endif

        <!-- Isi Konten Berita -->
        <div class="prose max-w-none text-stone-700 leading-relaxed mb-10 text-base md:text-lg">
            {!! $blog->content !!}
        </div>

        <!-- Tombol Pemicu Pop-up Share -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between py-6 border-t border-b border-stone-200 mb-16 gap-4">
            <span class="text-sm font-semibold text-stone-700">Suka artikel ini? Bagikan sekarang:</span>
            <button @click="shareModal = true"
                class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-[#B6171E] rounded-xl hover:bg-[#9e141a] transition-all shadow-sm active:scale-95 cursor-pointer w-fit">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z">
                    </path>
                </svg>
                Bagikan
            </button>
        </div>

        <!-- Modal Pop-up Share (Menggunakan Alpine.js) -->
        <div x-show="shareModal" class="fixed inset-0 z-50 flex items-center justify-center bg-stone-950/60 backdrop-blur-xs px-4" x-cloak>
            <div @click.away="shareModal = false"
                class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-7 relative border border-stone-200 transform transition-all text-left">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold font-serif text-stone-900">Bagikan Berita</h3>
                    <button @click="shareModal = false" class="w-8 h-8 rounded-full bg-stone-100 text-stone-500 hover:text-stone-900 hover:bg-stone-200 flex items-center justify-center transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
                <p class="text-xs text-stone-500 mb-5 line-clamp-1">Pilih platform untuk membagikan artikel:
                    "{{ $blog->title }}"</p>

                <!-- Pilihan Sosmed (Termasuk Instagram) -->
                <div class="grid grid-cols-2 gap-3 mb-6">
                    <!-- WhatsApp -->
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($blog->title . ' - ' . url()->current()) }}"
                        target="_blank"
                        class="flex flex-col items-center justify-center p-3.5 border border-stone-200 rounded-xl hover:bg-emerald-50 hover:border-emerald-200 transition-colors group">
                        <span class="text-xs font-semibold text-stone-700 group-hover:text-emerald-700">WhatsApp</span>
                    </a>
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"
                        class="flex flex-col items-center justify-center p-3.5 border border-stone-200 rounded-xl hover:bg-blue-50 hover:border-blue-200 transition-colors group">
                        <span class="text-xs font-semibold text-stone-700 group-hover:text-blue-700">Facebook</span>
                    </a>
                    <!-- Twitter/X -->
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(url()->current()) }}"
                        target="_blank"
                        class="flex flex-col items-center justify-center p-3.5 border border-stone-200 rounded-xl hover:bg-stone-100 hover:border-stone-300 transition-colors group">
                        <span class="text-xs font-semibold text-stone-700">Twitter / X</span>
                    </a>
                    <!-- Instagram (Salin Link + Alert khusus Instagram) -->
                    <button
                        onclick="navigator.clipboard.writeText('{{ url()->current() }}'); alert('Link berhasil disalin! Silakan tempel (paste) di Bio atau Direct Message Instagram Anda.');"
                        class="flex flex-col items-center justify-center p-3.5 border border-stone-200 rounded-xl hover:bg-pink-50 hover:border-pink-200 transition-colors group cursor-pointer">
                        <span class="text-xs font-semibold text-stone-700 group-hover:text-pink-600">Instagram</span>
                    </button>
                </div>

                <!-- Salin Link -->
                <div>
                    <label class="block text-xs font-medium text-stone-600 mb-1.5">Atau salin tautan:</label>
                    <div class="flex items-center gap-2">
                        <input type="text" readonly value="{{ url()->current() }}"
                            class="w-full bg-stone-50 border border-stone-200 text-stone-600 text-xs rounded-xl px-3.5 py-2.5 focus:outline-none">
                        <button
                            onclick="navigator.clipboard.writeText('{{ url()->current() }}'); alert('Link berhasil disalin!');"
                            class="px-4 py-2.5 bg-stone-900 text-white text-xs font-medium rounded-xl hover:bg-stone-800 transition-colors whitespace-nowrap active:scale-95 cursor-pointer">
                            Salin
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Berita Terkait (Related Blogs) -->
        @if($relatedBlogs->count() > 0)
            <div class="pt-10 mt-6 border-t border-stone-200">
                <h3 class="text-2xl font-bold font-serif text-stone-900 mb-6">{{ $setting->news_other_title ?? 'Berita Lainnya' }}</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach($relatedBlogs as $item)
                        <a href="{{ route('news.show', $item->slug) }}" 
                            class="group block bg-white border border-stone-200/80 rounded-2xl overflow-hidden shadow-2xs hover:shadow-md hover:border-stone-300 transition-all duration-300 flex flex-col">
                            
                            <!-- Thumbnail Gambar -->
                            <div class="aspect-video w-full bg-stone-100 overflow-hidden relative">
                                @if($item->img)
                                    <img src="{{ asset('storage/' . $item->img) }}" alt="{{ $item->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-stone-100 text-stone-400">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Konten Judul & Tanggal -->
                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <h4 class="font-serif font-bold text-base text-stone-900 group-hover:text-[#B6171E] transition-colors line-clamp-2 leading-snug mb-3">
                                    {{ $item->title }}
                                </h4>
                                <div class="flex items-center justify-between text-xs text-stone-400 mt-auto pt-3 border-t border-stone-100 gap-2">
                                    <span class="truncate">{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</span>
                                    <span class="inline-flex items-center gap-1 text-[#B6171E] font-semibold text-xs whitespace-nowrap shrink-0 group-hover:translate-x-0.5 transition-transform">
                                        <span>Baca</span>
                                        <svg class="w-3.5 h-3.5 shrink-0 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-6 py-16" x-data="{ shareModal: false }">
        <!-- Tombol Kembali -->
        <div class="mb-6">
            <a href="{{ route('news.index') }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-red-800 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Berita
            </a>
        </div>

        <!-- Judul & Metadata -->
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $blog->title }}</h1>
        <div class="flex items-center gap-4 text-sm text-gray-500 mb-8 pb-4 border-b border-gray-200">
            <span>{{ \Carbon\Carbon::parse($blog->date)->format('d M Y') }}</span>
            <span class="inline-flex items-center gap-1.5">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            <div class="mb-8">
                <div class="aspect-video bg-gray-200 overflow-hidden rounded-lg">
                    <img src="{{ asset('storage/' . $blog->img) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
                </div>
                @if($blog->caption)
                    <p class="text-xs text-gray-500 italic text-center mt-2">{{ $blog->caption }}</p>
                @endif
            </div>
        @endif

        <!-- Isi Konten Berita -->
        <div class="prose max-w-none text-gray-700 leading-relaxed mb-8">
            {!! $blog->content !!}
        </div>

        <!-- Tombol Pemicu Pop-up Share -->
        <div class="flex items-center justify-between py-6 border-t border-b border-gray-200 mb-16">
            <span class="text-sm font-semibold text-gray-700">Suka artikel ini? Bagikan sekarang:</span>
            <button @click="shareModal = true"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-red-800 rounded-lg hover:bg-red-900 transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z">
                    </path>
                </svg>
                Bagikan
            </button>
        </div>

        <!-- Modal Pop-up Share (Menggunakan Alpine.js) -->
        <div x-show="shareModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4" x-cloak>
            <div @click.away="shareModal = false"
                class="bg-white rounded-xl shadow-xl max-w-md w-full p-6 relative transform transition-all">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Bagikan Berita</h3>
                    <button @click="shareModal = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
                <p class="text-xs text-gray-500 mb-4 line-clamp-1">Pilih platform untuk membagikan artikel:
                    "{{ $blog->title }}"</p>

                <!-- Pilihan Sosmed (Termasuk Instagram) -->
                <div class="grid grid-cols-2 gap-3 mb-6">
                    <!-- WhatsApp -->
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($blog->title . ' - ' . url()->current()) }}"
                        target="_blank"
                        class="flex flex-col items-center justify-center p-3 border border-gray-200 rounded-lg hover:bg-green-50 hover:border-green-300 transition-colors group">
                        <span class="text-xs font-semibold text-gray-700 group-hover:text-green-700">WhatsApp</span>
                    </a>
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"
                        class="flex flex-col items-center justify-center p-3 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition-colors group">
                        <span class="text-xs font-semibold text-gray-700 group-hover:text-blue-700">Facebook</span>
                    </a>
                    <!-- Twitter/X -->
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(url()->current()) }}"
                        target="_blank"
                        class="flex flex-col items-center justify-center p-3 border border-gray-200 rounded-lg hover:bg-gray-100 hover:border-gray-400 transition-colors group">
                        <span class="text-xs font-semibold text-gray-700">Twitter / X</span>
                    </a>
                    <!-- Instagram (Salin Link + Alert khusus Instagram) -->
                    <button
                        onclick="navigator.clipboard.writeText('{{ url()->current() }}'); alert('Link berhasil disalin! Silakan tempel (paste) di Bio atau Direct Message Instagram Anda.');"
                        class="flex flex-col items-center justify-center p-3 border border-gray-200 rounded-lg hover:bg-pink-50 hover:border-pink-300 transition-colors group">
                        <span class="text-xs font-semibold text-gray-700 group-hover:text-pink-600">Instagram</span>
                    </button>
                </div>

                <!-- Salin Link -->
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Atau salin tautan:</label>
                    <div class="flex items-center gap-2">
                        <input type="text" readonly value="{{ url()->current() }}"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-600 text-xs rounded-lg px-3 py-2 focus:outline-none">
                        <button
                            onclick="navigator.clipboard.writeText('{{ url()->current() }}'); alert('Link berhasil disalin!');"
                            class="px-4 py-2 bg-gray-900 text-white text-xs font-medium rounded-lg hover:bg-gray-800 transition-colors whitespace-nowrap">
                            Salin
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Berita Terkait (Related Blogs) -->
        @if($relatedBlogs->count() > 0)
            <div class="pt-4">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Berita Lainnya</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedBlogs as $item)
                        <div class="border border-gray-200 p-4 rounded-lg flex flex-col">
                            <h4 class="font-bold text-base mb-2 line-clamp-2">
                                <a href="{{ route('news.show', $item->slug) }}" class="hover:text-red-800 transition-colors">
                                    {{ $item->title }}
                                </a>
                            </h4>
                            <p class="text-xs text-gray-500 mt-auto">
                                {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
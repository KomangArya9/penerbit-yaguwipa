@extends('layouts.app')

@section('content')

    <!-- Wrapper Utama -->
    <div class="bg-gray-50 py-16">
        <div class="container mx-auto px-4 md:px-12">

            <section class="text-center max-w-3xl mx-auto mb-20">
                <h4 class="animate-on-scroll text-[#B91C1C] font-bold text-xs uppercase tracking-widest mb-4">
                    @lang('profile.trusted_publisher')
                </h4>
                <h1 class="animate-on-scroll delay-100 text-4xl md:text-5xl text-gray-900 mb-6">
                    @lang('profile.about_heading')
                </h1>
                <p class="animate-on-scroll delay-200 text-gray-600 font-sans text-lg leading-relaxed mb-8">
                    @lang('profile.about_description')
                </p>
                <p class="animate-on-scroll delay-300 text-gray-500 leading-relaxed italic border-t border-gray-300 pt-6">
                    "@lang('profile.tagline')"
                </p>
            </section>

            <!-- Section: Photo Archive & Documentary -->
            <div class="bg-gray-100 pt-16 pb-24 mb-24 w-screen ml-[calc(-50vw+50%)] relative">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 px-6 md:px-12">

                    <!-- Photo Archive -->
                    <section class="animate-on-scroll">
                        <h3 class="text-xl font-bold mb-6 flex items-center gap-2 text-gray-900">
                            @lang('profile.photo_archive')
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            @forelse($albums as $index => $album)
                                <div
                                    class="animate-on-scroll delay-{{ ($index + 1) * 100 }} relative group overflow-hidden rounded-lg shadow-md aspect-[3/4]">
                                    <img src="{{ asset('storage/' . ($album->fotos->first()->img ?? 'default.jpg')) }}"
                                        alt="{{ $album->title }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-3">
                                        <span
                                            class="text-white text-xs font-semibold drop-shadow truncate">{{ $album->title }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full text-center text-gray-500 py-10 text-sm bg-gray-200 rounded">
                                    @lang('profile.no_album_photos')
                                </div>
                            @endforelse

                            <a href="{{ route('photos.all') }}"
                                class="animate-on-scroll delay-600 bg-gray-200 flex flex-col items-center justify-center font-semibold text-xs cursor-pointer hover:bg-gray-300 transition aspect-[3/4] rounded-lg shadow-md text-center p-4">
                                <span class="text-gray-800 font-bold text-sm mb-1">@lang('profile.view_all_photos')</span>
                                <span class="text-xs text-gray-500 font-normal">@lang('profile.view_all') →</span>
                            </a>
                        </div>
                    </section>

                    <!-- Documentary & Film Section -->
                    <section class="animate-on-scroll delay-200 relative">
                        <h3 class="text-xl font-bold mb-6 flex items-center gap-2 text-gray-900">
                            @lang('profile.documentary_film')
                        </h3>

                        @php
                            $mainVideo = \App\Models\Video::where('status', 'Show')->latest()->first();
                            $supportVideos = \App\Models\Video::where('status', 'Show')
                                ->when($mainVideo, function ($query) use ($mainVideo) {
                                    return $query->where('id', '!=', $mainVideo->id);
                                })
                                ->take(2)
                                ->get();
                        @endphp

                        @if($mainVideo)
                            @php
                                preg_match('~(?:http|https)?:?//(?:www\.)?(?:youtube\.com/(?:watch\?v=|embed/)|youtu\.be/)([\w-]+)~', $mainVideo->source, $mainMatches);
                                $mainVideoId = $mainMatches[1] ?? '';
                                $mainEmbedUrl = $mainVideoId ? "https://www.youtube.com/embed/{$mainVideoId}" : $mainVideo->source;
                            @endphp
                            <div
                                class="animate-on-scroll delay-300 bg-black aspect-video w-full mb-4 shadow-xl hover:shadow-2xl transition-all duration-700 overflow-hidden relative rounded-lg">
                                <iframe src="{{ $mainEmbedUrl }}" class="w-full h-full" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                            <div class="mb-4">
                                <h4 class="font-bold text-gray-800 text-base">{{ $mainVideo->title }}</h4>
                                <p class="text-xs text-gray-500">{{ date('d M Y', strtotime($mainVideo->date)) }}</p>
                            </div>
                        @else
                            <div
                                class="animate-on-scroll delay-300 bg-gray-200 aspect-video flex items-center justify-center text-gray-500 w-full mb-4 rounded-lg shadow">
                                @lang('profile.no_main_video')
                            </div>
                        @endif

                        <!-- Thumbnail Pendukung -->
                        @if($supportVideos->count() > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($supportVideos as $index => $video)
                                    @php
                                        preg_match('~(?:http|https)?:?//(?:www\.)?(?:youtube\.com/(?:watch\?v=|embed/)|youtu\.be/)([\w-]+)~', $video->source, $matches);
                                        $videoId = $matches[1] ?? '';
                                        $thumbnailUrl = $videoId ? "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg" : asset('images/default.jpg');
                                    @endphp
                                    <div
                                        class="animate-on-scroll delay-{{ 400 + ($index * 100) }} bg-white border border-gray-100 rounded-lg p-3 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between group">

                                        <a href="{{ $video->source }}" target="_blank"
                                            class="aspect-video bg-black mb-3 overflow-hidden relative rounded-md shadow-inner block group">
                                            <!-- Gambar Thumbnail -->
                                            <img src="{{ $thumbnailUrl }}" alt="{{ $video->title }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                                            <!-- Overlay & Tombol Play (Segitiga putih disesuaikan presisi di tengah dengan translate-x-1) -->
                                            <div
                                                class="absolute inset-0 bg-black/30 group-hover:bg-black/40 transition-colors flex items-center justify-center">
                                                <div
                                                    class="w-12 h-12 rounded-full bg-red-600 text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                                    <svg class="w-5 h-5 translate-x-0" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M8 5v14l11-7z" />
                                                    </svg>
                                                </div>
                                            </div>

                                            <!-- Badge YouTube -->
                                            <span
                                                class="absolute bottom-2 right-2 bg-black/70 text-white text-[10px] font-bold px-2 py-0.5 rounded backdrop-blur-sm">
                                                {{ __('common.youtube') }}
                                            </span>
                                        </a>

                                        <span
                                            class="text-xs font-semibold text-gray-800 truncate block group-hover:text-[#B6171E] transition-colors"
                                            title="{{ $video->title }}">
                                            {{ $video->title }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="mt-6 text-right">
                            <a href="{{ route('videos.all') }}"
                                class="text-sm text-[#B6171E] font-semibold hover:underline inline-flex items-center gap-1">
                                @lang('profile.view_all_videos') &rarr;
                            </a>
                        </div>
                    </section>

                </div>
            </div>

            <!-- Section: Reader Perspectives & Form -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="md:col-span-2">
                    <h3 class="animate-on-scroll text-xl font-bold mb-8 text-gray-900">@lang('profile.reader_perspectives')</h3>

                    <!-- Kontainer Ulasan dengan ID Auto-Scroll -->
                    <div id="review-auto-scroll-container"
                        class="animate-on-scroll delay-100 overflow-y-auto h-[500px] pr-4 scrollbar-thin scrollbar-thumb-gray-200 scrollbar-track-transparent">

                        @forelse($reviews as $review)
                            <div
                                class="bg-white p-6 border border-gray-100 mb-6 shadow-sm hover:shadow-md transition-all duration-500 rounded-lg">
                                <!-- Menampilkan Bintang Dinamis Berdasarkan Rating -->
                                <div class="text-[#B6171E] mb-2">
                                    {!! str_repeat('★', $review->starts) !!}{!! str_repeat('☆', 5 - $review->starts) !!}
                                </div>
                                <p class="italic mb-4 text-gray-700 leading-relaxed break-words">"{{ $review->review }}"</p>
                                <p class="font-bold text-sm">— {{ $review->nama }},
                                    <span class="text-gray-500 font-normal">{{ $review->pekerjaan }}</span>
                                </p>
                            </div>
                        @empty
                            <div class="bg-white p-6 border border-gray-100 text-center text-gray-500 rounded-lg">
                                @lang('profile.no_reviews')
                            </div>
                        @endforelse

                    </div>
                </div>

                <aside
                    class="animate-on-scroll delay-200 bg-white p-8 border border-gray-100 shadow-sm self-start rounded-lg">
                    <h3 class="font-bold mb-6 text-gray-900">@lang('profile.share_experience')</h3>

                    <!-- 1. Tempat Kotak Notifikasi Hijau (Awalnya tersembunyi/hidden) -->
                    <div id="review-alert"
                        class="hidden mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded transition-all duration-300">
                        <span id="alert-message"></span>
                    </div>

                    <!-- 2. Form Ulasan -->
                    <form id="review-form" class="space-y-4">
                        @csrf
                        <input type="text" name="nama" placeholder="{{ __('common.full_name') }}" required
                            class="w-full p-3 border border-gray-300 focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] outline-none transition-all rounded">

                        <input type="text" name="pekerjaan" placeholder="@lang('profile.job_optional')"
                            class="w-full p-3 border border-gray-300 focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] outline-none transition-all rounded">

                        <select name="starts" required
                            class="w-full p-3 border border-gray-300 focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] outline-none transition-all rounded">
                            <option value="">@lang('profile.rating_label')</option>
                            <option value="5">@lang('profile.stars_5')</option>
                            <option value="4">@lang('profile.stars_4')</option>
                            <option value="3">@lang('profile.stars_3')</option>
                            <option value="2">@lang('profile.stars_2')</option>
                            <option value="1">@lang('profile.stars_1')</option>
                        </select>

                        <div>
                            <textarea name="review" id="review-textarea" placeholder="{{ __('common.message_placeholder') }}" required maxlength="250"
                                class="w-full p-3 border border-gray-300 focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] outline-none transition-all rounded"></textarea>
                            <div class="text-right text-xs text-gray-400 mt-1">
                                <span id="char-count">0</span>/250 @lang('profile.characters')
                            </div>
                        </div>

                        <button type="submit" id="submit-btn"
                            class="w-full bg-[#B6171E] text-white px-8 py-3 font-semibold hover:bg-red-800 transition-all duration-300 rounded">
                            @lang('profile.submit_review')
                        </button>
                    </form>

                    <!-- 3. Skrip JavaScript untuk Menangani Kiriman Data & Penghitung Karakter -->
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            const textarea = document.getElementById('review-textarea');
                            const charCount = document.getElementById('char-count');
                            const reviewForm = document.getElementById('review-form');

                            // 1. Fitur Penghitung Karakter Real-time
                            if (textarea && charCount) {
                                textarea.addEventListener('input', function () {
                                    charCount.innerText = this.value.length;
                                });
                            }

                            // 2. Fitur Pengiriman Form AJAX Tanpa Reload
                            if (reviewForm) {
                                reviewForm.addEventListener('submit', function (e) {
                                    e.preventDefault(); // Mencegah halaman reload atau loading muter-muter

                                    let formData = new FormData(this);
                                    let submitBtn = document.getElementById('submit-btn');
                                    let alertBox = document.getElementById('review-alert');
                                    let alertMsg = document.getElementById('alert-message');

                                    // Ubah tombol jadi status memuat sementara
                                    submitBtn.disabled = true;
                                    submitBtn.innerText = '@lang("profile.sending")';

                                    fetch("{{ route('review.store') }}", {
                                        method: "POST",
                                        body: formData,
                                        headers: {
                                            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                                            "Accept": "application/json"
                                        }
                                    })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                // Munculkan kotak hijau dengan pesan dari server
                                                if (alertMsg && alertBox) {
                                                    alertMsg.innerText = data.message;
                                                    alertBox.classList.remove('hidden');
                                                }

                                                // Kosongkan form kembali secara otomatis
                                                reviewForm.reset();

                                                // Reset angka penghitung karakter kembali ke 0
                                                if (charCount) {
                                                    charCount.innerText = '0';
                                                }

                                                // Sembunyikan otomatis kotak hijaunya setelah 10 detik
                                                if (alertBox) {
                                                    setTimeout(() => {
                                                        alertBox.classList.add('hidden');
                                                    }, 10000);
                                                }
                                            }
                                        })
                                        .catch(error => {
                                            alert('@lang("profile.error_generic")');
                                        })
                                        .finally(() => {
                                            // Kembalikan tombol ke keadaan semula
                                            submitBtn.disabled = false;
                                            submitBtn.innerText = '@lang("profile.submit_review")';
                                        });
                                });
                            }
                        });
                    </script>
                </aside>
            </div>

        </div>
    </div>

@endsection
@extends('layouts.app')

@section('content')

    <!-- Wrapper Utama -->
    <div class="py-16">
        <div class="container mx-auto px-6 md:px-12">

            <section class="text-center max-w-3xl mx-auto mb-20">
                <span class="animate-on-scroll text-[#B6171E] font-semibold text-xs uppercase tracking-widest mb-3 inline-block">
                    {{ $setting->profile_badge ?? 'PENERBIT TEPERCAYA' }}
                </span>
                <h1 class="animate-on-scroll delay-100 text-4xl md:text-5xl font-bold font-serif text-stone-900 mb-6 tracking-tight">
                    {{ $setting->profile_title ?? ('Tentang ' . ($setting->company ?? 'Penerbit YAGUWIPA')) }}
                </h1>
                <div class="animate-on-scroll delay-200 text-stone-600 font-sans text-base md:text-lg leading-relaxed mb-8 space-y-4">
                    @php
                        $profileText = $setting->url_popup ?? null;
                    @endphp
                    @if(!empty($profileText))
                        {!! nl2br(e($profileText)) !!}
                    @else
                        <p>
                            Penerbit YAGUWIPA berkomitmen menyebarluaskan hasil riset, IPTEKS, dan karya sastra sebagai bagian dari
                            gerakan literasi. Kami menyediakan layanan penerbitan yang didukung tim profesional di bidang editorial,
                            desain, dan pemasaran untuk menghasilkan karya yang berkualitas, informatif, dan inspiratif.
                        </p>
                        <p>
                            Mari bersama Penerbit YAGUWIPA menghadirkan karya yang memberikan manfaat, memperluas wawasan, dan
                            berkontribusi bagi perkembangan ilmu pengetahuan serta literasi masyarakat.
                        </p>
                    @endif
                </div>
                @php
                    $quoteText = $setting->profile_quote ?? 'Menghubungkan gagasan dengan dunia melalui publikasi yang berkualitas dan berintegritas.';
                    $quoteText = trim($quoteText, '"“”');
                @endphp
                @if(!empty($quoteText))
                    <p class="animate-on-scroll delay-300 text-stone-500 leading-relaxed italic border-t border-stone-200 pt-6 font-serif text-base">
                        "{{ $quoteText }}"
                    </p>
                @endif
            </section>

            <!-- Section: Photo Archive & Documentary -->
            <div class="bg-stone-100/70 border-y border-stone-200/80 pt-16 pb-20 mb-24 w-screen ml-[calc(-50vw+50%)] relative">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 px-6 md:px-12 max-w-7xl mx-auto">

                    <!-- Photo Archive -->
                    <section class="animate-on-scroll">
                        <h2 class="text-2xl font-bold font-serif mb-6 flex items-center gap-2 text-stone-900">
                            {{ $setting->profile_photo_title ?? 'Photo Archive' }}
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            @forelse($albums as $index => $album)
                                <div
                                    class="animate-on-scroll delay-{{ ($index + 1) * 100 }} relative group overflow-hidden rounded-2xl shadow-sm border border-stone-200 aspect-[3/4]">
                                    <img src="{{ asset('storage/' . ($album->fotos->first()->img ?? 'default.jpg')) }}"
                                        alt="{{ $album->title }}"
                                        class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-105">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-3.5">
                                        <span
                                            class="text-white text-xs font-medium drop-shadow truncate">{{ $album->title }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full text-center text-stone-400 py-12 text-sm bg-white rounded-2xl border border-stone-200">
                                    Belum ada foto album.
                                </div>
                            @endforelse

                            <a href="{{ route('photos.all') }}"
                                class="animate-on-scroll delay-600 bg-white border border-stone-200 flex flex-col items-center justify-center font-medium text-xs cursor-pointer hover:border-stone-300 hover:shadow-md transition-all aspect-[3/4] rounded-2xl shadow-2xs text-center p-4 group">
                                <span class="text-stone-900 font-bold text-sm mb-1 group-hover:text-[#B6171E] transition-colors">View All Photos</span>
                                <span class="text-xs text-stone-500 font-normal group-hover:translate-x-0.5 transition-transform">Lihat Semua →</span>
                            </a>
                        </div>
                    </section>

                    <!-- Documentary & Film Section -->
                    <section class="animate-on-scroll delay-200 relative">
                        <h2 class="text-2xl font-bold font-serif mb-6 flex items-center gap-2 text-stone-900">
                            {{ $setting->profile_video_title ?? 'Documentary & Film' }}
                        </h2>

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
                                class="animate-on-scroll delay-300 bg-black aspect-video w-full mb-4 shadow-lg hover:shadow-xl transition-all duration-500 overflow-hidden relative rounded-2xl border border-stone-200">
                                <iframe src="{{ $mainEmbedUrl }}" class="w-full h-full" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                            <div class="mb-5">
                                <h3 class="font-serif font-bold text-stone-900 text-lg leading-snug">{{ $mainVideo->title }}</h3>
                                <p class="text-xs text-stone-400 mt-1">{{ date('d M Y', strtotime($mainVideo->date)) }}</p>
                            </div>
                        @else
                            <div
                                class="animate-on-scroll delay-300 bg-stone-200 aspect-video flex items-center justify-center text-stone-400 text-sm w-full mb-4 rounded-2xl">
                                Belum ada video utama.
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
                                        class="animate-on-scroll delay-{{ 400 + ($index * 100) }} bg-white border border-stone-200/80 rounded-2xl p-3.5 shadow-2xs hover:shadow-md transition-all duration-300 flex flex-col justify-between group">

                                        <a href="{{ $video->source }}" target="_blank"
                                            class="aspect-video bg-black mb-3 overflow-hidden relative rounded-xl shadow-inner block group">
                                            <!-- Gambar Thumbnail -->
                                            <img src="{{ $thumbnailUrl }}" alt="{{ $video->title }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                                            <!-- Overlay & Tombol Play -->
                                            <div
                                                class="absolute inset-0 bg-black/30 group-hover:bg-black/40 transition-colors flex items-center justify-center">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-red-600 text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M8 5v14l11-7z" />
                                                    </svg>
                                                </div>
                                            </div>

                                            <!-- Badge YouTube -->
                                            <span
                                                class="absolute bottom-2 right-2 bg-black/70 text-white text-[10px] font-semibold px-2 py-0.5 rounded-md backdrop-blur-xs">
                                                YouTube
                                            </span>
                                        </a>

                                        <span
                                            class="text-xs font-semibold text-stone-800 truncate block group-hover:text-[#B6171E] transition-colors"
                                            title="{{ $video->title }}">
                                            {{ $video->title }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="mt-6 text-right">
                            <a href="{{ route('videos.all') }}"
                                class="text-sm text-[#B6171E] font-medium hover:underline inline-flex items-center gap-1">
                                Lihat Semua Video &rarr;
                            </a>
                        </div>
                    </section>

                </div>
            </div>

            <!-- Section: Reader Perspectives & Form -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="md:col-span-2">
                    <h2 class="animate-on-scroll text-2xl font-bold font-serif mb-8 text-stone-900">{{ $setting->profile_review_title ?? 'Reader Perspectives' }}</h2>

                    <!-- Kontainer Ulasan dengan ID Auto-Scroll -->
                    <div id="review-auto-scroll-container"
                        class="animate-on-scroll delay-100 overflow-y-auto h-[500px] pr-4 scrollbar-thin scrollbar-thumb-stone-200 scrollbar-track-transparent">

                        @forelse($reviews as $review)
                            <div
                                class="bg-white p-6 border border-stone-200/80 mb-5 shadow-2xs hover:shadow-md transition-all duration-300 rounded-2xl">
                                <!-- Menampilkan Bintang Dinamis Berdasarkan Rating -->
                                <div class="text-amber-400 mb-2.5 text-sm tracking-widest">
                                    {!! str_repeat('★', $review->starts) !!}{!! str_repeat('☆', 5 - $review->starts) !!}
                                </div>
                                <p class="italic mb-4 text-stone-700 leading-relaxed break-words font-serif">"{{ $review->review }}"</p>
                                <p class="font-semibold text-sm text-stone-900">— {{ $review->nama }},
                                    <span class="text-stone-500 font-normal text-xs">{{ $review->pekerjaan }}</span>
                                </p>
                            </div>
                        @empty
                            <div class="bg-white p-6 border border-stone-200 text-center text-stone-400 rounded-2xl italic">
                                Belum ada ulasan yang ditampilkan.
                            </div>
                        @endforelse

                    </div>
                </div>

                <aside
                    class="animate-on-scroll delay-200 bg-white p-8 border border-stone-200/80 shadow-sm self-start rounded-2xl">
                    <h3 class="font-serif font-bold text-xl mb-6 text-stone-900">{{ $setting->profile_form_title ?? 'Share Your Experience' }}</h3>

                    <!-- 1. Tempat Kotak Notifikasi Hijau -->
                    <div id="review-alert"
                        class="hidden mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl transition-all duration-300 text-sm">
                        <span id="alert-message"></span>
                    </div>

                    <!-- 2. Form Ulasan -->
                    <form id="review-form" class="space-y-4">
                        @csrf
                        <input type="text" name="nama" placeholder="Full Name" required
                            class="w-full p-3 border border-stone-200 focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] outline-none transition-all rounded-xl bg-stone-50/50 hover:bg-white text-sm">

                        <input type="text" name="pekerjaan" placeholder="Pekerjaan (Opsional)"
                            class="w-full p-3 border border-stone-200 focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] outline-none transition-all rounded-xl bg-stone-50/50 hover:bg-white text-sm">

                        <select name="starts" required
                            class="w-full p-3 border border-stone-200 focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] outline-none transition-all rounded-xl bg-stone-50/50 hover:bg-white text-sm">
                            <option value="">Rating (1-5)</option>
                            <option value="5">5 Bintang</option>
                            <option value="4">4 Bintang</option>
                            <option value="3">3 Bintang</option>
                            <option value="2">2 Bintang</option>
                            <option value="1">1 Bintang</option>
                        </select>

                        <div>
                            <textarea name="review" id="review-textarea" placeholder="Your Message" required maxlength="250"
                                class="w-full p-3 border border-stone-200 focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] outline-none transition-all rounded-xl bg-stone-50/50 hover:bg-white text-sm"></textarea>
                            <div class="text-right text-xs text-stone-400 mt-1">
                                <span id="char-count">0</span>/250 karakter
                            </div>
                        </div>

                        <button type="submit" id="submit-btn"
                            class="w-full bg-[#B6171E] text-white px-8 py-3.5 font-medium hover:bg-[#9e141a] transition-all duration-200 rounded-xl shadow-sm hover:shadow-md active:scale-95 text-sm">
                            SUBMIT REVIEW
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
                                    submitBtn.innerText = 'MENGIRIM...';

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
                                            alert('Terjadi kesalahan, silakan coba lagi.');
                                        })
                                        .finally(() => {
                                            // Kembalikan tombol ke keadaan semula
                                            submitBtn.disabled = false;
                                            submitBtn.innerText = 'SUBMIT REVIEW';
                                        });
                                });
                            }
                        });
                    </script>
                </aside>
            </div>

            <!-- Section: Lokasi Kantor / Google Maps (Dinamis dari Admin) -->
            @if(!empty($setting->map))
                <section class="mt-20 pt-16 border-t border-stone-200">
                    <div class="text-center max-w-2xl mx-auto mb-10">
                        <span class="text-[#B6171E] font-semibold text-xs uppercase tracking-widest mb-2 inline-block">
                            KUNJUNGI KAMI
                        </span>
                        <h2 class="text-3xl font-bold font-serif text-stone-900 mb-3">{{ $setting->profile_map_title ?? 'Lokasi Kantor Kami' }}</h2>
                        <p class="text-stone-600 text-sm md:text-base">
                            {{ $setting->address ?? 'Jln. Ganetri IV No. 4 DPS 80237 Bali' }}
                        </p>
                    </div>
                    <div class="rounded-2xl overflow-hidden border border-stone-200/80 shadow-md aspect-video sm:aspect-[21/9] w-full max-w-5xl mx-auto [&>iframe]:w-full [&>iframe]:h-full [&>iframe]:border-0">
                        {!! $setting->map !!}
                    </div>
                </section>
            @endif

        </div>
    </div>

@endsection
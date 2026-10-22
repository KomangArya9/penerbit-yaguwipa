<footer class="bg-[#181515] text-stone-200 pt-16 border-t border-stone-800">
    <!-- Konten Utama -->
    <div class="container mx-auto px-4 md:px-12 mb-16">
        <!-- Tambahkan text-left untuk memastikan teks rata kiri di semua ukuran layar -->
        <div class="flex flex-col md:flex-row justify-between gap-12 text-left">

            <!-- Kolom 1: Informasi & Sosial Media -->
            <div class="w-full md:w-1/3 space-y-6">
                <div class="w-48">
                    @if($setting && $setting->logo)
                        <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo Penerbit Yaguwipa"
                            class="w-full h-auto">
                    @else
                        <img src="{{ asset('images/logo-footer.png') }}" alt="Logo Penerbit Yaguwipa" class="w-full h-auto">
                    @endif
                </div>

                <!-- Alamat dinamis dari database -->
                <p class="text-sm text-stone-300 leading-relaxed">
                    {{ $setting->address ?? 'Jln. Ganetri IV No. 4 DPS 80237 Bali' }}
                </p>

                <div class="text-sm text-stone-300 space-y-2">
                    <!-- Phone / Kontak dinamis dari database Kontak Kami -->
                    @if(isset($kontakList) && $kontakList->whereIn('type', ['Whatsapp', 'Call'])->isNotEmpty())
                        @foreach($kontakList->whereIn('type', ['Whatsapp', 'Call']) as $k)
                            <p><span class="font-semibold text-white">{{ $k->title }}:</span> {{ $k->kontak }}</p>
                        @endforeach
                    @elseif(!empty($setting->phone))
                        <p><span class="font-semibold text-white">Phone:</span> {{ $setting->phone }}</p>
                    @endif

                    <!-- Email dinamis dari database -->
                    @if(isset($kontakList) && $kontakList->where('type', 'Email')->isNotEmpty())
                        @foreach($kontakList->where('type', 'Email') as $e)
                            <p><span class="font-semibold text-white">{{ $e->title }}:</span> {{ $e->kontak }}</p>
                        @endforeach
                    @elseif(!empty($setting->email))
                        <p><span class="font-semibold text-white">Email:</span> {{ $setting->email }}</p>
                    @endif

                    <!-- Website dinamis dari database -->
                    @if(!empty($setting->website))
                        <p><span class="font-semibold text-white">Website:</span> {{ $setting->website }}</p>
                    @endif
                </div>

                @php
                    $allMedia = \App\Models\Media::all();
                @endphp
                @if($allMedia->isNotEmpty())
                    <div>
                        <h3 class="text-white font-bold text-sm uppercase tracking-wider mb-4">Sosial Media</h3>
                        <div class="flex flex-wrap gap-3">
                            @foreach($allMedia as $m)
                                @php
                                    $titleLower = strtolower(trim($m->title));
                                    $urlLower = strtolower(trim($m->url));
                                    $isYoutube = str_contains($titleLower, 'youtube') || str_contains($titleLower, 'yt') || str_contains($urlLower, 'youtube.com') || str_contains($urlLower, 'youtu.be');
                                    $isWhatsapp = str_contains($titleLower, 'whatsapp') || str_contains($titleLower, 'wa') || str_contains($urlLower, 'wa.me') || str_contains($urlLower, 'whatsapp.com');
                                    $isTiktok = str_contains($titleLower, 'tiktok') || str_contains($urlLower, 'tiktok.com');
                                    $isInstagram = str_contains($titleLower, 'instagram') || str_contains($titleLower, 'ig') || str_contains($urlLower, 'instagram.com');
                                    $isFacebook = str_contains($titleLower, 'facebook') || str_contains($titleLower, 'fb') || str_contains($urlLower, 'facebook.com');
                                    $isTwitter = str_contains($titleLower, 'twitter') || str_contains($titleLower, ' x ') || $titleLower === 'x' || str_contains($urlLower, 'twitter.com') || str_contains($urlLower, 'x.com');
                                    $isLinkedin = str_contains($titleLower, 'linkedin') || str_contains($urlLower, 'linkedin.com');
                                @endphp
                                <a href="{{ $m->url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $m->title }}" title="{{ $m->title }}"
                                    class="w-10 h-10 flex items-center justify-center rounded-full bg-white/10 hover:bg-[#B6171E] border border-white/10 text-white transition-all duration-200 hover:scale-105 active:scale-95">
                                    @if($isYoutube)
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                        </svg>
                                    @elseif($isWhatsapp)
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28" />
                                        </svg>
                                    @elseif($isTiktok)
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.77 0 2.89 2.89 0 0 1 2.5-2.87V9.3a6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.34-6.34V6.57a8.55 8.55 0 0 0 4.5 1.32v-3.4z" />
                                        </svg>
                                    @elseif($isInstagram)
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5" />
                                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" />
                                            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5" />
                                        </svg>
                                    @elseif($isFacebook)
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                        </svg>
                                    @elseif($isTwitter)
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                        </svg>
                                    @elseif($isLinkedin)
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                        </svg>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Bagian Kanan: Sitemap & Services -->
            <div class="flex flex-col sm:flex-row justify-start md:justify-end gap-10 sm:gap-16 md:gap-24 w-full md:w-2/3">
                <!-- Sitemap (Dinamis dari Menu Manager Admin) -->
                <div>
                    <h3 class="font-bold text-lg mb-6 text-white tracking-wide">Sitemap</h3>
                    <ul class="space-y-3 text-sm text-stone-300">
                        @if(isset($menus) && $menus->count() > 0)
                            @foreach($menus as $m)
                                @php
                                    $mUrl = strtolower($m->title) === 'home' ? '/' : '/' . ltrim($m->url, '/');
                                @endphp
                                <li>
                                    <a href="{{ $mUrl }}" class="hover:text-white hover:translate-x-1 inline-flex items-center gap-1.5 transition-all duration-200">
                                        › {{ $m->title }}
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <li><a href="/" class="hover:text-white hover:translate-x-1 inline-flex items-center gap-1.5 transition-all duration-200">› Home</a></li>
                            <li><a href="/profile" class="hover:text-white hover:translate-x-1 inline-flex items-center gap-1.5 transition-all duration-200">› Profil</a></li>
                            <li><a href="/program" class="hover:text-white hover:translate-x-1 inline-flex items-center gap-1.5 transition-all duration-200">› Program</a></li>
                            <li><a href="/portofolio" class="hover:text-white hover:translate-x-1 inline-flex items-center gap-1.5 transition-all duration-200">› Portofolio</a></li>
                            <li><a href="/penulis" class="hover:text-white hover:translate-x-1 inline-flex items-center gap-1.5 transition-all duration-200">› Penulis</a></li>
                            <li><a href="/katalog" class="hover:text-white hover:translate-x-1 inline-flex items-center gap-1.5 transition-all duration-200">› Katalog</a></li>
                            <li><a href="/partners" class="hover:text-white hover:translate-x-1 inline-flex items-center gap-1.5 transition-all duration-200">› Partners & Client</a></li>
                            <li><a href="/news" class="hover:text-white hover:translate-x-1 inline-flex items-center gap-1.5 transition-all duration-200">› News & Events</a></li>
                        @endif
                    </ul>
                </div>

                <!-- Services (Dinamis dari Program Admin) -->
                <div>
                    <h3 class="font-bold text-lg mb-6 text-white tracking-wide">Services</h3>
                    <ul class="space-y-3 text-sm text-stone-300">
                        @php
                            $dbServices = \App\Models\Program::where('status', 'Show')->orWhereNull('status')->get();
                            $defaultServices = [
                                'Manuscript Coaching' => 'manuscript-coaching',
                                'Plagiarism Check' => 'plagiarism-check',
                                'Full Package Publishing' => 'full-package-publishing',
                                'HKI' => 'hki',
                                'Cataloging' => 'cataloging',
                                'Kolaborasi' => 'kolaborasi',
                                'Editing' => 'editing',
                                'Setting Layout' => 'setting-layout',
                                'Cover Design' => 'cover-design',
                                'Percetakan' => 'percetakan',
                                'Terbitkan Jurnal ber-ISSN' => 'terbitkan-jurnal-ber-issn',
                                'Buku ber-ISBN' => 'buku-ber-isbn'
                            ];
                        @endphp

                        @if($dbServices->count() > 0)
                            @foreach($dbServices as $srv)
                                <li>
                                    <a href="{{ url('/program#' . ($srv->slug ?? Str::slug($srv->title))) }}"
                                        class="hover:text-white hover:translate-x-1 inline-flex items-center gap-1.5 transition-all duration-200">
                                        › {{ $srv->title }}
                                    </a>
                                </li>
                            @endforeach
                        @else
                            @foreach($defaultServices as $title => $slug)
                                <li>
                                    <a href="{{ url('/program#' . $slug) }}"
                                        class="hover:text-white hover:translate-x-1 inline-flex items-center gap-1.5 transition-all duration-200 {{ $title == 'Terbitkan Jurnal ber-ISSN' ? 'whitespace-nowrap' : '' }}">
                                        › {{ $title }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright Section (Dinamis dari database) -->
    <div class="bg-[#121010] w-full py-6 border-t border-stone-800">
        <div
            class="container mx-auto px-4 md:px-12 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-stone-400">
            <p>{{ $setting->copyright ?? '&copy; ' . date('Y') . ' Penerbit Yaguwipa - Bergerak Menerbit Karya. All Rights Reserved.' }}
            </p>
            <p class="text-stone-400 font-medium">{{ $setting->footer_credit ?? 'Designed by Yaguwipa Tech Team' }}</p>
        </div>
    </div>
</footer>
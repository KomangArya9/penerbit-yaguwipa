<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $setting->meta_title ?? $setting->company ?? 'Penerbit Yaguwipa' }}</title>

    @if(isset($setting) && $setting->favicon)
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $setting->favicon) }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @endif

    @if(isset($setting) && $setting->meta_description)
        <meta name="description" content="{{ Str::limit(strip_tags($setting->meta_description), 160) }}">
    @endif

    @if(isset($blog) && $blog->keyword)
        <meta name="keywords" content="{{ $blog->keyword }}">
    @elseif(isset($setting) && $setting->fax)
        <meta name="keywords" content="{{ $setting->fax }}">
    @endif

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Google Fonts untuk font serif elegan -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">

    <!-- Vite akan mengolah @import "tailwindcss" di app.css -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Website Translator Helper -->
    <style>
        /* Sembunyikan SEMUA variasi banner dan toolbar Google Translate */
        .goog-te-banner-frame,
        .goog-te-banner-frame.skiptranslate,
        iframe.goog-te-banner-frame,
        iframe[id*=":1.container"],
        iframe[id*=":2.container"],
        iframe[class*="goog-te-banner"],
        iframe[class*="skiptranslate"],
        iframe[src*="translate.google"],
        .VIpgJd-ZVi9od-ORHb-OEVmcd,
        .VIpgJd-ZVi9od-aZ2wEe-wOHMyf,
        .VIpgJd-ZVi9od-ORHb,
        #goog-gt-tt,
        .goog-te-balloon-frame {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
            height: 0px !important;
            width: 0px !important;
            pointer-events: none !important;
            position: fixed !important;
            top: -9999px !important;
            left: -9999px !important;
            z-index: -99999 !important;
        }
        html, body {
            top: 0px !important;
            position: static !important;
            margin-top: 0px !important;
            padding-top: 0px !important;
        }
        .goog-text-highlight {
            background-color: transparent !important;
            box-shadow: none !important;
        }
        #google_translate_element {
            position: fixed !important;
            left: -9999px !important;
            top: -9999px !important;
            width: 1px !important;
            height: 1px !important;
            opacity: 0 !important;
            pointer-events: none !important;
            z-index: -9999 !important;
        }
    </style>

    <script type="text/javascript">
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
            return null;
        }

        function getActiveLanguage() {
            const googtrans = getCookie('googtrans');
            if (googtrans) {
                const parts = googtrans.split('/');
                if (parts.length >= 3 && parts[2]) {
                    return parts[2].toUpperCase();
                }
            }
            return (localStorage.getItem('site_lang') || 'ID').toUpperCase();
        }

        function changeSiteLanguage(targetLang) {
            const code = targetLang.toLowerCase();
            const domain = window.location.hostname;

            localStorage.setItem('site_lang', code.toUpperCase());
            window.dispatchEvent(new CustomEvent('site-language-changed', { detail: code.toUpperCase() }));

            if (code === 'id') {
                document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=" + domain;
                document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=." + domain;
                const hostParts = domain.split('.');
                if (hostParts.length > 1) {
                    document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=." + hostParts.slice(-2).join('.');
                }
            } else {
                const cookieVal = '/id/' + code;
                const maxAge = '; max-age=31536000; path=/';
                document.cookie = "googtrans=" + cookieVal + maxAge;
                document.cookie = "googtrans=" + cookieVal + maxAge + "; domain=" + domain;
                document.cookie = "googtrans=" + cookieVal + maxAge + "; domain=." + domain;
                const hostParts = domain.split('.');
                if (hostParts.length > 1) {
                    document.cookie = "googtrans=" + cookieVal + maxAge + "; domain=." + hostParts.slice(-2).join('.');
                }
            }

            const select = document.querySelector('.goog-te-combo');
            if (select) {
                select.value = code;
                select.dispatchEvent(new Event('change'));
                if (code === 'id') {
                    setTimeout(() => { window.location.reload(); }, 250);
                }
            } else {
                window.location.reload();
            }
        }

        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'id',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                autoDisplay: false
            }, 'google_translate_element');
        }

        // Anti-Banner Watcher: Memastikan Google Translate banner tidak pernah muncul di layar
        (function() {
            function suppressGoogleBanner() {
                if (document.body && (document.body.style.top !== '0px' && document.body.style.top !== '')) {
                    document.body.style.setProperty('top', '0px', 'important');
                    document.body.style.setProperty('position', 'static', 'important');
                }
                if (document.documentElement && (document.documentElement.style.top !== '0px' && document.documentElement.style.top !== '')) {
                    document.documentElement.style.setProperty('top', '0px', 'important');
                }
                const bannerIframes = document.querySelectorAll('iframe.goog-te-banner-frame, iframe[id*=":1.container"], iframe[class*="skiptranslate"], iframe[class*="VIpgJd"], .VIpgJd-ZVi9od-ORHb-OEVmcd');
                bannerIframes.forEach(el => {
                    el.style.setProperty('display', 'none', 'important');
                    el.style.setProperty('visibility', 'hidden', 'important');
                    el.style.setProperty('height', '0px', 'important');
                    el.style.setProperty('width', '0px', 'important');
                    el.style.setProperty('top', '-9999px', 'important');
                    el.style.setProperty('position', 'fixed', 'important');
                    el.style.setProperty('pointer-events', 'none', 'important');
                });
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', suppressGoogleBanner);
            } else {
                suppressGoogleBanner();
            }

            window.addEventListener('load', suppressGoogleBanner);
            setInterval(suppressGoogleBanner, 150);

            if (window.MutationObserver) {
                const observer = new MutationObserver(suppressGoogleBanner);
                observer.observe(document.documentElement, {
                    childList: true,
                    subtree: true,
                    attributes: true,
                    attributeFilter: ['style', 'class']
                });
            }
        })();
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    @if(isset($setting) && !empty($setting->script))
        {!! $setting->script !!}
    @endif

</head>

<body class="antialiased bg-[#FAF9F6] text-stone-900 selection:bg-red-500/15 selection:text-[#B6171E] overflow-x-hidden min-h-screen flex flex-col">

    @include('components.navbar')

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('components.footer')

    <!-- Tombol WhatsApp & Kontak Floating (Dinamis dari Kontak Kami & Pengaturan Admin) -->
    @php
        $floatingContacts = collect();
        if (isset($kontakList)) {
            $floatingContacts = $kontakList->filter(function($k) {
                $type = strtolower($k->type ?? '');
                $title = strtolower($k->title ?? '');
                return in_array($type, ['whatsapp', 'call']) || str_contains($title, 'wa') || str_contains($title, 'whatsapp') || str_contains($title, 'call') || str_contains($title, 'telepon');
            })->map(function($k) {
                $type = strtolower($k->type ?? '');
                $title = strtolower($k->title ?? '');
                $isCall = ($type === 'call' || (str_contains($title, 'call') && !str_contains($title, 'wa')));

                $digits = preg_replace('/[^0-9]/', '', $k->kontak);
                $cleanWa = $digits;
                if (str_starts_with($cleanWa, '0')) {
                    $cleanWa = '62' . substr($cleanWa, 1);
                }

                $k->is_call = $isCall;
                $k->action_url = $isCall ? 'tel:' . preg_replace('/[^0-9+]/', '', $k->kontak) : 'https://wa.me/' . $cleanWa;
                $k->action_target = $isCall ? '_self' : '_blank';
                return $k;
            });
        }

        if ($floatingContacts->isEmpty() && !empty($setting->phone)) {
            $cleanDigits = preg_replace('/[^0-9]/', '', $setting->phone);
            if (str_starts_with($cleanDigits, '0')) {
                $cleanDigits = '62' . substr($cleanDigits, 1);
            }
            if (!empty($cleanDigits)) {
                $floatingContacts = collect([
                    (object)[
                        'title' => 'Admin Penerbit',
                        'kontak' => $setting->phone,
                        'is_call' => false,
                        'action_url' => 'https://wa.me/' . $cleanDigits,
                        'action_target' => '_blank'
                    ]
                ]);
            }
        }
    @endphp

    @if($floatingContacts->isNotEmpty())
        @if($floatingContacts->count() === 1)
            @php $singleContact = $floatingContacts->first(); @endphp
            <a href="{{ $singleContact->action_url }}" target="{{ $singleContact->action_target }}" rel="noopener noreferrer" aria-label="Hubungi Kami"
                class="fixed bottom-6 right-6 z-50 {{ $singleContact->is_call ? 'bg-sky-600 hover:bg-sky-700 shadow-sky-900/20' : 'bg-[#25D366] hover:bg-[#20ba59] shadow-emerald-900/20' }} text-white p-3.5 rounded-full shadow-lg hover:shadow-xl hover:scale-105 active:scale-95 transition-all duration-300 flex items-center justify-center border-2 border-white">
                @if($singleContact->is_call)
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                @else
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28" />
                    </svg>
                @endif
            </a>
        @else
            <!-- Multi-Contact Popup (WhatsApp & Call) -->
            <div x-data="{ openWa: false }" class="fixed bottom-6 right-6 z-50">
                <div x-show="openWa" @click.away="openWa = false" x-cloak
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                    class="absolute bottom-16 right-0 mb-2 w-64 bg-white rounded-2xl shadow-xl border border-stone-200/80 p-3 space-y-1.5">
                    
                    <!-- Header Minimalis -->
                    <div class="flex items-center justify-between px-2 pt-0.5 pb-2 border-b border-stone-100">
                        <span class="text-xs font-semibold text-stone-800 tracking-tight">Hubungi Kami</span>
                        <button @click="openWa = false" class="text-stone-400 hover:text-stone-700 transition p-0.5 rounded-md hover:bg-stone-100 cursor-pointer">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Daftar Kontak -->
                    <div class="space-y-1">
                        @foreach($floatingContacts as $item)
                            <a href="{{ $item->action_url }}" target="{{ $item->action_target }}"
                                class="flex items-center gap-3 p-2 rounded-xl {{ $item->is_call ? 'hover:bg-sky-50/70' : 'hover:bg-emerald-50/70' }} transition-colors group">
                                <div class="w-8 h-8 rounded-full {{ $item->is_call ? 'bg-sky-600 text-white' : 'bg-[#25D366] text-white' }} flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                                    @if($item->is_call)
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                            <path d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28" />
                                        </svg>
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1 text-left">
                                    <div class="text-xs font-semibold text-stone-800 truncate {{ $item->is_call ? 'group-hover:text-sky-700' : 'group-hover:text-emerald-700' }} transition-colors">{{ $item->title }}</div>
                                    <div class="text-[11px] text-stone-400 font-mono">{{ $item->kontak }}</div>
                                </div>
                                <svg class="w-4 h-4 text-stone-300 {{ $item->is_call ? 'group-hover:text-sky-600' : 'group-hover:text-emerald-600' }} group-hover:translate-x-0.5 transition-all shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @endforeach
                    </div>
                </div>

                <button @click="openWa = !openWa" aria-label="Hubungi Kami"
                    class="bg-[#25D366] text-white p-3.5 rounded-full shadow-lg shadow-emerald-900/20 hover:shadow-xl hover:scale-105 active:scale-95 transition-all duration-300 flex items-center justify-center border-2 border-white cursor-pointer">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28" />
                    </svg>
                </button>
            </div>
        @endif
    @endif

    <script>

        document.addEventListener("DOMContentLoaded", function () {



            // --- BAGIAN 1: ANIMASI SCROLL (Global) ---

            // Mendeteksi semua class animasi agar berjalan efisien dalam satu observer

            const scrollObserver = new IntersectionObserver((entries) => {

                entries.forEach(entry => {

                    if (entry.isIntersecting) {

                        entry.target.classList.add('active');

                        scrollObserver.unobserve(entry.target);

                    }

                });

            }, { threshold: 0.1 });



            // Mengamati semua jenis class animasi yang ada di website

            // Penambahan '.animate-card' agar kartu berita menunggu scroll

            const animatedElements = [

                '.animate-on-scroll',

                '.animate-fade-left',

                '.animate-fade-right',

                '.portfolio-entry',

                '.animate-card'

            ];



            document.querySelectorAll(animatedElements.join(',')).forEach(el => {

                scrollObserver.observe(el);

            });



            // --- BAGIAN 2: SLIDER TESTIMONI ---

            const slider = document.getElementById('testimoni-slider');

            if (slider) {

                const activeObserver = new IntersectionObserver((entries) => {

                    entries.forEach(entry => {

                        const card = entry.target;

                        if (entry.isIntersecting) card.classList.add('active-card');

                        else card.classList.remove('active-card');

                    });

                }, { root: slider, threshold: 0.6 });



                const cards = document.querySelectorAll('.card-item');

                cards.forEach(el => activeObserver.observe(el));

                setTimeout(() => { if (cards[0]) cards[0].classList.add('active-card'); }, 100);



                let isDown = false, startX, scrollLeft;

                slider.addEventListener('mousedown', (e) => {

                    isDown = true;

                    slider.style.cursor = 'grabbing';

                    startX = e.pageX - slider.offsetLeft;

                    scrollLeft = slider.scrollLeft;

                });

                slider.addEventListener('mouseleave', () => { isDown = false; slider.style.cursor = 'grab'; });

                slider.addEventListener('mouseup', () => { isDown = false; slider.style.cursor = 'grab'; });

                slider.addEventListener('mousemove', (e) => {

                    if (!isDown) return;

                    e.preventDefault();

                    const x = e.pageX - slider.offsetLeft;

                    const walk = (x - startX) * 2;

                    slider.scrollLeft = scrollLeft - walk;

                });

            }



            // --- BAGIAN 3: CONTINUOUS AUTO-SCROLL (Reader Perspectives) ---

            const reviewContainer = document.getElementById('review-auto-scroll-container');

            if (reviewContainer) {

                let isUserInteracting = false;

                let requestID;



                function animateScroll() {

                    if (!isUserInteracting) {

                        reviewContainer.scrollTop += 1;

                        if (reviewContainer.scrollTop >= (reviewContainer.scrollHeight - reviewContainer.clientHeight)) {

                            reviewContainer.scrollTop = 0;

                        }

                    }

                    requestID = requestAnimationFrame(animateScroll);

                }



                reviewContainer.addEventListener('mouseenter', () => { isUserInteracting = true; });

                reviewContainer.addEventListener('mouseleave', () => { isUserInteracting = false; });

                reviewContainer.addEventListener('scroll', () => {

                    isUserInteracting = true;

                    clearTimeout(window.scrollManualTimeout);

                    window.scrollManualTimeout = setTimeout(() => { isUserInteracting = false; }, 2500);

                }, { passive: true });



                animateScroll();

            }

        });



        // --- BAGIAN 4: FUNGSI TOMBOL PANAH (Global) ---

        function scrollSlider(direction) {

            const slider = document.getElementById('testimoni-slider');

            if (!slider) return;

            const cardWidth = slider.querySelector('.card-item').offsetWidth + 24;

            slider.scrollBy({ left: direction * cardWidth, behavior: 'smooth' });

        }

    </script>


</body>

</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', App::getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penerbit Yaguwipa</title>

    @if(isset($blog) && $blog->keyword)
        <meta name="keywords" content="{{ $blog->keyword }}">
    @endif

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Google Fonts untuk font serif elegan -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">

    <!-- Vite akan mengolah @import "tailwindcss" di app.css -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Translate Init - WITH DEBUGGING -->
    <script>
        console.log('[GT-DEBUG] ============================================');
        console.log('[GT-DEBUG] Tahap 1: Script loading...');

        function googleTranslateElementInit() {
            console.log('[GT-DEBUG] Tahap 2: googleTranslateElementInit() CALLED');
            console.log('[GT-DEBUG] google.translate.TranslateElement exists:', typeof google?.translate?.TranslateElement);

            try {
                var container = document.getElementById('google_translate_element');
                console.log('[GT-DEBUG] Tahap 3: #google_translate_element found:', !!container);

                var instance = new google.translate.TranslateElement({
                    pageLanguage: 'id',
                    autoDisplay: false
                }, 'google_translate_element');

                console.log('[GT-DEBUG] Tahap 3: TranslateElement instance created:', instance);
            } catch(err) {
                console.error('[GT-DEBUG] Tahap 3 FATAL ERROR:', err.message);
            }
        }
    </script>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <!-- Hide Google Translate Banner & Monitor DOM -->
    <script>
        function hideGoogleBanner() {
            // Hide the banner frame
            document.querySelectorAll('.goog-te-banner-frame').forEach(function(el) {
                el.style.display = 'none';
            });
            // Hide skiptranslate overlay
            document.querySelectorAll('.skiptranslate').forEach(function(el) {
                if (el.id !== 'google_translate_element') {
                    el.style.display = 'none';
                }
            });
            // Reset body position
            document.body.style.top = '0px';
        }

        // Run cleanup after load
        window.addEventListener('load', function() {
            hideGoogleBanner();
            // Run again after delay to catch late injections
            setTimeout(hideGoogleBanner, 1000);
            setTimeout(hideGoogleBanner, 3000);

            console.log('[GT-DEBUG] ============================================');
            console.log('[GT-DEBUG] Tahap 4: window.load fired');
            console.log('[GT-DEBUG] .goog-te-combo found:', !!document.querySelector('.goog-te-combo'));
            console.log('[GT-DEBUG] ============================================');
        });

        // MutationObserver to catch banner injection
        var bannerObserver = new MutationObserver(function() {
            hideGoogleBanner();
        });
        document.addEventListener('DOMContentLoaded', function() {
            bannerObserver.observe(document.body, { childList: true, subtree: true });
        });
    </script>

    <!-- Hide Google Translate Default UI -->
    <style>
        .goog-te-banner-frame { display: none !important; }
        .goog-te-gadget-simple { visibility: hidden !important; position: absolute !important; left: -9999px !important; }
        .goog-te-gadget .goog-te-combo { position: absolute !important; left: -9999px !important; opacity: 0 !important; }
        body { top: 0 !important; }
        #google_translate_element { position: absolute; left: -9999px; top: -9999px; }
    </style>

</head>

<body class="antialiased bg-gray-50 text-gray-900">

    <!-- Google Translate Container -->
    <div id="google_translate_element"></div>

    @include('components.navbar')

    <main>
        @yield('content')
    </main>

    @include('components.footer')

    <!-- Floating Contact FAB (dari tabel kontak_kami) -->
    @php $allContacts = App\Models\KontakKami::all(); @endphp
    @if($allContacts->count() > 0)
        <style>
            .fab-main-btn {
                background: linear-gradient(135deg, #B6171E 0%, #8B1118 100%);
                transition: all 0.3s ease;
            }
            .fab-main-btn:hover {
                transform: translateY(-2px) scale(1.05);
                box-shadow: 0 8px 25px rgba(182, 23, 30, 0.4);
            }
            .fab-option {
                transition: all 0.25s ease;
            }
            .fab-option:hover {
                background-color: #fef2f2;
                padding-left: 16px;
            }
            .fab-tooltip {
                opacity: 0;
                transition: opacity 0.3s ease;
                pointer-events: none;
            }
            .fab-group:hover .fab-tooltip {
                opacity: 1;
            }
            @keyframes fab-soft-pulse {
                0%, 100% { box-shadow: 0 4px 15px rgba(182, 23, 30, 0.3); }
                50% { box-shadow: 0 4px 20px rgba(182, 23, 30, 0.5); }
            }
            .fab-main-btn {
                animation: fab-soft-pulse 3s ease-in-out infinite;
            }
            .fab-main-btn:hover {
                animation: none;
            }
        </style>

        <div x-data="{ open: false }" class="fixed bottom-6 right-6 z-50 flex flex-col items-end gap-3">

            <!-- Panel Opsi Kontak -->
            <div x-show="open" x-cloak
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0 translate-y-2"
                class="bg-white rounded-xl shadow-xl border border-gray-100 p-3 min-w-[240px]">

                <!-- Header -->
                <div class="px-2 pb-2 mb-2 border-b border-gray-100">
                    <p class="text-xs font-semibold text-[#B6171E] uppercase tracking-wide">Kontak Kami</p>
                </div>

                <!-- Opsi -->
                @foreach($allContacts as $contact)
                    @php
                        $type = strtolower($contact->type);
                        $value = $contact->kontak;
                        $title = $contact->title;

                        if($type === 'whatsapp') {
                            $url = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $value);
                            $iconBg = 'bg-[#25D366]';
                        } elseif($type === 'call') {
                            $url = 'tel:' . preg_replace('/[^0-9]/', '', $value);
                            $iconBg = 'bg-[#B6171E]';
                        } elseif($type === 'email') {
                            $url = 'mailto:' . $value;
                            $iconBg = 'bg-gray-700';
                        } else {
                            $url = '#';
                            $iconBg = 'bg-gray-500';
                        }
                    @endphp
                    <a href="{{ $url }}" target="_blank" rel="noopener"
                        class="fab-option flex items-center gap-3 px-3 py-2.5 rounded-lg">
                        <div class="w-9 h-9 {{ $iconBg }} rounded-full flex items-center justify-center flex-shrink-0 shadow-sm">
                            @if($type === 'whatsapp')
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            @elseif($type === 'call')
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            @elseif($type === 'email')
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                            @else
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/></svg>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-800">{{ $title }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ $value }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Tombol Utama -->
            <div class="relative fab-group flex items-center gap-3">
                <!-- Tooltip muncul saat hover -->
                <div class="fab-tooltip bg-gray-800 text-white text-xs font-medium px-3 py-1.5 rounded-lg whitespace-nowrap shadow-lg">
                    Kontak Kami
                </div>
                <button @click="open = !open"
                    class="fab-main-btn w-14 h-14 rounded-full text-white shadow-lg flex items-center justify-center focus:outline-none">
                    <!-- Icon chat bubble (saat tertutup) -->
                    <svg x-show="!open" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                    <!-- Icon X (saat terbuka) -->
                    <svg x-show="open" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
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
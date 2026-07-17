<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penerbit Yaguwipa</title>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Google Fonts untuk font serif elegan -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">

    <!-- Vite akan mengolah @import "tailwindcss" di app.css -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="antialiased bg-gray-50 text-gray-900">

    @include('components.navbar')

    <main>
        @yield('content')
    </main>

    @include('components.footer')

    <!-- Tombol WhatsApp Floating -->
    <a href="https://wa.me/6281234567890" target="_blank"
        class="fixed bottom-6 right-6 z-50 bg-[#25D366] p-4 rounded-full shadow-lg hover:scale-110 transition-all duration-300 flex items-center justify-center">
        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
            width="1em" height="1em" viewBox="0 0 24 24">
            <path d="M0 0h24v24H0z" fill="none" />
            <path fill="currentColor"
                d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28" />
        </svg>
    </a>

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
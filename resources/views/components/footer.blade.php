<footer class="bg-[#1B1717] text-white pt-16">
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
                <p class="text-sm text-gray-100 leading-relaxed">
                    {{ $setting->address ?? 'Jln. Ganetri IV No. 4 DPS 80237 Bali' }}
                </p>

                <div class="text-sm text-gray-100 space-y-2">
                    <!-- Phone dinamis dari database -->
                    <p><span class="font-semibold text-white">Phone:</span> {{ $setting->phone ?? '+62 8113996698' }}
                    </p>

                    <!-- Email dinamis dari database -->
                    <p><span class="font-semibold text-white">Email:</span> {{ $setting->email ??
                        'partners@penerbityaguwipa.id' }}</p>

                    <!-- Website dinamis dari database -->
                    <p><span class="font-semibold text-white">Website:</span>
                        {{ $setting->website ?? 'www.penerbityaguwipa.id' }}</p>
                </div>

                <div>
                    <h3 class="text-white font-bold mb-4">Sosial Media</h3>
                    <div class="flex gap-4">
                        <!-- Ikon Sosial Media -->
                        <a href="https://www.youtube.com/@yaguwipapublisher"
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-[#1E293B] hover:bg-red-600 transition"><svg
                                class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg></a>
                        <a href="https://wa.me/628113996698"
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-[#1E293B] hover:bg-green-600 transition"><svg
                                class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path fill="currentColor"
                                    d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28" />
                            </svg>
                        </a>
                        <a href="https://tiktok.com/@yaguwipa.publishe"
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-[#1E293B] hover:bg-black transition"><svg
                                class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.77 0 2.89 2.89 0 0 1 2.5-2.87V9.3a6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.34-6.34V6.57a8.55 8.55 0 0 0 4.5 1.32v-3.4z" />
                            </svg></a>
                        <a href="https://instagram.com/penerbityaguwipa"
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-[#1E293B] hover:bg-pink-600 transition"><svg
                                class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <rect width="20" height="20" x="2" y="2" rx="5" ry="5" />
                                <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" />
                                <line x1="17.5" x2="17.51" y1="6.5" y2="6.5" />
                            </svg></a>
                    </div>
                </div>
            </div>

            <!-- Bagian Kanan: Sitemap & Services -->
            <div class="flex flex-row justify-start md:justify-end gap-16 md:gap-24 w-full md:w-2/3">
                <!-- Sitemap -->
                <div>
                    <h3 class="font-bold text-lg mb-6 text-white">Sitemap</h3>
                    <ul class="space-y-3 text-sm text-gray-100">
                        <li><a href="/" class="hover:underline transition">› Home</a></li>
                        <li><a href="/profile" class="hover:underline transition">› Profil</a></li>
                        <li><a href="/program" class="hover:underline transition">› Program</a></li>
                        <li><a href="/portofolio" class="hover:underline transition">› Portofolio</a></li>
                        <li><a href="/penulis" class="hover:underline transition">› Penulis</a></li>
                        <li><a href="/katalog" class="hover:underline transition">› Katalog</a></li>
                        <li><a href="/partners" class="hover:underline transition">› Partners & Client</a></li>
                        <li><a href="/news" class="hover:underline transition">› News & Events</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div>
                    <h3 class="font-bold text-lg mb-6 text-white">Services</h3>
                    <ul class="space-y-3 text-sm text-gray-100">
                        @php
                            $servicesList = [
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

                        @foreach($servicesList as $title => $slug)
                            <li>
                                <a href="{{ url('/program#' . $slug) }}"
                                    class="hover:underline transition {{ $title == 'Terbitkan Jurnal ber-ISSN' ? 'whitespace-nowrap' : '' }}">
                                    › {{ $title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright Section (Dinamis dari database) -->
    <div class="bg-[#1B1717] w-full py-8 border-t-2 border-gray-700">
        <div
            class="container mx-auto px-4 md:px-12 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-300">
            <p>{{ $setting->copyright ?? '&copy; 2026 Penerbit Yaguwipa - Bergerak Menerbit Karya. All Rights Reserved.' }}
            </p>
            <p>Designed by Yaguwipa Tech Team</p>
        </div>
    </div>
</footer>
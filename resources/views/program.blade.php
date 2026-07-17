@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-16">

        <!-- Judul Header -->
        <div class="text-center mb-16 animate-on-scroll delay-100">
            <h2 class="text-3xl font-bold text-gray-900 mb-3">Program Kerja Kami</h2>
            <p class="text-gray-600 text-sm max-w-lg mx-auto">
                Dedikasi kami untuk menyediakan ekosistem penerbitan yang menyeluruh dari naskah hingga distribusi.
            </p>
        </div>

        @php
            // Perbaikan: Ubah menjadi array satu tingkat saja 
            $programs = [
                [
                    'title' => 'Manuscript Coaching',
                    'desc' => 'Layanan Manuscript Coaching yang disediakan oleh Penerbit Yaguwipa dirancang khusus untuk penulis yang ingin menyempurnakan naskah mereka sebelum dipublikasikan. Melalui bimbingan intensif dari editor berpengalaman, penulis akan mendapatkan panduan langkah demi langkah dalam mengembangkan ide, memperbaiki alur cerita, memperkuat karakter, dan meningkatkan gaya penulisan.

                                                                                                                                                Kami juga membantu dalam aspek teknis seperti struktur naskah, pemilihan kata, dan konsistensi bahasa. Dengan fokus pada kebutuhan individual setiap penulis, Manuscript Coaching di Penerbit Yaguwipa memastikan naskah Anda siap bersaing di dunia penerbitan.Membantu penulis mempersiapkan konten dan struktur naskah hingga siap diterbitkan.',
                    'image' => 'manuscript.png'
                ],
                [
                    'title' => 'Plagiarism Check',
                    'desc' => 'Layanan Plagiarism Check di Penerbit Yaguwipa memberikan jaminan bahwa naskah Anda bebas dari unsur plagiarisme. Dengan menggunakan teknologi deteksi terkini, kami memeriksa setiap bagian dari naskah Anda untuk memastikan bahwa semua konten orisinal dan sesuai dengan standar etika penulisan.

                                                                                                                                    Kami juga menyediakan laporan detail yang menunjukkan bagian-bagian yang mungkin perlu penyesuaian atau pengutipan ulang. Dengan layanan ini, Penerbit Yaguwipa dapat membantu penulis menjaga integritas karya mereka dan memastikan bahwa naskah siap untuk dipublikasikan tanpa risiko pelanggaran hak cipta.',
                    'image' => 'plagiat.png'
                ],
                [
                    'title' => 'Full Package Publishing',
                    'desc' => 'Layanan Full Package Publishing di Penerbit Yaguwipa adalah solusi komprehensif untuk penulis yang ingin menerbitkan karya mereka dengan mudah dan profesional. Kami menangani setiap aspek dari proses penerbitan, mulai dari penyuntingan mendalam, desain sampul dan layout, hingga pencetakan dan distribusi. Penulis akan bekerja sama dengan tim ahli kami yang akan memastikan bahwa setiap detail naskah dipoles hingga sempurna.

                                                                                                                        Selain itu, kami juga menyediakan strategi pemasaran dan promosi untuk memastikan buku Anda menjangkau pembaca yang lebih luas. Dengan Full Package Publishing di Yaguwipa, Anda dapat fokus pada menulis sementara kami menangani semua hal lainnya, membawa karya Anda dari naskah menjadi buku yang siap dipasarkan.',
                    'image' => 'package.png'
                ],
                [
                    'title' => 'HKI',
                    'desc' => 'Layanan HKI di Penerbit Yaguwipa dirancang untuk melindungi karya kreatif Anda melalui pendaftaran Hak Kekayaan Intelektual (HKI). Kami membantu penulis dan kreator dalam proses pendaftaran hak cipta, paten, dan merek dagang untuk memastikan bahwa karya Anda diakui dan dilindungi secara hukum.

                                                                                                            Tim kami akan mendampingi Anda dalam setiap langkah, mulai dari persiapan dokumen hingga proses pengajuan, sehingga Anda dapat merasa tenang mengetahui bahwa hak-hak atas karya Anda aman. Dengan layanan HKI di Penerbit Yaguwipa, pastikan bahwa ide, naskah, dan inovasi Anda terlindungi dari potensi pelanggaran dan penyalahgunaan.',
                    'image' => 'hki.png'
                ],
                [
                    'title' => 'Cataloging',
                    'desc' => 'Layanan Cataloging di Penerbit Yaguwipa membantu penulis dan penerbit memastikan bahwa buku mereka terdaftar dengan benar dan mudah ditemukan oleh pembaca serta perpustakaan. Kami menyediakan layanan pengkatalogan profesional yang mencakup pembuatan metadata lengkap, seperti ISBN, deskripsi buku, kata kunci, dan klasifikasi berdasarkan standar internasional.

                                                                                                Dengan layanan ini, buku Anda akan lebih mudah diakses melalui platform penjualan online, perpustakaan, dan basis data global. Cataloging di Penerbit Yaguwipa memastikan karya Anda mendapatkan visibilitas yang optimal dan diorganisir secara profesional, memudahkan pembaca dan instansi untuk menemukan dan mengenali buku Anda di berbagai kanal distribusi.',
                    'image' => 'katalog.png'
                ],
                [
                    'title' => 'Kolaborasi',
                    'desc' => 'Penerbit YAGUWIPA berkolaborasi dengan sekolah dan perguruan tinggi untuk saling mendukung dan meningkatkan mutu pendidikan. Penerbit YAGUWIPA menyelenggarakan pelatihan dan workshop bagi guru dan dosen dalam rangka meningkatkan keterampilan mengajar. Hal ini dapat membantu meningkatkan kualitas pengajaran di sekolah dan perguruan tinggi.

                                                                                    Penerbit YAGUWIPA juga bekerja sama dengan sekolah dan perguruan tinggi dalam pengembangan dan penerbitan karya ilmiah, jurnal, dan buku referensi. Kolaborasi ini dapat mendorong penelitian yang lebih baik dan pengembangan pengetahuan di berbagai bidang.',
                    'image' => 'kolaborasi.png'
                ],
                [
                    'title' => 'Editing',
                    'desc' => 'Penerbit YAGUWIPA menyediakan layanan untuk mengedit dan menyempurnakan buku teks yang sedang dikembangkan. Penyuntingan meliputi peninjauan dan penyesuaian isi, pengaturan struktur yang lebih baik, serta perbaikan tata bahasa dan gaya penulisan. Hal ini untuk memastikan bahwa buku teks mencerminkan kebutuhan dan standar akademik terkini.

                                                                        Penerbit YAGUWIPA dapat menyunting dan mereview artikel yang diajukan untuk publikasi dalam jurnal ilmiah. Melalui proses peer review, penyunting membantu memperbaiki kualitas dan kejelasan artikel penelitian, serta memastikan kesesuaian dengan standar publikasi yang ditetapkan oleh jurnal tersebut.

                                                                        Selain itu, Penerbit YAGUWIPA menyediakan layanan proofreading atau koreksi Bahasa. Hal ini berguna untuk memastikan bahwa dokumen akademik, laporan penelitian, makalah, atau tugas mahasiswa bebas dari kesalahan tata bahasa, ejaan, dan tanda baca. Penyuntingan ini membantu meningkatkan kualitas dan kredibilitas tulisan akademik.',
                    'image' => 'editing.png'
                ],
                [
                    'title' => 'Setting Layout',
                    'desc' => 'Penerbit YAGUWIPA membantu untuk merancang tata letak buku teks yang menarik dan mudah dibaca. Hal ini meliputi penentuan ukuran dan jenis font yang sesuai, pemilihan gaya huruf yang konsisten, pengaturan halaman, pembuatan bagan, ilustrasi, dan penggunaan elemen visual lainnya. Hal ini membantu menciptakan buku teks yang menarik dan memudahkan pembaca dalam memahami materi.

                                                            Penerbit YAGUWIPA juga menyediakan setting layout untuk tata letak jurnal ilmiah. Ini mencakup desain halaman, format kutipan dan daftar pustaka, pemilihan tata letak tabel dan gambar, serta pengaturan kesesuaian antara teks dan elemen grafis. Hal ini penting untuk menciptakan jurnal ilmiah yang profesional dan mudah dinavigasi oleh para pembaca.

                                                            ',
                    'image' => 'layout.png'
                ],
                ['title' => 'Cover Design', 'desc' => 'Desain cover buku yang menarik dan relevan adalah faktor penting untuk menarik minat pembaca dan mempresentasikan isi buku dengan baik. Penerbit YAGUWIPA membantu untuk mengembangkan konsep dan tema desain cover yang sesuai dengan keinginaan penulis dan isi buku. Desain cover buku ini melibatkan penggunaan ilustrasi, gambar, atau grafis khusus untuk memperkuat pesan atau atmosfer buku. Penerbit juga membantu dalam pemilihan font yang sesuai dan penataan tipografi yang menarik untuk judul, subjudul, nama penulis, dan elemen teks lainnya pada cover buku.  Untuk hasil akhir, Penerbit melibatkan penulis untuk memberikan masukan terkait desain cover. Umpan balik ini membantu menghasilkan iterasi dan perbaikan desain hingga mencapai hasil akhir yang sesuai. Diskusi dalam desain cover buku memastikan bahwa cover buku mencerminkan isi yang relevan, menarik perhatian, dan mampu membangun ekspektasi positif bagi pembaca. ', 'image' => 'cover.png' ],
                [
                    'title' => 'Percetakan',
                    'desc' => 'Percetakan merupakan bagian penting dalam produksi buku dan materi pendidikan. Penerbit YAGUWIPA menyediakan layanan percetakan untuk mencetak buku fisik dalam jumlah yang dibutuhkan. Penerbit menyediakan estimasi biaya produksi berdasarkan spesifikasi dan jumlah yang diperlukan.',
                    'image' => 'cetak.png'
                ],
                [
                    'title' => 'Terbitkan Jurnal ber-ISSN',
                    'desc' => 'Menerbitkan jurnal dengan ISSN melibatkan proses yang melibatkan pengaturan, manajemen, dan pemasaran jurnal Anda. 
                                    Penerbit YAGUWIPA membantu untuk menerbitkan jurnal dengan ISSN (International Standard Serial Number). Lembaga dapat menentukan sendiri frekuensi penerbitan jurnal Anda, misalnya bulanan, perempat tahunan, atau tahunan. Pastikan jadwal penerbitan tetap terjaga dengan mempersiapkan dan memverifikasi artikel yang akan diterbitkan secara berkala.
                                    Selain itu, penerbit YAGUWIPA juga membantu mempromosikan jurnal Anda melalui berbagai saluran seperti situs web, media sosial, dan jaringan profesional akademik.
                                    ',
                    'image' => 'issn.png'
                ],
                [
                    'title' => 'Buku ber-ISBN',
                    'desc' => 'Penerbit YAGUWIPA berperan aktif menyebarluaskan hasil riset, IPTEKS, dan karya sastra sebagai bentuk gerakan literasi riset dan humaniora.

                        Kami mengajak dosen, guru, peneliti, pelaksana pengabdian masyarakat, inovator, praktisi, akademisi dan penulis untuk berbagi IPTEKS dan karya literasi melalui buku berISBN.

                        Penerbit YAGUWIPA sudah dipercaya oleh publik sebagai penerbit kredibel dengan menjadi anggota resmi IKAPI (Ikatan Penerbit Indonesia) dan FORPIN (Forum Penulis dan Penerbit Indonesia)',
                    'image' => 'buku.png'
                ]
            ];
        @endphp

        <!-- Wrapper List Program -->
        <div class="space-y-24">
            @foreach($programs as $index => $program)
                <div id="{{ Str::slug($program['title']) }}"
                    class="{{ $index % 2 == 0 ? 'animate-fade-left' : 'animate-fade-right' }} flex flex-col md:flex-row gap-12 items-center {{ $index % 2 != 0 ? 'md:flex-row-reverse' : '' }}">

                    <!-- Container Ikon (Ukuran diperbesar) -->
                    <div class="flex items-center justify-center p-4 bg-gray-50 rounded-xl">
                        <img src="{{ asset('images/' . ($program['image'] ?? 'default.png')) }}" alt="{{ $program['title'] }}"
                            class="w-24 h-24 object-contain block filter-red">
                    </div>

                    <!-- Teks -->
                    <div class="w-full md:w-1/2">
                        <h3 class="text-2xl font-bold mb-4 text-gray-900">{{ $program['title'] }}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $program['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
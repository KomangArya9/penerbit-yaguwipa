@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-16">

        <!-- 1. Header Halaman -->
        <div class="text-center mb-16 animate-on-scroll">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Katalog Buku</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Jelajahi koleksi karya sastra, non-fiksi, dan kajian akademik unggulan dari Penerbit Yaguwipa yang dikurasi
                khusus untuk memperkaya literasi dan intelektualitas Anda.
            </p>
        </div>

        <div class="flex flex-col md:flex-row gap-12">
            <!-- 2. Sidebar Filter -->
<aside class="portfolio-entry w-full md:w-64 shrink-0" style="transition-delay: 100ms;">
    <form method="GET" action="{{ route('catalog.index') }}" id="filterForm">
        
        <!-- KATEGORI -->
        <div class="mb-8">
            <h3 class="font-bold text-sm mb-4 border-b border-gray-300 pb-2 text-gray-900 tracking-wider">KATEGORI</h3>
            <ul class="space-y-3 text-sm text-gray-600">
                @foreach($categories as $cat)
                    @if($cat)
                        <li>
                            <label class="flex items-center cursor-pointer group">
                                <!-- PADA BAGIAN INI: Hapus onchange="..." -->
                                <input type="checkbox" name="kategori[]" value="{{ $cat }}" 
                                    {{ in_array($cat, request('kategori', [])) ? 'checked' : '' }}
                                    class="mr-3 w-4 h-4 rounded border-gray-300 accent-[#B6171E] transition-all">
                                <span class="group-hover:text-[#B6171E] group-hover:translate-x-1 transition-all duration-300">
                                    {{ $cat }}
                                </span>
                            </label>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

        <!-- TAHUN TERBIT -->
        <div class="mb-6">
            <h3 class="font-bold text-sm mb-4 border-b border-gray-300 pb-2 text-gray-900 tracking-wider">TAHUN TERBIT</h3>
            <ul class="space-y-3 text-sm text-gray-600">
                <li>
                    <label class="flex items-center cursor-pointer group">
                        <!-- PADA BAGIAN INI: Hapus onchange="..." -->
                        <input type="radio" name="tahun" value="" 
                            {{ request('tahun') == '' ? 'checked' : '' }}
                            class="mr-3 w-4 h-4 border-gray-300 accent-[#B6171E] transition-all">
                        <span class="group-hover:text-[#B6171E] group-hover:translate-x-1 transition-all duration-300">
                            Semua Tahun
                        </span>
                    </label>
                </li>
                <li>
                    <label class="flex items-center cursor-pointer group">
                        <input type="radio" name="tahun" value="2026" 
                            {{ request('tahun') == '2026' ? 'checked' : '' }}
                            class="mr-3 w-4 h-4 border-gray-300 accent-[#B6171E] transition-all">
                        <span class="group-hover:text-[#B6171E] group-hover:translate-x-1 transition-all duration-300">
                            2026 (Terkini)
                        </span>
                    </label>
                </li>
            </ul>
        </div>

        <!-- TOMBOL CARI / FILTER (Ditambahkan agar user bisa submit manual) -->
        <button type="submit" class="w-full bg-[#B6171E] text-white text-xs font-bold py-2.5 rounded-lg shadow hover:bg-red-900 transition-all">
            Terapkan Filter
        </button>

    </form>
</aside>

            <!-- 3. Katalog Grid Section -->
            <main class="flex-1">
                <!-- Header Filter & Sort -->
                <div class="portfolio-entry flex justify-between items-center mb-8 text-sm"
                    style="transition-delay: 200ms;">
                    <p class="text-gray-600">
    Menampilkan {{ $catalogs->firstItem() ?? 0 }} - {{ $catalogs->lastItem() ?? 0 }} dari {{ $catalogs->total() }} buku
</p>
                    <div class="flex items-center">
                        <span class="mr-2">Urutkan:</span>
                        <select
                            class="border border-gray-300 p-2 outline-none cursor-pointer hover:border-[#B6171E] transition-colors focus:border-[#B6171E]">
                            <option>Terbaru</option>
                            <option>Terpopuler</option>
                            <option>Abjad (A-Z)</option>
                        </select>
                    </div>
                </div>

                <!-- Grid Buku Dinamis dari Database -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
    @forelse($catalogs as $index => $book)
        <!-- Seluruh card dibungkus tag <a> agar bisa diklik dan berpindah ke halaman detail -->
        <a href="{{ route('catalog.show', $book->id) }}" 
           class="portfolio-entry border border-gray-200 p-6 flex flex-col hover:shadow-xl transition-all duration-500 opacity-0 translate-y-8 group"
           style="transition-delay: {{ 100 + ($index * 100) }}ms;">

            <!-- Image Wrapper (Menampilkan Cover dari Storage) -->
            <div class="aspect-[2/3] bg-gray-100 mb-6 overflow-hidden relative">
                @if($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->judul }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">No Cover</div>
                @endif
            </div>

            <!-- Kategori -->
            <p class="text-[10px] font-bold text-[#B6171E] mb-2 tracking-widest">
                {{ strtoupper($book->kategori ?? 'UMUM') }}
            </p>

            <!-- Judul Buku -->
            <h3 class="font-bold text-lg mb-4 leading-tight text-gray-900 group-hover:text-[#B6171E] transition-colors line-clamp-2">
                {{ $book->judul }}
            </h3>

            <!-- Harga (Format Rupiah) -->
            <p class="text-base font-bold text-gray-900 mt-auto">
                Rp {{ number_format($book->harga ?? 0, 0, ',', '.') }}
            </p>
        </a>
    @empty
        <div class="col-span-3 text-center py-16 text-gray-500">
            Belum ada katalog buku yang ditambahkan melalui admin panel.
        </div>
    @endforelse
</div>

                <!-- Pagination Laravel -->
                <div class="portfolio-entry opacity-0 translate-y-8" style="transition-delay: 500ms;">
                    {{ $catalogs->links() }}
                </div>
            </main>
        </div>

        <!-- Section 2: Formulir Pengajuan Naskah -->
        <section class="portfolio-entry mt-20 border-t border-gray-300 pt-20 max-w-4xl mx-auto animate-on-scroll"
            style="transition-delay: 200ms;">

            <!-- Tombol Pemicu Pop-up Form Katalog (Memanjang seperti di awal) -->
            <button onclick="document.getElementById('modal-katalog').classList.remove('hidden')"
                class="block w-full text-center bg-[#B6171E] border-2 border-gray-300 text-white px-10 py-2.5 rounded-lg font-medium hover:bg-white hover:text-gray-700 transition-all duration-300 shadow-md">
                Form Katalog
            </button>

        </section>

        <!-- Modal Form Unggah Catalog -->
<div id="modal-katalog"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden p-4 overflow-y-auto">
    <div
        class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-3xl relative my-8 max-h-[90vh] overflow-y-auto border border-gray-100 text-left">

        <!-- Tombol Close (X) -->
        <button onclick="document.getElementById('modal-katalog').classList.add('hidden')"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl font-bold">&times;</button>

        <h2 class="text-2xl font-bold mb-2 text-gray-900">Form Unggah Catalog</h2>
        <p class="text-xs text-gray-500 mb-6">Silakan lengkapi detail informasi katalog atau naskah Anda di bawah ini.</p>

        <!-- Kotak Notifikasi / Alert Dinamis (Sukses & Error) -->
        <div id="catalog-alert" class="hidden mb-4 p-4 rounded-lg text-sm flex items-center justify-between border">
            <span id="catalog-alert-message"></span>
            <button type="button" onclick="document.getElementById('catalog-alert').classList.add('hidden')" class="font-bold ml-2">&times;</button>
        </div>

        <form id="form-katalog" action="{{ route('catalog.store.public') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <!-- Judul -->
            <div>
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                <input type="text" id="judul" name="judul" placeholder="Judul Buku / Karya"
                    class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
            </div>

            <!-- Penulis & Editor -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="penulis" class="block text-sm font-medium text-gray-700 mb-1">Penulis</label>
                    <input type="text" id="penulis" name="penulis" placeholder="Nama Penulis"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
                <div>
                    <label for="editor" class="block text-sm font-medium text-gray-700 mb-1">Editor</label>
                    <input type="text" id="editor" name="editor" placeholder="Nama Editor (Opsional)"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
            </div>

            <!-- Penerbit & Institusi Penulis (i_penulis) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="penerbit" class="block text-sm font-medium text-gray-700 mb-1">Penerbit</label>
                    <input type="text" id="penerbit" name="penerbit" placeholder="Contoh: Penerbit Yaguwipa"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
                <div>
                    <label for="institusi_penulis" class="block text-sm font-medium text-gray-700 mb-1">Institusi Penulis</label>
                    <input type="text" id="institusi_penulis" name="i_penulis" placeholder="Institusi / Universitas"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
            </div>

            <!-- Institusi Editor (i_editor) & Jenis Terbitan (jenis) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="institusi_editor" class="block text-sm font-medium text-gray-700 mb-1">Institusi Editor</label>
                    <input type="text" id="institusi_editor" name="i_editor" placeholder="Institusi Editor"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
                <div>
                    <label for="jenis_terbitan" class="block text-sm font-medium text-gray-700 mb-1">Jenis Terbitan</label>
                    <select id="jenis_terbitan" name="jenis"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] bg-white">
                        <option value="">Jenis Terbitan</option>
                        <option value="Buku">Buku</option>
                        <option value="Jurnal">Jurnal</option>
                        <option value="Prosiding">Prosiding</option>
                        <option value="Majalah Ilmiah">Majalah Ilmiah</option>
                        <option value="Artikel Ilmiah">Artikel Ilmiah</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
            </div>

            <!-- Kategori & Bidang Ilmu (bidang) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select id="kategori" name="kategori"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] bg-white">
                        <option value="">Kategori Terbitan</option>
                        <option value="Buku Referensi">Buku Referensi</option>
                        <option value="Buku Monograf">Buku Monograf</option>
                        <option value="Buku Ajar">Buku Ajar</option>
                        <option value="Buku Teks">Buku Teks</option>
                        <option value="Karya Fiksi">Karya Fiksi</option>
                        <option value="Jurnal Nasional">Jurnal Nasional</option>
                        <option value="Jurnal Nasional Terakreditasi">Jurnal Nasional Terakreditasi</option>
                        <option value="Jurnal Internasional">Jurnal Internasional</option>
                        <option value="Jurnal Internasional Berreputasi">Jurnal Internasional Berreputasi</option>
                        <option value="Prosiding Nasional">Prosiding Nasional</option>
                        <option value="Prosiding Nasional Terakreditasi">Prosiding Nasional Terakreditasi</option>
                        <option value="Prosiding Internasional">Prosiding Internasional</option>
                        <option value="Prosiding Internasional Berreputasi">Prosiding Internasional Berreputasi</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div>
                    <label for="bidang_ilmu" class="block text-sm font-medium text-gray-700 mb-1">Bidang Ilmu</label>
                    <input type="text" id="bidang_ilmu" name="bidang" placeholder="Contoh: Sosiologi / Teknologi"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
            </div>

            <!-- ISBN & ISSN -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="isbn" class="block text-sm font-medium text-gray-700 mb-1">ISBN</label>
                    <input type="text" id="isbn" name="isbn" placeholder="Nomor ISBN"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
                <div>
                    <label for="issn" class="block text-sm font-medium text-gray-700 mb-1">ISSN</label>
                    <input type="text" id="issn" name="issn" placeholder="Nomor ISSN (Jika ada)"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
            </div>

            <!-- Ukuran & Jumlah Halaman (jumlah) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="ukuran" class="block text-sm font-medium text-gray-700 mb-1">Ukuran</label>
                    <input type="text" id="ukuran" name="ukuran" placeholder="Contoh: 14x20 cm"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
                <div>
                    <label for="jumlah_halaman" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Halaman</label>
                    <input type="number" id="jumlah_halaman" name="jumlah" placeholder="Contoh: 150"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
            </div>

            <!-- Bulan & Tahun Terbit (terbit) -->
            <div>
                <label for="tahun_terbit" class="block text-sm font-medium text-gray-700 mb-1">Bulan & Tahun Terbit</label>
                <input type="text" id="tahun_terbit" name="terbit" placeholder="Contoh: Januari 2026"
                    class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
            </div>

            <!-- Opsi Radio (Kondisi Terbitan & Ketersediaan) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kondisi Terbitan</label>
                    <div class="flex items-center gap-6">
                        <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                            <input type="radio" name="kondisi" value="Baru"
                                class="text-[#B6171E] focus:ring-[#B6171E]"> Baru
                        </label>
                        <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                            <input type="radio" name="kondisi" value="Second Hand"
                                class="text-[#B6171E] focus:ring-[#B6171E]"> Second Hand
                        </label>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ketersediaan</label>
                    <div class="flex items-center gap-6">
                        <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                            <input type="radio" name="ketersediaan" value="Tersedia"
                                class="text-[#B6171E] focus:ring-[#B6171E]"> Tersedia
                        </label>
                        <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                            <input type="radio" name="ketersediaan" value="Pre-Order"
                                class="text-[#B6171E] focus:ring-[#B6171E]"> Pre-Order
                        </label>
                    </div>
                </div>
            </div>

            <!-- Keterangan -->
            <div>
                <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                <input type="text" id="keterangan" name="keterangan" placeholder="Keterangan tambahan singkat"
                    class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Tuliskan deskripsi lengkap buku..."
                    class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]"></textarea>
            </div>

            <!-- Info Tambahan (info) -->
            <div>
                <label for="info_tambahan" class="block text-sm font-medium text-gray-700 mb-1">Info Tambahan</label>
                <textarea id="info_tambahan" name="info" rows="4" placeholder="Informasi tambahan lain jika ada..."
                    class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]"></textarea>
            </div>

            <!-- Harga & Harga Diskon (diskon) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="harga" class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                    <input type="text" id="harga" name="harga" placeholder="Contoh: 75000"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                    <p class="text-[11px] text-gray-500 mt-1">Catatan : Tuliskan Gratis jika Karya ini disumbangkan</p>
                </div>
                <div>
                    <label for="harga_diskon" class="block text-sm font-medium text-gray-700 mb-1">Harga Diskon</label>
                    <input type="text" id="harga_diskon" name="diskon" placeholder="Contoh: 60000"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                    <p class="text-[11px] text-gray-500 mt-1">Catatan : Kosongkan jika Program ini tidak ada Diskon</p>
                </div>
            </div>

            <!-- Penjual / Penyedia & No WA (wa) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="penjual" class="block text-sm font-medium text-gray-700 mb-1">Penjual/Penyedia</label>
                    <input type="text" id="penjual" name="penjual" placeholder="Nama Penjual / Penyedia"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
                <div>
                    <label for="no_wa" class="block text-sm font-medium text-gray-700 mb-1">No WA</label>
                    <input type="text" id="no_wa" name="wa" placeholder="Contoh: 081234567890"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
            </div>

            <!-- Alamat & No KTP (ktp) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <input type="text" id="alamat" name="alamat" placeholder="Alamat lengkap"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
                <div>
                    <label for="no_ktp" class="block text-sm font-medium text-gray-700 mb-1">No KTP</label>
                    <input type="text" id="no_ktp" name="ktp" placeholder="Nomor KTP penyedia / penulis"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
            </div>

            <!-- Nama Bank (bank) & Nomor Rekening (norek) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="nama_bank" class="block text-sm font-medium text-gray-700 mb-1">Nama Bank</label>
                    <input type="text" id="nama_bank" name="bank" placeholder="Contoh: BCA / BRI"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
                <div>
                    <label for="no_rekening" class="block text-sm font-medium text-gray-700 mb-1">Nomor Rekening</label>
                    <input type="text" id="no_rekening" name="norek" placeholder="Nomor Rekening Pembayaran"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
            </div>

            <!-- Unggah File: Cover Depan (cover), Cover Belakang (cover_belakang), Daftar Isi (img) -->
            <div class="space-y-4 pt-2 border-t">
                <div>
                    <label for="cover_depan" class="block text-sm font-medium text-gray-700 mb-1">Cover Depan</label>
                    <input type="file" id="cover_depan" name="cover" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-[#B6171E] hover:file:bg-red-100">
                    <p class="text-xs text-gray-400 mt-1">note: ukuran gambar 350x500 pixel. (recommended)</p>
                </div>
                <div>
                    <label for="cover_belakang" class="block text-sm font-medium text-gray-700 mb-1">Cover Belakang</label>
                    <input type="file" id="cover_belakang" name="cover_belakang" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-[#B6171E] hover:file:bg-red-100">
                    <p class="text-xs text-gray-400 mt-1">note: ukuran gambar 350x500 pixel. (recommended)</p>
                </div>
                <div>
                    <label for="daftar_isi" class="block text-sm font-medium text-gray-700 mb-1">Daftar Isi</label>
                    <input type="file" id="daftar_isi" name="img" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-[#B6171E] hover:file:bg-red-100">
                    <p class="text-xs text-gray-400 mt-1">note: ukuran gambar 350x500 pixel. (recommended)</p>
                </div>
            </div>

            <!-- Tombol Aksi Pop-up -->
            <div class="flex justify-end gap-2 pt-6 border-t">
                <button type="button" onclick="document.getElementById('modal-katalog').classList.add('hidden')"
                    class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-300 transition-all">
                    Batal
                </button>
                <button type="submit" id="submit-btn"
                    class="px-6 py-2.5 bg-[#B6171E] text-white rounded-lg font-semibold text-sm hover:bg-red-900 transition-all shadow-md">
                    Submit Katalog
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script AJAX dan Penanganan Alert/Error -->
<script>
    document.getElementById('form-katalog').addEventListener('submit', function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    let submitBtn = document.getElementById('submit-btn');
    let alertBox = document.getElementById('catalog-alert');
    let alertMsg = document.getElementById('catalog-alert-message');

    alertBox.classList.add('hidden');
    submitBtn.disabled = true;
    submitBtn.innerText = 'MENGIRIM...';

    fetch("{{ route('catalog.store.public') }}", {
        method: "POST",
        body: formData,
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
            "Accept": "application/json"
        }
    })
    .then(async response => {
        // Cek apakah server mengirim JSON atau halaman HTML Error
        const contentType = response.headers.get("content-type");
        if (contentType && contentType.includes("application/json")) {
            let data = await response.json();
            if (!response.ok) throw data;
            return data;
        } else {
            // Jika server mengembalikan HTML (Artinya ada error 500/404 di Laravel)
            let errorHtml = await response.text();
            console.error("Server HTML Error:", errorHtml);
            throw { message: "Terjadi kesalahan sistem (Server Error). Cek F12 > Network > Preview untuk melihat detail error." };
        }
    })
    .then(data => {
        // Sukses
        alertBox.className = "mb-4 p-4 bg-emerald-100 border border-emerald-400 text-emerald-700 rounded-lg text-sm flex items-center justify-between";
        alertMsg.innerText = data.message || "Katalog berhasil dikirim!";
        alertBox.classList.remove('hidden');

        document.getElementById('form-katalog').reset();
        alertBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

        setTimeout(() => {
            alertBox.classList.add('hidden');
        }, 8000);
    })
    .catch(error => {
        // Tangkap pesan error baik dari validasi maupun dari server
        let errorText = error.message || 'Terjadi kesalahan, silakan periksa kembali inputan Anda.';
        
        if (error.errors) {
            errorText = Object.values(error.errors).flat()[0];
        }

        alertBox.className = "mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm flex items-center justify-between";
        alertMsg.innerText = errorText;
        alertBox.classList.remove('hidden');
        
        alertBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    })
    .finally(() => {
        submitBtn.disabled = false;
        submitBtn.innerText = 'Submit Katalog';
    });
});
</script>

    </div>
@endsection
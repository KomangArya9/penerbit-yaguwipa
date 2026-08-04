@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-16">

        <!-- 1. Header Halaman -->
        <div class="text-center mb-16 animate-on-scroll">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">@lang('catalog.page_title')</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                @lang('catalog.page_subtitle')
            </p>
        </div>

        <div class="flex flex-col md:flex-row gap-12">
            <!-- 2. Sidebar Filter -->
<aside class="portfolio-entry w-full md:w-64 shrink-0" style="transition-delay: 100ms;">
    <form method="GET" action="{{ route('catalog.index') }}" id="filterForm">

        <!-- KATEGORI -->
        <div class="mb-8">
            <h3 class="font-bold text-sm mb-4 border-b border-gray-300 pb-2 text-gray-900 tracking-wider">@lang('catalog.filter_category')</h3>
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
            <h3 class="font-bold text-sm mb-4 border-b border-gray-300 pb-2 text-gray-900 tracking-wider">@lang('catalog.filter_year')</h3>
            <ul class="space-y-3 text-sm text-gray-600">
                <li>
                    <label class="flex items-center cursor-pointer group">
                        <!-- PADA BAGIAN INI: Hapus onchange="..." -->
                        <input type="radio" name="tahun" value=""
                            {{ request('tahun') == '' ? 'checked' : '' }}
                            class="mr-3 w-4 h-4 border-gray-300 accent-[#B6171E] transition-all">
                        <span class="group-hover:text-[#B6171E] group-hover:translate-x-1 transition-all duration-300">
                            @lang('catalog.all_years')
                        </span>
                    </label>
                </li>
                <li>
                    <label class="flex items-center cursor-pointer group">
                        <input type="radio" name="tahun" value="2026"
                            {{ request('tahun') == '2026' ? 'checked' : '' }}
                            class="mr-3 w-4 h-4 border-gray-300 accent-[#B6171E] transition-all">
                        <span class="group-hover:text-[#B6171E] group-hover:translate-x-1 transition-all duration-300">
                            2026 (@lang('catalog.latest'))
                        </span>
                    </label>
                </li>
            </ul>
        </div>

        <!-- TOMBOL CARI / FILTER (Ditambahkan agar user bisa submit manual) -->
        <button type="submit" class="w-full bg-[#B6171E] text-white text-xs font-bold py-2.5 rounded-lg shadow hover:bg-red-900 transition-all">
            @lang('catalog.apply_filter')
        </button>

    </form>
</aside>

            <!-- 3. Katalog Grid Section -->
            <main class="flex-1">
                <!-- Header Filter & Sort -->
                <div class="portfolio-entry flex justify-between items-center mb-8 text-sm"
                    style="transition-delay: 200ms;">
                    <p class="text-gray-600">
    @lang('catalog.showing_results', ['dari' => $catalogs->firstItem() ?? 0, 'total' => $catalogs->total()])
</p>
                    <div class="flex items-center">
                        <span class="mr-2">@lang('catalog.sort_by')</span>
                        <select
                            class="border border-gray-300 p-2 outline-none cursor-pointer hover:border-[#B6171E] transition-colors focus:border-[#B6171E]">
                            <option>@lang('catalog.newest')</option>
                            <option>@lang('catalog.most_popular')</option>
                            <option>@lang('catalog.alphabetical')</option>
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
                    <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">@lang('catalog.no_cover')</div>
                @endif
            </div>

            <!-- Kategori -->
            <p class="text-[10px] font-bold text-[#B6171E] mb-2 tracking-widest">
                {{ strtoupper($book->kategori ?? __('catalog.category_default_label')) }}
            </p>

            <!-- Judul Buku -->
            <h3 class="font-bold text-lg mb-4 leading-tight text-gray-900 group-hover:text-[#B6171E] transition-colors line-clamp-2">
                {{ $book->judul }}
            </h3>

            <!-- Harga (Format Rupiah) -->
            <p class="text-base font-bold text-gray-900 mt-auto">
                {{ __('common.currency_prefix') }} {{ number_format($book->harga ?? 0, 0, ',', '.') }}
            </p>
        </a>
    @empty
        <div class="col-span-3 text-center py-16 text-gray-500">
            @lang('catalog.no_books')
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
                @lang('catalog.form_button')
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

        <h2 class="text-2xl font-bold mb-2 text-gray-900">@lang('catalog.upload_form_title')</h2>
        <p class="text-xs text-gray-500 mb-6">@lang('catalog.form_description')</p>

        <!-- Kotak Notifikasi / Alert Dinamis (Sukses & Error) -->
        <div id="catalog-alert" class="hidden mb-4 p-4 rounded-lg text-sm flex items-center justify-between border">
            <span id="catalog-alert-message"></span>
            <button type="button" onclick="document.getElementById('catalog-alert').classList.add('hidden')" class="font-bold ml-2">&times;</button>
        </div>

        <form id="form-katalog" action="{{ route('catalog.store.public') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <!-- Judul -->
            <div>
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_title')</label>
                <input type="text" id="judul" name="judul" placeholder="@lang('catalog.title_placeholder')"
                    class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
            </div>

            <!-- Penulis & Editor -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="penulis" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_author')</label>
                    <input type="text" id="penulis" name="penulis" placeholder="@lang('catalog.author_placeholder')"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
                <div>
                    <label for="editor" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_editor')</label>
                    <input type="text" id="editor" name="editor" placeholder="@lang('catalog.editor_placeholder')"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
            </div>

            <!-- Penerbit & Institusi Penulis (i_penulis) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="penerbit" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_publisher')</label>
                    <input type="text" id="penerbit" name="penerbit" placeholder="@lang('catalog.publisher_placeholder')"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
                <div>
                    <label for="institusi_penulis" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_author_institution')</label>
                    <input type="text" id="institusi_penulis" name="i_penulis" placeholder="@lang('catalog.institution_placeholder')"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
            </div>

            <!-- Institusi Editor (i_editor) & Jenis Terbitan (jenis) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="institusi_editor" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_editor_institution')</label>
                    <input type="text" id="institusi_editor" name="i_editor" placeholder="@lang('catalog.institution_placeholder')"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
                <div>
                    <label for="jenis_terbitan" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_publication_type')</label>
                    <select id="jenis_terbitan" name="jenis"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] bg-white">
                        <option value="">@lang('catalog.type_default')</option>
                        <option value="Buku">@lang('catalog.type_book')</option>
                        <option value="Jurnal">@lang('catalog.type_journal')</option>
                        <option value="Prosiding">@lang('catalog.type_proceeding')</option>
                        <option value="Majalah Ilmiah">@lang('catalog.type_scientific_magazine')</option>
                        <option value="Artikel Ilmiah">@lang('catalog.type_scientific_article')</option>
                        <option value="Lainnya">@lang('catalog.type_other')</option>
                    </select>
                </div>
            </div>

            <!-- Kategori & Bidang Ilmu (bidang) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_category')</label>
                    <select id="kategori" name="kategori"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] bg-white">
                        <option value="">@lang('catalog.category_default')</option>
                        <option value="Buku Referensi">@lang('catalog.cat_reference_book')</option>
                        <option value="Buku Monograf">@lang('catalog.cat_monograph_book')</option>
                        <option value="Buku Ajar">@lang('catalog.cat_textbook')</option>
                        <option value="Buku Teks">@lang('catalog.cat_plain_text')</option>
                        <option value="Karya Fiksi">@lang('catalog.cat_fiction')</option>
                        <option value="Jurnal Nasional">@lang('catalog.cat_national_journal')</option>
                        <option value="Jurnal Nasional Terakreditasi">@lang('catalog.cat_national_accredited_journal')</option>
                        <option value="Jurnal Internasional">@lang('catalog.cat_international_journal')</option>
                        <option value="Jurnal Internasional Berreputasi">@lang('catalog.cat_intl_reputable_journal')</option>
                        <option value="Prosiding Nasional">@lang('catalog.cat_national_proceeding')</option>
                        <option value="Prosiding Nasional Terakreditasi">@lang('catalog.cat_national_accredited_proceeding')</option>
                        <option value="Prosiding Internasional">@lang('catalog.cat_international_proceeding')</option>
                        <option value="Prosiding Internasional Berreputasi">@lang('catalog.cat_intl_reputable_proceeding')</option>
                        <option value="Lainnya">@lang('catalog.cat_other')</option>
                    </select>
                </div>
                <div>
                    <label for="bidang_ilmu" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_field_of_study')</label>
                    <input type="text" id="bidang_ilmu" name="bidang" placeholder="@lang('catalog.field_placeholder')"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
            </div>

            <!-- ISBN & ISSN -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="isbn" class="block text-sm font-medium text-gray-700 mb-1">ISBN</label>
                    <input type="text" id="isbn" name="isbn" placeholder="@lang('catalog.isbn_placeholder')"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
                <div>
                    <label for="issn" class="block text-sm font-medium text-gray-700 mb-1">ISSN</label>
                    <input type="text" id="issn" name="issn" placeholder="@lang('catalog.issn_placeholder')"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
            </div>

            <!-- Ukuran & Jumlah Halaman (jumlah) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="ukuran" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_size')</label>
                    <input type="text" id="ukuran" name="ukuran" placeholder="@lang('catalog.size_placeholder')"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
                <div>
                    <label for="jumlah_halaman" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_page_count')</label>
                    <input type="number" id="jumlah_halaman" name="jumlah" placeholder="@lang('catalog.page_count_placeholder')"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
            </div>

            <!-- Bulan & Tahun Terbit (terbit) -->
            <div>
                <label for="tahun_terbit" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_publish_date')</label>
                <input type="text" id="tahun_terbit" name="terbit" placeholder="@lang('catalog.publish_date_placeholder')"
                    class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
            </div>

            <!-- Opsi Radio (Kondisi Terbitan & Ketersediaan) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">@lang('catalog.label_condition')</label>
                    <div class="flex items-center gap-6">
                        <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                            <input type="radio" name="kondisi" value="Baru"
                                class="text-[#B6171E] focus:ring-[#B6171E]"> @lang('catalog.condition_new')
                        </label>
                        <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                            <input type="radio" name="kondisi" value="Second Hand"
                                class="text-[#B6171E] focus:ring-[#B6171E]"> @lang('catalog.condition_used')
                        </label>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">@lang('catalog.label_availability')</label>
                    <div class="flex items-center gap-6">
                        <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                            <input type="radio" name="ketersediaan" value="Tersedia"
                                class="text-[#B6171E] focus:ring-[#B6171E]"> @lang('catalog.availability_available')
                        </label>
                        <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                            <input type="radio" name="ketersediaan" value="Pre-Order"
                                class="text-[#B6171E] focus:ring-[#B6171E]"> @lang('catalog.availability_preorder')
                        </label>
                    </div>
                </div>
            </div>

            <!-- Keterangan -->
            <div>
                <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_notes')</label>
                <input type="text" id="keterangan" name="keterangan" placeholder="@lang('catalog.notes_placeholder')"
                    class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_description')</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="@lang('catalog.description_placeholder')"
                    class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]"></textarea>
            </div>

            <!-- Info Tambahan (info) -->
            <div>
                <label for="info_tambahan" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_additional_info')</label>
                <textarea id="info_tambahan" name="info" rows="4" placeholder="@lang('catalog.additional_info_placeholder')"
                    class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]"></textarea>
            </div>

            <!-- Harga & Harga Diskon (diskon) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="harga" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_price')</label>
                    <input type="text" id="harga" name="harga" placeholder="@lang('catalog.price_placeholder')"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                    <p class="text-[11px] text-gray-500 mt-1">@lang('catalog.price_note')</p>
                </div>
                <div>
                    <label for="harga_diskon" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_discount_price')</label>
                    <input type="text" id="harga_diskon" name="diskon" placeholder="@lang('catalog.discount_placeholder')"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                    <p class="text-[11px] text-gray-500 mt-1">@lang('catalog.discount_note')</p>
                </div>
            </div>

            <!-- Penjual / Penyedia & No WA (wa) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="penjual" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_seller')</label>
                    <input type="text" id="penjual" name="penjual" placeholder="@lang('catalog.seller_placeholder')"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
                <div>
                    <label for="no_wa" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_whatsapp')</label>
                    <input type="text" id="no_wa" name="wa" placeholder="@lang('catalog.whatsapp_placeholder')"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
            </div>

            <!-- Alamat & No KTP (ktp) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_address')</label>
                    <input type="text" id="alamat" name="alamat" placeholder="@lang('catalog.address_placeholder')"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
                <div>
                    <label for="no_ktp" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_ktp')</label>
                    <input type="text" id="no_ktp" name="ktp" placeholder="@lang('catalog.ktp_placeholder')"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
            </div>

            <!-- Nama Bank (bank) & Nomor Rekening (norek) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="nama_bank" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_bank_name')</label>
                    <input type="text" id="nama_bank" name="bank" placeholder="@lang('catalog.bank_placeholder')"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
                <div>
                    <label for="no_rekening" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_account_number')</label>
                    <input type="text" id="no_rekening" name="norek" placeholder="@lang('catalog.account_placeholder')"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
            </div>

            <!-- Unggah File: Cover Depan (cover), Cover Belakang (cover_belakang), Daftar Isi (img) -->
            <div class="space-y-4 pt-2 border-t">
                <div>
                    <label for="cover_depan" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_front_cover')</label>
                    <input type="file" id="cover_depan" name="cover" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-[#B6171E] hover:file:bg-red-100">
                    <p class="text-xs text-gray-400 mt-1">@lang('catalog.note_image_size')</p>
                </div>
                <div>
                    <label for="cover_belakang" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_back_cover')</label>
                    <input type="file" id="cover_belakang" name="cover_belakang" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-[#B6171E] hover:file:bg-red-100">
                    <p class="text-xs text-gray-400 mt-1">@lang('catalog.note_image_size')</p>
                </div>
                <div>
                    <label for="daftar_isi" class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_table_of_contents')</label>
                    <input type="file" id="daftar_isi" name="img" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-[#B6171E] hover:file:bg-red-100">
                    <p class="text-xs text-gray-400 mt-1">@lang('catalog.note_image_size')</p>
                </div>
            </div>

            <!-- Tombol Aksi Pop-up -->
            <div class="flex justify-end gap-2 pt-6 border-t">
                <button type="button" onclick="document.getElementById('modal-katalog').classList.add('hidden')"
                    class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-300 transition-all">
                    @lang('common.cancel')
                </button>
                <button type="submit" id="submit-btn"
                    class="px-6 py-2.5 bg-[#B6171E] text-white rounded-lg font-semibold text-sm hover:bg-red-900 transition-all shadow-md">
                    @lang('catalog.submit')
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
    submitBtn.innerText = '@lang('common.sending')';

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
            throw { message: "@lang('catalog.server_error')" };
        }
    })
    .then(data => {
        // Sukses
        alertBox.className = "mb-4 p-4 bg-emerald-100 border border-emerald-400 text-emerald-700 rounded-lg text-sm flex items-center justify-between";
        alertMsg.innerText = data.message || "@lang('catalog.submit_success')";
        alertBox.classList.remove('hidden');

        document.getElementById('form-katalog').reset();
        alertBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

        setTimeout(() => {
            alertBox.classList.add('hidden');
        }, 8000);
    })
    .catch(error => {
        // Tangkap pesan error baik dari validasi maupun dari server
        let errorText = error.message || '@lang('catalog.submit_error')';

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
        submitBtn.innerText = '@lang('catalog.submit')';
    });
});
</script>

    </div>
@endsection

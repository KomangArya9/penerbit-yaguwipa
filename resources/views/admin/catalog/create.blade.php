@extends('admin.layouts.admin')

@section('title', 'Tambah Buku Baru')

@section('content')
<div class="p-8 max-w-5xl mx-auto space-y-6">
    <!-- Page Header & Back Button -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Tambah Buku Baru</h1>
            <p class="text-slate-500 text-sm mt-1">Masukkan rincian data buku, metadata penerbitan, dan berkas cover untuk katalog.</p>
        </div>
        <a href="{{ route('admin.catalog.index') }}"
            class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
            &larr; Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl text-sm shadow-2xs">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.catalog.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Informasi Utama Buku -->
        <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-200 space-y-5">
            <h3 class="text-lg font-bold text-slate-800 pb-3 border-b border-slate-100">1. Data Pokok Buku</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Judul Buku <span class="text-rose-500">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul') }}" required
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none"
                        placeholder="Judul lengkap buku...">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Penulis <span class="text-rose-500">*</span></label>
                    <input type="text" name="penulis" value="{{ old('penulis') }}" required
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none"
                        placeholder="Nama penulis...">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Editor</label>
                    <input type="text" name="editor" value="{{ old('editor') }}"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none"
                        placeholder="Nama editor...">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Penerbit</label>
                    <input type="text" name="penerbit" value="{{ old('penerbit', 'Yaguwipa') }}"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Institusi Penulis</label>
                    <input type="text" name="i_penulis" value="{{ old('i_penulis') }}"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Institusi Editor</label>
                    <input type="text" name="i_editor" value="{{ old('i_editor') }}"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Jenis Terbitan</label>
                    <select id="jenis" name="jenis"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white">
                        @php $jenisVal = old('jenis'); @endphp
                        <option value="">-- Pilih Jenis Terbitan --</option>
                        <option value="Buku" {{ $jenisVal == 'Buku' ? 'selected' : '' }}>Buku</option>
                        <option value="Jurnal" {{ $jenisVal == 'Jurnal' ? 'selected' : '' }}>Jurnal</option>
                        <option value="Prosiding" {{ $jenisVal == 'Prosiding' ? 'selected' : '' }}>Prosiding</option>
                        <option value="Majalah Ilmiah" {{ $jenisVal == 'Majalah Ilmiah' ? 'selected' : '' }}>Majalah Ilmiah</option>
                        <option value="Artikel Ilmiah" {{ $jenisVal == 'Artikel Ilmiah' ? 'selected' : '' }}>Artikel Ilmiah</option>
                        <option value="Lainnya" {{ $jenisVal == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kategori Terbitan</label>
                    <select id="kategori" name="kategori"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white">
                        @php $katVal = old('kategori'); @endphp
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Buku Referensi" {{ $katVal == 'Buku Referensi' ? 'selected' : '' }}>Buku Referensi</option>
                        <option value="Buku Monograf" {{ $katVal == 'Buku Monograf' ? 'selected' : '' }}>Buku Monograf</option>
                        <option value="Buku Ajar" {{ $katVal == 'Buku Ajar' ? 'selected' : '' }}>Buku Ajar</option>
                        <option value="Buku Teks" {{ $katVal == 'Buku Teks' ? 'selected' : '' }}>Buku Teks</option>
                        <option value="Karya Fiksi" {{ $katVal == 'Karya Fiksi' ? 'selected' : '' }}>Karya Fiksi</option>
                        <option value="Jurnal Nasional" {{ $katVal == 'Jurnal Nasional' ? 'selected' : '' }}>Jurnal Nasional</option>
                        <option value="Jurnal Nasional Terakreditasi" {{ $katVal == 'Jurnal Nasional Terakreditasi' ? 'selected' : '' }}>Jurnal Nasional Terakreditasi</option>
                        <option value="Jurnal Internasional" {{ $katVal == 'Jurnal Internasional' ? 'selected' : '' }}>Jurnal Internasional</option>
                        <option value="Jurnal Internasional Berreputasi" {{ $katVal == 'Jurnal Internasional Berreputasi' ? 'selected' : '' }}>Jurnal Internasional Berreputasi</option>
                        <option value="Prosiding Nasional" {{ $katVal == 'Prosiding Nasional' ? 'selected' : '' }}>Prosiding Nasional</option>
                        <option value="Prosiding Nasional Terakreditasi" {{ $katVal == 'Prosiding Nasional Terakreditasi' ? 'selected' : '' }}>Prosiding Nasional Terakreditasi</option>
                        <option value="Prosiding Internasional" {{ $katVal == 'Prosiding Internasional' ? 'selected' : '' }}>Prosiding Internasional</option>
                        <option value="Prosiding Internasional Berreputasi" {{ $katVal == 'Prosiding Internasional Berreputasi' ? 'selected' : '' }}>Prosiding Internasional Berreputasi</option>
                        <option value="Lainnya" {{ $katVal == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Bidang Ilmu</label>
                    <input type="text" name="bidang" value="{{ old('bidang') }}" placeholder="Contoh: Pendidikan / Ilmu Komputer"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nomor ISBN</label>
                    <input type="text" name="isbn" value="{{ old('isbn') }}" placeholder="Contoh: 978-623-..."
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none font-mono text-xs">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Ukuran Buku</label>
                    <input type="text" name="ukuran" value="{{ old('ukuran') }}" placeholder="14x20 cm"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Jumlah Halaman</label>
                    <input type="text" name="jumlah" value="{{ old('jumlah') }}" placeholder="Contoh: 180 hlm"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tahun Terbit</label>
                    <input type="text" name="terbit" value="{{ old('terbit') }}" placeholder="Contoh: Januari 2026"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kondisi</label>
                    <select name="kondisi" class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white">
                        @php $kondisiVal = old('kondisi'); @endphp
                        <option value="Baru" {{ $kondisiVal == 'Baru' ? 'selected' : '' }}>Baru</option>
                        <option value="Second Hand" {{ $kondisiVal == 'Second Hand' ? 'selected' : '' }}>Second Hand</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Ketersediaan Stok</label>
                    <select name="ketersediaan" class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white">
                        @php $tersediaVal = old('ketersediaan'); @endphp
                        <option value="Tersedia" {{ $tersediaVal == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="Pre-Order" {{ $tersediaVal == 'Pre-Order' ? 'selected' : '' }}>Pre-Order</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi / Sinopsis</label>
                    <textarea name="deskripsi" rows="4" placeholder="Sinopsis singkat buku..."
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">{{ old('deskripsi') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Info Tambahan</label>
                    <textarea name="info" rows="4" placeholder="Informasi tambahan lain..."
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">{{ old('info') }}</textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Harga (Rp)</label>
                    <input type="text" name="harga" value="{{ old('harga') }}" placeholder="Contoh: 75000"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Harga Diskon (Rp)</label>
                    <input type="text" name="diskon" value="{{ old('diskon') }}" placeholder="Contoh: 65000"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
            </div>
        </div>

        <!-- Berkas Gambar & Softfile -->
        <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-200 space-y-5">
            <h3 class="text-lg font-bold text-slate-800 pb-3 border-b border-slate-100">2. Berkas Cover & Dokumen</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="p-4 bg-slate-50/70 rounded-xl border border-slate-200">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Cover Depan</label>
                    <input type="file" name="cover" accept="image/*"
                        class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                </div>
                <div class="p-4 bg-slate-50/70 rounded-xl border border-slate-200">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Cover Belakang</label>
                    <input type="file" name="cover_belakang" accept="image/*"
                        class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="p-4 bg-slate-50/70 rounded-xl border border-slate-200">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Daftar Isi (Gambar / Foto)</label>
                    <input type="file" name="img" accept="image/*"
                        class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                </div>
                <div class="p-4 bg-slate-50/70 rounded-xl border border-slate-200">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Soft File Dokumen (PDF)</label>
                    <input type="file" name="soft_file"
                        class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Jumlah Kunjungan Awal (Hit)</label>
                    <input type="number" name="hite" value="{{ old('hite', 0) }}"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Status Publikasi</label>
                    <select name="status" class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white">
                        <option value="Show" {{ old('status') == 'Show' ? 'selected' : '' }}>Show (Tampilkan)</option>
                        <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                        <option value="Hide" {{ old('status') == 'Hide' ? 'selected' : '' }}>Hide (Sembunyikan)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex items-center justify-end gap-3 pt-4">
            <a href="{{ route('admin.catalog.index') }}"
                class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
                Batal
            </a>
            <button type="submit"
                class="px-6 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-lg text-sm font-medium transition shadow-sm">
                Simpan Buku ke Katalog
            </button>
        </div>
    </form>
</div>
@endsection
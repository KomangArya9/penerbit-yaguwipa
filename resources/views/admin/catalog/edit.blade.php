@extends('admin.layouts.admin')

@section('content')
<div class="p-6 max-w-5xl mx-auto bg-white rounded-xl shadow border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Catalog</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-rose-100 text-rose-700 rounded-lg text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.catalog.update', $catalog->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                <input type="text" name="judul" value="{{ old('judul', $catalog->judul) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Penulis</label>
                <input type="text" name="penulis" value="{{ old('penulis', $catalog->penulis) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Editor</label>
                <input type="text" name="editor" value="{{ old('editor', $catalog->editor) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Penerbit</label>
                <input type="text" name="penerbit" value="{{ old('penerbit', $catalog->penerbit) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Institusi Penulis</label>
                <input type="text" name="institusi_penulis" value="{{ old('institusi_penulis', $catalog->institusi_penulis) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Institusi Editor</label>
                <input type="text" name="institusi_editor" value="{{ old('institusi_editor', $catalog->institusi_editor) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Terbitan</label>
                <select name="jenis_terbitan" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm bg-white">
                    @php $jenisVal = old('jenis_terbitan', $catalog->jenis_terbitan); @endphp
                    <option value="Buku" {{ $jenisVal == 'Buku' ? 'selected' : '' }}>Buku</option>
                    <option value="Jurnal" {{ $jenisVal == 'Jurnal' ? 'selected' : '' }}>Jurnal</option>
                    <option value="Prosiding" {{ $jenisVal == 'Prosiding' ? 'selected' : '' }}>Prosiding</option>
                    <option value="Majalah Ilmiah" {{ $jenisVal == 'Majalah Ilmiah' ? 'selected' : '' }}>Majalah Ilmiah</option>
                    <option value="Artikel Ilmiah" {{ $jenisVal == 'Artikel Ilmiah' ? 'selected' : '' }}>Artikel Ilmiah</option>
                    <option value="Lainnya" {{ $jenisVal == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="kategori" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm bg-white">
                    @php $katVal = old('kategori', $catalog->kategori); @endphp
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

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bidang Ilmu</label>
                <input type="text" name="bidang_ilmu" value="{{ old('bidang_ilmu', $catalog->bidang_ilmu) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">ISBN</label>
                <input type="text" name="isbn" value="{{ old('isbn', $catalog->isbn) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">ISSN</label>
                <input type="text" name="issn" value="{{ old('issn', $catalog->issn) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ukuran</label>
                <input type="text" name="ukuran" value="{{ old('ukuran', $catalog->ukuran) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Halaman</label>
                <input type="text" name="jumlah_halaman" value="{{ old('jumlah_halaman', $catalog->jumlah_halaman) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bulan & Tahun Terbit</label>
                <input type="text" name="tahun_terbit" value="{{ old('tahun_terbit', $catalog->tahun_terbit) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kondisi Terbitan</label>
                <select name="kondisi" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm bg-white">
                    @php $kondisiVal = old('kondisi', $catalog->kondisi); @endphp
                    <option value="Baru" {{ $kondisiVal == 'Baru' ? 'selected' : '' }}>Baru</option>
                    <option value="Second Hand" {{ $kondisiVal == 'Second Hand' ? 'selected' : '' }}>Second Hand</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ketersediaan</label>
                <select name="ketersediaan" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm bg-white">
                    @php $tersediaVal = old('ketersediaan', $catalog->ketersediaan); @endphp
                    <option value="Tersedia" {{ $tersediaVal == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Pre-Order" {{ $tersediaVal == 'Pre-Order' ? 'selected' : '' }}>Pre-Order</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">{{ old('deskripsi', $catalog->deskripsi) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Info Tambahan</label>
                <textarea name="info_tambahan" rows="4" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">{{ old('info_tambahan', $catalog->info_tambahan) }}</textarea>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                <input type="text" name="harga" value="{{ old('harga', $catalog->harga) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga Diskon</label>
                <input type="text" name="harga_diskon" value="{{ old('harga_diskon', $catalog->harga_diskon) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                <input type="text" name="keterangan" value="{{ old('keterangan', $catalog->keterangan) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Penjual/Penyedia</label>
                <input type="text" name="penjual" value="{{ old('penjual', $catalog->penjual) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No WA</label>
                <input type="text" name="no_wa" value="{{ old('no_wa', $catalog->no_wa) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <input type="text" name="alamat" value="{{ old('alamat', $catalog->alamat) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No KTP</label>
                <input type="text" name="no_ktp" value="{{ old('no_ktp', $catalog->no_ktp) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Bank</label>
                <input type="text" name="nama_bank" value="{{ old('nama_bank', $catalog->nama_bank) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Rekening</label>
                <input type="text" name="no_rekening" value="{{ old('no_rekening', $catalog->no_rekening) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <!-- Bagian Gambar & Preview -->
        <div class="grid grid-cols-3 gap-4 pt-4 border-t">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cover Depan</label>
                @if($catalog->cover)
                    <div class="mb-2"><img src="{{ asset('storage/' . $catalog->cover) }}" class="w-20 h-28 object-cover rounded border"></div>
                @endif
                <input type="file" name="cover" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cover Belakang</label>
                @if($catalog->cover_belakang)
                    <div class="mb-2"><img src="{{ asset('storage/' . $catalog->cover_belakang) }}" class="w-20 h-28 object-cover rounded border"></div>
                @endif
                <input type="file" name="cover_belakang" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Daftar Isi (Img)</label>
                @if($catalog->img)
                    <div class="mb-2"><img src="{{ asset('storage/' . $catalog->img) }}" class="w-20 h-28 object-cover rounded border"></div>
                @endif
                <input type="file" name="img" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Hit</label>
                <input type="number" name="hite" value="{{ old('hite', $catalog->hite) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm bg-white">
                    <option value="Show" {{ $catalog->status == 'Show' ? 'selected' : '' }}>Show</option>
                    <option value="Hide" {{ $catalog->status == 'Hide' ? 'selected' : '' }}>Hide</option>
                </select>
            </div>
        </div>

        <div class="flex justify-end gap-2 pt-4">
            <a href="{{ route('admin.catalog.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg text-sm font-semibold">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
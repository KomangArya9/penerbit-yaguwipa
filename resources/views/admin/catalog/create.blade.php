@extends('admin.layouts.admin')

@section('content')
<div class="p-6 max-w-5xl mx-auto bg-white rounded-xl shadow border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Catalog</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-rose-100 text-rose-700 rounded-lg text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.catalog.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                <input type="text" name="judul" value="{{ old('judul') }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Penulis</label>
                <input type="text" name="penulis" value="{{ old('penulis') }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Editor</label>
                <input type="text" name="editor" value="{{ old('editor') }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Penerbit</label>
                <input type="text" name="penerbit" value="{{ old('penerbit') }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Institusi Penulis (i_penulis)</label>
                <input type="text" name="i_penulis" value="{{ old('i_penulis') }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Institusi Editor (i_editor)</label>
                <input type="text" name="i_editor" value="{{ old('i_editor') }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Terbitan (jenis)</label>
                <input type="text" name="jenis" value="{{ old('jenis') }}" placeholder="Buku, Jurnal, dll" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <input type="text" name="kategori" value="{{ old('kategori') }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bidang Ilmu (bidang)</label>
                <input type="text" name="bidang" value="{{ old('bidang') }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">ISBN</label>
                <input type="text" name="isbn" value="{{ old('isbn') }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">ISSN</label>
                <input type="text" name="issn" value="{{ old('issn') }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ukuran</label>
                <input type="text" name="ukuran" value="{{ old('ukuran') }}" placeholder="14x20 cm" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Halaman (jumlah)</label>
                <input type="text" name="jumlah" value="{{ old('jumlah') }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Terbit (terbit)</label>
                <input type="text" name="terbit" value="{{ old('terbit') }}" placeholder="Januari 2026" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kondisi</label>
                <input type="text" name="kondisi" value="{{ old('kondisi') }}" placeholder="Baru / Second" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ketersediaan</label>
                <input type="text" name="ketersediaan" value="{{ old('ketersediaan') }}" placeholder="Tersedia / Pre-Order" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">{{ old('deskripsi') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Info Tambahan (info)</label>
                <textarea name="info" rows="4" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">{{ old('info') }}</textarea>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                <input type="text" name="harga" value="{{ old('harga') }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga Diskon (diskon)</label>
                <input type="text" name="diskon" value="{{ old('diskon') }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                <input type="text" name="keterangan" value="{{ old('keterangan') }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Penjual</label>
                <input type="text" name="penjual" value="{{ old('penjual') }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No WhatsApp (wa)</label>
                <input type="text" name="wa" value="{{ old('wa') }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <input type="text" name="alamat" value="{{ old('alamat') }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No KTP (ktp)</label>
                <input type="text" name="ktp" value="{{ old('ktp') }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Bank (bank)</label>
                <input type="text" name="bank" value="{{ old('bank') }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Rekening (norek)</label>
                <input type="text" name="norek" value="{{ old('norek') }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <!-- File Gambar (Cover, Cover Belakang, Daftar Isi/img, soft_file) -->
        <div class="grid grid-cols-2 gap-4 pt-4 border-t">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cover Depan (cover)</label>
                <input type="file" name="cover" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cover Belakang (cover_belakang)</label>
                <input type="file" name="cover_belakang" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Daftar Isi (img)</label>
                <input type="file" name="img" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Soft File Dokumen (Opsional)</label>
                <input type="file" name="soft_file" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Hit (hite)</label>
                <input type="number" name="hite" value="{{ old('hite', 0) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm bg-white">
                    <option value="Show">Show</option>
                    <option value="Hide">Hide</option>
                    <option value="Pending">Pending</option>
                </select>
            </div>
        </div>

        <div class="flex justify-end gap-2 pt-4">
            <a href="{{ route('admin.catalog.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg text-sm font-semibold">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Submit</button>
        </div>
    </form>
</div>
@endsection
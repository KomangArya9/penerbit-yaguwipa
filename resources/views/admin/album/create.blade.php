@extends('admin.layouts.admin')

@section('title', 'Tambah Album Foto')

@section('content')
<div class="p-8 max-w-4xl mx-auto space-y-6">
    <!-- Page Header & Back Button -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Tambah Album Baru</h1>
            <p class="text-slate-500 text-sm mt-1">Buat album kegiatan baru dan unggah foto thumbnail utama.</p>
        </div>
        <a href="{{ route('admin.album.index') }}"
            class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
            &larr; Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-200">
        <form action="{{ route('admin.album.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Title -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama / Judul Album <span class="text-rose-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required maxlength="100"
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none"
                    placeholder="Contoh: Dokumentasi Seminar Literasi Nasional 2026">
                @error('title') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Thumbnail Image -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Thumbnail Utama Album <span class="text-rose-500">*</span></label>
                <input type="file" name="img" required
                    class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG, WebP. Foto ini akan menjadi cover album di galeri.</p>
                @error('img') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Grid: Date, Status, Hit -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggal Kegiatan <span class="text-rose-500">*</span></label>
                    <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white">
                    @error('date') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Status Publikasi</label>
                    <select name="status"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white">
                        <option value="Show" {{ old('status') == 'Show' ? 'selected' : '' }}>Tampilkan (Show)</option>
                        <option value="Hide" {{ old('status') == 'Hide' ? 'selected' : '' }}>Sembunyikan (Hide)</option>
                    </select>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('admin.album.index') }}"
                    class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-lg text-sm font-medium transition shadow-sm">
                    Simpan Album
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
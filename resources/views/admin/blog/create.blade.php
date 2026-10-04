@extends('admin.layouts.admin')

@section('title', 'Tambah Berita & Event')

@section('content')
<div class="p-8 max-w-5xl mx-auto space-y-6">
    <!-- Page Header & Back Button -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Tambah Berita / Event</h1>
            <p class="text-slate-500 text-sm mt-1">Publikasikan artikel, dokumentasi event, atau berita seputar penerbitan.</p>
        </div>
        <a href="{{ route('admin.blog.index') }}"
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

    <!-- Form Card -->
    <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-200">
        <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kategori Berita <span class="text-rose-500">*</span></label>
                    <select name="id_category" class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->id }}" {{ old('id_category') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Date -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggal Publikasi <span class="text-rose-500">*</span></label>
                    <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white">
                </div>
            </div>

            <!-- Title -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Judul Berita / Acara <span class="text-rose-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Tuliskan judul berita yang menarik..." required
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
            </div>

            <!-- Content -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Isi Konten Berita <span class="text-rose-500">*</span></label>
                <textarea name="content" rows="8" placeholder="Tuliskan narasi lengkap berita atau acara di sini..." required
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none leading-relaxed">{{ old('content') }}</textarea>
            </div>

            <!-- Image Upload Box -->
            <div class="p-5 bg-slate-50/70 rounded-xl border border-slate-200">
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Foto Utama Berita</label>
                <input type="file" name="img"
                    class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                <p class="text-xs text-slate-400 mt-1">Maks. 2MB. Format didukung: JPG, PNG, WEBP.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Caption Image Blog -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Caption Gambar (Opsional)</label>
                    <input type="text" name="caption" value="{{ old('caption') }}" placeholder="Contoh: Suasana penandatanganan MoU"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>

                <!-- Tags -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tags (Pisahkan dengan koma)</label>
                    <input type="text" name="tags" value="{{ old('tags') }}" placeholder="Contoh: literasi, yaguwipa, buku-baru"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Meta Keywords -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Meta Keywords SEO</label>
                    <input type="text" name="keyword" value="{{ old('keyword') }}" placeholder="Keyword SEO..."
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>

                <!-- Hit -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Jumlah View Awal</label>
                    <input type="number" name="hit" value="{{ old('hit', 0) }}"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Status Publikasi</label>
                    <select name="status" class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white">
                        <option value="Show" {{ old('status') == 'Show' ? 'selected' : '' }}>Tampilkan (Show)</option>
                        <option value="Hide" {{ old('status') == 'Hide' ? 'selected' : '' }}>Sembunyikan (Hide)</option>
                    </select>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('admin.blog.index') }}"
                    class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-lg text-sm font-medium transition shadow-sm">
                    Simpan Berita
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
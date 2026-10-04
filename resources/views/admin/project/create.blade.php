@extends('admin.layouts.admin')

@section('title', 'Tambah Portofolio')

@section('content')
<div class="p-8 max-w-5xl mx-auto space-y-6">
    <!-- Page Header & Back Button -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Tambah Portofolio Baru</h1>
            <p class="text-slate-500 text-sm mt-1">Tambahkan karya buku terbit atau dokumentasi proyek penerbitan baru.</p>
        </div>
        <a href="{{ route('admin.project.index') }}"
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
        <form action="{{ route('admin.project.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kategori Portofolio <span class="text-rose-500">*</span></label>
                    <select name="kategori_project_id" class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoriProjects as $kat)
                            <option value="{{ $kat->id }}" {{ old('kategori_project_id') == $kat->id ? 'selected' : '' }}>{{ $kat->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Program / Layanan Terkait <span class="text-rose-500">*</span></label>
                    <select name="id_service" class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white" required>
                        <option value="">-- Pilih Layanan --</option>
                        @foreach($services as $srv)
                            <option value="{{ $srv->id }}" {{ old('id_service') == $srv->id ? 'selected' : '' }}>{{ $srv->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Judul Proyek / Buku <span class="text-rose-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="Judul portofolio..." required
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggal <span class="text-rose-500">*</span></label>
                    <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Lokasi / Instansi Kerjasama <span class="text-rose-500">*</span></label>
                    <input type="text" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Denpasar, Bali / Universitas Udayana" required
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tautan Eksternal (Opsional)</label>
                    <input type="url" name="url" value="{{ old('url') }}" placeholder="https://example.com"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm font-mono focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi Lengkap Portofolio <span class="text-rose-500">*</span></label>
                <textarea name="content" rows="5" placeholder="Ceritakan proses dan hasil penerbitan proyek ini..." required
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">{{ old('content') }}</textarea>
            </div>

            <div class="p-4 bg-slate-50/60 rounded-xl border border-slate-200/80">
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Gambar / Foto Utama Portofolio</label>
                <input type="file" name="img"
                    class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG, WEBP. Maks 2MB.</p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Status Publikasi</label>
                <select name="status" class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white">
                    <option value="Show">Tampilkan (Show)</option>
                    <option value="Hide">Sembunyikan (Hide)</option>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('admin.project.index') }}"
                    class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-lg text-sm font-medium transition shadow-sm">
                    Simpan Portofolio
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
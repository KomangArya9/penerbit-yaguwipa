@extends('admin.layouts.admin')

@section('title', 'Edit Portofolio')

@section('content')
<div class="p-8 max-w-5xl mx-auto space-y-6">
    <!-- Page Header & Back Button -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Edit Portofolio</h1>
            <p class="text-slate-500 text-sm mt-1">Perbarui rincian karya atau dokumentasi portofolio penerbitan.</p>
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
        <form action="{{ route('admin.project.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kategori Portofolio <span class="text-rose-500">*</span></label>
                    <select name="kategori_project_id" class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoriProjects as $kat)
                            <option value="{{ $kat->id }}" {{ old('kategori_project_id', $project->kategori_project_id) == $kat->id ? 'selected' : '' }}>{{ $kat->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Program / Layanan Terkait <span class="text-rose-500">*</span></label>
                    <select name="id_service" class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white" required>
                        <option value="">-- Pilih Layanan --</option>
                        @foreach($services as $srv)
                            <option value="{{ $srv->id }}" {{ old('id_service', $project->id_service) == $srv->id ? 'selected' : '' }}>{{ $srv->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Judul Proyek / Buku <span class="text-rose-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $project->title) }}" placeholder="Judul portofolio..." required
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggal <span class="text-rose-500">*</span></label>
                    <input type="date" name="date" value="{{ old('date', $project->date) }}" required
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Lokasi / Instansi Kerjasama <span class="text-rose-500">*</span></label>
                    <input type="text" name="lokasi" value="{{ old('lokasi', $project->lokasi) }}" placeholder="Contoh: Denpasar, Bali / Universitas Udayana" required
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tautan Eksternal (Opsional)</label>
                    <input type="url" name="url" value="{{ old('url', $project->url) }}" placeholder="https://example.com"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm font-mono focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi Lengkap Portofolio <span class="text-rose-500">*</span></label>
                <textarea name="content" rows="6" placeholder="Ceritakan proses dan hasil penerbitan proyek ini..." required
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">{{ old('content', $project->content) }}</textarea>
            </div>

            <!-- Image Upload & Preview -->
            <div class="p-5 bg-slate-50/70 rounded-xl border border-slate-200">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Gambar / Cover Utama</label>
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    @if($project->img)
                        <div class="relative group shrink-0">
                            <img src="{{ asset('storage/' . $project->img) }}" alt="Preview" class="w-20 h-20 object-cover rounded-lg border border-slate-300 shadow-sm">
                            <span class="absolute -bottom-2 inset-x-0 text-center bg-slate-800/80 text-white text-[10px] rounded px-1 py-0.5">Saat Ini</span>
                        </div>
                    @endif
                    <div class="flex-1 w-full">
                        <input type="file" name="img"
                            class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                        <p class="text-xs text-slate-400 mt-1">Kosongkan jika tidak ingin mengganti gambar utama (Maks. 2MB, JPG/PNG/WEBP).</p>
                    </div>
                </div>
            </div>

            @if($project->fotos && $project->fotos->count() > 0)
                <div class="p-5 bg-slate-50/70 rounded-xl border border-slate-200">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Galeri Foto Portofolio:</label>
                    <div class="flex flex-wrap gap-3">
                        @foreach($project->fotos as $foto)
                            <div class="relative group">
                                <img src="{{ asset('storage/' . $foto->img) }}" alt="Galeri" class="w-20 h-20 object-cover rounded-lg border border-slate-200 shadow-sm">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Jumlah Kunjungan (Hit)</label>
                    <input type="number" name="hit" value="{{ old('hit', $project->hit) }}"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Status Publikasi</label>
                    <select name="status" class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white">
                        <option value="Show" {{ old('status', $project->status) == 'Show' ? 'selected' : '' }}>Tampilkan (Show)</option>
                        <option value="Hide" {{ old('status', $project->status) == 'Hide' ? 'selected' : '' }}>Sembunyikan (Hide)</option>
                    </select>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('admin.project.index') }}"
                    class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-lg text-sm font-medium transition shadow-sm">
                    Perbarui Portofolio
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
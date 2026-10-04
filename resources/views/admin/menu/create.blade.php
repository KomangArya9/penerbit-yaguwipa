@extends('admin.layouts.admin')

@section('title', 'Tambah Menu Baru')

@section('content')
<div class="p-8 max-w-4xl mx-auto">
    <!-- Breadcrumb & Header -->
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Tambah Menu Navigasi</h1>
            <p class="text-slate-500 text-sm mt-1">Buat menu baru untuk ditampilkan pada navigasi header website.</p>
        </div>
        <a href="{{ route('admin.menu.index') }}"
            class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
            &larr; Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-200">
        <form action="{{ route('admin.menu.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Judul Menu -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Menu (Title) <span class="text-rose-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}"
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none"
                    required placeholder="Contoh: Tentang Kami / Program Khusus">
                @error('title')
                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Target URL -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">URL / Link Target <span class="text-rose-500">*</span></label>
                <input type="text" id="menu-url-input" name="url" value="{{ old('url') }}"
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm font-mono focus:ring-2 focus:ring-red-500 focus:outline-none"
                    required placeholder="Contoh: profile, katalog, atau https://...">
                <p class="text-xs text-slate-500 mt-1.5">
                    Gunakan slug internal halaman website (misal: <code>profile</code>, <code>katalog</code>, <code>program</code>) atau link eksternal lengkap.
                </p>
                <!-- Quick Suggestion Buttons -->
                <div class="flex flex-wrap gap-1.5 mt-2">
                    <span class="text-xs text-slate-500 py-1">Pilih Cepat:</span>
                    @foreach(['/' => 'Home', 'profile' => 'Profile', 'program' => 'Program', 'portofolio' => 'Portofolio', 'penulis' => 'Penulis', 'katalog' => 'Katalog', 'partners' => 'Partners', 'news' => 'News'] as $val => $label)
                        <button type="button" onclick="document.getElementById('menu-url-input').value = '{{ $val }}'"
                            class="px-2.5 py-1 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded text-xs transition">
                            {{ $label }} ({{ $val }})
                        </button>
                    @endforeach
                </div>
                @error('url')
                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Grid: Parent Menu & Urutan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Parent Menu -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Menu Induk (Parent Menu)</label>
                    <select name="parent_id"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white">
                        <option value="">-- Menu Utama (Tanpa Induk) --</option>
                        @foreach($parentMenus as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                {{ $parent->title }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-slate-500 mt-1">Pilih jika menu ini adalah sub-menu / anak dari menu lain.</p>
                </div>

                <!-- Urutan Tampilan -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nomor Urutan Tampilan</label>
                    <input type="number" name="urutan" value="{{ old('urutan', $nextUrutan ?? 1) }}" min="1"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                    <p class="text-xs text-slate-500 mt-1">Urutan posisi menu (angka semakin kecil tampil lebih kiri/awal).</p>
                </div>
            </div>

            <!-- Status Publikasi -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Status Tampilan</label>
                <div class="flex gap-4">
                    <label class="inline-flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="status" value="Show" {{ old('status', 'Show') == 'Show' ? 'checked' : '' }}
                            class="text-red-600 focus:ring-red-500">
                        <span class="text-sm font-medium text-slate-700">Tampilkan (Show)</span>
                    </label>
                    <label class="inline-flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="status" value="Hide" {{ old('status') == 'Hide' ? 'checked' : '' }}
                            class="text-red-600 focus:ring-red-500">
                        <span class="text-sm font-medium text-slate-700">Sembunyikan (Hide)</span>
                    </label>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('admin.menu.index') }}"
                    class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-lg text-sm font-medium transition shadow-sm">
                    Simpan Menu
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
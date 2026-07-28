@extends('admin.layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">

        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Data Penulis</h1>
                <p class="text-sm text-gray-600 mt-1">Perbarui informasi profil penulis yang terdaftar.</p>
            </div>
            <a href="{{ route('admin.authors.index') }}" class="text-sm text-gray-600 hover:text-gray-900 font-medium">
                &larr; Kembali ke Daftar
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.authors.update', $author->id) }}" method="POST" enctype="multipart/form-data"
            class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm space-y-6">
            @csrf
            @method('PUT')

            <!-- Baris 1: Nama Lengkap & Institusi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', $author->nama) }}" required
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Institusi</label>
                    <input type="text" name="institusi" value="{{ old('institusi', $author->institusi) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
            </div>

            <!-- Baris 2: Email, Nomor, Social Media -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $author->email) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor</label>
                    <input type="text" name="nomor" value="{{ old('nomor', $author->nomor) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Social Media</label>
                    <input type="text" name="social_media" value="{{ old('social_media', $author->social_media ?? '') }}"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
            </div>

            <!-- Baris 3: Keahlian & Alamat -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Keahlian</label>
                    <input type="text" name="keahlian" value="{{ old('keahlian', $author->keahlian ?? '') }}"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat</label>
                    <input type="text" name="alamat" value="{{ old('alamat', $author->alamat ?? '') }}"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
            </div>

            <!-- Profil Singkat -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Profil Singkat</label>
                <textarea name="profile" rows="5"
                    class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">{{ old('profile', $author->profile ?? '') }}</textarea>
            </div>

            <!-- Bagian Edit Foto Profil di Admin -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profil Penulis</label>

                <!-- Kotak Preview Foto Lama (Menyesuaikan seperti Foto ke-2) -->
                <div class="border border-gray-300 p-4 rounded-lg bg-gray-50 mb-3 flex justify-center items-center">
                    @if($author->foto && file_exists(public_path($author->foto)))
                        <img src="{{ asset($author->foto) }}" alt="Preview Foto"
                            class="max-h-48 object-contain rounded shadow-sm">
                    @else
                        <div class="py-6 text-gray-400 text-sm italic">Belum ada foto yang diunggah</div>
                    @endif
                </div>

                <!-- Input File untuk Ganti Foto -->
                <input type="file" name="foto"
                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-[#B6171E] hover:file:bg-red-100">
                <p class="text-xs text-gray-400 mt-1">note: max. 2MB (PNG/JPG) — Biarkan kosong jika tidak ingin mengubah
                    foto.</p>
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                <select name="status"
                    class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] bg-white">
                    <option value="pending" {{ $author->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="show" {{ $author->status == 'show' ? 'selected' : '' }}>Show (Tampilkan)</option>
                    <option value="hide" {{ $author->status == 'hide' ? 'selected' : '' }}>Hide (Sembunyikan)</option>
                </select>
            </div>

            <!-- Tombol Update -->
            <div class="flex justify-end pt-4 border-t border-gray-200">
                <button type="submit"
                    class="px-8 py-3 bg-[#B6171E] hover:bg-red-800 text-white rounded-lg font-bold text-sm transition-all shadow-md">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection
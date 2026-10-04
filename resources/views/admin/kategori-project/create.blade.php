@extends('admin.layouts.admin')

@section('title', 'Tambah Kategori Portofolio')

@section('content')
<div class="p-8 max-w-4xl mx-auto space-y-6">
    <!-- Page Header & Back Button -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Tambah Kategori Portofolio</h1>
            <p class="text-slate-500 text-sm mt-1">Buat nama kategori baru untuk mengelompokkan portofolio.</p>
        </div>
        <a href="{{ route('admin.kategori-project.index') }}"
            class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
            &larr; Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-200">
        <form action="{{ route('admin.kategori-project.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Title -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Kategori <span class="text-rose-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none"
                    placeholder="Contoh: Penerbitan Buku Akademik / Buku Fiksi / Prosiding">
                @error('title') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('admin.kategori-project.index') }}"
                    class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-lg text-sm font-medium transition shadow-sm">
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
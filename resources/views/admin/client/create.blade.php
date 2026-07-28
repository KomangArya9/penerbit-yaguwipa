@extends('admin.layouts.admin')

@section('title', 'Tambah Client')

@section('content')
<div class="p-8 max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Tambah Client Baru</h1>
        <p class="text-slate-500 text-sm">Masukkan informasi data client atau partner.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <form action="{{ route('client.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs uppercase font-semibold text-slate-600 mb-1">Nama Client / Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500">
                @error('title') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs uppercase font-semibold text-slate-600 mb-1">Upload Logo</label>
                <input type="file" name="img" required class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                @error('img') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs uppercase font-semibold text-slate-600 mb-1">Status</label>
                <select name="status" class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500">
                    <option value="Show">Show</option>
                    <option value="Hide">Hide</option>
                </select>
            </div>

            <div>
                <label class="block text-xs uppercase font-semibold text-slate-600 mb-1">Website URL</label>
                <input type="url" name="url" value="{{ old('url') }}" placeholder="https://example.com" required class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500">
                @error('url') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end space-x-2 pt-4">
                <a href="{{ route('client.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-sm font-semibold transition">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold transition">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
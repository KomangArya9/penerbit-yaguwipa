@extends('admin.layouts.admin')

@section('content')
<div class="p-6 max-w-3xl mx-auto bg-white rounded-xl shadow border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Program Baru</h2>

    {{-- Tampilkan Error Validasi jika ada --}}
    @if ($errors->any())
        <div class="mb-4 p-4 bg-rose-100 text-rose-700 rounded-lg text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('program.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Short Content (Opsional)</label>
            <textarea name="short" rows="3" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">{{ old('short') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
            <textarea name="content" rows="5" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" required>{{ old('content') }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Icon <span class="text-rose-500">*</span></label>
                <input type="file" name="icon" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Image Banner (Opsional)</label>
                <input type="file" name="img" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
                    <option value="Show">Show</option>
                    <option value="Hide">Hide</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">URL (Opsional)</label>
                <input type="url" name="url" value="{{ old('url') }}" placeholder="https://example.com" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="flex justify-end gap-2 pt-4">
            <a href="{{ route('program.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg text-sm font-semibold">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
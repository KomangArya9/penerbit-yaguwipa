@extends('admin.layouts.admin')

@section('content')
<div class="p-6 max-w-5xl mx-auto bg-white rounded-xl shadow border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Portofolio</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-rose-100 text-rose-700 rounded-lg text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.project.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="kategori_project_id" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" required>
                    <option value="">Pilih Kategori...</option>
                    @foreach($kategoriProjects as $kat)
                        <option value="{{ $kat->id }}" {{ old('kategori_project_id', $project->kategori_project_id) == $kat->id ? 'selected' : '' }}>{{ $kat->title }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Services</label>
                <select name="id_service" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" required>
                    <option value="">Pilih Services...</option>
                    @foreach($services as $srv)
                        <option value="{{ $srv->id }}" {{ old('id_service', $project->id_service) == $srv->id ? 'selected' : '' }}>{{ $srv->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                <input type="date" name="date" value="{{ old('date', $project->date) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title', $project->title) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" required>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                <input type="text" name="lokasi" value="{{ old('lokasi', $project->lokasi) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">URL (Opsional)</label>
                <input type="url" name="url" value="{{ old('url', $project->url) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" placeholder="https://example.com">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                <textarea name="content" rows="6" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" required>{{ old('content', $project->content) }}</textarea>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Image Utama / Cover (Biarkan kosong jika tidak diubah)</label>
                    <input type="file" name="img" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    @if($project->img)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $project->img) }}" alt="Preview" class="w-16 h-16 object-cover rounded-lg border">
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @if($project->fotos && $project->fotos->count() > 0)
        <div class="p-4 bg-gray-50 rounded-xl border border-gray-200">
            <label class="block text-sm font-medium text-gray-700 mb-2">Galeri Foto Saat Ini:</label>
            <div class="flex flex-wrap gap-3">
                @foreach($project->fotos as $foto)
                    <div class="relative">
                        <img src="{{ asset('storage/' . $foto->img) }}" alt="Galeri" class="w-20 h-20 object-cover rounded-lg border shadow-sm">
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Hit</label>
                <input type="number" name="hit" value="{{ old('hit', $project->hit) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
                    <option value="Show" {{ $project->status == 'Show' ? 'selected' : '' }}>Show</option>
                    <option value="Hide" {{ $project->status == 'Hide' ? 'selected' : '' }}>Hide</option>
                </select>
            </div>
        </div>

        <div class="flex justify-end gap-2 pt-4">
            <a href="{{ route('admin.project.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg text-sm font-semibold">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Perbarui</button>
        </div>
    </form>
</div>
@endsection
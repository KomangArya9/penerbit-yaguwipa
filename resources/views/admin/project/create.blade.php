@extends('admin.layouts.admin')

@section('content')
<div class="p-6 max-w-5xl mx-auto bg-white rounded-xl shadow border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">@lang('admin.project_create_title')</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-rose-100 text-rose-700 rounded-lg text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.project.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('common.category')</label>
                <select name="kategori_project_id" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" required>
                    <option value="">@lang('common.select_category')</option>
                    @foreach($kategoriProjects as $kat)
                        <option value="{{ $kat->id }}" {{ old('kategori_project_id') == $kat->id ? 'selected' : '' }}>{{ $kat->title }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('common.services')</label>
                <select name="id_service" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" required>
                    <option value="">@lang('common.select_services')</option>
                    @foreach($services as $srv)
                        <option value="{{ $srv->id }}" {{ old('id_service') == $srv->id ? 'selected' : '' }}>{{ $srv->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('common.date')</label>
                <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('common.title')</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="{{ __('common.title') }}..." class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" required>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('admin.project_label_location')</label>
                <input type="text" name="lokasi" value="{{ old('lokasi') }}" placeholder="{{ __('admin.project_label_location') }}..." class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('admin.project_label_url_optional')</label>
                <input type="url" name="url" value="{{ old('url') }}" placeholder="https://example.com" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('common.content')</label>
                <textarea name="content" rows="6" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" required>{{ old('content') }}</textarea>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">@lang('admin.project_label_image_main')</label>
                    <input type="file" name="img" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-xs text-gray-400 mt-1">@lang('admin.project_note_image')</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('common.hit')</label>
                <input type="number" name="hit" value="{{ old('hit', 0) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('common.status')</label>
                <select name="status" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
                    <option value="Show">@lang('common.show')</option>
                    <option value="Hide">@lang('common.hide')</option>
                </select>
            </div>
        </div>

        <div class="flex justify-end gap-2 pt-4">
            <a href="{{ route('admin.project.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg text-sm font-semibold">@lang('common.cancel')</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">@lang('common.submit')</button>
        </div>
    </form>
</div>
@endsection
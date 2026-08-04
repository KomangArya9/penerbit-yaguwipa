@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid px-4 py-6 max-w-2xl">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">@lang('admin.album_edit_title')</h1>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.album.update', $album->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">@lang('common.title')</label>
                    <input type="text" name="title" value="{{ old('title', $album->title) }}" required maxlength="100"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2.5">
                    @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">@lang('admin.album_label_thumbnail')</label>
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $album->img) }}" alt="Current Image"
                            class="w-20 h-24 object-cover rounded shadow">
                    </div>
                    <input type="file" name="img"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <small class="text-gray-400">@lang('admin.album_change_image_hint')</small>
                    @error('img') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">@lang('common.date')</label>
                    <input type="date" name="date" value="{{ old('date', $album->date) }}" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2.5">
                    @error('date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">@lang('common.status')</label>
                    <select name="status"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2.5">
                        <option value="Show" {{ $album->status == 'Show' ? 'selected' : '' }}>@lang('common.show')</option>
                        <option value="Hide" {{ $album->status == 'Hide' ? 'selected' : '' }}>@lang('common.hide')</option>
                    </select>
                    @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">@lang('admin.album_label_hit')</label>
                    <input type="number" name="hit" value="{{ old('hit', $album->hit) }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.album.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg font-medium">@lang('common.cancel')</a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium shadow">@lang('admin.album_update_button')</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">@lang('admin.video_edit_title')</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.video.update', $video->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">@lang('common.date')</label>
                    <input type="date" name="date" value="{{ $video->date }}" required class="w-full border-gray-300 rounded-lg shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">@lang('common.title')</label>
                    <input type="text" name="title" value="{{ $video->title }}" required class="w-full border-gray-300 rounded-lg shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">@lang('admin.video_label_content')</label>
                <!-- Textarea biasa tanpa Summernote -->
                <textarea name="content" rows="5" required class="w-full border-gray-300 rounded-lg shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500">{{ $video->content }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">@lang('admin.video_label_source')</label>
                    <input type="text" name="source" value="{{ $video->source }}" required class="w-full border-gray-300 rounded-lg shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">@lang('common.status')</label>
                    <select name="status" class="w-full border-gray-300 rounded-lg shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="Show" {{ $video->status == 'Show' ? 'selected' : '' }}>@lang('common.show')</option>
                        <option value="Hide" {{ $video->status == 'Hide' ? 'selected' : '' }}>@lang('common.hide')</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.video.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium">@lang('common.cancel')</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-sm font-medium shadow">@lang('common.update')</button>
            </div>
        </form>
    </div>
</div>
@endsection
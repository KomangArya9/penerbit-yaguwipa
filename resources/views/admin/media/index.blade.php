@extends('admin.layouts.admin')

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            @lang('admin.media_index_title')
        </h2>

        @if(session('success'))
            <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('admin.media.create') }}"
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-md active:bg-blue-600 hover:bg-blue-700 focus:outline-none">
                @lang('common.add_data')
            </a>
        </div>

        <div class="w-full overflow-hidden rounded-lg shadow-xs bg-white dark:bg-gray-800">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3" style="width: 10%;">@lang('common.no_label')</th>
                            <th class="px-4 py-3" style="width: 25%;">@lang('common.title')</th>
                            <th class="px-4 py-3" style="width: 45%;">@lang('common.url')</th>
                            <th class="px-4 py-3 text-center" style="width: 20%;">@lang('common.action')</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-gray-700 dark:text-gray-400">
                        @foreach($media as $index => $item)
                            <tr class="dark:hover:bg-gray-900">
                                <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 text-sm font-semibold">{{ $item->title }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ $item->url }}" target="_blank"
                                        class="text-blue-500 hover:underline">{{ $item->url }}</a>
                                </td>
                                <td class="px-4 py-3 text-sm text-center">
                                    <div class="inline-flex items-center space-x-2">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('admin.media.edit', ['id' => $item->id]) }}"
                                            class="px-3 py-1 text-xs font-medium text-white rounded hover:bg-opacity-90"
                                            style="background-color: #0dcaf0;">
                                            @lang('common.edit')
                                        </a>
                                        
                                        <!-- Tombol Delete -->
                                        <form action="{{ route('admin.media.destroy', ['id' => $item->id]) }}" method="POST" class="inline"
                                            onsubmit="return confirm('@lang('admin.media_confirm_delete')')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 text-xs font-medium text-white rounded hover:bg-opacity-90"
                                                style="background-color: #dc3545;">
                                                @lang('common.delete')
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
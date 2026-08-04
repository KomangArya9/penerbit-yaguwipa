@extends('admin.layouts.admin')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">@lang('admin.menu_index_title')</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-6 shadow">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tombol Aksi Atas -->
        <div class="flex gap-3 mb-6">
            <a href="{{ route('admin.menu.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg shadow-sm flex items-center gap-2 text-sm transition">
                <i class="fas fa-plus"></i> @lang('common.add_data')
            </a>
            <a href="{{ route('admin.menu.sorting') }}"
                class="bg-amber-500 hover:bg-amber-600 text-white font-medium px-4 py-2 rounded-lg shadow-sm flex items-center gap-2 text-sm transition">
                <i class="fas fa-sort"></i> @lang('common.sorting_data')
            </a>
        </div>

        <!-- Tabel Data -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b text-gray-600 text-sm">
                        <th class="p-4 w-16">@lang('common.no_label')</th>
                        <th class="p-4">@lang('common.title')</th>
                        <th class="p-4 w-32 text-center">@lang('common.status')</th>
                        <th class="p-4 w-40 text-center">@lang('common.action')</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @if(isset($data_menu) && count($data_menu) > 0)
                        @foreach($data_menu as $index => $menu)
                            <tr class="hover:bg-gray-50">
                                <td class="p-4 text-gray-500">{{ $index + 1 }}</td>
                                <td class="p-4 font-medium text-gray-800">{{ $menu->title }}</td>
                                <td class="p-4 text-center">
                                    @if($menu->status == 'Show')
                                        <span class="bg-green-600 text-white text-xs px-3 py-1 rounded font-semibold">@lang('common.show')</span>
                                    @else
                                        <span class="bg-red-600 text-white text-xs px-3 py-1 rounded font-semibold">@lang('common.hide')</span>
                                    @endif
                                </td>
                                <td class="p-4 text-center">
                                    <div class="inline-flex items-center gap-2">
                                        <a href="{{ route('admin.menu.edit', $menu->id) }}" class="bg-cyan-500 hover:bg-cyan-600 text-white px-3 py-1.5 rounded text-xs font-medium">@lang('common.edit')</a>
                                        <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('@lang('admin.menu_confirm_delete')')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded text-xs font-medium">@lang('common.delete')</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="p-6 text-center text-gray-400">@lang('admin.menu_empty')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
@extends('admin.layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">@lang('admin.kategori_index_title')</h2>
        <a href="{{ route('admin.kategori.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-semibold shadow transition flex items-center gap-2">
            @lang('common.add_data')
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-emerald-100 text-emerald-700 rounded-lg text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow overflow-x-auto border border-gray-100">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="bg-gray-50 text-gray-700 text-xs uppercase tracking-wider border-b border-gray-200">
                    <th class="p-4 w-16">@lang('common.no_label')</th>
                    <th class="p-4">@lang('common.title')</th>
                    <th class="p-4 text-center w-32">@lang('common.action')</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm text-gray-600">
                @forelse($kategori as $index => $item)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 font-medium">{{ $index + 1 }}</td>
                    <td class="p-4 font-semibold text-gray-800">{{ $item->title }}</td>
                    <td class="p-4 text-center space-x-1">
                        <a href="{{ route('admin.kategori.edit', $item->id) }}" class="inline-block px-3 py-1.5 bg-cyan-500 hover:bg-cyan-600 text-white rounded-lg text-xs font-medium transition">
                            @lang('common.edit')
                        </a>
                        <form action="{{ route('admin.kategori.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('@lang('admin.kategori_confirm_delete')')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1.5 bg-rose-500 hover:bg-rose-600 text-white rounded-lg text-xs font-medium transition">
                                @lang('common.delete')
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="p-6 text-center text-gray-400">@lang('admin.kategori_empty')</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
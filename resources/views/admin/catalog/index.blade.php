@extends('admin.layouts.admin')

@section('content')
    <div class="p-6 max-w-full mx-auto bg-white rounded-xl shadow border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">@lang('admin.catalog_index_title')</h2>
            <a href="{{ route('admin.catalog.create') }}"
                class="px-4 py-2 bg-[#B6171E] text-white rounded-lg text-sm font-semibold hover:bg-red-900 flex items-center gap-2 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                @lang('common.add_data')
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-emerald-100 text-emerald-700 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 border text-sm">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">@lang('common.no_label')</th>
                        <th class="px-4 py-3 text-left font-semibold">@lang('common.cover')</th>
                        <th class="px-4 py-3 text-left font-semibold">@lang('catalog.label_publication_type')</th>
                        <th class="px-4 py-3 text-left font-semibold">@lang('common.category')</th>
                        <th class="px-4 py-3 text-left font-semibold">@lang('common.title')</th>
                        <th class="px-4 py-3 text-left font-semibold">@lang('catalog.label_author')</th>
                        <th class="px-4 py-3 text-left font-semibold">@lang('catalog.label_editor')</th>
                        <th class="px-4 py-3 text-left font-semibold">@lang('catalog.label_publisher')</th>
                        <th class="px-4 py-3 text-left font-semibold">@lang('catalog.label_price')</th>
                        <th class="px-4 py-3 text-left font-semibold">@lang('common.hit')</th>
                        <th class="px-4 py-3 text-center font-semibold">@lang('common.status')</th>
                        <th class="px-4 py-3 text-center font-semibold">@lang('common.action')</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($catalogs as $index => $item)
                        <tr>
                            <td class="px-4 py-3 text-gray-600">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">
                                @if($item->cover)
                                    <img src="{{ asset('storage/' . $item->cover) }}" alt="Cover"
                                        class="w-10 h-14 object-cover rounded shadow-sm border">
                                    <span class="block text-[10px] text-gray-500 mt-1">{{ $item->cover }}</span>
                                @else
                                    <span class="text-xs text-gray-400 italic">@lang('common.no_cover')</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-600">{{ $item->jenis }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $item->kategori }}</td>
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $item->judul }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $item->penulis }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $item->editor }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $item->penerbit }}</td>
                            <td class="px-4 py-3 text-gray-600">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $item->hite }}</td>
                            <td class="px-4 py-3 text-center">
                                <span
                                    class="px-2.5 py-1 rounded text-xs font-semibold {{ $item->status == 'Show' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-700' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center space-x-1 whitespace-nowrap">
                                <a href="{{ route('admin.catalog.edit', $item->id) }}"
                                    class="inline-block px-3 py-1.5 bg-cyan-500 text-white text-xs rounded hover:bg-cyan-600 font-medium">@lang('common.edit')</a>
                                <form action="{{ route('admin.catalog.destroy', $item->id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('@lang('admin.catalog_confirm_delete')')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1.5 bg-rose-500 text-white text-xs rounded hover:bg-rose-600 font-medium">@lang('common.delete')</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="px-4 py-6 text-center text-gray-400">@lang('admin.catalog_empty')</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
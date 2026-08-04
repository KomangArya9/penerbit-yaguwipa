@extends('admin.layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">

        <!-- Header Halaman -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">@lang('admin.authors_index_title')</h1>
            <p class="text-sm text-gray-600 mt-1">@lang('admin.authors_index_description')</p>
        </div>

        <!-- Alert Notifikasi Sukses -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Data Penulis -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-gray-700 uppercase text-xs tracking-wider">
                            <th class="py-3 px-6 font-semibold w-16">@lang('common.no_label')</th>
                            <th class="py-3 px-6 font-semibold">@lang('common.name')</th>
                            <th class="py-3 px-6 font-semibold">@lang('common.email')</th>
                            <th class="py-3 px-6 font-semibold">@lang('common.phone')</th>
                            <th class="py-3 px-6 font-semibold text-center">@lang('common.status')</th>
                            <th class="py-3 px-6 font-semibold text-center w-40">@lang('common.action')</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-gray-700">
                        @forelse($authors as $index => $author)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="py-4 px-6 font-medium text-gray-900">
                                    {{ $authors->firstItem() + $index }}
                                </td>
                                <td class="py-4 px-6 font-semibold text-gray-900">
                                    {{ $author->nama }}
                                </td>
                                <td class="py-4 px-6 text-gray-600">
                                    {{ $author->email ?? '-' }}
                                </td>
                                <td class="py-4 px-6 text-gray-600">
                                    {{ $author->nomor ?? '-' }}
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <!-- Form Ubah Status Langsung (Show / Hide / Pending) -->
                                    <form action="{{ route('admin.authors.updateStatus', $author->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()"
                                            class="text-xs font-bold px-3 py-1.5 rounded-lg border cursor-pointer transition-all
                                            {{ $author->status == 'show' ? 'bg-green-100 text-green-800 border-green-300' : '' }}
                                            {{ $author->status == 'hide' ? 'bg-red-100 text-red-800 border-red-300' : '' }}
                                            {{ $author->status == 'pending' ? 'bg-yellow-100 text-yellow-800 border-yellow-300' : '' }}">
                                            <option value="show" {{ $author->status == 'show' ? 'selected' : '' }}>@lang('common.show')</option>
                                            <option value="hide" {{ $author->status == 'hide' ? 'selected' : '' }}>@lang('common.hide')</option>
                                            <option value="pending" {{ $author->status == 'pending' ? 'selected' : '' }}>@lang('common.pending')</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('admin.authors.edit', $author->id) }}"
                                            class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded text-xs font-semibold shadow-sm transition-all">
                                            @lang('common.edit')
                                        </a>
                                        <!-- Tombol Delete -->
                                        <form action="{{ route('admin.authors.destroy', $author->id) }}" method="POST"
                                            onsubmit="return confirm('@lang('admin.authors_confirm_delete')')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded text-xs font-semibold shadow-sm transition-all">
                                                @lang('common.delete')
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-gray-500 italic bg-white">
                                    <div class="flex flex-col items-center justify-center space-y-2">
                                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                            </path>
                                        </svg>
                                        <span class="text-sm font-medium text-gray-600">@lang('admin.authors_empty')</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginasi -->
            @if($authors->hasPages())
                <div class="p-4 border-t border-gray-200 bg-gray-50/50">
                    {{ $authors->links() }}
                </div>
            @endif
        </div>

    </div>
@endsection
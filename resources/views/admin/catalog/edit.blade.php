@extends('admin.layouts.admin')

@section('content')
<div class="p-6 max-w-5xl mx-auto bg-white rounded-xl shadow border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">@lang('admin.catalog_edit_title')</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-rose-100 text-rose-700 rounded-lg text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.catalog.update', $catalog->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_title')</label>
                <input type="text" name="judul" value="{{ old('judul', $catalog->judul) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_author')</label>
                <input type="text" name="penulis" value="{{ old('penulis', $catalog->penulis) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_editor')</label>
                <input type="text" name="editor" value="{{ old('editor', $catalog->editor) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_publisher')</label>
                <input type="text" name="penerbit" value="{{ old('penerbit', $catalog->penerbit) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_author_institution')</label>
                <input type="text" name="i_penulis" value="{{ old('i_penulis', $catalog->i_penulis) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_editor_institution')</label>
                <input type="text" name="i_editor" value="{{ old('i_editor', $catalog->i_editor) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_publication_type')</label>
                <select id="jenis" name="jenis"
                    class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] bg-white">
                    @php $jenisVal = old('jenis', $catalog->jenis ?? $catalog->jenis); @endphp
                    <option value="">@lang('catalog.type_default')</option>
                    <option value="Buku" {{ $jenisVal == 'Buku' ? 'selected' : '' }}>@lang('catalog.type_book')</option>
                    <option value="Jurnal" {{ $jenisVal == 'Jurnal' ? 'selected' : '' }}>@lang('catalog.type_journal')</option>
                    <option value="Prosiding" {{ $jenisVal == 'Prosiding' ? 'selected' : '' }}>@lang('catalog.type_proceeding')</option>
                    <option value="Majalah Ilmiah" {{ $jenisVal == 'Majalah Ilmiah' ? 'selected' : '' }}>@lang('catalog.type_scientific_magazine')</option>
                    <option value="Artikel Ilmiah" {{ $jenisVal == 'Artikel Ilmiah' ? 'selected' : '' }}>@lang('catalog.type_scientific_article')</option>
                    <option value="Lainnya" {{ $jenisVal == 'Lainnya' ? 'selected' : '' }}>@lang('catalog.type_other')</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('common.category')</label>
                <select id="kategori" name="kategori"
                    class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] bg-white">
                    @php $katVal = old('kategori', $catalog->kategori); @endphp
                    <option value="">@lang('catalog.category_default')</option>
                    <option value="Buku Referensi" {{ $katVal == 'Buku Referensi' ? 'selected' : '' }}>@lang('catalog.cat_reference_book')</option>
                    <option value="Buku Monograf" {{ $katVal == 'Buku Monograf' ? 'selected' : '' }}>@lang('catalog.cat_monograph_book')</option>
                    <option value="Buku Ajar" {{ $katVal == 'Buku Ajar' ? 'selected' : '' }}>@lang('catalog.cat_textbook')</option>
                    <option value="Buku Teks" {{ $katVal == 'Buku Teks' ? 'selected' : '' }}>@lang('catalog.cat_plain_text')</option>
                    <option value="Karya Fiksi" {{ $katVal == 'Karya Fiksi' ? 'selected' : '' }}>@lang('catalog.cat_fiction')</option>
                    <option value="Jurnal Nasional" {{ $katVal == 'Jurnal Nasional' ? 'selected' : '' }}>@lang('catalog.cat_national_journal')</option>
                    <option value="Jurnal Nasional Terakreditasi" {{ $katVal == 'Jurnal Nasional Terakreditasi' ? 'selected' : '' }}>@lang('catalog.cat_national_accredited_journal')</option>
                    <option value="Jurnal Internasional" {{ $katVal == 'Jurnal Internasional' ? 'selected' : '' }}>@lang('catalog.cat_international_journal')</option>
                    <option value="Jurnal Internasional Berreputasi" {{ $katVal == 'Jurnal Internasional Berreputasi' ? 'selected' : '' }}>@lang('catalog.cat_intl_reputable_journal')</option>
                    <option value="Prosiding Nasional" {{ $katVal == 'Prosiding Nasional' ? 'selected' : '' }}>@lang('catalog.cat_national_proceeding')</option>
                    <option value="Prosiding Nasional Terakreditasi" {{ $katVal == 'Prosiding Nasional Terakreditasi' ? 'selected' : '' }}>@lang('catalog.cat_national_accredited_proceeding')</option>
                    <option value="Prosiding Internasional" {{ $katVal == 'Prosiding Internasional' ? 'selected' : '' }}>@lang('catalog.cat_international_proceeding')</option>
                    <option value="Prosiding Internasional Berreputasi" {{ $katVal == 'Prosiding Internasional Berreputasi' ? 'selected' : '' }}>@lang('catalog.cat_intl_reputable_proceeding')</option>
                    <option value="Lainnya" {{ $katVal == 'Lainnya' ? 'selected' : '' }}>@lang('catalog.cat_other')</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_field_of_study')</label>
                <input type="text" name="bidang" value="{{ old('bidang', $catalog->bidang) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">ISBN</label>
                <input type="text" name="isbn" value="{{ old('isbn', $catalog->isbn) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">ISSN</label>
                <input type="text" name="issn" value="{{ old('issn', $catalog->issn) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_size')</label>
                <input type="text" name="ukuran" value="{{ old('ukuran', $catalog->ukuran) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_page_count')</label>
                <input type="text" name="jumlah" value="{{ old('jumlah', $catalog->jumlah) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_publish_date')</label>
                <input type="text" name="terbit" value="{{ old('terbit', $catalog->terbit) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_condition')</label>
                <select name="kondisi" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm bg-white">
                    @php $kondisiVal = old('kondisi', $catalog->kondisi); @endphp
                    <option value="Baru" {{ $kondisiVal == 'Baru' ? 'selected' : '' }}>@lang('catalog.condition_new')</option>
                    <option value="Second Hand" {{ $kondisiVal == 'Second Hand' ? 'selected' : '' }}>@lang('catalog.condition_used')</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_availability')</label>
                <select name="ketersediaan" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm bg-white">
                    @php $tersediaVal = old('ketersediaan', $catalog->ketersediaan); @endphp
                    <option value="Tersedia" {{ $tersediaVal == 'Tersedia' ? 'selected' : '' }}>@lang('catalog.availability_available')</option>
                    <option value="Pre-Order" {{ $tersediaVal == 'Pre-Order' ? 'selected' : '' }}>@lang('catalog.availability_preorder')</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_description')</label>
                <textarea name="deskripsi" rows="4" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">{{ old('deskripsi', $catalog->deskripsi) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_additional_info')</label>
                <textarea name="info" rows="4" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">{{ old('info', $catalog->info) }}</textarea>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_price')</label>
                <input type="text" name="harga" value="{{ old('harga', $catalog->harga) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_discount_price')</label>
                <input type="text" name="diskon" value="{{ old('diskon', $catalog->diskon) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_notes')</label>
                <input type="text" name="keterangan" value="{{ old('keterangan', $catalog->keterangan) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_seller')</label>
                <input type="text" name="penjual" value="{{ old('penjual', $catalog->penjual) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_whatsapp')</label>
                <input type="text" name="wa" value="{{ old('wa', $catalog->wa) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_address')</label>
                <input type="text" name="alamat" value="{{ old('alamat', $catalog->alamat) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_ktp')</label>
                <input type="text" name="ktp" value="{{ old('ktp', $catalog->ktp) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_bank_name')</label>
                <input type="text" name="bank" value="{{ old('bank', $catalog->bank) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_account_number')</label>
                <input type="text" name="norek" value="{{ old('norek', $catalog->norek) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
        </div>

        <!-- Bagian Gambar & Preview -->
        <div class="grid grid-cols-3 gap-4 pt-4 border-t">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_front_cover')</label>
                @if($catalog->cover)
                    <div class="mb-2"><img src="{{ asset('storage/' . $catalog->cover) }}" class="w-20 h-28 object-cover rounded border"></div>
                @endif
                <input type="file" name="cover" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-[#B6171E] hover:file:bg-red-100">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_back_cover')</label>
                @if($catalog->cover_belakang)
                    <div class="mb-2"><img src="{{ asset('storage/' . $catalog->cover_belakang) }}" class="w-20 h-28 object-cover rounded border"></div>
                @endif
                <input type="file" name="cover_belakang" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-[#B6171E] hover:file:bg-red-100">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('catalog.label_table_of_contents')</label>
                @if($catalog->img)
                    <div class="mb-2"><img src="{{ asset('storage/' . $catalog->img) }}" class="w-20 h-28 object-cover rounded border"></div>
                @endif
                <input type="file" name="img" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-[#B6171E] hover:file:bg-red-100">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('common.hit')</label>
                <input type="number" name="hite" value="{{ old('hite', $catalog->hite) }}" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">@lang('common.status')</label>
                <select name="status" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm bg-white">
                    @php $statusVal = old('status', $catalog->status); @endphp
                    <option value="Show" {{ $statusVal == 'Show' ? 'selected' : '' }}>@lang('common.show')</option>
                    <option value="Hide" {{ $statusVal == 'Hide' ? 'selected' : '' }}>@lang('common.hide')</option>
                    <option value="Pending" {{ $statusVal == 'Pending' ? 'selected' : '' }}>@lang('common.pending')</option>
                </select>
            </div>
        </div>

        <div class="flex justify-end gap-2 pt-4">
            <a href="{{ route('admin.catalog.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-300">@lang('common.cancel')</a>
            <button type="submit" class="px-4 py-2 bg-[#B6171E] text-white rounded-lg text-sm font-semibold hover:bg-red-900 transition-all">@lang('common.save_changes')</button>
        </div>
    </form>
</div>
@endsection
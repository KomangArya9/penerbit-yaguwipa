@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-10">

        <!-- Tombol Kembali ke Katalog -->
        <div class="mb-6">
            <a href="{{ route('catalog.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Katalog
            </a>
        </div>

        <!-- Bagian Utama: Cover & Tabel Detail -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 mb-16">
            
            <!-- Kolom Kiri: Cover Buku (Span 5) -->
            <div class="lg:col-span-5">
                <div class="aspect-[2/3] bg-gray-100 rounded-lg overflow-hidden shadow-lg border border-gray-200 relative">
                    @if($catalog->cover)
                        <img src="{{ asset('storage/' . $catalog->cover) }}" alt="{{ $catalog->judul }}"
                            class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">No Cover</div>
                    @endif
                </div>
            </div>

            <!-- Kolom Kanan: Judul, Harga, Tabel Spesifikasi, & Tombol WA (Span 7) -->
            <div class="lg:col-span-7 flex flex-col justify-between">
                <div>
                    <!-- Judul Buku -->
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                        {{ $catalog->judul }}
                    </h1>

                    <!-- Harga -->
                    <p class="text-2xl font-bold text-gray-900 mb-6">
                        Rp {{ number_format($catalog->harga ?? 0, 0, ',', '.') }},-
                    </p>

                    <!-- Tabel Spesifikasi Detail -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden mb-8 text-sm">
                        <table class="w-full border-collapse">
                            <tbody>
                                @if($catalog->penulis)
                                <tr class="border-b border-gray-200">
                                    <td class="w-1/3 bg-gray-50 px-4 py-3 font-medium text-gray-700">Penulis</td>
                                    <td class="w-2/3 px-4 py-3 text-gray-900">{{ $catalog->penulis }}</td>
                                </tr>
                                @endif

                                @if($catalog->penerbit)
                                <tr class="border-b border-gray-200">
                                    <td class="bg-gray-50 px-4 py-3 font-medium text-gray-700">Penerbit</td>
                                    <td class="px-4 py-3 text-gray-900">{{ $catalog->penerbit }}</td>
                                </tr>
                                @endif

                                @if($catalog->institusi_penulis)
                                <tr class="border-b border-gray-200">
                                    <td class="bg-gray-50 px-4 py-3 font-medium text-gray-700">Institusi Penulis</td>
                                    <td class="px-4 py-3 text-gray-900">{{ $catalog->institusi_penulis }}</td>
                                </tr>
                                @endif

                                @if($catalog->jenis_terbitan)
                                <tr class="border-b border-gray-200">
                                    <td class="bg-gray-50 px-4 py-3 font-medium text-gray-700">Jenis Terbitan</td>
                                    <td class="px-4 py-3 text-gray-900">{{ $catalog->jenis_terbitan }}</td>
                                </tr>
                                @endif

                                @if($catalog->kategori)
                                <tr class="border-b border-gray-200">
                                    <td class="bg-gray-50 px-4 py-3 font-medium text-gray-700">Kategori</td>
                                    <td class="px-4 py-3 text-gray-900">{{ $catalog->kategori }}</td>
                                </tr>
                                @endif

                                @if($catalog->bidang_ilmu)
                                <tr class="border-b border-gray-200">
                                    <td class="bg-gray-50 px-4 py-3 font-medium text-gray-700">Bidang Ilmu</td>
                                    <td class="px-4 py-3 text-gray-900">{{ $catalog->bidang_ilmu }}</td>
                                </tr>
                                @endif

                                @if($catalog->isbn)
                                <tr class="border-b border-gray-200">
                                    <td class="bg-gray-50 px-4 py-3 font-medium text-gray-700">ISBN</td>
                                    <td class="px-4 py-3 text-gray-900">{{ $catalog->isbn }}</td>
                                </tr>
                                @endif

                                @if($catalog->ukuran)
                                <tr class="border-b border-gray-200">
                                    <td class="bg-gray-50 px-4 py-3 font-medium text-gray-700">Ukuran</td>
                                    <td class="px-4 py-3 text-gray-900">{{ $catalog->ukuran }}</td>
                                </tr>
                                @endif

                                @if($catalog->jumlah_halaman)
                                <tr class="border-b border-gray-200">
                                    <td class="bg-gray-50 px-4 py-3 font-medium text-gray-700">Jumlah Halaman</td>
                                    <td class="px-4 py-3 text-gray-900">{{ $catalog->jumlah_halaman }}</td>
                                </tr>
                                @endif

                                @if($catalog->tahun_terbit)
                                <tr class="border-b border-gray-200">
                                    <td class="bg-gray-50 px-4 py-3 font-medium text-gray-700">Bulan & Tahun Terbit</td>
                                    <td class="px-4 py-3 text-gray-900">{{ $catalog->tahun_terbit }}</td>
                                </tr>
                                @endif

                                @if($catalog->kondisi)
                                <tr class="border-b border-gray-200">
                                    <td class="bg-gray-50 px-4 py-3 font-medium text-gray-700">Kondisi Terbitan</td>
                                    <td class="px-4 py-3 text-gray-900">{{ $catalog->kondisi }}</td>
                                </tr>
                                @endif

                                @if($catalog->ketersediaan)
                                <tr>
                                    <td class="bg-gray-50 px-4 py-3 font-medium text-gray-700">Ketersediaan</td>
                                    <td class="px-4 py-3 text-gray-900">{{ $catalog->ketersediaan }}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tombol Pesan via WhatsApp -->
                @php
                    $noWa = $catalog->no_wa ?? '6281234567890'; // Default nomor jika kosong
                    $pesan = urlencode("Halo, saya ingin memesan buku dengan judul: " . $catalog->judul);
                @endphp
                <a href="https://wa.me/{{ $noWa }}?text={{ $pesan }}" target="_blank"
                    class="w-full bg-[#25D366] hover:bg-[#20ba5a] text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 flex items-center justify-center gap-2 shadow-md">
                    <!-- Ikon WhatsApp SVG -->
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.198-.198.347-.764.966-.937 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                    </svg>
                    Pesan Via WA
                </a>
            </div>
        </div>

        <!-- Bagian Tab Bawah: Deskripsi, Informasi Tambahan, Review -->
        <div class="mt-12 border-t border-gray-200 pt-8" x-data="{ tab: 'deskripsi' }">
            <!-- Tab Navigasi -->
            <div class="flex border-b border-gray-200 mb-6 gap-8 text-sm">
                <button @click="tab = 'deskripsi'" :class="tab === 'deskripsi' ? 'border-b-2 border-gray-900 text-gray-900 font-bold' : 'text-gray-500 hover:text-gray-900'" class="pb-3 transition-all">
                    Deskripsi
                </button>
                <button @click="tab = 'informasi'" :class="tab === 'informasi' ? 'border-b-2 border-gray-900 text-gray-900 font-bold' : 'text-gray-500 hover:text-gray-900'" class="pb-3 transition-all">
                    Informasi Tambahan
                </button>
                <button @click="tab = 'review'" :class="tab === 'review' ? 'border-b-2 border-gray-900 text-gray-900 font-bold' : 'text-gray-500 hover:text-gray-900'" class="pb-3 transition-all">
                    Review (0)
                </button>
            </div>

            <!-- Tab Konten: Deskripsi -->
            <div x-show="tab === 'deskripsi'" class="text-gray-700 leading-relaxed space-y-4 text-sm">
                <p>{{ $catalog->deskripsi ?? 'Belum ada deskripsi untuk buku ini.' }}</p>
            </div>

            <!-- Tab Konten: Informasi Tambahan -->
            <div x-show="tab === 'informasi'" class="text-gray-700 leading-relaxed space-y-4 text-sm" style="display: none;">
                <p>{{ $catalog->info_tambahan ?? 'Tidak ada informasi tambahan.' }}</p>
            </div>

            <!-- Tab Konten: Review -->
            <div x-show="tab === 'review'" class="text-gray-500 text-sm" style="display: none;">
                <p>Belum ada ulasan untuk produk ini.</p>
            </div>
        </div>

    </div>
@endsection
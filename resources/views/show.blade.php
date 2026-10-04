@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-10">

        <!-- Tombol Kembali ke Katalog -->
        <div class="mb-8">
            <a href="{{ route('catalog.index') }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-stone-600 hover:text-[#B6171E] transition-colors py-2 px-3.5 rounded-xl hover:bg-stone-100 w-fit">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Katalog
            </a>
        </div>

        <!-- Bagian Utama: Cover & Tabel Detail -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 mb-16">

            <!-- Kolom Kiri: Cover Buku (Span 5) -->
            <div class="lg:col-span-5">
                <div class="aspect-[2/3] bg-stone-100 rounded-2xl overflow-hidden shadow-xl border border-stone-200/80 relative">
                    @if($catalog->cover)
                        <img src="{{ asset('storage/' . $catalog->cover) }}" alt="{{ $catalog->judul }}"
                            class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-stone-400 text-sm italic">No Cover</div>
                    @endif
                </div>
            </div>

            <!-- Kolom Kanan: Judul, Harga, Tabel Spesifikasi, & Tombol WA (Span 7) -->
            <div class="lg:col-span-7 flex flex-col justify-between">
                <div>
                    <!-- Judul Buku -->
                    <h1 class="text-3xl lg:text-4xl font-bold font-serif text-stone-900 mb-3 leading-tight tracking-tight">
                        {{ $catalog->judul }}
                    </h1>

                    <!-- Harga -->
                    <p class="text-2xl font-bold text-[#B6171E] mb-6">
                        Rp {{ number_format($catalog->harga ?? 0, 0, ',', '.') }},-
                    </p>

                    <!-- Tabel Spesifikasi Detail -->
                    <div class="border border-stone-200 rounded-2xl overflow-hidden mb-8 text-sm shadow-[0_1px_3px_rgba(0,0,0,0.02)]">
                        <table class="w-full border-collapse">
                            <tbody>
                                @if($catalog->penulis)
                                    <tr class="border-b border-stone-100">
                                        <td class="w-1/3 bg-stone-50 px-5 py-3 font-medium text-stone-600 border-r border-stone-100">Penulis</td>
                                        <td class="w-2/3 px-5 py-3 text-stone-900 font-medium">{{ $catalog->penulis }}</td>
                                    </tr>
                                @endif

                                @if($catalog->penerbit)
                                    <tr class="border-b border-stone-100">
                                        <td class="bg-stone-50 px-5 py-3 font-medium text-stone-600 border-r border-stone-100">Penerbit</td>
                                        <td class="px-5 py-3 text-stone-900 font-medium">{{ $catalog->penerbit }}</td>
                                    </tr>
                                @endif

                                @if($catalog->i_penulis)
                                    <tr class="border-b border-stone-100">
                                        <td class="bg-stone-50 px-5 py-3 font-medium text-stone-600 border-r border-stone-100">Institusi Penulis</td>
                                        <td class="px-5 py-3 text-stone-900 font-medium">{{ $catalog->i_penulis }}</td>
                                    </tr>
                                @endif

                                @if($catalog->jenis)
                                    <tr class="border-b border-stone-100">
                                        <td class="bg-stone-50 px-5 py-3 font-medium text-stone-600 border-r border-stone-100">Jenis Terbitan</td>
                                        <td class="px-5 py-3 text-stone-900 font-medium">{{ $catalog->jenis}}</td>
                                    </tr>
                                @endif

                                @if($catalog->kategori)
                                    <tr class="border-b border-stone-100">
                                        <td class="bg-stone-50 px-5 py-3 font-medium text-stone-600 border-r border-stone-100">Kategori</td>
                                        <td class="px-5 py-3 text-stone-900 font-medium">{{ $catalog->kategori }}</td>
                                    </tr>
                                @endif

                                @if($catalog->bidang)
                                    <tr class="border-b border-stone-100">
                                        <td class="bg-stone-50 px-5 py-3 font-medium text-stone-600 border-r border-stone-100">Bidang Ilmu</td>
                                        <td class="px-5 py-3 text-stone-900 font-medium">{{ $catalog->bidang }}</td>
                                    </tr>
                                @endif

                                @if($catalog->isbn)
                                    <tr class="border-b border-stone-100">
                                        <td class="bg-stone-50 px-5 py-3 font-medium text-stone-600 border-r border-stone-100">ISBN</td>
                                        <td class="px-5 py-3 text-stone-900 font-medium">{{ $catalog->isbn }}</td>
                                    </tr>
                                @endif

                                @if($catalog->ukuran)
                                    <tr class="border-b border-stone-100">
                                        <td class="bg-stone-50 px-5 py-3 font-medium text-stone-600 border-r border-stone-100">Ukuran</td>
                                        <td class="px-5 py-3 text-stone-900 font-medium">{{ $catalog->ukuran }}</td>
                                    </tr>
                                @endif

                                @if($catalog->jumlah)
                                    <tr class="border-b border-stone-100">
                                        <td class="bg-stone-50 px-5 py-3 font-medium text-stone-600 border-r border-stone-100">Jumlah Halaman</td>
                                        <td class="px-5 py-3 text-stone-900 font-medium">{{ $catalog->jumlah}}</td>
                                    </tr>
                                @endif

                                @if($catalog->terbit)
                                    <tr class="border-b border-stone-100">
                                        <td class="bg-stone-50 px-5 py-3 font-medium text-stone-600 border-r border-stone-100">Bulan & Tahun Terbit</td>
                                        <td class="px-5 py-3 text-stone-900 font-medium">{{ $catalog->terbit }}</td>
                                    </tr>
                                @endif

                                @if($catalog->kondisi)
                                    <tr class="border-b border-stone-100">
                                        <td class="bg-stone-50 px-5 py-3 font-medium text-stone-600 border-r border-stone-100">Kondisi Terbitan</td>
                                        <td class="px-5 py-3 text-stone-900 font-medium">{{ $catalog->kondisi }}</td>
                                    </tr>
                                @endif

                                @if($catalog->ketersediaan)
                                    <tr>
                                        <td class="bg-stone-50 px-5 py-3 font-medium text-stone-600 border-r border-stone-100">Ketersediaan</td>
                                        <td class="px-5 py-3 text-stone-900 font-medium">{{ $catalog->ketersediaan }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tombol Pesan via WhatsApp -->
                @php
                    $rawWa = $catalog->wa;
                    if (empty($rawWa) && !empty($setting->phone)) {
                        $rawWa = $setting->phone;
                    }
                    $noWa = !empty($rawWa) ? preg_replace('/[^0-9]/', '', $rawWa) : '628113996698';
                    if (str_starts_with($noWa, '0')) {
                        $noWa = '62' . substr($noWa, 1);
                    }
                    $pesan = urlencode("Halo, saya ingin memesan buku dengan judul: " . $catalog->judul);
                @endphp
                <a href="https://wa.me/{{ $noWa }}?text={{ $pesan }}" target="_blank"
                    class="w-full bg-[#25D366] hover:bg-[#20ba5a] text-white font-medium py-3.5 px-6 rounded-xl transition-all duration-200 flex items-center justify-center gap-2.5 shadow-md shadow-emerald-900/10 active:scale-[0.99]">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path
                            d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.198-.198.347-.764.966-.937 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                    </svg>
                    Pesan Via WA
                </a>
            </div>
        </div>

        <!-- Bagian Tab Bawah: Deskripsi, Informasi Tambahan, Review -->
        <div class="mt-12 border-t border-stone-200 pt-8" x-data="{ tab: 'deskripsi' }">
            <!-- Tab Navigasi -->
            @php
                $approvedReviews = $catalog->ulasans ?? collect();
                $reviewCount = $approvedReviews->count();
            @endphp
            <div class="flex border-b border-stone-200 mb-6 gap-8 text-sm">
                <button @click="tab = 'deskripsi'"
                    :class="tab === 'deskripsi' ? 'border-b-2 border-[#B6171E] text-[#B6171E] font-semibold' : 'text-stone-500 hover:text-stone-900 font-medium'"
                    class="pb-3 transition-all cursor-pointer">
                    Deskripsi
                </button>
                <button @click="tab = 'informasi'"
                    :class="tab === 'informasi' ? 'border-b-2 border-[#B6171E] text-[#B6171E] font-semibold' : 'text-stone-500 hover:text-stone-900 font-medium'"
                    class="pb-3 transition-all cursor-pointer">
                    Informasi Tambahan
                </button>
                <button @click="tab = 'review'"
                    :class="tab === 'review' ? 'border-b-2 border-[#B6171E] text-[#B6171E] font-semibold' : 'text-stone-500 hover:text-stone-900 font-medium'"
                    class="pb-3 transition-all cursor-pointer">
                    Review ({{ $reviewCount }})
                </button>
            </div>

            <!-- Tab Konten: Deskripsi -->
            <div x-show="tab === 'deskripsi'" class="text-stone-700 leading-relaxed space-y-4 text-sm">
                <p>{{ $catalog->deskripsi ?? 'Belum ada deskripsi untuk buku ini.' }}</p>
            </div>

            <!-- Tab Konten: Informasi Tambahan -->
            <div x-show="tab === 'informasi'" class="text-stone-700 leading-relaxed space-y-4 text-sm"
                style="display: none;">
                <p>{{ $catalog->info ?? 'Tidak ada informasi tambahan.' }}</p>
            </div>

            <!-- Tab Konten: Review -->
            <div x-show="tab === 'review'" class="text-stone-700 text-sm space-y-8" style="display: none;">
                <!-- Daftar Ulasan (Status Show) -->
                <div>
                    <h3 class="text-lg font-bold font-serif text-stone-900 mb-4">Ulasan Pembaca</h3>
                    @php
                        $approvedReviews = $catalog->ulasans ?? collect();
                        $reviewCount = $approvedReviews->count();
                    @endphp

                    @if($reviewCount > 0)
                        <div class="space-y-4">
                            @foreach($approvedReviews as $review)
                                <div class="bg-white border border-stone-200/80 rounded-2xl p-5 shadow-2xs">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-semibold text-stone-900">{{ $review->nama }}</span>
                                        <div class="flex items-center text-amber-400">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4 {{ $i <= $review->stars ? 'fill-current' : 'text-stone-200' }}"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                                </svg>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="text-stone-600 text-sm leading-relaxed">{{ $review->ulasan }}</p>
                                    <span class="block text-xs text-stone-400 mt-2">{{ $review->created_at->diffForHumans() }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-stone-400 italic">Belum ada ulasan untuk produk ini.</p>
                    @endif
                </div>

                <!-- Form Input Ulasan -->
                <div class="bg-stone-50/80 border border-stone-200/80 rounded-2xl p-6 md:p-8">
                    <h3 class="text-lg font-bold font-serif text-stone-900 mb-4">Tulis Ulasan Anda</h3>

                    <!-- Tempat Munculnya Notifikasi AJAX -->
                    <div id="review-alert" class="hidden mb-4 p-4 rounded-xl text-sm"></div>

                    <form id="review-form" action="{{ route('catalog.review.store', $catalog->id) }}" method="POST"
                        class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1">Nama</label>
                            <input type="text" name="nama" required
                                class="w-full border border-stone-200 rounded-xl px-4 py-2.5 focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] focus:outline-none text-sm bg-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1">Rating (1 - 5)</label>
                            <select name="stars" required
                                class="w-full border border-stone-200 rounded-xl px-4 py-2.5 focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] focus:outline-none text-sm bg-white">
                                <option value="5">5 Bintang - Sangat Baik</option>
                                <option value="4">4 Bintang - Baik</option>
                                <option value="3">3 Bintang - Cukup</option>
                                <option value="2">2 Bintang - Kurang</option>
                                <option value="1">1 Bintang - Sangat Kurang</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1">Komentar</label>
                            <textarea name="ulasan" rows="4" required
                                class="w-full border border-stone-200 rounded-xl px-4 py-2.5 focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] focus:outline-none text-sm bg-white"></textarea>
                        </div>
                        <button type="submit" id="submit-btn"
                            class="bg-[#B6171E] hover:bg-[#9e141a] text-white font-medium py-2.5 px-6 rounded-xl transition-all duration-200 text-sm shadow-sm active:scale-95">
                            Kirim Ulasan
                        </button>
                    </form>

                    <script>
                        document.getElementById('review-form').addEventListener('submit', function (e) {
                            e.preventDefault(); // Mencegah form melakukan reload halaman

                            let form = this;
                            let formData = new FormData(form);
                            let submitBtn = document.getElementById('submit-btn');
                            let alertBox = document.getElementById('review-alert');

                            // Ubah tombol jadi status loading
                            submitBtn.disabled = true;
                            submitBtn.innerText = 'Mengirim...';

                            fetch(form.action, {
                                method: 'POST',
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                                },
                                body: formData
                            })
                                .then(response => response.json())
                                .then(data => {
                                    alertBox.classList.remove('hidden');
                                    if (data.success) {
                                        alertBox.className = 'mb-4 p-4 rounded-lg text-sm bg-green-50 border border-green-200 text-green-700';
                                        alertBox.innerText = data.message;
                                        form.reset(); // Kosongkan form setelah berhasil
                                    } else {
                                        alertBox.className = 'mb-4 p-4 rounded-lg text-sm bg-red-50 border border-red-200 text-red-700';
                                        alertBox.innerText = 'Terjadi kesalahan, silakan coba lagi.';
                                    }
                                })
                                .catch(error => {
                                    alertBox.classList.remove('hidden');
                                    alertBox.className = 'mb-4 p-4 rounded-lg text-sm bg-red-50 border border-red-200 text-red-700';
                                    alertBox.innerText = 'Terjadi kesalahan pada server.';
                                })
                                .finally(() => {
                                    submitBtn.disabled = false;
                                    submitBtn.innerText = 'Kirim Ulasan';
                                });
                        });
                    </script>
                </div>
            </div>
        </div>

    </div>
@endsection
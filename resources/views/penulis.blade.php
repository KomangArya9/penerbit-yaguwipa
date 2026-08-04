@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-16">

        <!-- 1. Header Halaman -->
        <div class="text-center mb-16 animate-on-scroll">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">@lang('authors.page_title')</h1>
            <div class="author-description">
                <p>{{ \App\Models\Pengaturan::first()->team ?? __('authors.no_description_fallback') }}</p>
            </div>
        </div>

        <!-- 2. Grid Kartu Penulis -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
            @foreach($authors as $index => $author)
                <div class="portfolio-entry border border-gray-200 p-6 shadow-sm hover:shadow-lg transition-all duration-300"
                    style="transition-delay: {{ $index * 150 }}ms;">

                    <!-- Foto Profil -->
                    <div
                        class="w-24 h-24 mb-6 overflow-hidden rounded-full mx-auto border-4 border-white shadow-sm bg-gray-100 flex items-center justify-center">
                        @if($author->foto && file_exists(public_path($author->foto)))
                            <img src="{{ asset($author->foto) }}" alt="{{ $author->nama }}" class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('images/default.jpg') }}" alt="{{ $author->nama }}"
                                class="w-full h-full object-cover">
                        @endif
                    </div>

                    <div class="flex justify-between items-start mb-4">
                        <h3 class="font-bold text-lg">{{ $author->nama }}</h3>
                        <span class="text-[10px] font-bold bg-[#B6171E] text-white px-2 py-1 uppercase tracking-wider">
                            {{ $author->institusi ?? __('authors.badge_fallback') }}
                        </span>
                    </div>

                    <p class="text-xs font-bold text-[#B6171E] mb-4">{{ $author->keahlian ?? '-' }}</p>

                    <div class="border-t pt-4">
                        <p class="text-sm font-semibold mb-2 text-gray-900">@lang('authors.short_profile')</p>
                        <p class="text-sm text-gray-600 line-clamp-3">{{ $author->profile }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- 3. Section Formulir -->
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Pemicu Form Penulis -->
            <button onclick="document.getElementById('modal-penulis').classList.remove('hidden')"
                class="border-2 border-gray-300 text-gray-700 px-10 py-2.5 rounded-lg font-medium hover:bg-[#B6171E] hover:text-white hover:border-[#B6171E] transition-all duration-300 animate-on-scroll fade-in-up">
                @lang('authors.form_button')
            </button>

            <!-- Tombol Form Unggah Naskah -->
            <a href="https://docs.google.com/forms/d/e/1FAIpQLScflolJ88GIIsQmBnR6-kEwd4Z9YvfSWk7d4ps458a6pM2PYg/viewform"
                target="_blank"
                class="block text-center bg-[#B6171E] border-2 border-gray-300 text-white px-10 py-2.5 rounded-lg font-medium hover:bg-white hover:text-gray-700 transition-all duration-300 animate-on-scroll fade-in-up"
                style="transition-delay: 0.2s;">
                @lang('authors.upload_manuscript')
            </a>
        </div>

        <!-- Modal Form Penulis -->
        <div id="modal-penulis"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden p-4 overflow-y-auto">
            <div
                class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-2xl relative my-8 max-h-[90vh] overflow-y-auto border border-gray-100 text-left">

                <!-- Tombol Close (X) -->
                <button onclick="document.getElementById('modal-penulis').classList.add('hidden')"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl font-bold">&times;</button>

                <h2 class="text-2xl font-bold mb-2 text-gray-900">@lang('authors.form_title')</h2>
                <p class="text-xs text-gray-500 mb-6">@lang('authors.form_description')
                </p>

                <!-- Notifikasi Modern (Diganti dengan Banner Kustom yang Estetik) -->
                <div id="form-alert"
                    class="hidden mb-6 p-4 rounded-xl text-sm flex items-center gap-3 shadow-sm transition-all duration-300">
                    <!-- Icon disuntikkan via JS -->
                    <div id="alert-icon"></div>
                    <div>
                        <p id="alert-title" class="font-bold"></p>
                        <p id="alert-message" class="text-xs mt-0.5 opacity-90"></p>
                    </div>
                </div>

                <form id="formPendaftaranAuthors" action="{{ route('authors.store') }}" method="POST"
                    enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <!-- Nama Lengkap dengan Gelar -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">@lang('authors.full_name_with_title') <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nama" required placeholder="{{ __('authors.name_placeholder') }}"
                            class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                    </div>

                    <!-- Institusi atau Perusahaan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">@lang('authors.institution_or_company') <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="institusi" required placeholder="{{ __('authors.institution_placeholder') }}"
                            class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                    </div>

                    <!-- Grid Kontak (Telepon & Email) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">@lang('authors.phone_number') <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="nomor" required placeholder="{{ __('authors.phone_placeholder') }}"
                                class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">@lang('authors.email') <span
                                    class="text-red-500">*</span></label>
                            <input type="email" name="email" required placeholder="{{ __('authors.email_placeholder') }}"
                                class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">@lang('authors.address') <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="alamat" required placeholder="{{ __('authors.address_placeholder') }}"
                            class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                    </div>

                    <!-- Link Social Media & Keahlian -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">@lang('authors.social_media') <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="social_media" required placeholder="www.instagram.com/namapenulis"
                                class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">@lang('authors.expertise') <span
                                    class="text-gray-400 font-normal">(@lang('authors.optional'))</span></label>
                            <input type="text" name="keahlian" placeholder="{{ __('authors.expertise_placeholder') }}"
                                class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                        </div>
                    </div>

                    <!-- Profil Singkat -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">@lang('authors.short_profile_label') <span
                                class="text-red-500">*</span></label>
                        <textarea name="profile" rows="4" required
                            placeholder="{{ __('authors.profile_placeholder') }}"
                            class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]"></textarea>
                    </div>

                    <!-- Unggah Foto Profil -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">@lang('authors.upload_photo') <span
                                class="text-red-500">*</span></label>
                        <input type="file" name="foto" required
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-[#B6171E] hover:file:bg-red-100">
                        <p class="text-xs text-gray-400 mt-1">@lang('authors.photo_note')</p>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end gap-2 pt-4 border-t">
                        <button type="button" onclick="document.getElementById('modal-penulis').classList.add('hidden')"
                            class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-300 transition-all">
                            @lang('common.cancel')
                        </button>
                        <button type="submit" id="submit-btn"
                            class="px-6 py-2.5 bg-[#B6171E] text-white rounded-lg font-semibold text-sm hover:bg-red-900 transition-all shadow-md">
                            @lang('authors.register_now')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script AJAX untuk Submit Tanpa Reload & Notifikasi Kustom Estetik -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('formPendaftaranAuthors');
            const alertBox = document.getElementById('form-alert');
            const alertIcon = document.getElementById('alert-icon');
            const alertTitle = document.getElementById('alert-title');
            const alertMessage = document.getElementById('alert-message');
            const submitBtn = document.getElementById('submit-btn');
            const modalContent = document.querySelector('#modal-penulis > div'); // Container modal untuk scroll

            if (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    let formData = new FormData(this);
                    let originalText = submitBtn.innerText;

                    // Ubah status tombol jadi proses
                    submitBtn.innerText = '@lang('common.sending')';
                    submitBtn.disabled = true;
                    alertBox.classList.add('hidden');

                    fetch("{{ route('authors.store') }}", {
                        method: "POST",
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                        .then(async response => {
                            let contentType = response.headers.get("content-type");
                            if (contentType && contentType.indexOf("application/json") !== -1) {
                                let result = await response.json();
                                if (!response.ok) {
                                    throw new Error(result.message || '@lang('authors.validation_error')');
                                }
                                return result;
                            } else {
                                throw new Error("@lang('authors.server_error')");
                            }
                        })
                        .then(data => {
                            // Tampilkan Banner Sukses yang Estetik
                            alertBox.className = "mb-6 p-4 rounded-xl text-sm flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-900 shadow-sm";
                            alertIcon.innerHTML = `
                                <div class="bg-emerald-500 text-white p-2 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                </div>`;
                            alertTitle.innerText = "@lang('authors.registration_success')";
                            alertMessage.innerText = data.message || "@lang('authors.registration_success_message')";
                            alertBox.classList.remove('hidden');

                            // Otomatis geser modal ke paling atas agar notifikasi terlihat
                            if (modalContent) modalContent.scrollTo({ top: 0, behavior: 'smooth' });

                            // Reset form & tutup modal otomatis setelah 3 detik
                            form.reset();
                            setTimeout(() => {
                                document.getElementById('modal-penulis').classList.add('hidden');
                                alertBox.classList.add('hidden');
                                window.location.reload(); // Refresh halaman setelah sukses agar data baru muncul di grid
                            }, 3000);
                        })
                        .catch(error => {
                            console.error('Error Terdeteksi:', error);
                            // Tampilkan Banner Error yang Estetik
                            alertBox.className = "mb-6 p-4 rounded-xl text-sm flex items-center gap-3 bg-rose-50 border border-rose-200 text-rose-900 shadow-sm";
                            alertIcon.innerHTML = `
                                <div class="bg-rose-500 text-white p-2 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </div>`;
                            alertTitle.innerText = "@lang('authors.submission_failed')";
                            alertMessage.innerText = error.message || "@lang('authors.submission_failed_message')";
                            alertBox.classList.remove('hidden');

                            // Otomatis geser modal ke paling atas agar pesan error terlihat
                            if (modalContent) modalContent.scrollTo({ top: 0, behavior: 'smooth' });
                        })
                        .finally(() => {
                            submitBtn.innerText = originalText;
                            submitBtn.disabled = false;
                        });
                });
            }
        });
    </script>
@endsection
@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-16">

        <!-- 1. Header Halaman -->
        <div class="text-center mb-16 animate-on-scroll">
            <h1 class="text-4xl sm:text-5xl font-bold font-serif text-stone-900 mb-4 tracking-tight">{{ $setting->penulis_title ?? 'Penulis Kami' }}</h1>
            <div class="author-description text-stone-600 max-w-2xl mx-auto leading-relaxed text-base">
                <p>{{ $setting->team ?? 'Deskripsi penulis belum diatur.' }}</p>
            </div>
        </div>

        <!-- 2. Grid Kartu Penulis -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7 mb-20">
            @foreach($authors as $index => $author)
                <div class="portfolio-entry bg-white rounded-2xl border border-stone-200/80 p-7 shadow-[0_2px_8px_rgba(0,0,0,0.03)] hover:border-stone-300 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between"
                    style="transition-delay: {{ $index * 100 }}ms;">

                    <div>
                        <!-- Foto Profil -->
                        <div
                            class="w-24 h-24 mb-6 overflow-hidden rounded-full mx-auto border-3 border-stone-100 shadow-md bg-stone-100 flex items-center justify-center shrink-0">
                            @if($author->foto && file_exists(public_path($author->foto)))
                                <img src="{{ asset($author->foto) }}" alt="{{ $author->nama }}" class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset('images/default.jpg') }}" alt="{{ $author->nama }}"
                                    class="w-full h-full object-cover">
                            @endif
                        </div>

                        <div class="flex justify-between items-start mb-2.5 gap-2">
                            <h3 class="font-serif font-bold text-lg text-stone-900 leading-snug">{{ $author->nama }}</h3>
                            <span class="text-[10px] font-semibold bg-red-50 text-[#B6171E] border border-red-200/60 px-2.5 py-1 rounded-full uppercase tracking-wider shrink-0">
                                {{ $author->institusi ?? 'Penulis' }}
                            </span>
                        </div>

                        <p class="text-xs font-semibold text-[#B6171E] mb-4">{{ $author->keahlian ?? '-' }}</p>
                    </div>

                    <div class="border-t border-stone-100 pt-4 mt-auto">
                        <p class="text-[11px] font-bold uppercase tracking-wider mb-1.5 text-stone-500">Profil Singkat</p>
                        <p class="text-sm text-stone-600 leading-relaxed line-clamp-3">{{ $author->profile }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- 3. Section Formulir -->
        <div class="grid md:grid-cols-2 gap-6 max-w-2xl mx-auto">
            <!-- Pemicu Form Penulis -->
            <button onclick="document.getElementById('modal-penulis').classList.remove('hidden')"
                class="border border-stone-300 bg-white text-stone-800 px-8 py-3.5 rounded-xl font-medium hover:border-[#B6171E] hover:text-[#B6171E] shadow-2xs hover:shadow-md transition-all duration-200 animate-on-scroll fade-in-up active:scale-[0.99] cursor-pointer">
                Form Penulis
            </button>

            <!-- Tombol Form Unggah Naskah (Dinamis dari Admin Pengaturan) -->
            <a href="{{ $setting->cek ?? '#' }}"
                target="_blank"
                class="block text-center bg-[#B6171E] text-white px-8 py-3.5 rounded-xl font-medium hover:bg-[#9e141a] shadow-sm hover:shadow-md transition-all duration-200 animate-on-scroll fade-in-up active:scale-[0.99]"
                style="transition-delay: 0.2s;">
                Form Unggah Naskah
            </a>
        </div>

        <!-- Modal Form Penulis -->
        <div id="modal-penulis"
            class="fixed inset-0 z-50 flex items-center justify-center bg-stone-950/60 backdrop-blur-xs hidden p-4 overflow-y-auto">
            <div
                class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-2xl relative my-8 max-h-[90vh] overflow-y-auto border border-stone-200 text-left">

                <!-- Tombol Close (X) -->
                <button onclick="document.getElementById('modal-penulis').classList.add('hidden')"
                    class="absolute top-4 right-4 w-8 h-8 rounded-full bg-stone-100 text-stone-500 hover:text-stone-900 hover:bg-stone-200 flex items-center justify-center text-xl font-bold transition-all">&times;</button>

                <h2 class="text-2xl font-bold font-serif mb-1 text-stone-900">Form Penulis</h2>
                <p class="text-xs text-stone-500 mb-6">Lengkapi data diri Anda di bawah ini untuk mendaftar sebagai penulis.
                </p>

                <!-- Notifikasi Modern -->
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
                        <label class="block text-sm font-medium text-stone-700 mb-1">Nama Lengkap dengan Gelar <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nama" required placeholder="Contoh: Dr. I Nengah Laba"
                            class="w-full p-3 border border-stone-200 rounded-xl text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] bg-stone-50/50 hover:bg-white transition-all">
                    </div>

                    <!-- Institusi atau Perusahaan -->
                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-1">Institusi atau Perusahaan <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="institusi" required placeholder="Contoh: Universitas Udayana"
                            class="w-full p-3 border border-stone-200 rounded-xl text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] bg-stone-50/50 hover:bg-white transition-all">
                    </div>

                    <!-- Grid Kontak (Telepon & Email) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1">Nomor Telepon <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="nomor" required placeholder="Contoh: 081234567890"
                                class="w-full p-3 border border-stone-200 rounded-xl text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] bg-stone-50/50 hover:bg-white transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1">Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" name="email" required placeholder="Contoh: email@domain.com"
                                class="w-full p-3 border border-stone-200 rounded-xl text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] bg-stone-50/50 hover:bg-white transition-all">
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-1">Alamat <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="alamat" required placeholder="Alamat lengkap domisili"
                            class="w-full p-3 border border-stone-200 rounded-xl text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] bg-stone-50/50 hover:bg-white transition-all">
                    </div>

                    <!-- Link Social Media & Keahlian -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1">Link Social Media <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="social_media" required placeholder="www.instagram.com/namapenulis"
                                class="w-full p-3 border border-stone-200 rounded-xl text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] bg-stone-50/50 hover:bg-white transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1">Keahlian <span
                                    class="text-stone-400 font-normal">(opsional)</span></label>
                            <input type="text" name="keahlian" placeholder="Boleh tuliskan lebih dari satu"
                                class="w-full p-3 border border-stone-200 rounded-xl text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] bg-stone-50/50 hover:bg-white transition-all">
                        </div>
                    </div>

                    <!-- Profil Singkat -->
                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-1">Profil Singkat <span
                                class="text-red-500">*</span></label>
                        <textarea name="profile" rows="4" required
                            placeholder="Ceritakan sedikit tentang latar belakang Anda..."
                            class="w-full p-3 border border-stone-200 rounded-xl text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] bg-stone-50/50 hover:bg-white transition-all"></textarea>
                    </div>

                    <!-- Unggah Foto Profil -->
                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-1">Unggah Foto Profil <span
                                class="text-red-500">*</span></label>
                        <input type="file" name="foto" required
                            class="w-full text-sm text-stone-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-[#B6171E] hover:file:bg-red-100 file:cursor-pointer">
                        <p class="text-xs text-stone-400 mt-1">note: max. 2MB (IMAGE)</p>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end gap-2.5 pt-4 border-t border-stone-200">
                        <button type="button" onclick="document.getElementById('modal-penulis').classList.add('hidden')"
                            class="px-5 py-2.5 bg-stone-100 text-stone-700 rounded-xl text-sm font-medium hover:bg-stone-200 active:scale-95 transition-all">
                            Batal
                        </button>
                        <button type="submit" id="submit-btn"
                            class="px-6 py-2.5 bg-[#B6171E] text-white rounded-xl font-medium text-sm hover:bg-[#9e141a] transition-all shadow-sm active:scale-95">
                            Daftar Sekarang
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
                    submitBtn.innerText = 'Mengirim...';
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
                                    throw new Error(result.message || 'Terjadi kesalahan pada validasi data.');
                                }
                                return result;
                            } else {
                                throw new Error("Server tidak merespons dalam format JSON. Periksa kembali Controller Anda.");
                            }
                        })
                        .then(data => {
                            // Tampilkan Banner Sukses yang Estetik
                            alertBox.className = "mb-6 p-4 rounded-xl text-sm flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-900 shadow-sm";
                            alertIcon.innerHTML = `
                                <div class="bg-emerald-500 text-white p-2 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                </div>`;
                            alertTitle.innerText = "Pendaftaran Berhasil!";
                            alertMessage.innerText = data.message || "Data penulis Anda berhasil disimpan.";
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
                            alertBox.className = "mb-6 p-4 rounded-xl text-sm flex items-center gap-3 bg-red-50 border border-red-200 text-red-900 shadow-sm";
                            alertIcon.innerHTML = `
                                <div class="bg-red-500 text-white p-2 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </div>`;
                            alertTitle.innerText = "Gagal Mendaftar";
                            alertMessage.innerText = error.message;
                            alertBox.classList.remove('hidden');

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
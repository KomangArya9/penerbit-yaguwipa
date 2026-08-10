<footer class="bg-[#1B1717] text-white pt-16">
    <!-- Konten Utama -->
    <div class="container mx-auto px-4 md:px-12 mb-16">
        <div class="flex flex-col md:flex-row justify-between gap-12 text-left">

            <!-- Kolom 1: Informasi & Sosial Media -->
            <div class="w-full md:w-1/3 space-y-6">
                <div class="w-40 md:w-48">
                    @if($setting && $setting->logo)
                        <img src="{{ asset('storage/' . $setting->logo) }}" alt="{{ __('common.site_title') }}"
                            class="w-full h-auto">
                    @else
                        <img src="{{ asset('images/logo-footer.png') }}" alt="{{ __('common.site_title') }}" class="w-full h-auto">
                    @endif
                </div>

                <!-- Alamat -->
                <p class="text-sm text-gray-100 leading-relaxed">
                    {{ $setting->address ?? '' }}
                </p>

                <div class="text-sm text-gray-100 space-y-2">
                    <p class="break-all"><span class="font-semibold text-white">{{ __('footer.phone') }}:</span> {{ $setting->phone ?? '' }}</p>
                    <p class="break-all"><span class="font-semibold text-white">{{ __('footer.email') }}:</span> {{ $setting->email ?? '' }}</p>
                    <p class="break-all"><span class="font-semibold text-white">{{ __('footer.website') }}:</span> {{ $setting->website ?? '' }}</p>
                </div>

                <!-- Social Media dari Database -->
                @php $socialMedia = App\Models\Media::all(); @endphp
                @if($socialMedia->count() > 0)
                <div>
                    <h3 class="text-white font-bold mb-4">{{ __('footer.social_media') }}</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach($socialMedia as $media)
                            @php
                                $title = strtolower($media->title);
                                if(str_contains($title, 'youtube')) { $hoverColor = 'hover:bg-red-600'; }
                                elseif(str_contains($title, 'whatsapp') || str_contains($title, 'wa')) { $hoverColor = 'hover:bg-green-500'; }
                                elseif(str_contains($title, 'tiktok')) { $hoverColor = 'hover:bg-black'; }
                                elseif(str_contains($title, 'instagram') || str_contains($title, 'ig')) { $hoverColor = 'hover:bg-pink-600'; }
                                elseif(str_contains($title, 'facebook') || str_contains($title, 'fb')) { $hoverColor = 'hover:bg-blue-600'; }
                                elseif(str_contains($title, 'twitter') || $title === 'x') { $hoverColor = 'hover:bg-sky-500'; }
                                elseif(str_contains($title, 'linkedin')) { $hoverColor = 'hover:bg-blue-700'; }
                                else { $hoverColor = 'hover:bg-[#B6171E]'; }
                            @endphp
                            <a href="{{ $media->url }}" target="_blank" rel="noopener noreferrer"
                                class="group w-10 h-10 flex items-center justify-center rounded-full bg-[#1E293B] {{ $hoverColor }} transition-all duration-300 hover:scale-110 hover:shadow-lg"
                                title="{{ $media->title }}">
                                @if(str_contains($title, 'youtube'))
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                @elseif(str_contains($title, 'whatsapp') || str_contains($title, 'wa'))
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                @elseif(str_contains($title, 'tiktok'))
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.77 0 2.89 2.89 0 0 1 2.5-2.87V9.3a6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.34-6.34V6.57a8.55 8.55 0 0 0 4.5 1.32v-3.4z"/></svg>
                                @elseif(str_contains($title, 'instagram') || str_contains($title, 'ig'))
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                                @elseif(str_contains($title, 'facebook') || str_contains($title, 'fb'))
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                @elseif(str_contains($title, 'twitter') || $title === 'x')
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                @elseif(str_contains($title, 'linkedin'))
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                @elseif(str_contains($title, 'email') || str_contains($title, 'mail'))
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                @else
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/></svg>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Bagian Kanan: Sitemap & Services -->
            <div class="w-full md:w-2/3 grid grid-cols-2 gap-8 md:justify-items-end">
                <!-- Sitemap -->
                <div>
                    <h3 class="font-bold text-lg mb-6 text-white">{{ __('footer.sitemap') }}</h3>
                    <ul class="space-y-3 text-sm text-gray-100">
                        <li><a href="/" class="hover:underline transition">› {{ __('footer.home') }}</a></li>
                        <li><a href="/profile" class="hover:underline transition">› {{ __('footer.profile') }}</a></li>
                        <li><a href="/program" class="hover:underline transition">› {{ __('footer.program') }}</a></li>
                        <li><a href="/portofolio" class="hover:underline transition">› {{ __('footer.portfolio') }}</a></li>
                        <li><a href="/penulis" class="hover:underline transition">› {{ __('footer.authors') }}</a></li>
                        <li><a href="/katalog" class="hover:underline transition">› {{ __('footer.catalog') }}</a></li>
                        <li><a href="/partners" class="hover:underline transition">› {{ __('footer.partners') }}</a></li>
                        <li><a href="/news" class="hover:underline transition">› {{ __('footer.news') }}</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div>
                    <h3 class="font-bold text-lg mb-6 text-white">{{ __('footer.services') }}</h3>
                    <ul class="space-y-3 text-sm text-gray-100">
                        @php $footerPrograms = App\Models\Program::where('status', 'Show')->get(); @endphp
                        @forelse($footerPrograms as $program)
                            <li>
                                <a href="{{ url('/program#' . $program->slug) }}" class="hover:underline transition">
                                    › {{ $program->title }}
                                </a>
                            </li>
                        @empty
                            <li class="text-gray-400 italic">No services available</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright Section -->
    <div class="bg-[#1B1717] w-full py-8 border-t-2 border-gray-700">
        <div class="container mx-auto px-4 md:px-12 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-300 text-center md:text-left">
            <p>{{ $setting->copyright ?? __('footer.copyright') }}</p>
            <p>{{ __('footer.designed_by') }}</p>
        </div>
    </div>
</footer>
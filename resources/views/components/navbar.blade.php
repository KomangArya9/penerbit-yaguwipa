<!-- Navbar Sticky -->
<nav x-data="{ isOpen: false }" id="navbar"
    class="sticky top-0 z-50 bg-white/90 backdrop-blur-sm border-b border-gray-200 py-4 w-full transition-all duration-300">

    <div class="w-full px-6 md:px-10 flex justify-between items-center relative">

        <!-- Logo (Dinamis dari Pengaturan Admin) -->
        @php
            $settingHeader = App\Models\Pengaturan::first();
            $logoPath = $settingHeader && $settingHeader->header ? asset('storage/' . $settingHeader->header) : asset('images/logo.png');
        @endphp
        <a href="/" class="flex items-center">
            <img src="{{ $logoPath }}" alt="Logo Yaguwipa" class="h-10 w-auto object-contain">
        </a>

        <!-- Wrapper Mobile (Language Switcher + Hamburger) -->
        <div class="md:hidden flex items-center gap-4">

            <!-- Language Switcher Mobile -->
            <div x-data="{ openLang: false }" class="relative">
                <button @click="openLang = !openLang"
                    class="flex items-center gap-1 text-sm font-semibold text-gray-700 uppercase hover:text-[#B6171E] transition-colors">
                    <span id="current-lang-mobile">{{ App::getLocale() }}</span>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div x-show="openLang" @click.away="openLang = false" x-cloak
                    class="absolute right-0 mt-3 w-48 max-h-[300px] overflow-y-auto bg-white border border-gray-100 shadow-xl py-2 z-[9999] rounded-lg">

                    {{-- Semua bahasa pakai Google Translate --}}
                    @php
                        $googleLanguages = [
                            ['code' => 'id', 'name' => 'Indonesian - (Bahasa Indonesia)'],
                            ['code' => 'en', 'name' => 'English'],
                            ['code' => 'af', 'name' => 'Afrikaans'],
                            ['code' => 'sq', 'name' => 'Albanian - (Shqip)'],
                            ['code' => 'am', 'name' => 'Amharic - (አማርኛ)'],
                            ['code' => 'ar', 'name' => 'Arabic - (العربية)'],
                            ['code' => 'hy', 'name' => 'Armenian - (Հայերեն)'],
                            ['code' => 'az', 'name' => 'Azerbaijani - (Azərbaycan dili)'],
                            ['code' => 'eu', 'name' => 'Basque - (Euskara)'],
                            ['code' => 'be', 'name' => 'Belarusian - (Беларуская)'],
                            ['code' => 'bn', 'name' => 'Bengali - (বাংলা)'],
                            ['code' => 'bs', 'name' => 'Bosnian - (Bosanski)'],
                            ['code' => 'bg', 'name' => 'Bulgarian - (Български)'],
                            ['code' => 'ca', 'name' => 'Catalan - (Català)'],
                            ['code' => 'zh-CN', 'name' => 'Chinese Simplified - (中文简体)'],
                            ['code' => 'zh-TW', 'name' => 'Chinese Traditional - (中文繁體)'],
                            ['code' => 'hr', 'name' => 'Croatian - (Hrvatski)'],
                            ['code' => 'cs', 'name' => 'Czech - (Čeština)'],
                            ['code' => 'da', 'name' => 'Danish - (Dansk)'],
                            ['code' => 'nl', 'name' => 'Dutch - (Nederlands)'],
                            ['code' => 'et', 'name' => 'Estonian - (Eesti)'],
                            ['code' => 'fil', 'name' => 'Filipino - (Wikang Filipino)'],
                            ['code' => 'fi', 'name' => 'Finnish - (Suomi)'],
                            ['code' => 'fr', 'name' => 'French - (Français)'],
                            ['code' => 'gl', 'name' => 'Galician - (Galego)'],
                            ['code' => 'ka', 'name' => 'Georgian - (ქართული)'],
                            ['code' => 'de', 'name' => 'German - (Deutsch)'],
                            ['code' => 'el', 'name' => 'Greek - (Ελληνικά)'],
                            ['code' => 'gu', 'name' => 'Gujarati - (ગુજરાતી)'],
                            ['code' => 'ha', 'name' => 'Hausa - (هَوُسَ)'],
                            ['code' => 'he', 'name' => 'Hebrew - (עברית)'],
                            ['code' => 'hi', 'name' => 'Hindi - (हिन्दी)'],
                            ['code' => 'hu', 'name' => 'Hungarian - (Magyar)'],
                            ['code' => 'is', 'name' => 'Icelandic - (Íslenska)'],
                            ['code' => 'ga', 'name' => 'Irish - (Gaeilge)'],
                            ['code' => 'it', 'name' => 'Italian - (Italiano)'],
                            ['code' => 'ja', 'name' => 'Japanese - (日本語)'],
                            ['code' => 'kn', 'name' => 'Kannada - (ಕನ್ನಡ)'],
                            ['code' => 'kk', 'name' => 'Kazakh - (Қазақ тілі)'],
                            ['code' => 'km', 'name' => 'Khmer - (ខ្មែរ)'],
                            ['code' => 'ko', 'name' => 'Korean - (한국어)'],
                            ['code' => 'ku', 'name' => 'Kurdish - (Kurdî)'],
                            ['code' => 'lo', 'name' => 'Lao - (ລາວ)'],
                            ['code' => 'lv', 'name' => 'Latvian - (Latviešu)'],
                            ['code' => 'lt', 'name' => 'Lithuanian - (Lietuvių)'],
                            ['code' => 'mk', 'name' => 'Macedonian - (Македонски)'],
                            ['code' => 'ms', 'name' => 'Malay - (Bahasa Melayu)'],
                            ['code' => 'ml', 'name' => 'Malayalam - (മലയാളം)'],
                            ['code' => 'mt', 'name' => 'Maltese - (Malti)'],
                            ['code' => 'mr', 'name' => 'Marathi - (मराठी)'],
                            ['code' => 'mn', 'name' => 'Mongolian - (Монгол)'],
                            ['code' => 'ne', 'name' => 'Nepali - (नेपाली)'],
                            ['code' => 'no', 'name' => 'Norwegian - (Norsk)'],
                            ['code' => 'fa', 'name' => 'Persian - (فارسی)'],
                            ['code' => 'pl', 'name' => 'Polish - (Polski)'],
                            ['code' => 'pt', 'name' => 'Portuguese - (Português)'],
                            ['code' => 'pt-BR', 'name' => 'Portuguese Brazil - (Português Brasil)'],
                            ['code' => 'pa', 'name' => 'Punjabi - (ਪੰਜਾਬੀ)'],
                            ['code' => 'ro', 'name' => 'Romanian - (Română)'],
                            ['code' => 'ru', 'name' => 'Russian - (Русский)'],
                            ['code' => 'sr', 'name' => 'Serbian - (Српски)'],
                            ['code' => 'si', 'name' => 'Sinhala - (සිංහල)'],
                            ['code' => 'sk', 'name' => 'Slovak - (Slovenčina)'],
                            ['code' => 'sl', 'name' => 'Slovenian - (Slovenščina)'],
                            ['code' => 'so', 'name' => 'Somali - (Soomaali)'],
                            ['code' => 'es', 'name' => 'Spanish - (Español)'],
                            ['code' => 'su', 'name' => 'Sundanese - (Basa Sunda)'],
                            ['code' => 'sw', 'name' => 'Swahili - (Kiswahili)'],
                            ['code' => 'sv', 'name' => 'Swedish - (Svenska)'],
                            ['code' => 'ta', 'name' => 'Tamil - (தமிழ்)'],
                            ['code' => 'te', 'name' => 'Telugu - (తెలుగు)'],
                            ['code' => 'th', 'name' => 'Thai - (ไทย)'],
                            ['code' => 'tr', 'name' => 'Turkish - (Türkçe)'],
                            ['code' => 'uk', 'name' => 'Ukrainian - (Українська)'],
                            ['code' => 'ur', 'name' => 'Urdu - (اردو)'],
                            ['code' => 'uz', 'name' => 'Uzbek - (O\'zbek)'],
                            ['code' => 'vi', 'name' => 'Vietnamese - (Tiếng Việt)'],
                            ['code' => 'cy', 'name' => 'Welsh - (Cymraeg)'],
                            ['code' => 'yo', 'name' => 'Yoruba - (Èdè Yorùbá)'],
                            ['code' => 'zu', 'name' => 'Zulu - (isiZulu)'],
                        ];
                    @endphp

                    @foreach($googleLanguages as $lang)
                        <a href="#" onclick="triggerGoogleTranslate('{{ $lang['code'] }}'); return false;"
                            class="block px-4 py-2 hover:bg-gray-50 text-sm font-medium transition text-gray-700">
                            {{ $lang['name'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Tombol Hamburger -->
            <button @click="isOpen = !isOpen"
                class="text-gray-700 hover:text-[#B6171E] transition-colors duration-300 focus:outline-none">
                <svg x-show="!isOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg x-show="isOpen" x-cloak class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Menu Mobile (Dinamis dari Database) -->
        <div x-show="isOpen" x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            @click.away="isOpen = false"
            class="md:hidden bg-white border-t border-gray-100 shadow-xl absolute w-full left-0 top-full z-40 rounded-b-xl">
            <div class="flex flex-col px-6 py-6">
                <div class="space-y-2">
                    @isset($menus)
                        @foreach($menus as $menu)
                            @php
                                $menuUrl = strtolower($menu->title) === 'home' ? '/' : '/' . ltrim($menu->url, '/');
                                $isActive = request()->is(trim($menuUrl, '/')) || (strtolower($menu->title) === 'home' && request()->is('/'));
                            @endphp
                            <a href="{{ $menuUrl }}" @click="isOpen = false"
                                class="block px-4 py-3 rounded-lg text-base font-medium transition-all duration-300 {{ $isActive ? 'text-[#B6171E] bg-red-50' : 'text-gray-700 hover:text-[#B6171E] hover:bg-gray-50' }}">
                                {{ $menu->title }}
                            </a>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>

        <!-- Menu Desktop (Dinamis dari Database) -->
        <div class="hidden md:flex space-x-6 text-sm font-medium text-gray-700">
            @isset($menus)
                @foreach($menus as $menu)
                    @php
                        $menuUrl = strtolower($menu->title) === 'home' ? '/' : '/' . ltrim($menu->url, '/');
                        $isActive = request()->is(trim($menuUrl, '/')) || (strtolower($menu->title) === 'home' && request()->is('/'));
                    @endphp
                    <a href="{{ $menuUrl }}"
                        class="relative py-2 transition-colors duration-300 {{ $isActive ? 'text-[#B6171E]' : 'hover:text-[#B6171E]' }}">
                        {{ $menu->title }}
                        <span class="absolute left-0 bottom-0 h-0.5 bg-[#B6171E] origin-left transition-all duration-[700ms] ease-out {{ $isActive ? 'w-full' : 'w-0' }}">
                        </span>
                    </a>
                @endforeach
            @endisset
        </div>

        <!-- Right Side (Language Switcher Desktop) -->
        <div class="hidden md:flex items-center gap-6">
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                    class="flex items-center gap-2 text-sm font-semibold text-gray-700 hover:text-[#B6171E] transition">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                    </svg>
                    <span class="uppercase" id="current-lang">{{ App::getLocale() }}</span>
                    <svg class="h-4 w-4 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown Menu Bahasa -->
                <div x-show="open" @click.away="open = false" x-cloak
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="absolute right-0 mt-3 w-64 max-h-[400px] overflow-y-auto bg-white border border-gray-100 shadow-xl py-2 z-50 rounded-lg">

                    {{-- Semua bahasa pakai Google Translate --}}
                    @foreach($googleLanguages as $lang)
                        <a href="#" onclick="triggerGoogleTranslate('{{ $lang['code'] }}'); return false;"
                            class="block px-4 py-2 hover:bg-gray-50 text-sm font-medium transition text-gray-700">
                            {{ $lang['name'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</nav>

<!-- Google Translate Language Switcher Script -->
<script>
    // Restore saved language on page load
    document.addEventListener('DOMContentLoaded', function() {
        var savedLang = localStorage.getItem('yaguwipa_lang');
        if (savedLang && savedLang !== 'id') {
            // Update display immediately
            var displays = document.querySelectorAll('#current-lang, #current-lang-mobile');
            displays.forEach(function(el) { el.textContent = savedLang.toUpperCase(); });

            // Wait for Google Translate to load, then apply
            var checker = setInterval(function() {
                var select = document.querySelector('.goog-te-combo');
                if (select) {
                    clearInterval(checker);
                    setTimeout(function() {
                        select.value = savedLang;
                        var event = document.createEvent('HTMLEvents');
                        event.initEvent('change', true, true);
                        select.dispatchEvent(event);
                    }, 500);
                }
            }, 500);
        }
    });

    // Trigger Google Translate for a language
    var gtRetryCount = 0;
    var gtMaxRetries = 30;

    function triggerGoogleTranslate(lang) {
        gtRetryCount++;

        var select = document.querySelector('.goog-te-combo');
        if (!select) {
            if (gtRetryCount >= gtMaxRetries) return;
            setTimeout(function() { triggerGoogleTranslate(lang); }, 300);
            return;
        }

        gtRetryCount = 0;

        // Indonesian = original language → reload to reset
        if (lang === 'id') {
            localStorage.removeItem('yaguwipa_lang');
            // Delete Google Translate cookies
            document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=' + window.location.hostname;
            document.cookie = 'googtransopt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            window.location.reload();
            return;
        }

        // Other languages → trigger Google Translate
        select.value = lang;
        var event = document.createEvent('HTMLEvents');
        event.initEvent('change', true, true);
        select.dispatchEvent(event);

        // Save to localStorage
        localStorage.setItem('yaguwipa_lang', lang);

        // Update display
        document.querySelectorAll('#current-lang, #current-lang-mobile').forEach(function(el) {
            el.textContent = lang.toUpperCase();
        });
    }
</script>

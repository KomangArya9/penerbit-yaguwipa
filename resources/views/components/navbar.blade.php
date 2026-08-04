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

            <!-- Language Switcher Mobile (Vanilla JS) -->
            <div id="lang-switcher-mobile" class="relative">
                <button id="lang-btn-mobile"
                    class="flex items-center gap-1 text-sm font-semibold text-gray-700 uppercase hover:text-[#B6171E] transition-colors">
                    <span id="current-lang-mobile">ID</span>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div id="lang-dropdown-mobile"
                    class="hidden absolute right-0 mt-3 w-40 max-h-[300px] overflow-y-auto bg-white border border-gray-100 shadow-xl py-2 z-[9999] rounded-lg">

                    @php
                        $languages = [
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
                            ['code' => 'en', 'name' => 'English'],
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
                            ['code' => 'id', 'name' => 'Indonesian - (Bahasa Indonesia)'],
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

                    @foreach($languages as $lang)
                        <a href="#" data-lang="{{ $lang['code'] }}"
                            class="lang-option block px-4 py-2 hover:bg-gray-50 text-sm font-medium transition text-gray-700">
                            {{ $lang['name'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Tombol Hamburger -->
            <button @click="isOpen = !isOpen"
                class="text-gray-700 hover:text-[#B6171E] transition-colors duration-300 focus:outline-none">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Menu Mobile (Dinamis dari Database) -->
        <div x-show="isOpen" x-cloak x-transition @click.away="isOpen = false"
            class="md:hidden bg-white border-t border-gray-100 shadow-lg absolute w-full left-0 top-full z-40">
            <div class="flex flex-col px-5 py-6">
                <div class="space-y-4">
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

        <!-- Right Side (Language Switcher Desktop - Vanilla JS) -->
        <div class="hidden md:flex items-center gap-6">
            <div id="lang-switcher-desktop" class="relative">
                <button id="lang-btn-desktop"
                    class="flex items-center gap-2 text-sm font-semibold text-gray-700 hover:text-[#B6171E] transition">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                    </svg>
                    <span class="uppercase" id="current-lang">ID</span>
                    <svg id="lang-chevron-desktop" class="h-4 w-4 transition-transform duration-300" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div id="lang-dropdown-desktop"
                    class="hidden absolute right-0 mt-3 w-64 max-h-[400px] overflow-y-auto bg-white border border-gray-100 shadow-xl py-2 z-50 rounded-lg">

                    @foreach($languages as $lang)
                        <a href="#" data-lang="{{ $lang['code'] }}"
                            class="lang-option block px-4 py-2 hover:bg-gray-50 text-sm font-medium transition text-gray-700">
                            {{ $lang['name'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</nav>

<!-- Google Translate Language Switcher Script (Vanilla JS - NO Alpine.js) -->
<script>
(function() {
    // ========== LANGUAGE SWITCHER ==========

    // Toggle dropdown
    function toggleDropdown(type) {
        var dropdown = document.getElementById('lang-dropdown-' + type);
        var chevron = document.getElementById('lang-chevron-' + type);

        // Close other dropdowns first
        document.querySelectorAll('[id^="lang-dropdown-"]').forEach(function(el) {
            if (el.id !== 'lang-dropdown-' + type) {
                el.classList.add('hidden');
            }
        });

        // Toggle current
        if (dropdown) {
            dropdown.classList.toggle('hidden');
            // Rotate chevron
            if (chevron) {
                chevron.style.transform = dropdown.classList.contains('hidden') ? '' : 'rotate(180deg)';
            }
        }
    }

    // Select language - trigger Google Translate directly (NO reload)
    function selectLanguage(lang, e) {
        e.preventDefault();
        e.stopPropagation();

        // Stop restore interval immediately — user is in control now
        if (restoreChecker) {
            clearInterval(restoreChecker);
            restoreChecker = null;
        }

        // Save to localStorage
        localStorage.setItem('yaguwipa_lang', lang);

        // Update display
        var displays = document.querySelectorAll('#current-lang, #current-lang-mobile');
        for (var i = 0; i < displays.length; i++) {
            displays[i].textContent = lang.toUpperCase();
        }

        // Close all dropdowns
        document.querySelectorAll('[id^="lang-dropdown-"]').forEach(function(el) {
            el.classList.add('hidden');
        });

        // Trigger Google Translate
        triggerTranslate(lang);
    }

    // Trigger Google Translate for a given language
    function triggerTranslate(lang) {
        // Indonesian = original language → delete cookie + reload
        // Cookie must be deleted BEFORE reload, otherwise Google Translate
        // reads the old cookie and re-translates on page load
        if (lang === 'id' || lang === 'ID') {
            // Delete all Google Translate cookies
            document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=' + window.location.hostname;
            document.cookie = 'googtransopt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';

            localStorage.removeItem('yaguwipa_lang');
            window.location.reload();
            return;
        }

        // For all other languages → translate directly without reload
        var select = document.querySelector('.goog-te-combo');
        if (!select) {
            setTimeout(function() { triggerTranslate(lang); }, 300);
            return;
        }

        select.value = lang;

        // Dispatch change event
        var event = document.createEvent('HTMLEvents');
        event.initEvent('change', true, true);
        select.dispatchEvent(event);
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('#lang-switcher-desktop') && !e.target.closest('#lang-switcher-mobile')) {
            document.querySelectorAll('[id^="lang-dropdown-"]').forEach(function(el) {
                el.classList.add('hidden');
            });
            document.querySelectorAll('[id^="lang-chevron-"]').forEach(function(el) {
                el.style.transform = '';
            });
        }
    });

    // ========== EVENT LISTENERS ==========

    // Desktop button
    var desktopBtn = document.getElementById('lang-btn-desktop');
    if (desktopBtn) {
        desktopBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            toggleDropdown('desktop');
        });
    }

    // Mobile button
    var mobileBtn = document.getElementById('lang-btn-mobile');
    if (mobileBtn) {
        mobileBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            toggleDropdown('mobile');
        });
    }

    // Language options (event delegation)
    document.querySelectorAll('.lang-option').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var lang = this.getAttribute('data-lang');
            selectLanguage(lang, e);
        });
    });

    // ========== RESTORE SAVED LANGUAGE ==========

    var restoreChecker = null;

    function restoreLanguage() {
        var saved = localStorage.getItem('yaguwipa_lang');
        if (!saved || saved === 'id' || saved === 'ID') return;

        // Update display text in navbar
        var displays = document.querySelectorAll('#current-lang, #current-lang-mobile');
        for (var i = 0; i < displays.length; i++) {
            displays[i].textContent = saved.toUpperCase();
        }

        // Wait for Google Translate to initialize
        var attempts = 0;
        var maxAttempts = 50;

        restoreChecker = setInterval(function() {
            attempts++;
            if (attempts >= maxAttempts) {
                clearInterval(restoreChecker);
                restoreChecker = null;
                return;
            }

            // Check if user already selected a language — stop restoring
            if (localStorage.getItem('yaguwipa_lang') !== saved) {
                clearInterval(restoreChecker);
                restoreChecker = null;
                return;
            }

            var select = document.querySelector('.goog-te-combo');
            if (select) {
                clearInterval(restoreChecker);
                restoreChecker = null;
                setTimeout(function() {
                    triggerTranslate(saved);
                }, 500);
            }
        }, 500);
    }

    // Run on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', restoreLanguage);
    } else {
        restoreLanguage();
    }

})();
</script>

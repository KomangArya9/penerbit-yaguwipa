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
                    {{ app()->getLocale() }}
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div x-show="openLang" @click.away="openLang = false" x-cloak
                    class="absolute right-0 mt-3 w-40 max-h-[300px] overflow-y-auto bg-white border border-gray-100 shadow-xl py-2 z-[9999] rounded-lg">

                    @php
                        $languages = [
                            ['code' => 'af', 'name' => 'Afrikaans'],
                            ['code' => 'sq', 'name' => 'Albanian - (Shqip)'],
                            ['code' => 'am', 'name' => 'Amharic - (አማርኛ)'],
                            ['code' => 'ar', 'name' => 'Arabic - (العربية)'],
                            ['code' => 'an', 'name' => 'Aragonese - (Aragonés)'],
                            ['code' => 'hy', 'name' => 'Armenian - (Հայերեն)'],
                            ['code' => 'ast', 'name' => 'Asturian - (Asturianu)'],
                            ['code' => 'ay', 'name' => 'Aymara - (Aymar aru)'],
                            ['code' => 'az', 'name' => 'Azerbaijani - (Azərbaycan dili)'],
                            ['code' => 'eu', 'name' => 'Basque - (Euskara)'],
                            ['code' => 'be', 'name' => 'Belarusian - (Беларуская)'],
                            ['code' => 'bn', 'name' => 'Bengali - (বাংলা)'],
                            ['code' => 'brx', 'name' => 'Bodo - (बर\')'],
                            ['code' => 'bs', 'name' => 'Bosnian - (Bosanski)'],
                            ['code' => 'br', 'name' => 'Breton - (Brezhoneg)'],
                            ['code' => 'bg', 'name' => 'Bulgarian - (Български)'],
                            ['code' => 'ca', 'name' => 'Catalan - (Català)'],
                            ['code' => 'ckb', 'name' => 'Central - Kurdish (کوردی)'],
                            ['code' => 'ce', 'name' => 'Chechen (Нохчийн мотт)'],
                            ['code' => 'zh', 'name' => 'Chinese (中文)'],
                            ['code' => 'zh-HK', 'name' => 'Chinese Hong Kong - (中文 - 香港)'],
                            ['code' => 'zh-CN', 'name' => 'Chinese Simplified - (中文简体)'],
                            ['code' => 'zh-TW', 'name' => 'Chinese Traditional - (中文繁體)'],
                            ['code' => 'co', 'name' => 'Corsican - (Corsu)'],
                            ['code' => 'hr', 'name' => 'Croatian - (Hrvatski)'],
                            ['code' => 'cs', 'name' => 'Czech - (Čeština)'],
                            ['code' => 'da', 'name' => 'Danish - (Dansk)'],
                            ['code' => 'dv', 'name' => 'Dhivehi - (ދިވެހި)'],
                            ['code' => 'nl', 'name' => 'Dutch (Nederlands)'],
                            ['code' => 'dz', 'name' => 'Dzongkha (རྫོང་ཁ)'],
                            ['code' => 'en', 'name' => 'English'],
                            ['code' => 'en-AU', 'name' => 'English (Australia)'],
                            ['code' => 'en-CA', 'name' => 'English (Canada)'],
                            ['code' => 'en-IN', 'name' => 'English (India)'],
                            ['code' => 'en-NZ', 'name' => 'English (New Zealand)'],
                            ['code' => 'en-ZA', 'name' => 'English (South Africa)'],
                            ['code' => 'en-GB', 'name' => 'English (United Kingdom)'],
                            ['code' => 'en-US', 'name' => 'English (United States)'],
                            ['code' => 'eo', 'name' => 'Esperanto'],
                            ['code' => 'et', 'name' => 'Estonian (Eesti)'],
                            ['code' => 'ee', 'name' => 'Ewe (Eʋegbe)'],
                            ['code' => 'fo', 'name' => 'Faroese - (Føroyskt)'],
                            ['code' => 'fil', 'name' => 'Filipino (Wikang Filipino)'],
                            ['code' => 'fi', 'name' => 'Finnish (Suomi)'],
                            ['code' => 'fr', 'name' => 'French (Français)'],
                            ['code' => 'fr-CA', 'name' => 'French Canada - (Français Canada)'],
                            ['code' => 'fr-FR', 'name' => 'French France - (Français France)'],
                            ['code' => 'fr-CH', 'name' => 'French Switzerland - (Français Suisse)'],
                            ['code' => 'gl', 'name' => 'Galician - (Galego)'],
                            ['code' => 'ka', 'name' => 'Georgian - (ქართული)'],
                            ['code' => 'de', 'name' => 'German - (Deutsch)'],
                            ['code' => 'de-AT', 'name' => 'German Austria - (Deutsch Österreich)'],
                            ['code' => 'de-DE', 'name' => 'German Germany - (Deutsch Deutschland)'],
                            ['code' => 'de-LI', 'name' => 'German Liechtenstein - (Deutsch Liechtenstein)'],
                            ['code' => 'de-CH', 'name' => 'German Switzerland - (Deutsch Schweiz)'],
                            ['code' => 'el', 'name' => 'Greek - (Ελληνικά)'],
                            ['code' => 'gn', 'name' => 'Guarani - (Avañe\'ẽ)'],
                            ['code' => 'gu', 'name' => 'Gujarati - (ગુજરાતી)'],
                            ['code' => 'ha', 'name' => 'Hausa - (هَوُسَ)'],
                            ['code' => 'haw', 'name' => 'Hawaiian - (ʻŌlelo Hawaiʻi)'],
                            ['code' => 'he', 'name' => 'Hebrew - (עברית)'],
                            ['code' => 'hi', 'name' => 'Hindi - (हिन्दी)'],
                            ['code' => 'hu', 'name' => 'Hungarian - (Magyar)'],
                            ['code' => 'is', 'name' => 'Icelandic - (Íslenska)'],
                            ['code' => 'id', 'name' => 'Indonesian - (Bahasa Indonesia)'],
                            ['code' => 'ia', 'name' => 'Interlingua'],
                            ['code' => 'iu', 'name' => 'Inuktitut - (ᐃᓄᒃᑎᑐᑦ)'],
                            ['code' => 'ga', 'name' => 'Irish - (Gaeilge)'],
                            ['code' => 'it', 'name' => 'Italian - (Italiano)'],
                            ['code' => 'it-IT', 'name' => 'Italian Italy - (Italiano Italia)'],
                            ['code' => 'it-CH', 'name' => 'Italian Switzerland - (Italiano - Svizzera)'],
                            ['code' => 'ja', 'name' => 'Japanese - (日本語)'],
                            ['code' => 'kl', 'name' => 'Kalaallisut - (Kalaallisut)'],
                            ['code' => 'kn', 'name' => 'Kannada - (ಕನ್ನಡ)'],
                            ['code' => 'ks', 'name' => 'Kashmiri - (कॉशुर / كٲشُر‎)'],
                            ['code' => 'kk', 'name' => 'Kazakh - (Қазақ тілі)'],
                            ['code' => 'km', 'name' => 'Khmer - (ខ្មែរ)'],
                            ['code' => 'rw', 'name' => 'Kinyarwanda - (Ikinyarwanda)'],
                            ['code' => 'ko', 'name' => 'Korean - (한국어)'],
                            ['code' => 'ku', 'name' => 'Kurdish - (Kurdî)'],
                            ['code' => 'ky', 'name' => 'Kyrgyz - (Кыргызча)'],
                            ['code' => 'lo', 'name' => 'Lao - (ລາວ)'],
                            ['code' => 'la', 'name' => 'Latin - (Latina)'],
                            ['code' => 'lv', 'name' => 'Latvian - (Latviešu)'],
                            ['code' => 'ln', 'name' => 'Lingala - (Lingála)'],
                            ['code' => 'lt', 'name' => 'Lithuanian - (Lietuvių)'],
                            ['code' => 'lg', 'name' => 'Luganda - (Luganda)'],
                            ['code' => 'lb', 'name' => 'Luxembourgish - (Lëtzebuergesch)'],
                            ['code' => 'mk', 'name' => 'Macedonian - (Македонски)'],
                            ['code' => 'mai', 'name' => 'Maithili - (मैथिली)'],
                            ['code' => 'ms', 'name' => 'Malay - (Bahasa Melayu)'],
                            ['code' => 'ml', 'name' => 'Malayalam - (മലയാളം)'],
                            ['code' => 'mt', 'name' => 'Maltese - (Malti)'],
                            ['code' => 'mni', 'name' => 'Manipuri - (ꯃꯅꯤꯄꯨꯔꯤ)'],
                            ['code' => 'mr', 'name' => 'Marathi - (मराठी)'],
                            ['code' => 'mn', 'name' => 'Mongolian - (Монгол)'],
                            ['code' => 'ne', 'name' => 'Nepali - (नेपाली)'],
                            ['code' => 'nso', 'name' => 'Northern Sotho - (Sesotho sa Leboa)'],
                            ['code' => 'no', 'name' => 'Norwegian (Norsk)'],
                            ['code' => 'nb', 'name' => 'Norwegian Bokmål - (Norsk bokmål)'],
                            ['code' => 'nn', 'name' => 'Norwegian Nynorsk - (Nynorsk)'],
                            ['code' => 'oc', 'name' => 'Occitan'],
                            ['code' => 'or', 'name' => 'Oriya - (ଓଡ଼ିଆ)'],
                            ['code' => 'om', 'name' => 'Oromo - (Afaan Oromoo)'],
                            ['code' => 'os', 'name' => 'Ossetian - (Ирон æвзаг)'],
                            ['code' => 'ps', 'name' => 'Pashto - (پښتو)'],
                            ['code' => 'fa', 'name' => 'Persian - (فارسی)'],
                            ['code' => 'pl', 'name' => 'Polish - (Polski)'],
                            ['code' => 'pt', 'name' => 'Portuguese - (Português)'],
                            ['code' => 'pt-BR', 'name' => 'Portuguese Brazil - (Português Brasil)'],
                            ['code' => 'pt-PT', 'name' => 'Portuguese Portugal - (Português Portugal)'],
                            ['code' => 'pa', 'name' => 'Punjabi - (ਪੰਜਾਬੀ)'],
                            ['code' => 'qu', 'name' => 'Quechua - (Runa Simi)'],
                            ['code' => 'ro', 'name' => 'Romanian - (Română)'],
                            ['code' => 'mo', 'name' => 'Romanian Moldova - (Română Moldova)'],
                            ['code' => 'rm', 'name' => 'Romansh - (Rumantsch)'],
                            ['code' => 'ru', 'name' => 'Russian - (Русский)'],
                            ['code' => 'sm', 'name' => 'Samoan - (Gagana Samoa)'],
                            ['code' => 'sat', 'name' => 'Santali - (ᱥᱟᱱᱛᱟᱲᱤ)'],
                            ['code' => 'sc', 'name' => 'Sardinian - (Sardu)'],
                            ['code' => 'gd', 'name' => 'Scottish Gaelic - (Gàidhlig)'],
                            ['code' => 'sr', 'name' => 'Serbian - (Српски)'],
                            ['code' => 'sh', 'name' => 'Serbo_Croatian - (Srpskohrvatski)'],
                            ['code' => 'sn', 'name' => 'Shona - (ChiShona)'],
                            ['code' => 'sd', 'name' => 'Sindhi - (سنڌي)'],
                            ['code' => 'si', 'name' => 'Sinhala - (සිංහල)'],
                            ['code' => 'sk', 'name' => 'Slovak - (Slovenčina)'],
                            ['code' => 'sl', 'name' => 'Slovenian - (Slovenščina)'],
                            ['code' => 'so', 'name' => 'Somali - (Soomaali)'],
                            ['code' => 'st', 'name' => 'Southern - Sotho (Sesotho)'],
                            ['code' => 'es', 'name' => 'Spanish - (Español)'],
                            ['code' => 'es-AR', 'name' => 'Spanish Argentina - (Español Argentina)'],
                            ['code' => 'es-419', 'name' => 'Spanish Latin America - (Español Latinoamérica)'],
                            ['code' => 'es-MX', 'name' => 'Spanish Mexico - (Español México)'],
                            ['code' => 'es-ES', 'name' => 'Spanish Spain - (Español España)'],
                            ['code' => 'es-US', 'name' => 'Spanish United States - (Español Estados Unidos)'],
                            ['code' => 'su', 'name' => 'Sundanese - (Basa Sunda)'],
                            ['code' => 'sw', 'name' => 'Swahili - (Kiswahili)'],
                            ['code' => 'sv', 'name' => 'Swedish - (Svenska)'],
                            ['code' => 'tg', 'name' => 'Tajik - (Тоҷикӣ)'],
                            ['code' => 'ta', 'name' => 'Tamil - (தமிழ்)'],
                            ['code' => 'tt', 'name' => 'Tatar - (Татар)'],
                            ['code' => 'te', 'name' => 'Telugu - (తెలుగు)'],
                            ['code' => 'th', 'name' => 'Thai - (ไทย)'],
                            ['code' => 'ti', 'name' => 'Tigrinya - (ትግርኛ)'],
                            ['code' => 'to', 'name' => 'Tongan - (Lea fakatonga)'],
                            ['code' => 'tn', 'name' => 'Tswana - (Setswana)'],
                            ['code' => 'tr', 'name' => 'Turkish - (Türkçe)'],
                            ['code' => 'tk', 'name' => 'Turkmen - (Türkmençe)'],
                            ['code' => 'tw', 'name' => 'Twi - (Twi)'],
                            ['code' => 'udm', 'name' => 'Udmurt - (Удмурт кыл)'],
                            ['code' => 'uk', 'name' => 'Ukrainian - (Українська)'],
                            ['code' => 'ur', 'name' => 'Urdu - (اردو)'],
                            ['code' => 'ug', 'name' => 'Uyghur - (ئۇيغۇرچە)'],
                            ['code' => 'uz', 'name' => 'Uzbek - (O\'zbek)'],
                            ['code' => 've', 'name' => 'Venda - (Tshivenḓa)'],
                            ['code' => 'vi', 'name' => 'Vietnamese - (Tiếng Việt)'],
                            ['code' => 'wa', 'name' => 'Walloon - (Walon)'],
                            ['code' => 'cy', 'name' => 'Welsh - (Cymraeg)'],
                            ['code' => 'fy', 'name' => 'Western Frisian - (Frysk)'],
                            ['code' => 'wo', 'name' => 'Wolof - (Wollof)'],
                            ['code' => 'xh', 'name' => 'Xhosa - (isiXhosa)'],
                            ['code' => 'yi', 'name' => 'Yiddish - (ייִדיש)'],
                            ['code' => 'yo', 'name' => 'Yoruba - (Èdè Yorùbá)'],
                            ['code' => 'za', 'name' => 'Zhuang - (Saɯ cueŋƅ)'],
                            ['code' => 'zu', 'name' => 'Zulu - (isiZulu)']
                        ];
                    @endphp

                    @foreach($languages as $lang)
                        <a href="{{ route('lang.switch', $lang['code']) }}"
                            class="block px-4 py-2 hover:bg-gray-50 text-sm font-medium transition text-gray-700">
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
                                // Menentukan URL menu untuk desktop berdasarkan kolom 'url' dari database
                                $menuUrl = strtolower($menu->title) === 'home' ? '/' : '/' . ltrim($menu->url, '/');

                                // Mengecek apakah halaman sedang aktif
                                $isActive = request()->is(trim($menuUrl, '/')) || (strtolower($menu->title) === 'home' && request()->is('/'));
                            @endphp
                            <a href="{{ $menuUrl }}"
                                class="relative py-2 transition-colors duration-300 {{ $isActive ? 'text-[#B6171E]' : 'hover:text-[#B6171E]' }}">

                                {{ $menu->title }}

                                <!-- Garis bawah dengan animasi "berjalan" -->
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
                        // Menentukan URL menu untuk desktop berdasarkan kolom 'url' dari database
                        $menuUrl = strtolower($menu->title) === 'home' ? '/' : '/' . ltrim($menu->url, '/');

                        // Mengecek apakah halaman sedang aktif
                        $isActive = request()->is(trim($menuUrl, '/')) || (strtolower($menu->title) === 'home' && request()->is('/'));
                    @endphp
                    <a href="{{ $menuUrl }}"
                        class="relative py-2 transition-colors duration-300 {{ $isActive ? 'text-[#B6171E]' : 'hover:text-[#B6171E]' }}">

                        {{ $menu->title }}

                        <!-- Garis bawah dengan animasi "berjalan" -->
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
                    <span class="uppercase">{{ app()->getLocale() }}</span>
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

                    @php
                        $languages = [
                            ['code' => 'af', 'name' => 'Afrikaans'],
                            ['code' => 'sq', 'name' => 'Albanian - (Shqip)'],
                            ['code' => 'am', 'name' => 'Amharic - (አማርኛ)'],
                            ['code' => 'ar', 'name' => 'Arabic - (العربية)'],
                            ['code' => 'an', 'name' => 'Aragonese - (Aragonés)'],
                            ['code' => 'hy', 'name' => 'Armenian - (Հայերեն)'],
                            ['code' => 'ast', 'name' => 'Asturian - (Asturianu)'],
                            ['code' => 'ay', 'name' => 'Aymara - (Aymar aru)'],
                            ['code' => 'az', 'name' => 'Azerbaijani - (Azərbaycan dili)'],
                            ['code' => 'eu', 'name' => 'Basque - (Euskara)'],
                            ['code' => 'be', 'name' => 'Belarusian - (Беларуская)'],
                            ['code' => 'bn', 'name' => 'Bengali - (বাংলা)'],
                            ['code' => 'brx', 'name' => 'Bodo - (बर\')'],
                            ['code' => 'bs', 'name' => 'Bosnian - (Bosanski)'],
                            ['code' => 'br', 'name' => 'Breton - (Brezhoneg)'],
                            ['code' => 'bg', 'name' => 'Bulgarian - (Български)'],
                            ['code' => 'ca', 'name' => 'Catalan - (Català)'],
                            ['code' => 'ckb', 'name' => 'Central - Kurdish (کوردی)'],
                            ['code' => 'ce', 'name' => 'Chechen (Нохчийн мотт)'],
                            ['code' => 'zh', 'name' => 'Chinese (中文)'],
                            ['code' => 'zh-HK', 'name' => 'Chinese Hong Kong - (中文 - 香港)'],
                            ['code' => 'zh-CN', 'name' => 'Chinese Simplified - (中文简体)'],
                            ['code' => 'zh-TW', 'name' => 'Chinese Traditional - (中文繁體)'],
                            ['code' => 'co', 'name' => 'Corsican - (Corsu)'],
                            ['code' => 'hr', 'name' => 'Croatian - (Hrvatski)'],
                            ['code' => 'cs', 'name' => 'Czech - (Čeština)'],
                            ['code' => 'da', 'name' => 'Danish - (Dansk)'],
                            ['code' => 'dv', 'name' => 'Dhivehi - (ދިވެހި)'],
                            ['code' => 'nl', 'name' => 'Dutch (Nederlands)'],
                            ['code' => 'dz', 'name' => 'Dzongkha (རྫོང་ཁ)'],
                            ['code' => 'en', 'name' => 'English'],
                            ['code' => 'en-AU', 'name' => 'English (Australia)'],
                            ['code' => 'en-CA', 'name' => 'English (Canada)'],
                            ['code' => 'en-IN', 'name' => 'English (India)'],
                            ['code' => 'en-NZ', 'name' => 'English (New Zealand)'],
                            ['code' => 'en-ZA', 'name' => 'English (South Africa)'],
                            ['code' => 'en-GB', 'name' => 'English (United Kingdom)'],
                            ['code' => 'en-US', 'name' => 'English (United States)'],
                            ['code' => 'eo', 'name' => 'Esperanto'],
                            ['code' => 'et', 'name' => 'Estonian (Eesti)'],
                            ['code' => 'ee', 'name' => 'Ewe (Eʋegbe)'],
                            ['code' => 'fo', 'name' => 'Faroese - (Føroyskt)'],
                            ['code' => 'fil', 'name' => 'Filipino (Wikang Filipino)'],
                            ['code' => 'fi', 'name' => 'Finnish (Suomi)'],
                            ['code' => 'fr', 'name' => 'French (Français)'],
                            ['code' => 'fr-CA', 'name' => 'French Canada - (Français Canada)'],
                            ['code' => 'fr-FR', 'name' => 'French France - (Français France)'],
                            ['code' => 'fr-CH', 'name' => 'French Switzerland - (Français Suisse)'],
                            ['code' => 'gl', 'name' => 'Galician - (Galego)'],
                            ['code' => 'ka', 'name' => 'Georgian - (ქართული)'],
                            ['code' => 'de', 'name' => 'German - (Deutsch)'],
                            ['code' => 'de-AT', 'name' => 'German Austria - (Deutsch Österreich)'],
                            ['code' => 'de-DE', 'name' => 'German Germany - (Deutsch Deutschland)'],
                            ['code' => 'de-LI', 'name' => 'German Liechtenstein - (Deutsch Liechtenstein)'],
                            ['code' => 'de-CH', 'name' => 'German Switzerland - (Deutsch Schweiz)'],
                            ['code' => 'el', 'name' => 'Greek - (Ελληνικά)'],
                            ['code' => 'gn', 'name' => 'Guarani - (Avañe\'ẽ)'],
                            ['code' => 'gu', 'name' => 'Gujarati - (ગુજરાતી)'],
                            ['code' => 'ha', 'name' => 'Hausa - (هَوُسَ)'],
                            ['code' => 'haw', 'name' => 'Hawaiian - (ʻŌlelo Hawaiʻi)'],
                            ['code' => 'he', 'name' => 'Hebrew - (עברית)'],
                            ['code' => 'hi', 'name' => 'Hindi - (हिन्दी)'],
                            ['code' => 'hu', 'name' => 'Hungarian - (Magyar)'],
                            ['code' => 'is', 'name' => 'Icelandic - (Íslenska)'],
                            ['code' => 'id', 'name' => 'Indonesian - (Bahasa Indonesia)'],
                            ['code' => 'ia', 'name' => 'Interlingua'],
                            ['code' => 'iu', 'name' => 'Inuktitut - (ᐃᓄᒃᑎᑐᑦ)'],
                            ['code' => 'ga', 'name' => 'Irish - (Gaeilge)'],
                            ['code' => 'it', 'name' => 'Italian - (Italiano)'],
                            ['code' => 'it-IT', 'name' => 'Italian Italy - (Italiano Italia)'],
                            ['code' => 'it-CH', 'name' => 'Italian Switzerland - (Italiano - Svizzera)'],
                            ['code' => 'ja', 'name' => 'Japanese - (日本語)'],
                            ['code' => 'kl', 'name' => 'Kalaallisut - (Kalaallisut)'],
                            ['code' => 'kn', 'name' => 'Kannada - (ಕನ್ನಡ)'],
                            ['code' => 'ks', 'name' => 'Kashmiri - (कॉशुर / كٲشُر‎)'],
                            ['code' => 'kk', 'name' => 'Kazakh - (Қазақ тілі)'],
                            ['code' => 'km', 'name' => 'Khmer - (ខ្មែរ)'],
                            ['code' => 'rw', 'name' => 'Kinyarwanda - (Ikinyarwanda)'],
                            ['code' => 'ko', 'name' => 'Korean - (한국어)'],
                            ['code' => 'ku', 'name' => 'Kurdish - (Kurdî)'],
                            ['code' => 'ky', 'name' => 'Kyrgyz - (Кыргызча)'],
                            ['code' => 'lo', 'name' => 'Lao - (ລາວ)'],
                            ['code' => 'la', 'name' => 'Latin - (Latina)'],
                            ['code' => 'lv', 'name' => 'Latvian - (Latviešu)'],
                            ['code' => 'ln', 'name' => 'Lingala - (Lingála)'],
                            ['code' => 'lt', 'name' => 'Lithuanian - (Lietuvių)'],
                            ['code' => 'lg', 'name' => 'Luganda - (Luganda)'],
                            ['code' => 'lb', 'name' => 'Luxembourgish - (Lëtzebuergesch)'],
                            ['code' => 'mk', 'name' => 'Macedonian - (Македонски)'],
                            ['code' => 'mai', 'name' => 'Maithili - (मैथिली)'],
                            ['code' => 'ms', 'name' => 'Malay - (Bahasa Melayu)'],
                            ['code' => 'ml', 'name' => 'Malayalam - (മലയാളം)'],
                            ['code' => 'mt', 'name' => 'Maltese - (Malti)'],
                            ['code' => 'mni', 'name' => 'Manipuri - (ꯃꯅꯤꯄꯨꯔꯤ)'],
                            ['code' => 'mr', 'name' => 'Marathi - (मराठी)'],
                            ['code' => 'mn', 'name' => 'Mongolian - (Монгол)'],
                            ['code' => 'ne', 'name' => 'Nepali - (नेपाली)'],
                            ['code' => 'nso', 'name' => 'Northern Sotho - (Sesotho sa Leboa)'],
                            ['code' => 'no', 'name' => 'Norwegian (Norsk)'],
                            ['code' => 'nb', 'name' => 'Norwegian Bokmål - (Norsk bokmål)'],
                            ['code' => 'nn', 'name' => 'Norwegian Nynorsk - (Nynorsk)'],
                            ['code' => 'oc', 'name' => 'Occitan'],
                            ['code' => 'or', 'name' => 'Oriya - (ଓଡ଼ିଆ)'],
                            ['code' => 'om', 'name' => 'Oromo - (Afaan Oromoo)'],
                            ['code' => 'os', 'name' => 'Ossetian - (Ирон æвзаг)'],
                            ['code' => 'ps', 'name' => 'Pashto - (پښتو)'],
                            ['code' => 'fa', 'name' => 'Persian - (فارسی)'],
                            ['code' => 'pl', 'name' => 'Polish - (Polski)'],
                            ['code' => 'pt', 'name' => 'Portuguese - (Português)'],
                            ['code' => 'pt-BR', 'name' => 'Portuguese Brazil - (Português Brasil)'],
                            ['code' => 'pt-PT', 'name' => 'Portuguese Portugal - (Português Portugal)'],
                            ['code' => 'pa', 'name' => 'Punjabi - (ਪੰਜਾਬੀ)'],
                            ['code' => 'qu', 'name' => 'Quechua - (Runa Simi)'],
                            ['code' => 'ro', 'name' => 'Romanian - (Română)'],
                            ['code' => 'mo', 'name' => 'Romanian Moldova - (Română Moldova)'],
                            ['code' => 'rm', 'name' => 'Romansh - (Rumantsch)'],
                            ['code' => 'ru', 'name' => 'Russian - (Русский)'],
                            ['code' => 'sm', 'name' => 'Samoan - (Gagana Samoa)'],
                            ['code' => 'sat', 'name' => 'Santali - (ᱥᱟᱱᱛᱟᱲᱤ)'],
                            ['code' => 'sc', 'name' => 'Sardinian - (Sardu)'],
                            ['code' => 'gd', 'name' => 'Scottish Gaelic - (Gàidhlig)'],
                            ['code' => 'sr', 'name' => 'Serbian - (Српски)'],
                            ['code' => 'sh', 'name' => 'Serbo_Croatian - (Srpskohrvatski)'],
                            ['code' => 'sn', 'name' => 'Shona - (ChiShona)'],
                            ['code' => 'sd', 'name' => 'Sindhi - (سنڌي)'],
                            ['code' => 'si', 'name' => 'Sinhala - (සිංහල)'],
                            ['code' => 'sk', 'name' => 'Slovak - (Slovenčina)'],
                            ['code' => 'sl', 'name' => 'Slovenian - (Slovenščina)'],
                            ['code' => 'so', 'name' => 'Somali - (Soomaali)'],
                            ['code' => 'st', 'name' => 'Southern - Sotho (Sesotho)'],
                            ['code' => 'es', 'name' => 'Spanish - (Español)'],
                            ['code' => 'es-AR', 'name' => 'Spanish Argentina - (Español Argentina)'],
                            ['code' => 'es-419', 'name' => 'Spanish Latin America - (Español Latinoamérica)'],
                            ['code' => 'es-MX', 'name' => 'Spanish Mexico - (Español México)'],
                            ['code' => 'es-ES', 'name' => 'Spanish Spain - (Español España)'],
                            ['code' => 'es-US', 'name' => 'Spanish United States - (Español Estados Unidos)'],
                            ['code' => 'su', 'name' => 'Sundanese - (Basa Sunda)'],
                            ['code' => 'sw', 'name' => 'Swahili - (Kiswahili)'],
                            ['code' => 'sv', 'name' => 'Swedish - (Svenska)'],
                            ['code' => 'tg', 'name' => 'Tajik - (Тоҷикӣ)'],
                            ['code' => 'ta', 'name' => 'Tamil - (தமிழ்)'],
                            ['code' => 'tt', 'name' => 'Tatar - (Татар)'],
                            ['code' => 'te', 'name' => 'Telugu - (తెలుగు)'],
                            ['code' => 'th', 'name' => 'Thai - (ไทย)'],
                            ['code' => 'ti', 'name' => 'Tigrinya - (ትግርኛ)'],
                            ['code' => 'to', 'name' => 'Tongan - (Lea fakatonga)'],
                            ['code' => 'tn', 'name' => 'Tswana - (Setswana)'],
                            ['code' => 'tr', 'name' => 'Turkish - (Türkçe)'],
                            ['code' => 'tk', 'name' => 'Turkmen - (Türkmençe)'],
                            ['code' => 'tw', 'name' => 'Twi - (Twi)'],
                            ['code' => 'udm', 'name' => 'Udmurt - (Удмурт кыл)'],
                            ['code' => 'uk', 'name' => 'Ukrainian - (Українська)'],
                            ['code' => 'ur', 'name' => 'Urdu - (اردو)'],
                            ['code' => 'ug', 'name' => 'Uyghur - (ئۇيغۇرچە)'],
                            ['code' => 'uz', 'name' => 'Uzbek - (O\'zbek)'],
                            ['code' => 've', 'name' => 'Venda - (Tshivenḓa)'],
                            ['code' => 'vi', 'name' => 'Vietnamese - (Tiếng Việt)'],
                            ['code' => 'wa', 'name' => 'Walloon - (Walon)'],
                            ['code' => 'cy', 'name' => 'Welsh - (Cymraeg)'],
                            ['code' => 'fy', 'name' => 'Western Frisian - (Frysk)'],
                            ['code' => 'wo', 'name' => 'Wolof - (Wollof)'],
                            ['code' => 'xh', 'name' => 'Xhosa - (isiXhosa)'],
                            ['code' => 'yi', 'name' => 'Yiddish - (ייִדיש)'],
                            ['code' => 'yo', 'name' => 'Yoruba - (Èdè Yorùbá)'],
                            ['code' => 'za', 'name' => 'Zhuang - (Saɯ cueŋƅ)'],
                            ['code' => 'zu', 'name' => 'Zulu - (isiZulu)']
                        ];
                    @endphp

                    @foreach($languages as $lang)
                        <a href="{{ route('lang.switch', $lang['code']) }}"
                            class="block px-4 py-2 hover:bg-gray-50 text-sm font-medium transition text-gray-700">
                            {{ $lang['name'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</nav>
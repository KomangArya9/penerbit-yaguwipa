<!-- Navbar Sticky -->
<nav x-data="{ isOpen: false }" id="navbar"
    class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-stone-200/80 py-3.5 w-full transition-all duration-300 shadow-[0_1px_3px_rgba(0,0,0,0.02)]">

    <div class="w-full px-4 sm:px-6 lg:px-8 xl:px-10 flex justify-between items-center relative flex-nowrap">

        <!-- Logo (Dinamis dari Pengaturan Admin) -->
        @php
            $settingHeader = App\Models\Pengaturan::first();
            $logoPath = $settingHeader && $settingHeader->header ? asset('storage/' . $settingHeader->header) : asset('images/logo.png');

            $languages = [
        ['code' => 'id', 'name' => 'Indonesian - (Bahasa Indonesia)'],
        ['code' => 'en', 'name' => 'English'],
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
        ['code' => 'gu', 'name' => 'Gujarati - (ગુજરાતી)'],
        ['code' => 'ha', 'name' => 'Hausa - (هَوُسَ)'],
        ['code' => 'haw', 'name' => 'Hawaiian - (ʻŌlelo Hawaiʻi)'],
        ['code' => 'he', 'name' => 'Hebrew - (עברית)'],
        ['code' => 'hi', 'name' => 'Hindi - (हिन्दी)'],
        ['code' => 'hu', 'name' => 'Hungarian - (Magyar)'],
        ['code' => 'is', 'name' => 'Icelandic - (Íslenska)'],
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
        <a href="/" class="flex items-center group shrink-0">
            <img src="{{ $logoPath }}" alt="Logo Yaguwipa" class="h-8 sm:h-9 lg:h-10 w-auto object-contain transition-transform duration-200 group-hover:scale-[1.02]">
        </a>

        <!-- Wrapper Mobile (Language Switcher + Hamburger) -->
        <div class="lg:hidden flex items-center gap-2 sm:gap-3 shrink-0">

            <!-- Language Switcher Mobile -->
            <div x-data="{
                    openLang: false,
                    searchLangMobile: '',
                    currentLang: (typeof getActiveLanguage === 'function') ? getActiveLanguage() : 'ID'
                }"
                x-init="window.addEventListener('site-language-changed', (e) => { currentLang = e.detail; });"
                class="relative">
                <button @click="openLang = !openLang"
                    class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg border border-stone-200 bg-stone-50 text-xs font-semibold text-stone-700 uppercase hover:text-[#B6171E] hover:border-red-200 transition-colors">
                    <svg class="h-3.5 w-3.5 text-stone-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                    </svg>
                    <span x-text="currentLang">ID</span>
                    <svg class="w-3 h-3 text-stone-400 transition-transform duration-200" :class="openLang ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div x-show="openLang" @click.away="openLang = false" x-cloak
                    class="absolute right-0 mt-2 w-60 max-h-[340px] overflow-y-auto bg-white border border-stone-200 shadow-2xl py-2 z-[9999] rounded-2xl scrollbar-thin">

                    <!-- Search Input Mobile -->
                    <div class="px-3 pb-2 pt-1 border-b border-stone-100 sticky top-0 bg-white z-10">
                        <input type="text" x-model="searchLangMobile" placeholder="Cari bahasa..."
                            class="w-full px-2.5 py-1 text-xs border border-stone-200 rounded-lg bg-stone-50 focus:outline-none focus:ring-1 focus:ring-[#B6171E] focus:border-[#B6171E]">
                    </div>

                    @foreach($languages as $lang)
                        <button type="button"
                            x-show="!searchLangMobile || '{{ strtolower($lang['name']) }}'.includes(searchLangMobile.toLowerCase()) || '{{ strtolower($lang['code']) }}'.includes(searchLangMobile.toLowerCase())"
                            @click="changeSiteLanguage('{{ $lang['code'] }}'); openLang = false;"
                            class="w-full text-left flex items-center justify-between px-3.5 py-1.5 hover:bg-red-50 hover:text-[#B6171E] text-xs transition"
                            :class="currentLang === '{{ strtoupper($lang['code']) }}' ? 'bg-red-50 text-[#B6171E] font-semibold' : 'text-stone-700'">
                            <span>{{ $lang['name'] }}</span>
                            <span x-show="currentLang === '{{ strtoupper($lang['code']) }}'" class="text-[#B6171E] font-bold text-xs">✓</span>
                        </button>
                    @endforeach
                </div>
            </div>
            <!-- Tombol Hamburger (Toggle Hamburger & X) -->
            <button @click="isOpen = !isOpen"
                type="button"
                aria-label="Toggle Menu"
                class="p-2 rounded-xl text-stone-700 hover:text-[#B6171E] hover:bg-stone-100 transition-colors focus:outline-none">
                <svg x-show="!isOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg x-show="isOpen" x-cloak class="w-6 h-6 text-[#B6171E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Menu Mobile (Dinamis dari Database - Vertikal List Rapi) -->
        <div x-show="isOpen" x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            @click.away="isOpen = false"
            class="lg:hidden bg-white/98 backdrop-blur-md border-b border-stone-200 shadow-2xl absolute w-full left-0 top-full z-40 max-h-[calc(100vh-70px)] overflow-y-auto">
            <div class="px-5 py-5">
                <nav class="flex flex-col space-y-1">
                    @isset($menus)
                        @foreach($menus as $menu)
                            @php
                                $menuUrl = strtolower($menu->title) === 'home' ? '/' : '/' . ltrim($menu->url, '/');
                                $isActive = request()->is(trim($menuUrl, '/')) || (strtolower($menu->title) === 'home' && request()->is('/'));
                                $hasChildren = $menu->children && $menu->children->count() > 0;
                            @endphp
                            @if($hasChildren)
                                <div x-data="{ openSub: {{ $isActive ? 'true' : 'false' }} }" class="w-full">
                                    <div class="flex items-center justify-between w-full rounded-xl px-3.5 py-2.5 transition-colors {{ $isActive ? 'bg-red-50 text-[#B6171E] font-semibold' : 'text-stone-700 hover:bg-stone-50 hover:text-[#B6171E]' }}">
                                        <a href="{{ $menuUrl }}" @click="isOpen = false"
                                            class="flex-1 font-medium text-sm">
                                            {{ $menu->title }}
                                        </a>
                                        <button @click.stop="openSub = !openSub" type="button" class="p-1.5 -mr-1 text-stone-400 hover:text-[#B6171E] rounded-lg">
                                            <svg class="w-4 h-4 transition-transform duration-200" :class="openSub ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div x-show="openSub" x-cloak class="pl-4 pr-2 mt-1 mb-2 space-y-1 border-l-2 border-red-200 ml-4">
                                        @foreach($menu->children as $child)
                                            @php
                                                $childUrl = '/' . ltrim($child->url, '/');
                                                $childActive = request()->is(trim($childUrl, '/'));
                                            @endphp
                                            <a href="{{ $childUrl }}" @click="isOpen = false"
                                                class="block w-full py-2 px-3 rounded-lg text-xs font-medium transition-colors {{ $childActive ? 'bg-red-50 text-[#B6171E] font-semibold' : 'text-stone-600 hover:bg-stone-50 hover:text-[#B6171E]' }}">
                                                {{ $child->title }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <a href="{{ $menuUrl }}" @click="isOpen = false"
                                    class="block w-full rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors {{ $isActive ? 'bg-red-50 text-[#B6171E] font-semibold border-l-4 border-[#B6171E]' : 'text-stone-700 hover:bg-stone-50 hover:text-[#B6171E]' }}">
                                    {{ $menu->title }}
                                </a>
                            @endif
                        @endforeach
                    @endisset
                </nav>
            </div>
        </div>

        <!-- Menu Desktop (Dinamis dari Database) -->
        <div class="hidden lg:flex items-center gap-3.5 xl:gap-5 2xl:gap-7 text-xs xl:text-sm font-medium text-stone-700 whitespace-nowrap flex-nowrap shrink-0">
            @isset($menus)
                @foreach($menus as $menu)
                    @php
                        $menuUrl = strtolower($menu->title) === 'home' ? '/' : '/' . ltrim($menu->url, '/');
                        $isActive = request()->is(trim($menuUrl, '/')) || (strtolower($menu->title) === 'home' && request()->is('/'));
                        $hasChildren = $menu->children && $menu->children->count() > 0;
                    @endphp
                    @if($hasChildren)
                        <div x-data="{ openDropdown: false }" class="relative shrink-0 whitespace-nowrap" @mouseenter="openDropdown = true" @mouseleave="openDropdown = false">
                            <a href="{{ $menuUrl }}"
                                class="relative py-2 flex items-center gap-1 whitespace-nowrap shrink-0 transition-colors duration-200 {{ $isActive ? 'text-[#B6171E] font-semibold' : 'hover:text-[#B6171E]' }}">
                                {{ $menu->title }}
                                <svg class="w-3.5 h-3.5 text-stone-400 transition-transform duration-200" :class="openDropdown ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                                <span class="absolute left-0 bottom-0 h-0.5 bg-[#B6171E] origin-left transition-all duration-300 ease-out {{ $isActive ? 'w-full' : 'w-0' }}"></span>
                            </a>
                            <div x-show="openDropdown" x-cloak
                                x-transition:enter="transition ease-out duration-150"
                                x-transition:enter-start="opacity-0 translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="absolute left-0 mt-1 w-48 bg-white border border-stone-200 shadow-xl rounded-xl py-2 z-50">
                                @foreach($menu->children as $child)
                                    @php
                                        $childUrl = '/' . ltrim($child->url, '/');
                                    @endphp
                                    <a href="{{ $childUrl }}"
                                        class="block px-4 py-2 text-xs font-medium text-stone-700 hover:bg-stone-50 hover:text-[#B6171E] transition">
                                        {{ $child->title }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ $menuUrl }}"
                            class="relative py-2 whitespace-nowrap shrink-0 transition-colors duration-200 {{ $isActive ? 'text-[#B6171E] font-semibold' : 'hover:text-[#B6171E]' }}">
                            {{ $menu->title }}
                            <span class="absolute left-0 bottom-0 h-0.5 bg-[#B6171E] origin-left transition-all duration-300 ease-out {{ $isActive ? 'w-full' : 'w-0' }}"></span>
                        </a>
                    @endif
                @endforeach
            @endisset
        </div>

        <!-- Right Side (Language Switcher Desktop) -->
        <div class="hidden lg:flex items-center gap-3 xl:gap-6 shrink-0">
            <div x-data="{
                    open: false,
                    searchLang: '',
                    currentLang: (typeof getActiveLanguage === 'function') ? getActiveLanguage() : 'ID'
                }"
                x-init="window.addEventListener('site-language-changed', (e) => { currentLang = e.detail; });"
                class="relative">
                <button @click="open = !open"
                    class="flex items-center gap-2 px-3 py-1.5 rounded-xl border border-stone-200 bg-stone-50/80 text-xs font-semibold text-stone-700 hover:text-[#B6171E] hover:border-red-200 hover:bg-red-50/50 transition-all">
                    <svg class="h-4 w-4 text-stone-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                    </svg>
                    <span class="uppercase font-bold" x-text="currentLang">ID</span>
                    <svg class="h-3.5 w-3.5 text-stone-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown Menu Bahasa -->
                <div x-show="open" @click.away="open = false" x-cloak
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="absolute right-0 mt-2 w-64 max-h-[380px] overflow-y-auto bg-white border border-stone-200 shadow-xl py-2 z-50 rounded-2xl scrollbar-thin">

                    <!-- Search Input Desktop -->
                    <div class="px-3 pb-2 pt-1 border-b border-stone-100 sticky top-0 bg-white z-10">
                        <input type="text" x-model="searchLang" placeholder="Cari bahasa..."
                            class="w-full px-2.5 py-1 text-xs border border-stone-200 rounded-lg bg-stone-50 focus:outline-none focus:ring-1 focus:ring-[#B6171E] focus:border-[#B6171E]">
                    </div>

                    @foreach($languages as $lang)
                        <button type="button"
                            x-show="!searchLang || '{{ strtolower($lang['name']) }}'.includes(searchLang.toLowerCase()) || '{{ strtolower($lang['code']) }}'.includes(searchLang.toLowerCase())"
                            @click="changeSiteLanguage('{{ $lang['code'] }}'); open = false;"
                            class="w-full text-left flex items-center justify-between px-3.5 py-1.5 hover:bg-red-50 hover:text-[#B6171E] text-xs transition"
                            :class="currentLang === '{{ strtoupper($lang['code']) }}' ? 'bg-red-50 text-[#B6171E] font-semibold' : 'text-stone-700'">
                            <span>{{ $lang['name'] }}</span>
                            <span x-show="currentLang === '{{ strtoupper($lang['code']) }}'" class="text-[#B6171E] font-bold text-xs">✓</span>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</nav>

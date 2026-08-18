<nav class="sticky top-0 z-50 bg-white border-b border-slate-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-18 items-center">
            {{-- Logo Shield & Text --}}
            <a href="{{ route('beranda') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('assets/img/logo/logo_banyuwangi.png') }}" alt="Logo Kabupaten Banyuwangi"
                    class="w-9 h-11 object-contain transition-transform duration-300 group-hover:scale-105">
                <div class="flex flex-col leading-tight">
                    <span
                        class="font-display font-black text-[14px] tracking-wider text-slate-900 leading-none">BAKESBANGPOL</span>
                    <span
                        class="font-display font-extrabold text-[11px] tracking-widest text-slate-500 uppercase leading-none mt-1">KABUPATEN
                        BANYUWANGI</span>
                </div>
            </a>

            {{-- Desktop Nav Links --}}
            <div class="hidden lg:flex items-center space-x-7">
                <a href="{{ route('beranda') }}"
                    class="text-[13.5px] font-bold transition-colors duration-300 {{ request()->routeIs('beranda') ? 'text-primary' : 'text-slate-600 hover:text-primary' }}">
                    Beranda
                </a>

                {{-- Dropdown Profil --}}
                <div class="relative group/menu py-4">
                    <a href="{{ route('profil') }}"
                        class="text-[13.5px] font-bold transition-colors duration-300 flex items-center gap-1 {{ request()->routeIs('profil*') ? 'text-primary' : 'text-slate-600 hover:text-primary' }}">
                        <span>Profil</span>
                        <i data-lucide="chevron-down"
                            class="w-3.5 h-3.5 opacity-80 group-hover/menu:rotate-180 transition-transform duration-300"></i>
                    </a>

                    {{-- Dropdown Panel --}}
                    <div
                        class="absolute left-1/2 -translate-x-1/2 top-full pt-2 w-60 opacity-0 invisible group-hover/menu:opacity-100 group-hover/menu:visible transition-all duration-300 z-50">
                        <div
                            class="rounded-2xl bg-white border border-slate-100 shadow-xl py-2.5 transform translate-y-2 group-hover/menu:translate-y-0 transition-transform duration-300">
                            <a href="{{ route('profil.pimpinan') }}"
                                class="group/item flex items-center gap-2.5 px-4 py-2 mx-1.5 rounded-xl text-[13px] font-semibold text-slate-600 hover:bg-slate-50 hover:text-primary transition-all duration-200">
                                <span
                                    class="w-1.5 h-1.5 rounded-full bg-slate-300 group-hover/item:bg-primary transition-colors"></span>
                                Pimpinan
                            </a>
                            <a href="{{ route('profil.struktur') }}"
                                class="group/item flex items-center gap-2.5 px-4 py-2 mx-1.5 rounded-xl text-[13px] font-semibold text-slate-600 hover:bg-slate-50 hover:text-primary transition-all duration-200">
                                <span
                                    class="w-1.5 h-1.5 rounded-full bg-slate-300 group-hover/item:bg-primary transition-colors"></span>
                                Struktur Organisasi
                            </a>
                            <a href="{{ route('profil.visi-misi') }}"
                                class="group/item flex items-center gap-2.5 px-4 py-2 mx-1.5 rounded-xl text-[13px] font-semibold text-slate-600 hover:bg-slate-50 hover:text-primary transition-all duration-200">
                                <span
                                    class="w-1.5 h-1.5 rounded-full bg-slate-300 group-hover/item:bg-primary transition-colors"></span>
                                Visi dan Misi
                            </a>
                            <a href="{{ route('profil.tupoksi') }}"
                                class="group/item flex items-center gap-2.5 px-4 py-2 mx-1.5 rounded-xl text-[13px] font-semibold text-slate-600 hover:bg-slate-50 hover:text-primary transition-all duration-200">
                                <span
                                    class="w-1.5 h-1.5 rounded-full bg-slate-300 group-hover/item:bg-primary transition-colors"></span>
                                Tugas Pokok dan Fungsi
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Dropdown Informasi --}}
                {{-- <div class="relative group/menu">
                    <a href="#"
                        class="text-[13.5px] font-bold text-slate-600 hover:text-primary transition-colors duration-300 flex items-center gap-1">
                        <span>Informasi</span>
                        <i data-lucide="chevron-down"
                            class="w-3.5 h-3.5 opacity-80 group-hover/menu:rotate-180 transition-transform duration-300"></i>
                    </a>
                </div> --}}

                {{-- Dropdown Publikasi --}}
                <div class="relative group/menu">
                    <a href="{{ route('publikasi') }}"
                        class="text-[13.5px] font-bold transition-colors duration-300 {{ request()->routeIs('publikasi*') ? 'text-primary' : 'text-slate-600 hover:text-primary' }}">
                        Publikasi
                    </a>
                </div>

                {{-- Active PPID Link --}}
                <a href="{{ route('dokumen') }}"
                    class="text-[13.5px] font-bold transition-colors duration-300 relative py-1 {{ request()->routeIs('dokumen*') ? 'text-primary' : 'text-slate-600 hover:text-primary' }}">
                    Dokumen PPID
                    @if (request()->routeIs('dokumen*'))
                        <span class="absolute bottom-[-10px] left-0 right-0 h-0.5 bg-primary rounded-full"></span>
                    @endif
                </a>

                {{-- FAQ Link --}}
                <a href="{{ route('faq') }}"
                    class="text-[13.5px] font-bold transition-colors duration-300 relative py-1 {{ request()->routeIs('faq') ? 'text-primary' : 'text-slate-600 hover:text-primary' }}">
                    FAQ
                    @if (request()->routeIs('faq'))
                        <span class="absolute bottom-[-10px] left-0 right-0 h-0.5 bg-primary rounded-full"></span>
                    @endif
                </a>

                <a href="{{ route('kontak') }}"
                    class="text-[13.5px] font-bold transition-colors duration-300 {{ request()->routeIs('kontak') ? 'text-primary' : 'text-slate-600 hover:text-primary' }}">
                    Kontak
                </a>
            </div>

            {{-- Search Box --}}
            <div class="flex items-center gap-3">
                <form action="{{ route('search') }}" method="GET" class="relative hidden lg:block">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari informasi..."
                        class="text-[12px] bg-slate-50 border border-slate-200 rounded-full px-5 py-2.5 pr-12 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-primary/50 focus:ring-2 focus:ring-primary/10 transition-all w-52 outline-none">
                    <button type="submit"
                        class="absolute right-0 top-0 bottom-0 bg-[#0b2447] hover:bg-slate-800 text-white rounded-full px-3.5 flex items-center justify-center transition-colors">
                        <i data-lucide="search" class="w-3.5 h-3.5"></i>
                    </button>
                </form>
                {{-- Mobile menu button --}}
                <button id="mobile-menu-button" onclick="toggleMobileMenu()" class="lg:hidden p-2 text-slate-600 hover:text-slate-900 transition-colors focus:outline-none">
                    <i data-lucide="menu" id="menu-icon" class="w-6 h-6"></i>
                    <i data-lucide="x" id="close-icon" class="w-6 h-6 hidden"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu Container --}}
    <div id="mobile-menu" class="hidden lg:hidden border-t border-slate-100 bg-white px-4 pt-2 pb-6 space-y-3 shadow-inner">
        {{-- Search bar in mobile menu --}}
        <form action="{{ route('search') }}" method="GET" class="relative mt-2">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari informasi..."
                class="text-[14px] bg-slate-50 border border-slate-200 rounded-xl px-5 py-3 pr-12 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-primary/50 focus:ring-2 focus:ring-primary/10 transition-all w-full outline-none">
            <button type="submit"
                class="absolute right-0 top-0 bottom-0 bg-[#0b2447] hover:bg-slate-800 text-white rounded-xl px-4 flex items-center justify-center transition-colors">
                <i data-lucide="search" class="w-4 h-4"></i>
            </button>
        </form>

        {{-- Nav Links --}}
        <div class="flex flex-col space-y-1 pt-2">
            <a href="{{ route('beranda') }}"
                class="block px-3 py-2.5 rounded-xl text-[14px] font-bold transition-all duration-200 {{ request()->routeIs('beranda') ? 'bg-blue-50/50 text-primary' : 'text-slate-600 hover:bg-slate-50' }}">
                Beranda
            </a>

            {{-- Profil (Accordion/Submenu) --}}
            <div>
                <button id="mobile-profil-btn" onclick="toggleMobileProfil()" class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-[14px] font-bold text-slate-600 hover:bg-slate-50 transition-all duration-200 focus:outline-none">
                    <span>Profil</span>
                    <i data-lucide="chevron-down" id="mobile-profil-chevron" class="w-4 h-4 transition-transform duration-300"></i>
                </button>
                <div id="mobile-profil-menu" class="hidden pl-6 pr-2 py-1 space-y-1 bg-slate-50/50 rounded-xl mt-1">
                    <a href="{{ route('profil.pimpinan') }}"
                        class="block px-3 py-2 rounded-lg text-[13px] font-semibold text-slate-600 hover:text-primary transition-colors">
                        Pimpinan
                    </a>
                    <a href="{{ route('profil.struktur') }}"
                        class="block px-3 py-2 rounded-lg text-[13px] font-semibold text-slate-600 hover:text-primary transition-colors">
                        Struktur Organisasi
                    </a>
                    <a href="{{ route('profil.visi-misi') }}"
                        class="block px-3 py-2 rounded-lg text-[13px] font-semibold text-slate-600 hover:text-primary transition-colors">
                        Visi dan Misi
                    </a>
                    <a href="{{ route('profil.tupoksi') }}"
                        class="block px-3 py-2 rounded-lg text-[13px] font-semibold text-slate-600 hover:text-primary transition-colors">
                        Tugas Pokok dan Fungsi
                    </a>
                </div>
            </div>

            <a href="{{ route('publikasi') }}"
                class="block px-3 py-2.5 rounded-xl text-[14px] font-bold transition-all duration-200 {{ request()->routeIs('publikasi*') ? 'bg-blue-50/50 text-primary' : 'text-slate-600 hover:bg-slate-50' }}">
                Publikasi
            </a>

            <a href="{{ route('dokumen') }}"
                class="block px-3 py-2.5 rounded-xl text-[14px] font-bold transition-all duration-200 {{ request()->routeIs('dokumen*') ? 'bg-blue-50/50 text-primary' : 'text-slate-600 hover:bg-slate-50' }}">
                Dokumen PPID
            </a>

            <a href="{{ route('faq') }}"
                class="block px-3 py-2.5 rounded-xl text-[14px] font-bold transition-all duration-200 {{ request()->routeIs('faq') ? 'bg-blue-50/50 text-primary' : 'text-slate-600 hover:bg-slate-50' }}">
                FAQ
            </a>

            <a href="{{ route('kontak') }}"
                class="block px-3 py-2.5 rounded-xl text-[14px] font-bold transition-all duration-200 {{ request()->routeIs('kontak') ? 'bg-blue-50/50 text-primary' : 'text-slate-600 hover:bg-slate-50' }}">
                Kontak
            </a>
        </div>
    </div>
</nav>

<script>
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');
    
    if (mobileMenu) {
        mobileMenu.classList.toggle('hidden');
    }
    
    if (menuIcon && closeIcon) {
        menuIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
    }
}

function toggleMobileProfil() {
    const mobileProfilMenu = document.getElementById('mobile-profil-menu');
    const mobileProfilChevron = document.getElementById('mobile-profil-chevron');
    
    if (mobileProfilMenu) {
        mobileProfilMenu.classList.toggle('hidden');
    }
    if (mobileProfilChevron) {
        mobileProfilChevron.classList.toggle('rotate-180');
    }
}
</script>

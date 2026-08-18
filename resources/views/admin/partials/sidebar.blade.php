<aside class="w-[280px] bg-white/70 backdrop-blur-2xl border-r border-slate-100/50 flex-shrink-0 flex flex-col min-h-screen z-20 shadow-[4px_0_24px_-12px_rgba(0,0,0,0.05)]">
    {{-- Brand --}}
    <div class="px-8 py-8 border-b border-slate-100/50 flex items-center justify-center">
        <a href="{{ route('admin.dashboard') }}" class="text-center block hover:opacity-80 transition-all duration-300 transform hover:scale-105">
            <span class="font-display font-black text-[16px] tracking-tight text-slate-800 uppercase leading-tight block">BAKESBANGPOL</span>
            <span class="font-display font-extrabold text-[15px] tracking-tight text-primary uppercase leading-tight block">BANYUWANGI</span>
        </a>
    </div>

    {{-- User --}}
    <div class="px-8 py-7 border-b border-slate-100/50">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-50 to-primary/10 border border-primary/10 flex items-center justify-center text-primary font-black text-lg flex-shrink-0 shadow-sm">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="min-w-0">
                <p class="font-display font-bold text-slate-800 text-[15px] truncate">{{ Auth::user()->name }}</p>
                <p class="text-slate-400 text-[13px] font-medium">{{ ucfirst(Auth::user()->role) }}</p>
            </div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-5 py-8 space-y-1.5 overflow-y-auto">
        @php
            $links = [
                ['route' => 'admin.dashboard',    'icon' => 'layout-dashboard', 'label' => 'Dashboard'],
            ];

            $bottomLinks = [
                ['route' => 'admin.announcement.index','icon' => 'megaphone',   'label' => 'Bilah Pengumuman'],
                ['route' => 'admin.dokumen.index','icon' => 'file-text',        'label' => 'Dokumen'],
                ['route' => 'admin.halaman.index','icon' => 'book-open',        'label' => 'Halaman'],
                ['route' => 'admin.pimpinan.index','icon' => 'users-round',     'label' => 'Pimpinan'],
                ['route' => 'admin.faq.index',     'icon' => 'help-circle',     'label' => 'FAQ'],
            ];

            $settingLinks = [
                ['route' => 'admin.users.index',   'icon' => 'users',           'label' => 'Kelola Admin'],
                ['route' => 'admin.profile.edit',  'icon' => 'user-cog',        'label' => 'Profil Saya'],
            ];

            $isKabarTerbaruActive = request()->routeIs('admin.berita.*') || request()->routeIs('admin.video.*') || request()->routeIs('admin.pesan.*');
        @endphp

        <div class="text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-4 px-4">Menu Utama</div>

        {{-- Flat Top Links (Dashboard) --}}
        @foreach($links as $link)
            @php
                $active = request()->routeIs($link['route']) || request()->routeIs(str_replace('.index','',$link['route']).'.*');
            @endphp
            <a href="{{ route($link['route']) }}"
               class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-[14px] font-semibold transition-all duration-300 group relative overflow-hidden
                      {{ $active ? 'text-primary bg-blue-50/80 shadow-sm border border-blue-100/50' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                @if($active)
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-primary rounded-r-full"></div>
                @endif
                <i data-lucide="{{ $link['icon'] }}" class="w-5 h-5 transition-transform duration-300 group-hover:scale-110 {{ $active ? 'text-primary' : 'text-slate-400 group-hover:text-slate-500' }}"></i>
                {{ $link['label'] }}
            </a>
        @endforeach

        {{-- Unified Accordion: Kabar Terbaru (Berita, Video, Pesan) --}}
        <details class="group/dropdown" {{ $isKabarTerbaruActive ? 'open' : '' }}>
            <summary class="flex items-center justify-between gap-3.5 px-4 py-3.5 rounded-2xl text-[14px] font-semibold text-slate-500 hover:bg-slate-50 hover:text-slate-800 cursor-pointer list-none [&::-webkit-details-marker]:hidden select-none transition-all duration-300 relative {{ $isKabarTerbaruActive ? 'text-primary bg-blue-50/80 shadow-sm border border-blue-100/50' : '' }}">
                <div class="flex items-center gap-3.5">
                    @if($isKabarTerbaruActive)
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-primary rounded-r-full"></div>
                    @endif
                    <i data-lucide="newspaper" class="w-5 h-5 transition-transform duration-300 group-hover:scale-110 {{ $isKabarTerbaruActive ? 'text-primary' : 'text-slate-400 group-hover:text-slate-500' }}"></i>
                    <span>Kabar Terbaru</span>
                </div>
                <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 group-open/dropdown:rotate-180 transition-transform"></i>
            </summary>
            <div class="mt-1.5 ml-6 pl-3 border-l border-slate-100 space-y-1">
                <a href="{{ route('admin.berita.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] font-semibold transition-all duration-200 {{ request()->routeIs('admin.berita.*') ? 'text-primary bg-blue-50/50 font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                    Berita
                </a>
                <a href="{{ route('admin.video.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] font-semibold transition-all duration-200 {{ request()->routeIs('admin.video.*') ? 'text-primary bg-blue-50/50 font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                    Video
                </a>
                <a href="{{ route('admin.pesan.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13.5px] font-semibold transition-all duration-200 {{ request()->routeIs('admin.pesan.*') ? 'text-primary bg-blue-50/50 font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                    Pesan Terbaru
                </a>
            </div>
        </details>

        {{-- Other Main Links --}}
        @foreach($bottomLinks as $link)
            @php
                $active = request()->routeIs($link['route']) || request()->routeIs(str_replace('.index','',$link['route']).'.*');
            @endphp
            <a href="{{ route($link['route']) }}"
               class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-[14px] font-semibold transition-all duration-300 group relative overflow-hidden
                      {{ $active ? 'text-primary bg-blue-50/80 shadow-sm border border-blue-100/50' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                @if($active)
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-primary rounded-r-full"></div>
                @endif
                <i data-lucide="{{ $link['icon'] }}" class="w-5 h-5 transition-transform duration-300 group-hover:scale-110 {{ $active ? 'text-primary' : 'text-slate-400 group-hover:text-slate-500' }}"></i>
                {{ $link['label'] }}
            </a>
        @endforeach

        {{-- Settings Section --}}
        <div class="text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mt-8 mb-4 px-4">Pengaturan & Admin</div>
        @foreach($settingLinks as $link)
            @php
                $active = request()->routeIs($link['route']) || request()->routeIs(str_replace('.edit','',$link['route']).'.*') || request()->routeIs(str_replace('.index','',$link['route']).'.*');
            @endphp
            <a href="{{ route($link['route']) }}"
               class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-[14px] font-semibold transition-all duration-300 group relative overflow-hidden
                      {{ $active ? 'text-primary bg-blue-50/80 shadow-sm border border-blue-100/50' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                @if($active)
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-primary rounded-r-full"></div>
                @endif
                <i data-lucide="{{ $link['icon'] }}" class="w-5 h-5 transition-transform duration-300 group-hover:scale-110 {{ $active ? 'text-primary' : 'text-slate-400 group-hover:text-slate-500' }}"></i>
                {{ $link['label'] }}
            </a>
        @endforeach
    </nav>

    {{-- Logout --}}
    <div class="px-5 pb-8 pt-6 border-t border-slate-100/50">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit"
                    class="w-full flex items-center justify-center gap-3 px-4 py-3.5 rounded-2xl text-[14px] font-semibold text-slate-500 bg-white border border-slate-200 shadow-sm hover:bg-red-50 hover:text-red-600 hover:border-red-200 hover:shadow-red-500/10 transition-all duration-300 group">
                <i data-lucide="log-out" class="w-5 h-5 text-slate-400 group-hover:text-red-500 transition-transform duration-300 group-hover:-translate-x-1"></i>
                Keluar Aplikasi
            </button>
        </form>
    </div>
</aside>

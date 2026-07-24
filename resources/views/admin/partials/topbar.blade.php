<header class="bg-white/70 backdrop-blur-2xl border-b border-slate-100/50 px-8 py-5 flex items-center justify-between sticky top-0 z-30 shadow-[0_4px_24px_-12px_rgba(0,0,0,0.05)]">
    <div>
        <h1 class="font-display font-bold text-slate-800 text-xl leading-tight tracking-tight">@yield('page-title', 'Dashboard')</h1>
        <div class="flex items-center text-[13px] text-slate-400 mt-1.5 gap-2 font-medium">
            <i data-lucide="home" class="w-3.5 h-3.5"></i>
            <span>@yield('page-subtitle', 'Selamat datang kembali, ' . Auth::user()->name)</span>
        </div>
    </div>
    <div class="flex items-center gap-5">
        <a href="{{ route('beranda') }}" target="_blank"
           class="flex items-center gap-2 text-[13px] font-bold text-slate-500 hover:text-primary bg-white hover:bg-blue-50 px-5 py-2.5 rounded-2xl transition-all duration-300 border border-slate-200 hover:border-blue-200 shadow-sm hover:shadow-md hover:shadow-primary/10 group">
            <i data-lucide="external-link" class="w-4 h-4 group-hover:scale-110 transition-transform duration-300"></i>
            Lihat Website
        </a>
    </div>
</header>

@php
    $halamanRoute = '#';
    if ($item->slug === 'profil') {
        $halamanRoute = route('profil');
    } elseif ($item->slug === 'pimpinan') {
        $halamanRoute = route('profil.pimpinan');
    } elseif ($item->slug === 'struktur-organisasi') {
        $halamanRoute = route('profil.struktur');
    } elseif ($item->slug === 'visi-misi') {
        $halamanRoute = route('profil.visi-misi');
    } elseif ($item->slug === 'tupoksi') {
        $halamanRoute = route('profil.tupoksi');
    } else {
        $halamanRoute = url($item->slug);
    }
@endphp
<div class="flex items-start md:items-center gap-4 bg-white border border-slate-100 rounded-2xl p-5 shadow-sm hover:shadow-md hover:border-primary/20 transition duration-300">
    <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center shrink-0">
        <i data-lucide="layout" class="w-6 h-6"></i>
    </div>
    
    <div class="flex-grow min-w-0">
        <div class="flex flex-wrap items-center gap-2 mb-1.5">
            <span class="px-2.5 py-0.5 text-[9px] font-bold uppercase tracking-wider bg-orange-100 text-orange-700 rounded-md">
                Profil & Halaman
            </span>
        </div>
        <h4 class="font-display font-bold text-slate-900 text-[14.5px] leading-snug mb-1">
            <a href="{{ $halamanRoute }}" class="hover:text-primary transition">{{ $item->judul_halaman }}</a>
        </h4>
        <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
            {{ strip_tags($item->isi_konten) }}
        </p>
    </div>

    <div class="shrink-0 flex items-center gap-2 self-end md:self-center">
        <a href="{{ $halamanRoute }}" 
            class="inline-flex items-center gap-1.5 px-4 py-2 border border-slate-200 hover:border-primary hover:text-primary text-slate-600 text-xs font-bold rounded-xl transition">
            <span>Kunjungi</span>
            <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
        </a>
    </div>
</div>

<div class="flex items-start md:items-center gap-4 bg-white border border-slate-100 rounded-2xl p-5 shadow-sm hover:shadow-md hover:border-primary/20 transition duration-300">
    <div class="w-12 h-12 rounded-xl bg-blue-50 text-primary flex items-center justify-center shrink-0">
        <i data-lucide="file-text" class="w-6 h-6"></i>
    </div>
    
    <div class="flex-grow min-w-0">
        <div class="flex flex-wrap items-center gap-2 mb-1.5">
            <span class="px-2.5 py-0.5 text-[9px] font-bold uppercase tracking-wider bg-slate-100 text-slate-600 rounded-md">
                {{ $item->kategori->nama_kategori }}
            </span>
            <span class="text-[10px] text-slate-400 font-medium">
                Diunggah: {{ $item->tanggal_upload ? \Carbon\Carbon::parse($item->tanggal_upload)->translatedFormat('d M Y') : $item->created_at->translatedFormat('d M Y') }}
            </span>
        </div>
        <h4 class="font-display font-bold text-slate-900 text-[14.5px] leading-snug mb-1 truncate">
            {{ $item->judul }}
        </h4>
        @if($item->deskripsi)
            <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
                {{ $item->deskripsi }}
            </p>
        @endif
    </div>

    <div class="shrink-0 flex items-center gap-2 self-end md:self-center">
        <a href="{{ route('dokumen.unduh', $item->id) }}" 
            class="inline-flex items-center gap-1.5 px-4 py-2 bg-primary hover:bg-[#003670] text-white text-xs font-bold rounded-xl transition shadow-md">
            <i data-lucide="download" class="w-3.5 h-3.5"></i>
            <span class="hidden sm:inline">Unduh</span>
        </a>
    </div>
</div>

<div class="flex flex-col bg-white border border-slate-100 rounded-3xl p-5 shadow-sm hover:shadow-md hover:border-primary/20 transition duration-300">
    <div class="aspect-[4/3] overflow-hidden rounded-2xl mb-4 relative bg-slate-950 group/v">
        @if($item->gambar_cover)
            <img src="{{ asset('storage/' . $item->gambar_cover) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover opacity-80 group-hover/v:opacity-60 transition duration-300">
        @else
            <div class="w-full h-full bg-slate-900 flex items-center justify-center">
                <i data-lucide="video" class="w-12 h-12 text-slate-700"></i>
            </div>
        @endif
        
        {{-- Play Icon Overlay --}}
        <div class="absolute inset-0 flex items-center justify-center">
            <a href="{{ $item->link_video }}" target="_blank" 
                class="w-12 h-12 rounded-full bg-primary/95 text-white flex items-center justify-center shadow-lg hover:scale-110 transition duration-300">
                <i data-lucide="play" class="w-5 h-5 fill-current ml-0.5"></i>
            </a>
        </div>
        
        <div class="absolute top-3 left-3">
            <span class="px-2.5 py-1 text-[9px] font-black uppercase tracking-wider bg-red-600 text-white rounded-full">
                Video Kegiatan
            </span>
        </div>
    </div>
    
    <h4 class="font-display font-extrabold text-slate-900 text-sm leading-snug mb-3 line-clamp-2">
        <a href="{{ $item->link_video }}" target="_blank" class="hover:text-primary transition">{{ $item->judul }}</a>
    </h4>

    <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400 font-medium mt-auto">
        <span>{{ $item->created_at->translatedFormat('d M Y') }}</span>
        <a href="{{ $item->link_video }}" target="_blank" class="font-bold text-primary hover:text-blue-800 transition flex items-center gap-0.5">
            <span>Tonton</span>
            <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
        </a>
    </div>
</div>

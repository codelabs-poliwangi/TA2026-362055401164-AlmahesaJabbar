<div class="flex flex-col bg-white border border-slate-100 rounded-3xl p-5 shadow-sm hover:shadow-md hover:border-primary/20 transition duration-300">
    <div class="aspect-[4/3] overflow-hidden rounded-2xl mb-4 relative bg-slate-50">
        @if($item->gambar)
            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
        @else
            @include('front.partials.img_placeholder')
        @endif
        <div class="absolute top-3 left-3">
            <span class="px-2.5 py-1 text-[9px] font-black uppercase tracking-wider bg-primary/95 text-white rounded-full">
                {{ $item->kategori->nama_kategori }}
            </span>
        </div>
    </div>
    
    <h4 class="font-display font-extrabold text-slate-900 text-sm leading-snug mb-3 line-clamp-2">
        <a href="{{ route('publikasi.show', $item->slug) }}" class="hover:text-primary transition">{{ $item->judul }}</a>
    </h4>
    
    <div class="text-xs text-slate-500 leading-relaxed mb-4 flex-grow line-clamp-3">
        {{ strip_tags($item->isi) }}
    </div>

    <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400 font-medium">
        <span>{{ $item->tanggal_publish ? \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d M Y') : $item->created_at->translatedFormat('d M Y') }}</span>
        <a href="{{ route('publikasi.show', $item->slug) }}" class="font-bold text-primary hover:text-blue-800 transition flex items-center gap-0.5">
            <span>Detail</span>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
        </a>
    </div>
</div>

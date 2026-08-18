@extends('layouts.app')

@section('title', 'Publikasi - Bakesbangpol Kabupaten Banyuwangi')

@section('content')
<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
</style>

{{-- =============================================
     PAGE TITLE BAR
     ============================================= --}}
<div class="bg-white border-b border-slate-200 py-4">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <h1 class="font-display font-bold text-slate-950 text-xl">Publikasi</h1>
    </div>
</div>

{{-- =============================================
     MAIN NEWS SECTION
     ============================================= --}}
<section class="bg-white pt-8 pb-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        {{-- Breadcrumb --}}
        <nav class="text-[13px] text-slate-500 mb-8">
            <a href="{{ route('beranda') }}" class="hover:text-slate-900 transition">Beranda</a>
            <span class="mx-1">/</span>
            <span class="font-medium text-slate-800">Publikasi</span>
        </nav>

        {{-- Section Header --}}
        <div class="mb-8">
            <h2 class="font-display font-bold text-slate-950 text-2xl mb-1">Berita</h2>
            <p class="text-[13px] text-slate-600">Simak Informasi mengenai kegiatan, peristiwa terkini mengenai Kabupaten Banyuwangi</p>
        </div>

        {{-- Search and Filter Form --}}
        <div class="bg-slate-50 border border-slate-100 rounded-3xl p-6 md:p-8 mb-12">
            <form action="{{ route('publikasi') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                {{-- Search Input --}}
                <div class="flex-1 relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul atau isi berita..." class="w-full pl-12 pr-6 py-4 bg-white border border-slate-200 rounded-2xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition shadow-sm font-medium text-slate-800">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                {{-- Category Filter --}}
                <div class="w-full md:w-64 relative">
                    <select name="category" onchange="this.form.submit()" class="w-full pl-6 pr-12 py-4 bg-white border border-slate-200 rounded-2xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition appearance-none cursor-pointer shadow-sm text-slate-700 font-medium">
                        <option value="">Semua Kategori</option>
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->id }}" {{ request('category') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-3">
                    <button type="submit" class="px-8 py-4 bg-primary text-white font-bold rounded-2xl hover:bg-blue-800 transition shadow-lg shadow-primary/20 text-sm flex items-center justify-center gap-2 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Filter
                    </button>
                    @if(request('search') || request('category'))
                        <a href="{{ route('publikasi') }}" class="px-6 py-4 bg-white border border-slate-200 text-slate-600 font-bold rounded-2xl hover:bg-slate-100 transition text-sm flex items-center justify-center gap-2 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Main News Item --}}
        @if($beritaUtama)
        <div class="flex flex-col md:flex-row gap-8 items-start mb-6">
            {{-- Image --}}
            <div class="w-full md:w-[45%] shrink-0">
                <div class="aspect-[4/3] overflow-hidden border border-slate-200 rounded-2xl bg-slate-50 shadow-sm relative group">
                    @if($beritaUtama->gambar)
                        <img src="{{ asset('storage/' . $beritaUtama->gambar) }}" alt="{{ $beritaUtama->judul }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                    @else
                        @include('front.partials.img_placeholder')
                    @endif
                    <div class="absolute top-4 left-4">
                        <span class="px-3.5 py-1.5 text-[10px] font-black uppercase tracking-wider bg-primary text-white rounded-full shadow-md">
                            {{ $beritaUtama->kategori->nama_kategori }}
                        </span>
                    </div>
                </div>
            </div>
            
            {{-- Content --}}
            <div class="w-full md:flex-1 pt-2">
                <h3 class="font-display font-extrabold text-slate-900 text-2xl leading-tight mb-4">
                    <a href="{{ route('publikasi.show', $beritaUtama->slug) }}" class="hover:text-primary transition">{{ $beritaUtama->judul }}</a>
                </h3>
                <div class="text-[14px] text-slate-600 leading-relaxed mb-6 line-clamp-4">
                    <span class="font-bold text-slate-400">
                        {{ $beritaUtama->tanggal_publish ? \Carbon\Carbon::parse($beritaUtama->tanggal_publish)->translatedFormat('d F Y') : $beritaUtama->created_at->translatedFormat('d F Y') }}
                    </span>
                    <span class="mx-1 text-slate-300">•</span>
                    {{ strip_tags($beritaUtama->isi) }}
                </div>
                <a href="{{ route('publikasi.show', $beritaUtama->slug) }}" class="inline-flex items-center gap-1.5 font-bold text-sm text-primary hover:text-blue-800 transition">
                    <span>Baca Selengkapnya</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>
        @else
        <div class="bg-slate-50 border border-slate-100 rounded-3xl p-16 text-center shadow-sm">
            <div class="w-16 h-16 bg-white border border-slate-200 rounded-2xl flex items-center justify-center mx-auto mb-4 text-slate-400 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <h4 class="font-display font-extrabold text-slate-800 text-base mb-1">Berita Tidak Ditemukan</h4>
            <p class="text-xs text-slate-500">Coba gunakan kata kunci pencarian lain atau ubah kategori pilihan Anda.</p>
        </div>
        @endif

    </div>
</section>

{{-- =============================================
     OTHER NEWS CAROUSEL SECTION
     ============================================= --}}
<section class="bg-slate-50 border-t border-slate-100 py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="mb-10 flex items-center justify-between">
            <div>
                <h3 class="font-display font-extrabold text-slate-900 text-2xl">Berita Lainnya</h3>
                <p class="text-xs text-slate-500 mt-1">Jelajahi informasi menarik dan peristiwa terkini lainnya</p>
            </div>
            
            {{-- Carousel Nav Buttons Header --}}
            @if($beritaLainnya && $beritaLainnya->count() > 0)
            <div class="flex gap-2">
                <button id="prev-btn" class="w-10 h-10 rounded-xl bg-white border border-slate-200 shadow-sm text-slate-600 hover:bg-primary hover:text-white hover:border-primary transition flex items-center justify-center focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="next-btn" class="w-10 h-10 rounded-xl bg-white border border-slate-200 shadow-sm text-slate-600 hover:bg-primary hover:text-white hover:border-primary transition flex items-center justify-center focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            @endif
        </div>

        @if($beritaLainnya && $beritaLainnya->count() > 0)
            <div class="relative overflow-hidden">
                <!-- Carousel Wrapper -->
                <div id="berita-carousel" class="flex overflow-x-auto gap-6 scroll-smooth snap-x snap-mandatory no-scrollbar pb-4">
                    @foreach($beritaLainnya as $berita)
                    <div class="w-[85vw] sm:w-[45vw] md:w-[30vw] lg:w-[23.5vw] shrink-0 snap-start flex flex-col bg-white border border-slate-100 rounded-3xl p-5 shadow-sm hover:shadow-md hover:border-primary/20 transition duration-300">
                        <div class="aspect-[4/3] overflow-hidden rounded-2xl mb-4 relative bg-slate-50">
                            @if($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover">
                            @else
                                @include('front.partials.img_placeholder')
                            @endif
                            <div class="absolute top-3 left-3">
                                <span class="px-2.5 py-1 text-[9px] font-black uppercase tracking-wider bg-primary/95 text-white rounded-full">
                                    {{ $berita->kategori->nama_kategori }}
                                </span>
                            </div>
                        </div>
                        
                        <h4 class="font-display font-extrabold text-slate-900 text-sm leading-snug mb-3 line-clamp-2">
                            <a href="{{ route('publikasi.show', $berita->slug) }}" class="hover:text-primary transition">{{ $berita->judul }}</a>
                        </h4>
                        
                        <div class="text-xs text-slate-500 leading-relaxed mb-4 flex-grow line-clamp-3">
                            {{ strip_tags($berita->isi) }}
                        </div>
                        
                        <div class="pt-4 border-t border-slate-50 flex items-center justify-between mt-auto">
                            <span class="text-[10px] font-bold text-slate-400">
                                {{ $berita->tanggal_publish ? \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('d M Y') : $berita->created_at->translatedFormat('d M Y') }}
                            </span>
                            <a href="{{ route('publikasi.show', $berita->slug) }}" class="inline-flex items-center gap-1 text-[11px] font-black text-primary hover:text-blue-800 transition">
                                <span>Selengkapnya</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="bg-white border border-slate-100 rounded-3xl p-12 text-center shadow-sm">
                <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4 text-slate-400 border border-slate-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4a2 2 0 00-2-2m2 2a2 2 0 11-4 0M2 9h4m4 0h1m-7 4h12m-3 4h3" />
                    </svg>
                </div>
                <h4 class="font-display font-bold text-slate-800 text-base mb-1">Belum Ada Berita Lainnya</h4>
                <p class="text-xs text-slate-500">Tidak ada berita tambahan yang cocok dengan kriteria pencarian Anda.</p>
            </div>
        @endif

    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.getElementById('berita-carousel');
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');

        if (carousel && prevBtn && nextBtn) {
            nextBtn.addEventListener('click', () => {
                const itemWidth = carousel.firstElementChild.clientWidth;
                carousel.scrollBy({ left: itemWidth + 24, behavior: 'smooth' });
            });
            prevBtn.addEventListener('click', () => {
                const itemWidth = carousel.firstElementChild.clientWidth;
                carousel.scrollBy({ left: -(itemWidth + 24), behavior: 'smooth' });
            });
            
            const toggleButtons = () => {
                const scrollLeft = carousel.scrollLeft;
                const maxScroll = carousel.scrollWidth - carousel.clientWidth;
                
                if (scrollLeft <= 5) {
                    prevBtn.classList.add('pointer-events-none', 'opacity-30');
                } else {
                    prevBtn.classList.remove('pointer-events-none', 'opacity-30');
                }
                
                if (scrollLeft >= maxScroll - 5) {
                    nextBtn.classList.add('pointer-events-none', 'opacity-30');
                } else {
                    nextBtn.classList.remove('pointer-events-none', 'opacity-30');
                }
            };
            
            carousel.addEventListener('scroll', toggleButtons);
            window.addEventListener('resize', toggleButtons);
            setTimeout(toggleButtons, 100);
        }
    });
</script>
@endpush

@endsection

@extends('layouts.app')

@section('title', 'Publikasi - Bakesbangpol Kabupaten Banyuwangi')

@section('content')

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
        <div class="mb-6">
            <h2 class="font-display font-bold text-slate-950 text-2xl mb-1">Berita</h2>
            <p class="text-[13px] text-slate-600">Simak Informasi mengenai kegiatan, peristiwa terkini mengenai Kabupaten Banyuwangi</p>
        </div>

        {{-- Main News Item --}}
        @if($beritaUtama)
        <div class="flex flex-col md:flex-row gap-8 items-start mb-10">
            {{-- Image --}}
            <div class="w-full md:w-[45%] shrink-0">
                <div class="aspect-[4/3] overflow-hidden border border-slate-300 rounded-sm">
                    @if($beritaUtama->gambar)
                        <img src="{{ asset('storage/' . $beritaUtama->gambar) }}" alt="{{ $beritaUtama->judul }}" class="w-full h-full object-cover">
                    @else
                        @include('front.partials.img_placeholder')
                    @endif
                </div>
            </div>
            
            {{-- Content --}}
            <div class="w-full md:flex-1 pt-2">
                <h3 class="font-display font-bold text-slate-950 text-2xl leading-tight mb-4">
                    <a href="{{ route('publikasi.show', $beritaUtama->slug) }}" class="hover:text-primary transition">{{ $beritaUtama->judul }}</a>
                </h3>
                <div class="text-[14px] text-slate-700 leading-relaxed mb-4 line-clamp-4">
                    <span class="font-medium text-slate-600">
                        {{ $beritaUtama->tanggal_publish ? \Carbon\Carbon::parse($beritaUtama->tanggal_publish)->translatedFormat('d F Y') : $beritaUtama->created_at->translatedFormat('d F Y') }} - 
                    </span>
                    {{ strip_tags($beritaUtama->isi) }}
                </div>
                <a href="{{ route('publikasi.show', $beritaUtama->slug) }}" class="font-bold text-[14px] text-slate-950 hover:underline">Baca Selengkapnya</a>
            </div>
        </div>
        @else
        <div class="flex flex-col md:flex-row gap-8 items-start mb-10">
            <div class="w-full md:w-[45%] shrink-0">
                <div class="aspect-[4/3] overflow-hidden border border-slate-300 rounded-sm">
                    @include('front.partials.img_placeholder')
                </div>
            </div>
            <div class="w-full md:flex-1 pt-2">
                <h3 class="font-display font-bold text-slate-950 text-2xl leading-tight mb-4">
                    <a href="#" class="hover:text-primary transition">Hari Kartini, Bupati Ipuk Gelar "Rembug Perempuan" Serap Aspirasi untuk Kebijakan Pembangunan</a>
                </h3>
                <div class="text-[14px] text-slate-700 leading-relaxed mb-4 line-clamp-4">
                    <span class="font-medium text-slate-600">
                        KabarBanyuwangi.co.id - Peringatan Hari Kartini tiap 21 April, dimanfaatkan Bupati Banyuwangi Ipuk Fiestiandani memperkuat partisipasi perempuan dalam pembangunan daerah.
                    </span><br><br>
                    Salah satunya dengan menggelar "Rembug Perempuan" yang merupakan forum menyerap aspirasi untuk merancang kebijakan pembangunan.....
                </div>
                <a href="#" class="font-bold text-[14px] text-slate-950 hover:underline">Baca Selengkapnya</a>
            </div>
        </div>
        @endif

    </div>
</section>

{{-- =============================================
     OTHER NEWS GRID SECTION
     ============================================= --}}
<section class="bg-[#e5e7eb] py-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @if($beritaLainnya && $beritaLainnya->count() > 0)
                @foreach($beritaLainnya as $berita)
                <div class="flex flex-col">
                    <div class="aspect-[4/3] overflow-hidden border border-slate-300 rounded-sm mb-4">
                        @if($berita->gambar)
                            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover">
                        @else
                            @include('front.partials.img_placeholder')
                        @endif
                    </div>
                    
                    <h4 class="font-display font-bold text-slate-950 text-[15px] leading-snug mb-3 line-clamp-3">
                        <a href="{{ route('publikasi.show', $berita->slug) }}" class="hover:text-primary transition">{{ $berita->judul }}</a>
                    </h4>
                    
                    <div class="text-[13px] text-slate-700 leading-relaxed mb-1 flex-grow">
                        <span class="line-clamp-3 inline">{{ strip_tags($berita->isi) }}</span>
                        <a href="{{ route('publikasi.show', $berita->slug) }}" class="font-bold text-slate-950 hover:underline inline">Baca Selengkapnya</a>
                    </div>
                    
                    <div class="text-[12px] text-slate-600 mt-2">
                        {{ $berita->tanggal_publish ? \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('d F Y H:i') : $berita->created_at->translatedFormat('d F Y H:i') }}
                    </div>
                </div>
                @endforeach
            @else
                @for($i = 0; $i < 3; $i++)
                <div class="flex flex-col">
                    <div class="aspect-[4/3] overflow-hidden border border-slate-300 rounded-sm mb-4">
                        @include('front.partials.img_placeholder')
                    </div>
                    <h4 class="font-display font-bold text-slate-950 text-[15px] leading-snug mb-3 line-clamp-3">
                        <a href="#" class="hover:text-primary transition">Hari Kartini, Bupati Ipuk Gelar "Rembug Perempuan" Serap Aspirasi untuk Kebijakan Pembangunan</a>
                    </h4>
                    <div class="text-[13px] text-slate-700 leading-relaxed mb-1 flex-grow">
                        <span class="line-clamp-3 inline">KabarBanyuwangi.co.id – Peringatan Hari Kartini tiap 21 April, dimanfaatkan Bupati Banyuwangi Ipuk Fiestiandani memperkuat.....</span>
                        <a href="#" class="font-bold text-slate-950 hover:underline inline">Baca Selengkapnya</a>
                    </div>
                    <div class="text-[12px] text-slate-600 mt-2">
                        21 April 2026 12:00
                    </div>
                </div>
                @endfor
            @endif
        </div>

    </div>
</section>

{{-- =============================================
     PENGUMUMAN SECTION
     ============================================= --}}
<section class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        @if($pengumuman)
        <div class="flex flex-col md:flex-row gap-8 items-start">
            <div class="w-full md:w-1/3 shrink-0">
                <div class="aspect-[4/3] overflow-hidden border border-slate-300 rounded-sm">
                    @if($pengumuman->gambar)
                        <img src="{{ asset('storage/' . $pengumuman->gambar) }}" alt="{{ $pengumuman->judul }}" class="w-full h-full object-cover">
                    @else
                        @include('front.partials.img_placeholder')
                    @endif
                </div>
            </div>
            
            <div class="w-full md:flex-1 pt-1">
                <h2 class="font-display font-bold text-slate-950 text-2xl mb-2">Pengumuman</h2>
                <h3 class="font-display font-bold text-slate-800 text-[15px] mb-3">{{ $pengumuman->judul }}</h3>
                
                <div class="text-[14px] text-slate-700 leading-relaxed mb-2 line-clamp-3">
                    {{ strip_tags($pengumuman->isi) }}
                </div>
                <a href="{{ route('publikasi.show', $pengumuman->slug) }}" class="font-bold text-[14px] text-slate-950 hover:underline inline-block mb-3">Baca Selengkapnya</a>
                
                <div class="text-[12px] text-slate-600 mb-6">
                    {{ $pengumuman->tanggal_publish ? \Carbon\Carbon::parse($pengumuman->tanggal_publish)->translatedFormat('d F Y H:i') : $pengumuman->created_at->translatedFormat('d F Y H:i') }}
                </div>
                
                <a href="{{ route('publikasi.show', $pengumuman->slug) }}" class="inline-block px-5 py-2 bg-[#cfd1d4] border border-slate-900 text-slate-900 text-[13px] font-bold hover:bg-slate-400 transition">
                    Pelajari lebih lanjut
                </a>
            </div>
        </div>
        @else
        <div class="flex flex-col md:flex-row gap-8 items-start">
            <div class="w-full md:w-1/3 shrink-0">
                <div class="aspect-[4/3] overflow-hidden border border-slate-300 rounded-sm">
                    @include('front.partials.img_placeholder')
                </div>
            </div>
            <div class="w-full md:flex-1 pt-1">
                <h2 class="font-display font-bold text-slate-950 text-2xl mb-2">Pengumuman</h2>
                <h3 class="font-display font-bold text-slate-800 text-[15px] mb-3">Pengumuman Tahap Seleksi Paskibra Kabupaten Banyuwangi</h3>
                
                <div class="text-[14px] text-slate-700 leading-relaxed mb-2 line-clamp-3">
                    KabarBanyuwangi.co.id - Peringatan Hari Kartini tiap 21 April, dimanfaatkan Bupati Banyuwangi Ipuk Fiestiandani memperkuat.....
                </div>
                <a href="#" class="font-bold text-[14px] text-slate-950 hover:underline inline-block mb-3">Baca Selengkapnya</a>
                
                <div class="text-[12px] text-slate-600 mb-6">
                    21 April 2026 12:00
                </div>
                
                <a href="#" class="inline-block px-5 py-2 bg-[#cfd1d4] border border-slate-900 text-slate-900 text-[13px] font-bold hover:bg-slate-400 transition">
                    Pelajari lebih lanjut
                </a>
            </div>
        </div>
        @endif
    </div>
</section>

@endsection

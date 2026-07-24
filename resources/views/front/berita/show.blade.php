@extends('layouts.app')

@section('title', $berita->judul . ' - Bakesbangpol Kabupaten Banyuwangi')

@section('content')
<!-- Article Header -->
<section class="pt-32 pb-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex text-slate-400 text-xs font-bold uppercase tracking-widest mb-8">
            <a href="{{ route('beranda') }}" class="hover:text-primary">Beranda</a>
            <span class="mx-3">/</span>
            <a href="{{ route('publikasi') }}" class="hover:text-primary">Publikasi</a>
            <span class="mx-3">/</span>
            <span class="text-secondary">{{ $berita->kategori->nama_kategori }}</span>
        </nav>
        
        <h1 class="text-3xl md:text-5xl font-display font-extrabold text-slate-900 mb-8 leading-tight">
            {{ $berita->judul }}
        </h1>
        
        <div class="flex flex-wrap items-center gap-6 pb-12 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center text-primary font-bold text-sm">
                    {{ strtoupper(substr($berita->author->name ?? 'A', 0, 1)) }}
                </div>
                <div>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mb-0.5">Penulis</p>
                    <p class="text-sm font-bold text-slate-900">{{ $berita->author->name ?? 'Administrator' }}</p>
                </div>
            </div>
            <div class="h-10 w-px bg-slate-100 hidden sm:block"></div>
            <div>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mb-0.5">Diterbitkan</p>
                <p class="text-sm font-bold text-slate-900">{{ $berita->tanggal_publish ? \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('d M Y') : $berita->created_at->translatedFormat('d M Y') }}</p>
            </div>
            <div class="ml-auto flex items-center gap-3">
                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Share:</p>
                <div class="flex gap-2">
                    <a href="#" class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-primary hover:text-white transition"><i data-lucide="facebook" class="w-4 h-4"></i></a>
                    <a href="#" class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-primary hover:text-white transition"><i data-lucide="twitter" class="w-4 h-4"></i></a>
                    <a href="#" class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-primary hover:text-white transition"><i data-lucide="link" class="w-4 h-4"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Article Content -->
<section class="pb-24 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($berita->gambar)
            <div class="mb-16 rounded-3xl overflow-hidden shadow-2xl">
                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full object-cover">
            </div>
        @endif
        
        <div class="prose prose-blue prose-lg max-w-none text-slate-600 leading-relaxed">
            {!! $berita->isi !!}
        </div>
        
        <!-- Related News -->
        <div class="mt-24 pt-24 border-t border-slate-100">
            <h3 class="text-2xl font-display font-extrabold text-slate-900 mb-12">Berita Terkait</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($beritaLainnya as $item)
                <div class="group">
                    <div class="aspect-square rounded-2xl overflow-hidden mb-6">
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-slate-100"></div>
                        @endif
                    </div>
                    <p class="text-[10px] text-primary font-bold uppercase tracking-widest mb-2">{{ $item->kategori->nama_kategori }}</p>
                    <h4 class="text-base font-display font-bold text-slate-900 leading-snug group-hover:text-primary transition-colors">
                        <a href="{{ route('publikasi.show', $item->slug) }}">{{ $item->judul }}</a>
                    </h4>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection

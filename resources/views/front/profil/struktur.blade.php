@extends('layouts.app')
@section('title', 'Struktur Organisasi - Bakesbangpol Kabupaten Banyuwangi')

@section('content')
<style>
    .bg-grid-pattern {
        background-size: 20px 20px;
        background-image: 
            linear-gradient(to right, rgba(148, 163, 184, 0.05) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(148, 163, 184, 0.05) 1px, transparent 1px);
    }
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(148, 163, 184, 0.2);
        border-radius: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(148, 163, 184, 0.4);
    }
</style>
<section class="pt-32 pb-20 bg-slate-900 relative overflow-hidden">
    <div class="absolute inset-0 bg-primary/20 z-0"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-display font-extrabold text-white mb-4">Struktur Organisasi</h1>
        <nav class="flex justify-center text-slate-400 text-sm font-medium">
            <a href="{{ route('beranda') }}" class="hover:text-white">Beranda</a>
            <span class="mx-3">/</span>
            <a href="{{ route('profil') }}" class="hover:text-white">Profil</a>
            <span class="mx-3">/</span>
            <span class="text-secondary">Struktur Organisasi</span>
        </nav>
    </div>
</section>

<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-16">
            <div class="w-full lg:w-1/4">
                @include('front.profil._sidebar')
            </div>
            <div class="w-full lg:w-3/4 text-slate-600 leading-relaxed">
                <h2 class="text-3xl font-display font-extrabold text-slate-900 mb-8 border-b border-slate-100 pb-4">
                    {{ $halaman->judul_halaman ?? 'Struktur Organisasi' }}
                </h2>

                @if($halaman && $halaman->gambar)
                    <!-- Bagan Struktur Organisasi Visual (Gambar Uploaded) -->
                    <div class="mb-16 bg-white border border-slate-100 rounded-3xl p-6 shadow-sm relative overflow-hidden group">
                        <div class="w-full rounded-2xl overflow-hidden bg-slate-50 border border-slate-100 relative group-hover:shadow-md transition-shadow duration-300">
                            <img src="{{ asset('storage/' . $halaman->gambar) }}" alt="{{ $halaman->judul_halaman }}" class="w-full h-auto max-h-[600px] object-contain mx-auto transition-transform duration-500 group-hover:scale-[1.01]">
                        </div>
                        <div class="mt-4 text-center">
                            <p class="text-xs text-slate-400 font-sans italic">*Bagan resmi Struktur Organisasi Bakesbangpol Kabupaten Banyuwangi</p>
                        </div>
                    </div>
                @endif

                <!-- Konten Teks Tambahan (Deskripsi dari Database) -->
                @if($halaman && !empty(trim(strip_tags($halaman->isi_konten))))
                    <div class="prose prose-blue max-w-none text-slate-600 leading-relaxed border-t border-slate-100 pt-10">
                        {!! $halaman->isi_konten !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

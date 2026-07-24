@extends('layouts.app')
@section('title', 'Tugas Pokok & Fungsi - Bakesbangpol Kabupaten Banyuwangi')

@section('content')
<section class="pt-32 pb-20 bg-slate-900 relative overflow-hidden">
    <div class="absolute inset-0 bg-primary/20 z-0"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-display font-extrabold text-white mb-4">Tugas Pokok & Fungsi</h1>
        <nav class="flex justify-center text-slate-400 text-sm font-medium">
            <a href="{{ route('beranda') }}" class="hover:text-white">Beranda</a>
            <span class="mx-3">/</span>
            <a href="{{ route('profil') }}" class="hover:text-white">Profil</a>
            <span class="mx-3">/</span>
            <span class="text-secondary">Tupoksi</span>
        </nav>
    </div>
</section>

<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-16">
            <div class="w-full lg:w-1/4">
                @include('front.profil._sidebar')
            </div>
            <div class="w-full lg:w-3/4 prose prose-blue max-w-none text-slate-600 leading-relaxed">
                <h2 class="text-3xl font-display font-extrabold text-slate-900 mb-8 border-b border-slate-100 pb-4">
                    {{ $halaman->judul_halaman ?? 'Tugas Pokok dan Fungsi' }}
                </h2>
                @if($halaman)
                    {!! $halaman->isi_konten !!}
                @else
                    <div class="py-12 bg-slate-50 rounded-2xl text-center text-slate-400 italic not-prose">Konten belum tersedia.</div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

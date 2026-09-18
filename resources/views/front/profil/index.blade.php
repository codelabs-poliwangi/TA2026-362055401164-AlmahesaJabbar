@extends('layouts.app')

@section('title', 'Profil - Bakesbangpol Kabupaten Banyuwangi')

@section('content')

    {{-- =============================================
     PAGE TITLE BAR
     ============================================= --}}
    <div class="bg-white border-b border-slate-200 py-4">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <h1 class="font-display font-bold text-slate-950 text-xl">Profil</h1>
        </div>
    </div>

    {{-- =============================================
     HERO / BANNER SECTION
     ============================================= --}}
    <section class="bg-slate-100 py-10">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <nav class="text-[13px] text-slate-500 mb-6">
                <a href="{{ route('beranda') }}" class="hover:text-slate-900 transition">Beranda</a>
                <span class="mx-1">/</span>
                <span class="font-medium text-slate-800">Profil</span>
            </nav>

            {{-- Content row: image left, text right --}}
            <div class="flex flex-col lg:flex-row items-start gap-10">

                {{-- Left: Image --}}
                <div class="w-full lg:w-[35%] shrink-0">
                    <div class="aspect-square overflow-hidden border border-slate-300 rounded-sm">
                        <img src="{{ asset('assets/img/hero-section.png') }}" alt="Profil Bakesbangpol"
                            class="w-full h-full object-cover">
                    </div>
                </div>

                {{-- Right: Text --}}
                <div class="w-full lg:flex-1 pt-2">
                    <h2 class="font-display font-bold text-slate-950 leading-snug mb-4"
                        style="font-size: clamp(1.5rem, 3vw, 2.25rem);">
                        {{ $halaman->judul_halaman ?? 'Badan Kesatuan Bangsa dan Politik Kabupaten Banyuwangi' }}
                    </h2>
                    @if ($halaman && $halaman->isi_konten && strlen(strip_tags($halaman->isi_konten)) > 20)
                        <div class="text-[14px] text-slate-700 leading-relaxed prose prose-slate max-w-none">
                            {!! $halaman->isi_konten !!}
                        </div>
                    @else
                        <p class="text-[14px] text-slate-700 leading-relaxed">
                            Bakesbangpol Kabupaten Banyuwangi berperan penting dalam menjaga stabilitas politik, keamanan,
                            dan kerukunan warga untuk mendukung pembangunan daerah.
                        </p>
                    @endif
                </div>

            </div>
        </div>
    </section>

    {{-- =============================================
     PERANAN KAMI SECTION
     ============================================= --}}
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            {{-- Section Header --}}
            <h2 class="font-display font-bold text-primary text-2xl mb-2">Peranan Kami</h2>
            <p class="text-[13px] text-slate-700 mb-8 max-w-2xl leading-relaxed">
                Bersama dengan kami, Bakesbangpol Banyuwangi, wujudkan masyarakat yang cerdas berpolitik, waspada terhadap
                konflik, dan bersinergi membangun daerah yang aman, damai, serta kondusif.
            </p>

            {{-- 2×2 Card Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <a href="{{ route('profil.pimpinan') }}"
                    class="border border-slate-300 rounded-sm overflow-hidden hover:border-primary hover:shadow-md transition-all group">
                    <div class="aspect-video overflow-hidden">
                        <img src="{{ asset('assets/img/profil/pimpinan.webp') }}"
                            alt="Pimpinan" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="px-4 py-3 border-t border-slate-200 bg-white">
                        <span class="font-display font-bold text-slate-900 text-[14px]">Pimpinan</span>
                    </div>
                </a>

                {{-- Card: Struktur Organisasi --}}
                <a href="{{ route('profil.struktur') }}"
                    class="border border-slate-300 rounded-sm overflow-hidden hover:border-primary hover:shadow-md transition-all group">
                    <div class="aspect-video overflow-hidden">
                        <img src="{{ asset('assets/img/profil/struktur.webp') }}"
                            alt="Struktur Organisasi"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="px-4 py-3 border-t border-slate-200 bg-white">
                        <span class="font-display font-bold text-slate-900 text-[14px]">Struktur Organisasi</span>
                    </div>
                </a>

                {{-- Card: Visi dan Misi --}}
                <a href="{{ route('profil.visi-misi') }}"
                    class="border border-slate-300 rounded-sm overflow-hidden hover:border-primary hover:shadow-md transition-all group">
                    <div class="aspect-video overflow-hidden">
                        <img src="{{ asset('assets/img/profil/visi-misi.webp') }}"
                            alt="Visi dan Misi"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="px-4 py-3 border-t border-slate-200 bg-white">
                        <span class="font-display font-bold text-slate-900 text-[14px]">Visi dan Misi</span>
                    </div>
                </a>

                {{-- Card: Tugas Pokok dan Fungsi --}}
                <a href="{{ route('profil.tupoksi') }}"
                    class="border border-slate-300 rounded-sm overflow-hidden hover:border-primary hover:shadow-md transition-all group">
                    <div class="aspect-video overflow-hidden">
                        <img src="{{ asset('assets/img/profil/tupoksi.webp') }}"
                            alt="Tugas Pokok dan Fungsi"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="px-4 py-3 border-t border-slate-200 bg-white">
                        <span class="font-display font-bold text-slate-900 text-[14px]">Tugas Pokok dan Fungsi</span>
                    </div>
                </a>

            </div>
        </div>
    </section>

@endsection

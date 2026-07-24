@extends('layouts.app')

@section('title', 'Daftar Pimpinan - Bakesbangpol Kabupaten Banyuwangi')

@section('content')
<!-- Page Header -->
<section class="pt-32 pb-20 bg-slate-900 relative overflow-hidden">
    <div class="absolute inset-0 bg-primary/20 z-0"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-display font-extrabold text-white mb-4">Pimpinan</h1>
        <nav class="flex justify-center text-slate-400 text-sm font-medium">
            <a href="{{ route('beranda') }}" class="hover:text-white transition-colors">Beranda</a>
            <span class="mx-3">/</span>
            <a href="{{ route('profil') }}" class="hover:text-white transition-colors">Profil</a>
            <span class="mx-3">/</span>
            <span class="text-secondary font-bold">Pimpinan</span>
        </nav>
    </div>
</section>

<!-- Content Section -->
<section class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($pimpinanList->isNotEmpty())
        <div class="flex flex-col lg:flex-row gap-16">
            <!-- Sidebar -->
            <div class="w-full lg:w-1/4">
                <div class="bg-slate-50 rounded-3xl p-6 border border-slate-100/80 sticky top-28 shadow-sm">
                    <h3 class="font-display font-black text-slate-900 mb-6 text-lg border-b border-slate-200/50 pb-3 flex items-center gap-2">
                        <i data-lucide="users-round" class="w-5 h-5 text-primary"></i>
                        Daftar Pimpinan
                    </h3>
                    <div class="space-y-2" id="tab-buttons-container">
                        @foreach($pimpinanList as $p)
                        <button data-target="pimpinan-{{ $p->id }}" 
                                class="tab-btn w-full text-left block px-5 py-4 rounded-2xl text-[14px] font-extrabold transition-all duration-300 border
                                       {{ $loop->first 
                                          ? 'bg-primary text-white border-primary shadow-xl shadow-primary/20 scale-[1.02]' 
                                          : 'text-slate-600 bg-white hover:bg-slate-100/50 hover:text-slate-900 border-slate-100 hover:border-slate-200' }}">
                            {{ $p->jabatan }}
                        </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Main Content (Dynamic Tab Panels) -->
            <div class="w-full lg:w-3/4">
                <div class="bg-white">
                    @foreach($pimpinanList as $p)
                    <div id="pimpinan-{{ $p->id }}" 
                         class="tab-content transition-all duration-500 {{ $loop->first ? 'block' : 'hidden opacity-0 translate-y-4' }}">
                        
                        {{-- Header Jabatan & Tupoksi --}}
                        <div class="border-b border-slate-100 pb-6 mb-8">
                            <h2 class="text-3xl font-display font-black text-slate-900 mb-3">{{ $p->jabatan }}</h2>
                            <div class="flex items-start gap-3 text-slate-500 bg-slate-50/50 border border-slate-100 rounded-2xl p-4 italic text-sm font-sans font-medium leading-relaxed">
                                <i data-lucide="info" class="w-5 h-5 text-primary flex-shrink-0 mt-0.5"></i>
                                <div>
                                    <span class="font-bold not-italic text-slate-700 block mb-0.5">Tugas Pokok & Fungsi:</span>
                                    {{ $p->tupoksi_singkat ?? 'Tupoksi belum ditentukan.' }}
                                </div>
                            </div>
                        </div>
                        
                        {{-- Detail Pimpinan --}}
                        <div class="flex flex-col md:flex-row gap-12 items-start">
                            {{-- Foto Profil --}}
                            <div class="w-full md:w-1/3">
                                <div class="aspect-[3/4] bg-slate-100 rounded-3xl overflow-hidden shadow-xl border-4 border-white relative group">
                                    @if($p->foto)
                                        <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->nama }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-slate-200">
                                            <i data-lucide="user" class="w-16 h-16 text-slate-400"></i>
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent opacity-80"></div>
                                </div>
                            </div>
                            
                            {{-- Biodata & Keterangan --}}
                            <div class="w-full md:w-2/3">
                                <h3 class="text-3xl font-display font-black text-slate-900 mb-1 leading-tight">{{ $p->nama }}</h3>
                                <p class="text-primary font-extrabold uppercase tracking-widest text-[12px] mb-6 font-sans flex items-center gap-1.5">
                                    <span class="inline-block w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
                                    {{ $p->jabatan }} Bakesbangpol Banyuwangi
                                </p>
                                
                                <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed text-[15px] font-sans font-medium space-y-4">
                                    @if($p->bio)
                                        {!! $p->bio !!}
                                    @else
                                        <p class="text-slate-400 italic">Informasi biografi dan profil lengkap pimpinan belum tersedia.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Daftar Anggota / Staf --}}
                        @if(!empty($p->anggota))
                            @php
                                $anggotaList = array_filter(array_map('trim', explode("\n", $p->anggota)));
                            @endphp
                            @if(count($anggotaList) > 0)
                                <div class="mt-16 border-t border-slate-100 pt-10">
                                    <h4 class="font-display font-extrabold text-slate-900 text-lg mb-6 flex items-center gap-3">
                                        <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-primary/10 text-primary">
                                            <i data-lucide="users" class="w-5 h-5"></i>
                                        </span>
                                        Daftar Staf / Anggota Bidang
                                    </h4>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                        @foreach($anggotaList as $anggotaName)
                                            <div class="flex items-center gap-4.5 p-4 bg-slate-50/50 border border-slate-100 rounded-2xl hover:border-primary/20 hover:bg-white hover:shadow-xl hover:shadow-slate-100/50 transition-all duration-300 group">
                                                <div class="w-8 h-8 rounded-xl bg-slate-100 text-slate-500 group-hover:bg-primary group-hover:text-white flex items-center justify-center transition-colors duration-300 font-extrabold text-xs">
                                                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                                </div>
                                                <span class="text-[13.5px] font-bold text-slate-600 group-hover:text-slate-900 transition-colors duration-300 leading-snug">{{ $anggotaName }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endif

                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        {{-- Fallback jika data pimpinan kosong --}}
        <div class="text-center py-20 bg-slate-50 rounded-3xl border border-slate-100 max-w-2xl mx-auto">
            <div class="w-20 h-20 bg-white rounded-full shadow-sm border border-slate-100 flex items-center justify-center mx-auto mb-6">
                <i data-lucide="users-round" class="w-10 h-10 text-slate-300"></i>
            </div>
            <h3 class="font-display font-bold text-slate-900 text-xl mb-2">Data Pimpinan Belum Tersedia</h3>
            <p class="text-slate-500 text-sm font-sans font-medium max-w-md mx-auto mb-6">Administrator sedang mempersiapkan pengunggahan data pimpinan dan pejabat Badan Kesatuan Bangsa dan Politik Kabupaten Banyuwangi secara lengkap.</p>
            <a href="{{ route('beranda') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white text-[14px] font-bold rounded-xl hover:bg-blue-700 shadow-lg shadow-primary/20 transition-all">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali ke Beranda
            </a>
        </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabButtons = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('data-target');

                // 1. Perbarui Gaya Aktif pada Tombol Sidebar
                tabButtons.forEach(b => {
                    b.classList.remove('bg-primary', 'text-white', 'border-primary', 'shadow-xl', 'shadow-primary/20', 'scale-[1.02]');
                    b.classList.add('text-slate-600', 'bg-white', 'hover:bg-slate-100/50', 'hover:text-slate-900', 'border-slate-100', 'hover:border-slate-200');
                });
                this.classList.add('bg-primary', 'text-white', 'border-primary', 'shadow-xl', 'shadow-primary/20', 'scale-[1.02]');
                this.classList.remove('text-slate-600', 'bg-white', 'hover:bg-slate-100/50', 'hover:text-slate-900', 'border-slate-100', 'hover:border-slate-200');

                // 2. Tampilkan Konten Target dengan Animasi Transisi Lembut (Smooth Fade-in)
                tabContents.forEach(content => {
                    if (content.id === targetId) {
                        content.classList.remove('hidden');
                        // Memicu reflow browser agar transisi CSS berjalan lancar
                        void content.offsetWidth;
                        content.classList.remove('opacity-0', 'translate-y-4');
                        content.classList.add('opacity-100', 'translate-y-0');
                    } else {
                        content.classList.add('hidden', 'opacity-0', 'translate-y-4');
                        content.classList.remove('opacity-100', 'translate-y-0');
                    }
                });
            });
        });
    });
</script>
@endpush
@endsection

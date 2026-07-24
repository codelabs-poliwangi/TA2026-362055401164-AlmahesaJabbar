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

                @if($pimpinanList->isNotEmpty())
                    @php
                        $kepala = $pimpinanList->firstWhere('urutan', 1);
                        $sekretaris = $pimpinanList->firstWhere('urutan', 2);
                        $kasubag = $pimpinanList->firstWhere('urutan', 3);
                        $fungsionalSekre = $pimpinanList->firstWhere('urutan', 4);
                        $bidangIdeologi = $pimpinanList->firstWhere('urutan', 5);
                        $bidangWaspada = $pimpinanList->firstWhere('urutan', 6);
                        $bidangBudaya = $pimpinanList->firstWhere('urutan', 7);
                        
                        $lainnya = $pimpinanList->filter(function($item) {
                            return !in_array($item->urutan, [1, 2, 3, 4, 5, 6, 7]);
                        });
                    @endphp

                    <!-- Bagan Struktur Organisasi Visual -->
                    <div class="mb-16 bg-slate-50/50 border border-slate-100 rounded-3xl p-6 md:p-10 shadow-sm relative overflow-hidden">
                        <div class="absolute inset-0 bg-grid-pattern opacity-[0.03] pointer-events-none"></div>
                        <div class="w-full flex flex-col items-center">
                            
                            <!-- Tier 1: Kepala Badan -->
                            @if($kepala)
                                <div class="flex flex-col items-center w-full max-w-[280px] z-10 relative">
                                    <div class="bg-gradient-to-br from-slate-900 to-slate-800 border-2 border-secondary rounded-3xl p-5 shadow-xl text-center relative group w-full text-white">
                                        <div class="absolute -top-3 left-1/2 transform -translate-x-1/2 bg-secondary text-white text-[9px] font-black uppercase tracking-widest px-3 py-1 rounded-full shadow-md leading-none">
                                            Pimpinan
                                        </div>
                                        <div class="w-18 h-18 rounded-2xl overflow-hidden border border-white/20 shadow-sm mx-auto mb-3.5 relative group-hover:scale-[1.03] transition-transform duration-500 flex-shrink-0">
                                            @if($kepala->foto)
                                                <img src="{{ asset('storage/' . $kepala->foto) }}" alt="{{ $kepala->nama }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full bg-slate-700 flex items-center justify-center text-slate-300">
                                                    <i data-lucide="user" class="w-8 h-8"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <span class="text-[9.5px] font-black text-secondary uppercase tracking-widest mb-1.5 block leading-none">Kepala Badan</span>
                                        <h5 class="text-sm font-extrabold text-white leading-tight mb-2.5">{{ $kepala->nama }}</h5>
                                        <a href="{{ route('front.profil.pimpinan') }}" class="inline-flex items-center gap-1 text-[11px] font-bold text-slate-400 hover:text-white transition-colors">
                                            <span>Detail Profil</span>
                                            <i data-lucide="arrow-up-right" class="w-3.5 h-3.5 text-secondary"></i>
                                        </a>
                                    </div>
                                    
                                    <!-- Connector Line Down -->
                                    <div class="w-0.5 h-12 bg-gradient-to-b from-secondary to-primary/40"></div>
                                </div>
                            @endif

                            <!-- Tier 2: Sekretaris & Sub Bagian -->
                            @if($sekretaris)
                                <div class="flex flex-col items-center w-full z-10 relative">
                                    <!-- Sekretaris Node -->
                                    <div class="w-full max-w-[280px]">
                                        <div class="bg-white border border-primary/20 rounded-3xl p-5 shadow-lg shadow-slate-100/50 hover:shadow-xl hover:shadow-primary/5 hover:border-primary/40 transition-all duration-300 flex flex-col items-center text-center relative group">
                                            <div class="w-18 h-18 rounded-2xl overflow-hidden border border-slate-100 shadow-sm mb-3.5 relative flex-shrink-0">
                                                @if($sekretaris->foto)
                                                    <img src="{{ asset('storage/' . $sekretaris->foto) }}" alt="{{ $sekretaris->nama }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400">
                                                        <i data-lucide="user" class="w-8 h-8"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <span class="text-[9.5px] font-black text-primary uppercase tracking-widest mb-1.5 block leading-none">{{ $sekretaris->jabatan }}</span>
                                            <h5 class="text-sm font-extrabold text-slate-800 group-hover:text-primary transition-colors duration-300 leading-tight mb-2.5">{{ $sekretaris->nama }}</h5>
                                            <a href="{{ route('front.profil.pimpinan') }}" class="inline-flex items-center gap-1 text-[11px] font-bold text-slate-400 hover:text-primary transition-colors">
                                                <span>Detail Profil</span>
                                                <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Branching Connector from Sekretaris to Sub Bagian -->
                                    @if($kasubag || $fungsionalSekre)
                                        <div class="w-full max-w-4xl flex flex-col items-center relative mt-4">
                                            <!-- Horizontal Bridge Line -->
                                            <div class="absolute top-0 left-1/4 right-1/4 h-0.5 bg-slate-200 hidden md:block"></div>
                                            
                                            <!-- Columns for Sub-Nodes of Sekretaris -->
                                            <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-8 pt-4 px-4">
                                                <!-- Left Sub-Node: Kasub Bagian Umum dan Keuangan -->
                                                @if($kasubag)
                                                    <div class="flex flex-col items-center relative">
                                                        <!-- Line Up Connector -->
                                                        <div class="absolute -top-4 w-0.5 h-4 bg-slate-200 hidden md:block"></div>
                                                        <div class="bg-slate-50 border border-slate-100 rounded-3xl p-4.5 shadow-md hover:border-primary/20 hover:bg-white hover:shadow-lg transition-all duration-300 flex flex-col items-center text-center relative group w-full max-w-[260px]">
                                                            <div class="w-14 h-14 rounded-2xl overflow-hidden border border-slate-100 shadow-sm mb-3 relative flex-shrink-0">
                                                                @if($kasubag->foto)
                                                                    <img src="{{ asset('storage/' . $kasubag->foto) }}" alt="{{ $kasubag->nama }}" class="w-full h-full object-cover">
                                                                @else
                                                                    <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400">
                                                                        <i data-lucide="user" class="w-6 h-6"></i>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1 block leading-none">{{ $kasubag->jabatan }}</span>
                                                            <h5 class="text-[13px] font-extrabold text-slate-800 group-hover:text-primary transition-colors duration-300 leading-tight">{{ $kasubag->nama }}</h5>
                                                        </div>
                                                    </div>
                                                @endif

                                                <!-- Right Sub-Node: Fungsional Sekretariat -->
                                                @if($fungsionalSekre)
                                                    <div class="flex flex-col items-center relative">
                                                        <!-- Line Up Connector -->
                                                        <div class="absolute -top-4 w-0.5 h-4 bg-slate-200 hidden md:block"></div>
                                                        <div class="bg-slate-50 border border-slate-100 rounded-3xl p-4.5 shadow-md hover:border-primary/20 hover:bg-white hover:shadow-lg transition-all duration-300 flex flex-col items-center text-center relative group w-full max-w-[260px]">
                                                            <div class="w-14 h-14 rounded-2xl overflow-hidden border border-slate-100 shadow-sm mb-3 relative flex-shrink-0">
                                                                @if($fungsionalSekre->foto)
                                                                    <img src="{{ asset('storage/' . $fungsionalSekre->foto) }}" alt="{{ $fungsionalSekre->nama }}" class="w-full h-full object-cover">
                                                                @else
                                                                    <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400">
                                                                        <i data-lucide="user" class="w-6 h-6"></i>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1 block leading-none">Kelompok Fungsional</span>
                                                            <h5 class="text-[13px] font-extrabold text-slate-800 group-hover:text-primary transition-colors duration-300 leading-tight">{{ $fungsionalSekre->nama }}</h5>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <!-- Line Down to Bidang Tier -->
                                    <div class="w-0.5 h-16 bg-slate-200 mt-6 hidden md:block"></div>
                                </div>
                            @endif

                            <!-- Tier 3: 3 Fungsional Bidang -->
                            <div class="w-full max-w-7xl relative mt-6 md:mt-0">
                                <!-- Horizontal Bridge Line spanning across the 3 columns -->
                                <div class="absolute top-0 left-[16.6%] right-[16.6%] h-0.5 bg-slate-200 hidden md:block"></div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pt-6">
                                    <!-- Bidang 1: Ideologi -->
                                    @if($bidangIdeologi)
                                        <div class="flex flex-col items-center relative">
                                            <div class="w-0.5 h-6 bg-slate-200 absolute -top-6 hidden md:block"></div>
                                            <div class="bg-white border border-slate-100 rounded-3xl p-5 shadow-lg hover:border-primary/20 hover:shadow-xl hover:shadow-slate-100/50 transition-all duration-300 flex flex-col items-center text-center relative group w-full max-w-[280px]">
                                                <div class="w-16 h-16 rounded-2xl overflow-hidden border border-slate-100 shadow-sm mb-3.5 relative flex-shrink-0">
                                                    @if($bidangIdeologi->foto)
                                                        <img src="{{ asset('storage/' . $bidangIdeologi->foto) }}" alt="{{ $bidangIdeologi->nama }}" class="w-full h-full object-cover">
                                                    @else
                                                        <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400">
                                                            <i data-lucide="user" class="w-8 h-8"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <span class="text-[9.5px] font-black text-slate-400 uppercase tracking-widest mb-1.5 block text-center leading-tight">Bidang Bina Ideologi & Wawasan Kebangsaan</span>
                                                <h5 class="text-sm font-extrabold text-slate-800 group-hover:text-primary transition-colors duration-300 leading-tight mb-2.5">{{ $bidangIdeologi->nama }}</h5>
                                                <a href="{{ route('front.profil.pimpinan') }}" class="inline-flex items-center gap-1 text-[11px] font-bold text-slate-400 hover:text-primary transition-colors">
                                                    <span>Detail Profil</span>
                                                    <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Bidang 2: Kewaspadaan -->
                                    @if($bidangWaspada)
                                        <div class="flex flex-col items-center relative">
                                            <div class="w-0.5 h-6 bg-slate-200 absolute -top-6 hidden md:block"></div>
                                            <div class="bg-white border border-slate-100 rounded-3xl p-5 shadow-lg hover:border-primary/20 hover:shadow-xl hover:shadow-slate-100/50 transition-all duration-300 flex flex-col items-center text-center relative group w-full max-w-[280px]">
                                                <div class="w-16 h-16 rounded-2xl overflow-hidden border border-slate-100 shadow-sm mb-3.5 relative flex-shrink-0">
                                                    @if($bidangWaspada->foto)
                                                        <img src="{{ asset('storage/' . $bidangWaspada->foto) }}" alt="{{ $bidangWaspada->nama }}" class="w-full h-full object-cover">
                                                    @else
                                                        <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400">
                                                            <i data-lucide="user" class="w-8 h-8"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <span class="text-[9.5px] font-black text-slate-400 uppercase tracking-widest mb-1.5 block text-center leading-tight">Bidang Kewaspadaan & Penanganan Konflik</span>
                                                <h5 class="text-sm font-extrabold text-slate-800 group-hover:text-primary transition-colors duration-300 leading-tight mb-2.5">{{ $bidangWaspada->nama }}</h5>
                                                <a href="{{ route('front.profil.pimpinan') }}" class="inline-flex items-center gap-1 text-[11px] font-bold text-slate-400 hover:text-primary transition-colors">
                                                    <span>Detail Profil</span>
                                                    <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
                                                </a>

                                                <!-- Accordion Anggota -->
                                                @if(!empty($bidangWaspada->anggota))
                                                    @php
                                                        $anggotaList = array_filter(array_map('trim', explode("\n", $bidangWaspada->anggota)));
                                                    @endphp
                                                    @if(count($anggotaList) > 0)
                                                        <div class="mt-4 w-full border-t border-slate-100 pt-4">
                                                            <button class="toggle-staf-btn w-full py-2 px-3 bg-slate-50 border border-slate-100 text-slate-600 hover:bg-primary/5 hover:text-primary hover:border-primary/20 rounded-xl text-[11px] font-extrabold flex items-center justify-between transition-all duration-300" data-target="staf-{{ $bidangWaspada->id }}">
                                                                <span class="flex items-center gap-1.5">
                                                                    <i data-lucide="users" class="w-3.5 h-3.5"></i>
                                                                    Staf / Anggota ({{ count($anggotaList) }})
                                                                </span>
                                                                <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform duration-300" id="icon-staf-{{ $bidangWaspada->id }}"></i>
                                                            </button>
                                                            <div id="staf-{{ $bidangWaspada->id }}" class="hidden overflow-hidden transition-all duration-500 mt-2 bg-slate-50/50 border border-slate-100 rounded-xl max-h-[220px] overflow-y-auto custom-scrollbar p-2.5 space-y-1.5 text-left">
                                                                @foreach($anggotaList as $staf)
                                                                    <div class="flex items-center gap-2 p-1.5 bg-white border border-slate-100/50 rounded-lg shadow-sm">
                                                                        <div class="w-4 h-4 rounded bg-primary/10 text-primary flex items-center justify-center font-black text-[8px] flex-shrink-0">
                                                                            {{ $loop->iteration }}
                                                                        </div>
                                                                        <span class="text-[10px] font-bold text-slate-600 leading-tight">{{ $staf }}</span>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Bidang 3: Budaya Politik -->
                                    @if($bidangBudaya)
                                        <div class="flex flex-col items-center relative">
                                            <div class="w-0.5 h-6 bg-slate-200 absolute -top-6 hidden md:block"></div>
                                            <div class="bg-white border border-slate-100 rounded-3xl p-5 shadow-lg hover:border-primary/20 hover:shadow-xl hover:shadow-slate-100/50 transition-all duration-300 flex flex-col items-center text-center relative group w-full max-w-[280px]">
                                                <div class="w-16 h-16 rounded-2xl overflow-hidden border border-slate-100 shadow-sm mb-3.5 relative flex-shrink-0">
                                                    @if($bidangBudaya->foto)
                                                        <img src="{{ asset('storage/' . $bidangBudaya->foto) }}" alt="{{ $bidangBudaya->nama }}" class="w-full h-full object-cover">
                                                    @else
                                                        <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400">
                                                            <i data-lucide="user" class="w-8 h-8"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <span class="text-[9.5px] font-black text-slate-400 uppercase tracking-widest mb-1.5 block text-center leading-tight">Bidang Budaya Politik & HAM</span>
                                                <h5 class="text-sm font-extrabold text-slate-800 group-hover:text-primary transition-colors duration-300 leading-tight mb-2.5">{{ $bidangBudaya->nama }}</h5>
                                                <a href="{{ route('front.profil.pimpinan') }}" class="inline-flex items-center gap-1 text-[11px] font-bold text-slate-400 hover:text-primary transition-colors">
                                                    <span>Detail Profil</span>
                                                    <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Tier 4: Posisi Jabatan Tambahan Lainnya -->
                            @if($lainnya->isNotEmpty())
                                <div class="w-full border-t border-slate-100 mt-16 pt-12">
                                    <h4 class="font-display font-extrabold text-slate-800 text-center text-lg mb-8 flex items-center justify-center gap-2">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-primary/10 text-primary">
                                            <i data-lucide="briefcase" class="w-4.5 h-4.5"></i>
                                        </span>
                                        Posisi Jabatan Tambahan
                                    </h4>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-5xl mx-auto">
                                        @foreach($lainnya as $item)
                                            <div class="bg-white border border-slate-100 rounded-3xl p-5 shadow-md hover:border-primary/20 hover:shadow-lg transition-all duration-300 flex flex-col items-center text-center relative group">
                                                <div class="w-14 h-14 rounded-2xl overflow-hidden border border-slate-100 shadow-sm mb-3.5 relative flex-shrink-0">
                                                    @if($item->foto)
                                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover">
                                                    @else
                                                        <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400">
                                                            <i data-lucide="user" class="w-7 h-7"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1.5 block leading-none">{{ $item->jabatan }}</span>
                                                <h5 class="text-[13px] font-extrabold text-slate-800 group-hover:text-primary transition-colors duration-300 leading-tight mb-2.5">{{ $item->nama }}</h5>
                                                <a href="{{ route('front.profil.pimpinan') }}" class="inline-flex items-center gap-1 text-[10px] font-bold text-slate-400 hover:text-primary transition-colors">
                                                    <span>Detail Profil</span>
                                                    <i data-lucide="arrow-up-right" class="w-3 h-3"></i>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('.toggle-staf-btn');
        
        toggleButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const targetContent = document.getElementById(targetId);
                const icon = document.getElementById('icon-' + targetId);
                
                if (targetContent) {
                    if (targetContent.classList.contains('hidden')) {
                        targetContent.classList.remove('hidden');
                        // Memicu reflow browser agar animasi berjalan lancar
                        void targetContent.offsetWidth;
                        targetContent.classList.add('opacity-100');
                        if (icon) icon.classList.add('rotate-180');
                    } else {
                        targetContent.classList.add('hidden');
                        targetContent.classList.remove('opacity-100');
                        if (icon) icon.classList.remove('rotate-180');
                    }
                }
            });
        });
    });
</script>
@endpush
@endsection

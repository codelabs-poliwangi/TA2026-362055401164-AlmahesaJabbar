@extends('layouts.app')

@section('title', 'Pencarian Global - Bakesbangpol Kabupaten Banyuwangi')

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
        <h1 class="font-display font-bold text-slate-950 text-xl">Pencarian</h1>
    </div>
</div>

{{-- =============================================
     MAIN CONTENT SECTION
     ============================================= --}}
<section class="bg-white pt-8 pb-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        {{-- Breadcrumb --}}
        <nav class="text-[13px] text-slate-500 mb-6">
            <a href="{{ route('beranda') }}" class="hover:text-slate-900 transition">Beranda</a>
            <span class="mx-1">/</span>
            <span class="font-medium text-slate-800">Pencarian</span>
        </nav>

        {{-- Search Input Refiner --}}
        <div class="bg-slate-50 border border-slate-100 rounded-3xl p-6 md:p-8 mb-10 shadow-sm">
            <form action="{{ route('search') }}" method="GET" class="relative">
                <input type="text" name="search" value="{{ $search }}" 
                    placeholder="Cari informasi, berita, dokumen..." 
                    class="w-full pl-12 pr-28 py-4 bg-white border border-slate-200 rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none text-sm transition shadow-sm font-medium text-slate-800">
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                    <i data-lucide="search" class="w-5 h-5"></i>
                </div>
                <button type="submit" 
                    class="absolute right-3 top-1/2 -translate-y-1/2 px-6 py-2.5 bg-primary hover:bg-[#003670] text-white font-bold rounded-xl transition text-xs flex items-center gap-1.5 shadow-md">
                    <i data-lucide="search" class="w-3.5 h-3.5"></i>
                    <span>Cari</span>
                </button>
            </form>
            @if(!empty($search))
                <p class="text-xs text-slate-500 mt-3 flex items-center gap-1">
                    <i data-lucide="info" class="w-3.5 h-3.5 text-primary"></i>
                    Menampilkan hasil pencarian untuk kata kunci: <strong class="text-slate-800">"{{ $search }}"</strong>
                </p>
            @endif
        </div>

        @if(empty($search))
            {{-- Welcome Search State --}}
            <div class="bg-slate-50 border border-slate-100 rounded-3xl p-16 text-center max-w-2xl mx-auto">
                <div class="w-16 h-16 bg-white border border-slate-200 rounded-2xl flex items-center justify-center mx-auto mb-4 text-primary shadow-sm">
                    <i data-lucide="search" class="w-8 h-8"></i>
                </div>
                <h4 class="font-display font-extrabold text-slate-800 text-base mb-2">Pencarian Konten Global</h4>
                <p class="text-xs text-slate-500 leading-relaxed">Masukkan kata kunci pencarian Anda pada kotak input di atas untuk mencari Berita Kegiatan, Dokumen PPID, Profil Instansi, atau Video Kegiatan.</p>
            </div>
        @elseif($totalResults === 0)
            {{-- Empty Results State --}}
            <div class="bg-slate-50 border border-slate-100 rounded-3xl p-16 text-center max-w-2xl mx-auto shadow-sm">
                <div class="w-16 h-16 bg-white border border-slate-200 rounded-2xl flex items-center justify-center mx-auto mb-4 text-red-500 shadow-sm">
                    <i data-lucide="alert-circle" class="w-8 h-8"></i>
                </div>
                <h4 class="font-display font-extrabold text-slate-800 text-base mb-1">Hasil Tidak Ditemukan</h4>
                <p class="text-xs text-slate-500 mb-4">Maaf, kami tidak menemukan hasil pencarian yang cocok untuk kata kunci <strong class="text-slate-700">"{{ $search }}"</strong>.</p>
                <div class="text-left bg-white border border-slate-200 rounded-2xl p-5 text-xs text-slate-600 max-w-md mx-auto space-y-2">
                    <p class="font-bold text-slate-800 mb-1">Saran Pencarian:</p>
                    <ul class="list-disc pl-4 space-y-1.5">
                        <li>Periksa ejaan kata kunci Anda.</li>
                        <li>Gunakan kata kunci yang lebih umum (contoh: "wawasan", "kinerja", "paskibra").</li>
                        <li>Hindari kata kunci yang terlalu spesifik atau panjang.</li>
                    </ul>
                </div>
            </div>
        @else
            {{-- Tab Buttons --}}
            <div class="border-b border-slate-200 mb-8 overflow-x-auto no-scrollbar flex">
                <div class="flex gap-2 min-w-max">
                    <button onclick="switchTab('all-results')" data-tab="all-results" 
                        class="tab-btn px-5 py-3 border-b-2 font-bold text-[13.5px] transition-all flex items-center gap-2 border-primary text-primary bg-slate-50/50 rounded-t-xl">
                        <i data-lucide="layers" class="w-4 h-4"></i>
                        Semua Hasil
                        <span class="bg-primary text-white text-[11px] px-2 py-0.5 rounded-full font-extrabold">{{ $totalResults }}</span>
                    </button>
                    
                    <button onclick="switchTab('berita-results')" data-tab="berita-results" 
                        class="tab-btn px-5 py-3 border-b-2 font-bold text-[13.5px] transition-all flex items-center gap-2 border-transparent text-slate-500 hover:text-slate-800">
                        <i data-lucide="newspaper" class="w-4 h-4"></i>
                        Berita
                        <span class="bg-slate-100 text-slate-600 text-[11px] px-2 py-0.5 rounded-full font-bold">{{ $berita->count() }}</span>
                    </button>
                    
                    <button onclick="switchTab('dokumen-results')" data-tab="dokumen-results" 
                        class="tab-btn px-5 py-3 border-b-2 font-bold text-[13.5px] transition-all flex items-center gap-2 border-transparent text-slate-500 hover:text-slate-800">
                        <i data-lucide="file-text" class="w-4 h-4"></i>
                        Dokumen
                        <span class="bg-slate-100 text-slate-600 text-[11px] px-2 py-0.5 rounded-full font-bold">{{ $dokumen->count() }}</span>
                    </button>
                    
                    <button onclick="switchTab('halaman-results')" data-tab="halaman-results" 
                        class="tab-btn px-5 py-3 border-b-2 font-bold text-[13.5px] transition-all flex items-center gap-2 border-transparent text-slate-500 hover:text-slate-800">
                        <i data-lucide="layout" class="w-4 h-4"></i>
                        Halaman Statis
                        <span class="bg-slate-100 text-slate-600 text-[11px] px-2 py-0.5 rounded-full font-bold">{{ $halaman->count() }}</span>
                    </button>
                    
                    <button onclick="switchTab('video-results')" data-tab="video-results" 
                        class="tab-btn px-5 py-3 border-b-2 font-bold text-[13.5px] transition-all flex items-center gap-2 border-transparent text-slate-500 hover:text-slate-800">
                        <i data-lucide="video" class="w-4 h-4"></i>
                        Video
                        <span class="bg-slate-100 text-slate-600 text-[11px] px-2 py-0.5 rounded-full font-bold">{{ $videos->count() }}</span>
                    </button>
                </div>
            </div>

            {{-- =============================================
                 TAB CONTENTS
                 ============================================= --}}
            
            {{-- 1. ALL RESULTS TAB --}}
            <div id="all-results" class="tab-content space-y-12">
                {{-- Berita Section --}}
                @if($berita->count() > 0)
                    <div>
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-6">
                            <h3 class="font-display font-extrabold text-slate-900 text-base flex items-center gap-2">
                                <i data-lucide="newspaper" class="w-5 h-5 text-primary"></i>
                                Berita Terkait
                            </h3>
                            <button onclick="switchTab('berita-results')" class="text-xs font-bold text-primary hover:underline">
                                Lihat Semua Berita ({{ $berita->count() }})
                            </button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($berita->take(3) as $item)
                                @include('front.search_partials.berita_card', ['item' => $item])
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Dokumen Section --}}
                @if($dokumen->count() > 0)
                    <div>
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-6">
                            <h3 class="font-display font-extrabold text-slate-900 text-base flex items-center gap-2">
                                <i data-lucide="file-text" class="w-5 h-5 text-primary"></i>
                                Dokumen PPID Terkait
                            </h3>
                            <button onclick="switchTab('dokumen-results')" class="text-xs font-bold text-primary hover:underline">
                                Lihat Semua Dokumen ({{ $dokumen->count() }})
                            </button>
                        </div>
                        <div class="space-y-4">
                            @foreach($dokumen->take(3) as $item)
                                @include('front.search_partials.dokumen_row', ['item' => $item])
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Halaman Section --}}
                @if($halaman->count() > 0)
                    <div>
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-6">
                            <h3 class="font-display font-extrabold text-slate-900 text-base flex items-center gap-2">
                                <i data-lucide="layout" class="w-5 h-5 text-primary"></i>
                                Halaman Statis Terkait
                            </h3>
                            <button onclick="switchTab('halaman-results')" class="text-xs font-bold text-primary hover:underline">
                                Lihat Semua Halaman ({{ $halaman->count() }})
                            </button>
                        </div>
                        <div class="space-y-4">
                            @foreach($halaman->take(3) as $item)
                                @include('front.search_partials.halaman_row', ['item' => $item])
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Video Section --}}
                @if($videos->count() > 0)
                    <div>
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-6">
                            <h3 class="font-display font-extrabold text-slate-900 text-base flex items-center gap-2">
                                <i data-lucide="video" class="w-5 h-5 text-primary"></i>
                                Video Kegiatan Terkait
                            </h3>
                            <button onclick="switchTab('video-results')" class="text-xs font-bold text-primary hover:underline">
                                Lihat Semua Video ({{ $videos->count() }})
                            </button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($videos->take(3) as $item)
                                @include('front.search_partials.video_card', ['item' => $item])
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- 2. BERITA ONLY TAB --}}
            <div id="berita-results" class="tab-content hidden">
                <div class="border-b border-slate-100 pb-3 mb-6">
                    <h3 class="font-display font-extrabold text-slate-900 text-base flex items-center gap-2">
                        <i data-lucide="newspaper" class="w-5 h-5 text-primary"></i>
                        Hasil Berita ({{ $berita->count() }})
                    </h3>
                </div>
                @if($berita->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($berita as $item)
                            @include('front.search_partials.berita_card', ['item' => $item])
                        @endforeach
                    </div>
                @else
                    <p class="text-xs text-slate-500 py-6 text-center">Tidak ada berita yang cocok dengan pencarian.</p>
                @endif
            </div>

            {{-- 3. DOKUMEN ONLY TAB --}}
            <div id="dokumen-results" class="tab-content hidden">
                <div class="border-b border-slate-100 pb-3 mb-6">
                    <h3 class="font-display font-extrabold text-slate-900 text-base flex items-center gap-2">
                        <i data-lucide="file-text" class="w-5 h-5 text-primary"></i>
                        Hasil Dokumen PPID ({{ $dokumen->count() }})
                    </h3>
                </div>
                @if($dokumen->count() > 0)
                    <div class="space-y-4">
                        @foreach($dokumen as $item)
                            @include('front.search_partials.dokumen_row', ['item' => $item])
                        @endforeach
                    </div>
                @else
                    <p class="text-xs text-slate-500 py-6 text-center">Tidak ada dokumen yang cocok dengan pencarian.</p>
                @endif
            </div>

            {{-- 4. HALAMAN ONLY TAB --}}
            <div id="halaman-results" class="tab-content hidden">
                <div class="border-b border-slate-100 pb-3 mb-6">
                    <h3 class="font-display font-extrabold text-slate-900 text-base flex items-center gap-2">
                        <i data-lucide="layout" class="w-5 h-5 text-primary"></i>
                        Hasil Halaman Statis ({{ $halaman->count() }})
                    </h3>
                </div>
                @if($halaman->count() > 0)
                    <div class="space-y-4">
                        @foreach($halaman as $item)
                            @include('front.search_partials.halaman_row', ['item' => $item])
                        @endforeach
                    </div>
                @else
                    <p class="text-xs text-slate-500 py-6 text-center">Tidak ada halaman statis yang cocok dengan pencarian.</p>
                @endif
            </div>

            {{-- 5. VIDEO ONLY TAB --}}
            <div id="video-results" class="tab-content hidden">
                <div class="border-b border-slate-100 pb-3 mb-6">
                    <h3 class="font-display font-extrabold text-slate-900 text-base flex items-center gap-2">
                        <i data-lucide="video" class="w-5 h-5 text-primary"></i>
                        Hasil Video Kegiatan ({{ $videos->count() }})
                    </h3>
                </div>
                @if($videos->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($videos as $item)
                            @include('front.search_partials.video_card', ['item' => $item])
                        @endforeach
                    </div>
                @else
                    <p class="text-xs text-slate-500 py-6 text-center">Tidak ada video yang cocok dengan pencarian.</p>
                @endif
            </div>
        @endif

    </div>
</section>
@endsection

@push('scripts')
<script>
    function switchTab(tabId) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        
        // Show selected tab content
        const targetTab = document.getElementById(tabId);
        if (targetTab) {
            targetTab.classList.remove('hidden');
        }
        
        // Deactivate all tab buttons
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('border-primary', 'text-primary', 'bg-slate-50/50', 'rounded-t-xl');
            btn.classList.add('border-transparent', 'text-slate-500', 'hover:text-slate-800');
        });
        
        // Activate current tab button
        const activeBtn = document.querySelector(`[data-tab="${tabId}"]`);
        if (activeBtn) {
            activeBtn.classList.remove('border-transparent', 'text-slate-500', 'hover:text-slate-800');
            activeBtn.classList.add('border-primary', 'text-primary', 'bg-slate-50/50', 'rounded-t-xl');
        }
    }
</script>
@endpush

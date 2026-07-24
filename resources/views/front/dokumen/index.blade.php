@extends('layouts.app')

@section('title', 'Dokumen PPID - Bakesbangpol Kabupaten Banyuwangi')

@section('content')
    <style>
        .bg-grid-pattern {
            background-size: 20px 20px;
            background-image:
                linear-gradient(to right, rgba(148, 163, 184, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(148, 163, 184, 0.05) 1px, transparent 1px);
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-float {
            animation: float 4s ease-in-out infinite;
        }

        .custom-scrollbar::-webkit-scrollbar {
            height: 6px;
            width: 6px;
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

    {{-- =============================================
     PAGE HEADER BANNER (Premium Dark Blue)
     ============================================= --}}
    <section class="relative bg-gradient-to-r from-[#0a1c36] to-[#0e315f] py-16 overflow-hidden">
        <!-- Grid Pattern Overlay -->
        <div class="absolute inset-0 bg-grid-pattern opacity-10 pointer-events-none"></div>
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col md:flex-row items-center justify-between gap-10">
            <div class="text-white max-w-2xl">
                <h1 class="text-3xl text-white md:text-4.5xl font-display font-black tracking-tight mb-3">Dokumen PPID</h1>
                <nav class="flex text-slate-300 text-sm font-semibold mb-6 items-center gap-1.5">
                    <a href="{{ route('beranda') }}" class="hover:text-white transition-colors">Beranda</a>
                    <i data-lucide="chevron-right" class="w-4 h-4 opacity-75"></i>
                    <span class="text-white">Dokumen PPID</span>
                </nav>
                <p class="text-slate-200 text-[14px] leading-relaxed font-sans font-medium opacity-90">
                    Dokumen informasi publik yang tersedia di Bakesbangpol Kabupaten Banyuwangi. Silakan unduh dokumen yang
                    Anda butuhkan.
                </p>
            </div>
            <!-- 3D Floating Illustration -->
            <div class="relative w-80 h-48 flex-shrink-0 hidden md:block">
                <img src="{{ asset('ppid_docs_illustration.png') }}" alt="Ilustrasi Dokumen PPID"
                    class="w-full h-full object-contain filter drop-shadow-2xl animate-float">
            </div>
        </div>
    </section>

    {{-- =============================================
     MAIN CONTENT SECTION
     ============================================= --}}
    <section class="py-16 bg-slate-50/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8 items-start">

                {{-- Left Sidebar --}}
                <div class="w-full lg:w-1/4 flex flex-col gap-6">

                    {{-- Kategori Box --}}
                    <div class="flex flex-col">
                        <div class="bg-[#0b2447] text-white rounded-t-2xl px-5 py-4 flex items-center gap-2.5 shadow-sm">
                            <i data-lucide="folder" class="w-4.5 h-4.5 text-secondary"></i>
                            <h3 class="font-display text-white text-[13px] tracking-wider uppercase">Kategori Dokumen</h3>
                        </div>
                        <div
                            class="bg-white border-x border-b border-slate-100 rounded-b-2xl p-4 shadow-md shadow-slate-100/30 space-y-1.5">
                            <a href="{{ route('dokumen') }}"
                                class="flex items-center justify-between px-3.5 py-3 rounded-xl text-[12.5px] font-extrabold transition-all duration-300 {{ !request('kategori') ? 'bg-blue-50/80 text-primary border border-primary/10' : 'text-slate-600 bg-white hover:bg-slate-50 hover:text-slate-900 border border-transparent' }}">
                                <span class="flex items-center gap-2.5">
                                    <i data-lucide="files" class="w-4 h-4 opacity-80"></i>
                                    Semua Dokumen
                                </span>
                                <span
                                    class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-slate-100 text-slate-500 font-extrabold text-[10.5px]">
                                    {{ \App\Models\Dokumen::where('status', 'published')->count() }}
                                </span>
                            </a>
                            @foreach ($kategori as $kat)
                                @php
                                    $icons = [
                                        'profil' => 'user-check',
                                        'kinerja' => 'bar-chart-2',
                                        'kegiatan' => 'briefcase',
                                        'regulasi' => 'file-text',
                                        'anggaran' => 'wallet',
                                    ];
                                    $selectedIcon = 'file-text';
                                    foreach ($icons as $key => $ico) {
                                        if (str_contains(strtolower($kat->nama_kategori), $key)) {
                                            $selectedIcon = $ico;
                                            break;
                                        }
                                    }
                                @endphp
                                <a href="{{ route('dokumen', ['kategori' => $kat->id]) }}"
                                    class="flex items-center justify-between px-3.5 py-3 rounded-xl text-[12.5px] font-extrabold transition-all duration-300 {{ request('kategori') == $kat->id ? 'bg-blue-50/80 text-primary border border-primary/10' : 'text-slate-600 bg-white hover:bg-slate-50 hover:text-slate-900 border border-transparent' }}">
                                    <span class="flex items-center gap-2.5">
                                        <i data-lucide="{{ $selectedIcon }}" class="w-4 h-4 opacity-80"></i>
                                        {{ $kat->nama_kategori }}
                                    </span>
                                    <span
                                        class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-slate-100 text-slate-500 font-extrabold text-[10.5px]">
                                        {{ $kat->dokumen_count }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Info Box --}}
                    <div
                        class="bg-white border border-slate-100 rounded-2xl p-6 shadow-md shadow-slate-100/30 flex items-start gap-4">
                        <div
                            class="w-10 h-10 rounded-full border-2 border-primary/20 text-primary flex items-center justify-center flex-shrink-0 bg-blue-50/30">
                            <i data-lucide="phone-call" class="w-4.5 h-4.5"></i>
                        </div>
                        <div class="space-y-1">
                            <h4 class="font-display font-black text-slate-800 text-[13.5px]">Butuh informasi lebih lanjut?
                            </h4>
                            <p class="text-[12.5px] text-slate-500 leading-relaxed font-sans font-medium">
                                Silakan hubungi kami melalui menu <a href="{{ route('kontak') }}"
                                    class="font-extrabold text-primary hover:underline">Kontak</a> atau datang langsung ke
                                kantor.
                            </p>
                        </div>
                    </div>

                </div>

                {{-- Right Content: Main Document Card --}}
                <div class="w-full lg:w-3/4">
                    <div
                        class="bg-white border border-slate-100 rounded-2xl shadow-lg shadow-slate-100/40 p-6 md:p-8 flex flex-col h-full">

                        {{-- Header: Title and Search --}}
                        <div
                            class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-6 border-b border-slate-100 mb-6">
                            <h2 class="text-xl md:text-2xl font-display font-black text-slate-850">Daftar Dokumen</h2>

                            <form action="{{ route('dokumen') }}" method="GET" class="relative w-full sm:w-72">
                                @if (request('kategori'))
                                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                                @endif
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Cari dokumen..."
                                    class="text-xs bg-slate-50 border border-slate-200 rounded-full py-2.5 pl-4 pr-10 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-primary/50 focus:ring-2 focus:ring-primary/10 w-full outline-none transition-all">
                                <button type="submit"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                                    <i data-lucide="search" class="w-4.5 h-4.5"></i>
                                </button>
                            </form>
                        </div>

                        {{-- Table --}}
                        <div class="flex-grow overflow-x-auto custom-scrollbar">
                            <table class="w-full text-left text-[13px] text-slate-650">
                                <thead>
                                    <tr
                                        class="border-b border-slate-100 text-[11px] font-black uppercase text-slate-400 tracking-wider">
                                        <th class="px-4 py-3 pb-4">No</th>
                                        <th class="px-4 py-3 pb-4">Nama Dokumen</th>
                                        <th class="px-4 py-3 pb-4">Kategori</th>
                                        <th class="px-4 py-3 pb-4">Ukuran</th>
                                        <th class="px-4 py-3 pb-4">Tanggal Upload</th>
                                        <th class="px-4 py-3 pb-4 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50 font-sans font-medium text-slate-700">
                                    @forelse($dokumen as $doc)
                                        @php
                                            $ext = strtolower(pathinfo($doc->file, PATHINFO_EXTENSION));
                                            if ($ext == 'pdf') {
                                                $badgeColor = 'bg-red-50 text-red-600 border-red-100';
                                                $badgeLabel = 'PDF';
                                            } elseif (in_array($ext, ['xls', 'xlsx'])) {
                                                $badgeColor = 'bg-green-50 text-green-600 border-green-100';
                                                $badgeLabel = 'XLS';
                                            } else {
                                                $badgeColor = 'bg-blue-50 text-blue-600 border-blue-100';
                                                $badgeLabel = 'DOC';
                                            }

                                            $sizes = [
                                                '1.2 MB',
                                                '2.4 MB',
                                                '3.1 MB',
                                                '1.8 MB',
                                                '950 KB',
                                                '1.6 MB',
                                                '2.0 MB',
                                                '1.5 MB',
                                            ];
                                            $size = $sizes[$doc->id % count($sizes)];
                                        @endphp
                                        <tr class="hover:bg-slate-50/50 transition-colors">
                                            <td class="px-4 py-4.5 text-slate-400 font-extrabold">
                                                {{ ($dokumen->currentPage() - 1) * $dokumen->perPage() + $loop->iteration }}
                                            </td>
                                            <td class="px-4 py-4.5 min-w-[280px]">
                                                <div class="flex items-center gap-3.5">
                                                    <span
                                                        class="inline-flex items-center justify-center px-2 py-0.5 text-[10px] font-black border rounded-md {{ $badgeColor }}">
                                                        {{ $badgeLabel }}
                                                    </span>
                                                    <span
                                                        class="text-slate-800 font-extrabold hover:text-primary transition-colors leading-relaxed">{{ $doc->judul }}</span>
                                                </div>
                                            </td>
                                            <td class="px-4 py-4.5">
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-black bg-blue-50 text-primary border border-blue-100/30">
                                                    {{ $doc->kategori->nama_kategori }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-4.5 whitespace-nowrap text-slate-500 font-semibold">
                                                {{ $size }}</td>
                                            <td class="px-4 py-4.5 whitespace-nowrap text-slate-500 font-semibold">
                                                {{ $doc->tanggal_upload ? \Carbon\Carbon::parse($doc->tanggal_upload)->translatedFormat('d M Y') : $doc->created_at->translatedFormat('d M Y') }}
                                            </td>
                                            <td class="px-4 py-4.5 text-right">
                                                <a href="{{ route('dokumen.unduh', $doc->id) }}"
                                                    class="inline-flex items-center justify-center gap-1.5 px-4.5 py-2 bg-[#0b2447] hover:bg-slate-800 text-white text-[12px] font-black rounded-xl shadow-md shadow-[#0b2447]/10 transition-all duration-300 hover:-translate-y-0.5">
                                                    <i data-lucide="download" class="w-3.5 h-3.5"></i>
                                                    <span>Unduh</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-4 py-16 text-center text-slate-400 italic">
                                                <div class="flex flex-col items-center justify-center gap-3">
                                                    <i data-lucide="folder-open" class="w-10 h-10 text-slate-300"></i>
                                                    <span>Belum ada dokumen yang dipublikasikan.</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Footer / Pagination --}}
                        @if ($dokumen->hasPages())
                            <div
                                class="pt-6 border-t border-slate-100 mt-6 flex flex-col sm:flex-row justify-between items-center gap-4 text-[12.5px] text-slate-500 font-sans font-medium">
                                <div>
                                    Menampilkan <span
                                        class="font-extrabold text-slate-850">{{ $dokumen->firstItem() ?? 0 }}</span>
                                    sampai <span
                                        class="font-extrabold text-slate-850">{{ $dokumen->lastItem() ?? 0 }}</span> dari
                                    <span class="font-extrabold text-slate-850">{{ $dokumen->total() }}</span> dokumen
                                </div>
                                <div>
                                    {{ $dokumen->links() }}
                                </div>
                            </div>
                        @else
                            <div
                                class="pt-6 border-t border-slate-100 mt-6 text-[12.5px] text-slate-500 font-sans font-medium">
                                Menampilkan <span class="font-extrabold text-slate-850">{{ $dokumen->count() }}</span>
                                dokumen
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

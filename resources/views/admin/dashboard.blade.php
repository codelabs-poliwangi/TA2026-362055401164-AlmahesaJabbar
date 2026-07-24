@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')
@section('page-subtitle', 'Ringkasan performa dan data website Bakesbangpol')

@section('content')

{{-- Stats Cards Row --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    @php
        $stats = [
            ['label' => 'Total Berita',  'value' => $totalBerita,  'sub' => 'Publikasi aktif', 'icon' => 'newspaper', 'color' => 'text-blue-600', 'bg' => 'bg-blue-100', 'border' => 'border-blue-200'],
            ['label' => 'Total Dokumen', 'value' => $totalDokumen, 'sub' => 'File publik tersedia', 'icon' => 'file-text', 'color' => 'text-emerald-600', 'bg' => 'bg-emerald-100', 'border' => 'border-emerald-200'],
            ['label' => 'Halaman Statis', 'value' => $totalHalaman, 'sub' => 'Halaman profil aktif', 'icon' => 'book-open', 'color' => 'text-amber-600', 'bg' => 'bg-amber-100', 'border' => 'border-amber-200'],
            ['label' => 'Daftar Pimpinan', 'value' => $totalPimpinan, 'sub' => 'Pejabat & pimpinan', 'icon' => 'users-round', 'color' => 'text-purple-600', 'bg' => 'bg-purple-100', 'border' => 'border-purple-200'],
        ];
    @endphp
    @foreach($stats as $s)
    <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm hover:shadow-md transition-shadow flex items-center gap-5 relative overflow-hidden group">
        <div class="absolute right-[-10%] top-[-10%] w-24 h-24 {{ $s['bg'] }} opacity-50 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
        <div class="w-14 h-14 rounded-2xl {{ $s['bg'] }} {{ $s['border'] }} border flex items-center justify-center flex-shrink-0 relative z-10 shadow-inner">
            <i data-lucide="{{ $s['icon'] }}" class="w-7 h-7 {{ $s['color'] }}"></i>
        </div>
        <div class="relative z-10">
            <p class="text-[13px] font-bold text-slate-400 uppercase tracking-widest mb-1">{{ $s['label'] }}</p>
            <p class="font-display font-extrabold text-slate-900 text-3xl leading-none mb-1.5">{{ $s['value'] }}</p>
            <p class="text-[13px] text-slate-500 font-medium">{{ $s['sub'] }}</p>
        </div>
    </div>
    @endforeach
</div>

{{-- Two-column middle section --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

    {{-- Berita Terbaru --}}
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm flex flex-col h-full overflow-hidden">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-50 bg-slate-50/50">
            <h2 class="font-display font-bold text-slate-900 text-[16px] flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center"><i data-lucide="newspaper" class="w-4 h-4 text-blue-600"></i></div>
                Berita Terbaru
            </h2>
            <a href="{{ route('admin.berita.index') }}" class="text-[13px] font-bold text-primary hover:text-blue-800 hover:bg-blue-50 px-3 py-1.5 rounded-lg transition-colors">Lihat Semua</a>
        </div>
        <div class="flex-1 divide-y divide-slate-50">
            @forelse($beritaTerbaru as $b)
            <div class="flex items-center gap-4 px-6 py-4 hover:bg-slate-50/80 transition-colors group">
                <div class="w-16 h-16 rounded-xl bg-slate-100 overflow-hidden flex-shrink-0 border border-slate-200">
                    @if($b->gambar)
                        <img src="{{ asset('storage/'.$b->gambar) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $b->judul }}">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i data-lucide="image" class="w-6 h-6 text-slate-300"></i>
                        </div>
                    @endif
                </div>
                <div class="min-w-0 flex-1">
                    <a href="{{ route('admin.berita.edit', $b->id) }}" class="text-[14px] font-bold text-slate-800 hover:text-primary truncate block mb-1">{{ $b->judul }}</a>
                    <p class="text-[12px] text-slate-500 font-medium flex items-center gap-1.5">
                        <i data-lucide="user" class="w-3.5 h-3.5 text-slate-400"></i> Oleh {{ $b->author->name ?? 'Admin' }}
                    </p>
                </div>
                <div class="text-[12px] text-slate-400 whitespace-nowrap flex flex-col items-end gap-1 flex-shrink-0">
                    <span class="bg-slate-50 text-slate-600 px-2 py-0.5 rounded border border-slate-100 text-[11px] font-bold">{{ $b->created_at->format('d M') }}</span>
                    <span class="font-medium">{{ $b->created_at->format('Y') }}</span>
                </div>
            </div>
            @empty
            <div class="flex flex-col items-center justify-center p-8 text-center">
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                    <i data-lucide="inbox" class="w-8 h-8 text-slate-300"></i>
                </div>
                <p class="text-[14px] font-medium text-slate-600">Belum ada berita dipublikasikan.</p>
                <a href="{{ route('admin.berita.create') }}" class="text-[13px] font-bold text-primary hover:underline mt-1">Buat berita baru</a>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Dokumen Terbaru --}}
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm flex flex-col h-full overflow-hidden">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-50 bg-slate-50/50">
            <h2 class="font-display font-bold text-slate-900 text-[16px] flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center"><i data-lucide="file-text" class="w-4 h-4 text-emerald-600"></i></div>
                Dokumen Terbaru
            </h2>
            <a href="{{ route('admin.dokumen.index') }}" class="text-[13px] font-bold text-emerald-600 hover:text-emerald-800 hover:bg-emerald-50 px-3 py-1.5 rounded-lg transition-colors">Lihat Semua</a>
        </div>
        <div class="flex-1 divide-y divide-slate-50">
            @forelse($dokumenTerbaru as $d)
            <div class="flex items-center gap-4 px-6 py-4 hover:bg-slate-50/80 transition-colors group">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center flex-shrink-0 border border-emerald-100">
                    <i data-lucide="file-pdf" class="w-6 h-6"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <a href="{{ route('admin.dokumen.edit', $d->id) }}" class="text-[14px] font-bold text-slate-800 hover:text-emerald-600 truncate block mb-1">{{ $d->judul }}</a>
                    <p class="text-[12px] text-slate-500 font-medium flex items-center gap-1.5">
                        <i data-lucide="folder" class="w-3.5 h-3.5 text-slate-400"></i> {{ $d->kategori->nama_kategori ?? 'Umum' }}
                    </p>
                </div>
                <div class="flex items-center gap-3 flex-shrink-0">
                    <span class="text-[12px] text-slate-400 font-medium">{{ $d->created_at->format('d M Y') }}</span>
                    <a href="{{ route('dokumen.unduh', $d->id) }}" class="text-slate-400 hover:text-emerald-600 bg-white border border-slate-200 rounded-lg p-2 shadow-sm hover:shadow hover:border-emerald-200 transition-all group-hover:bg-emerald-50" title="Unduh File">
                        <i data-lucide="download" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
            @empty
            <div class="flex flex-col items-center justify-center p-8 text-center">
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                    <i data-lucide="inbox" class="w-8 h-8 text-slate-300"></i>
                </div>
                <p class="text-[14px] font-medium text-slate-600">Belum ada dokumen diupload.</p>
                <a href="{{ route('admin.dokumen.create') }}" class="text-[13px] font-bold text-emerald-600 hover:underline mt-1">Upload dokumen baru</a>
            </div>
            @endforelse
        </div>
    </div>
</div>

{{-- Aktivitas Terakhir --}}
<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden mb-6">
    <div class="px-6 py-5 border-b border-slate-50 bg-slate-50/50">
        <h2 class="font-display font-bold text-slate-900 text-[16px] flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center"><i data-lucide="activity" class="w-4 h-4 text-amber-600"></i></div>
            Aktivitas Terakhir
        </h2>
    </div>
    <div class="p-6">
        <div class="relative border-l-2 border-slate-100 ml-3 space-y-6">
            @forelse($beritaTerbaru->take(4) as $b)
            <div class="relative pl-6 group">
                <span class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-primary/20 flex items-center justify-center group-hover:bg-primary/30 transition-colors">
                    <span class="w-2 h-2 rounded-full bg-primary"></span>
                </span>
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 bg-slate-50/50 rounded-xl p-4 border border-slate-100 hover:border-slate-200 transition-colors">
                    <div>
                        <p class="text-[14px] text-slate-700 font-medium">
                            <span class="font-bold text-slate-900">Admin</span> menerbitkan berita baru: 
                            <a href="{{ route('admin.berita.edit', $b->id) }}" class="font-bold text-primary hover:underline">"{{ Str::limit($b->judul, 60) }}"</a>
                        </p>
                    </div>
                    <div class="text-[12px] text-slate-500 font-bold bg-white px-3 py-1.5 rounded-lg border border-slate-200 inline-flex items-center gap-1.5 w-max shadow-sm">
                        <i data-lucide="clock" class="w-3.5 h-3.5 text-slate-400"></i>
                        {{ $b->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
            @empty
            <div class="pl-6 text-[14px] text-slate-500 italic font-medium">Belum ada log aktivitas yang tercatat.</div>
            @endforelse
        </div>
    </div>
</div>

@endsection

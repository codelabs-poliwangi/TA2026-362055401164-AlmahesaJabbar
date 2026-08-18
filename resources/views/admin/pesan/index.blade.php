@extends('layouts.admin')
@section('title', 'Kelola Pesan Masuk')
@section('page-title', 'Pesan Masuk')
@section('page-subtitle', 'Manajemen pesan masuk dari pengunjung website')

@section('content')

<div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="font-display font-bold text-slate-900 text-2xl mb-1">Daftar Pesan Masuk</h2>
        <p class="text-[14px] text-slate-500 font-medium">Lihat dan kelola masukan, saran, atau pertanyaan dari pengunjung website.</p>
    </div>
</div>

{{-- Success Alert --}}
@if(session('success'))
<div class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-250 text-emerald-700 px-5 py-4 rounded-2xl shadow-sm">
    <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0 text-emerald-500"></i>
    <span class="text-[14px] font-semibold">{{ session('success') }}</span>
</div>
@endif

<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
    {{-- Filter Bar --}}
    <div class="p-6 border-b border-slate-50 bg-slate-50/50">
        <form action="{{ route('admin.pesan.index') }}" method="GET" class="flex flex-col lg:flex-row lg:items-center gap-4">
            <div class="relative flex-1 group">
                <i data-lucide="search" class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, email, subjek, atau isi pesan..."
                       class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-[14px] font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all shadow-sm">
            </div>
            <div class="flex flex-wrap sm:flex-nowrap gap-3">
                <button type="submit" class="flex items-center justify-center gap-2 px-6 py-3 bg-slate-800 text-white text-[14px] font-bold rounded-xl hover:bg-slate-700 hover:shadow-lg hover:shadow-slate-800/20 transition-all whitespace-nowrap">
                    <i data-lucide="filter" class="w-4 h-4"></i>
                    Cari
                </button>
                @if(request()->filled('search'))
                    <a href="{{ route('admin.pesan.index') }}" class="flex items-center justify-center px-4 py-3 bg-red-50 text-red-600 text-[14px] font-bold rounded-xl hover:bg-red-100 transition-colors whitespace-nowrap border border-red-100">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left text-[14px] text-slate-700 border-collapse">
            <thead>
                <tr class="border-b border-slate-100 bg-white">
                    <th class="px-6 py-5 font-bold text-slate-400 text-[12px] uppercase tracking-widest w-12 text-center">No</th>
                    <th class="px-6 py-5 font-bold text-slate-400 text-[12px] uppercase tracking-widest">Nama & Email</th>
                    <th class="px-6 py-5 font-bold text-slate-400 text-[12px] uppercase tracking-widest">Subjek & Cuplikan Pesan</th>
                    <th class="px-6 py-5 font-bold text-slate-400 text-[12px] uppercase tracking-widest w-48">Tanggal Kirim</th>
                    <th class="px-6 py-5 font-bold text-slate-400 text-[12px] uppercase tracking-widest text-right w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($pesan as $p)
                <tr class="hover:bg-slate-50/80 transition-colors group">
                    <td class="px-6 py-5 text-slate-500 font-bold text-[13px] text-center align-middle">
                        {{ ($pesan->currentPage()-1) * $pesan->perPage() + $loop->iteration }}
                    </td>
                    <td class="px-6 py-5 align-middle">
                        <div class="font-bold text-slate-900 text-[15px] leading-snug">{{ $p->nama }}</div>
                        <div class="text-slate-400 text-[13px] font-medium mt-0.5 flex items-center gap-1.5">
                            <i data-lucide="mail" class="w-3.5 h-3.5 text-slate-350"></i>
                            {{ $p->email }}
                        </div>
                    </td>
                    <td class="px-6 py-5 align-middle">
                        <div class="font-semibold text-slate-800 text-[14px] leading-snug">{{ $p->subjek }}</div>
                        <p class="text-slate-500 text-[13px] font-medium line-clamp-1 mt-1">{{ strip_tags($p->pesan) }}</p>
                    </td>
                    <td class="px-6 py-5 text-slate-500 font-medium align-middle">
                        <div class="flex items-center gap-2">
                            <i data-lucide="calendar" class="w-4 h-4 text-slate-400"></i>
                            <span>{{ $p->created_at->translatedFormat('d M Y, H:i') }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-right align-middle">
                        <div class="flex items-center justify-end gap-2 opacity-80 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('admin.pesan.show', $p->id) }}"
                               class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 hover:bg-primary hover:text-white flex items-center justify-center transition-colors border border-blue-200 hover:border-primary" title="Detail Pesan">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('admin.pesan.destroy', $p->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-9 h-9 rounded-xl bg-red-50 text-red-600 hover:bg-red-500 hover:text-white flex items-center justify-center transition-colors border border-red-200 hover:border-red-500" title="Hapus Pesan">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                        <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-slate-100 text-slate-350 shadow-inner">
                            <i data-lucide="mail-warning" class="w-8 h-8"></i>
                        </div>
                        <h4 class="font-display font-bold text-slate-700 text-base mb-1">Belum Ada Pesan</h4>
                        <p class="text-xs text-slate-500">Tidak ada pesan masuk dari pengunjung untuk saat ini.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($pesan->hasPages())
    <div class="p-6 border-t border-slate-50 bg-white">
        {{ $pesan->links() }}
    </div>
    @endif
</div>

@endsection

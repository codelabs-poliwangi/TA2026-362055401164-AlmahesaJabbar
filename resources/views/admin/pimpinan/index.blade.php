@extends('layouts.admin')
@section('title', 'Kelola Pimpinan')
@section('page-title', 'Kelola Pimpinan')
@section('page-subtitle', 'Manajemen daftar pejabat, posisi, foto, tugas pokok, dan biografi pimpinan')

@section('content')

<div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="font-display font-bold text-slate-900 text-2xl mb-1">Daftar Pimpinan & Pejabat</h2>
        <p class="text-[14px] text-slate-500 font-medium font-sans">Kelola daftar pimpinan yang tampil pada menu profil halaman depan.</p>
    </div>
    <a href="{{ route('admin.pimpinan.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-primary text-white text-[14px] font-bold rounded-xl hover:bg-blue-700 shadow-lg shadow-primary/20 transition-all hover:-translate-y-0.5 whitespace-nowrap">
        <i data-lucide="plus" class="w-5 h-5"></i>
        Tambah Pimpinan Baru
    </a>
</div>

<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
    {{-- Filter Bar --}}
    <div class="p-6 border-b border-slate-50 bg-slate-50/50">
        <form action="{{ route('admin.pimpinan.index') }}" method="GET" class="flex flex-col lg:flex-row lg:items-center gap-4">
            <div class="relative flex-1 group">
                <i data-lucide="search" class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pimpinan atau jabatan..."
                       class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-[14px] font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all shadow-sm">
            </div>
            <div class="flex gap-3">
                <button type="submit" class="flex items-center justify-center gap-2 px-6 py-3 bg-slate-800 text-white text-[14px] font-bold rounded-xl hover:bg-slate-700 hover:shadow-lg hover:shadow-slate-800/20 transition-all whitespace-nowrap">
                    <i data-lucide="filter" class="w-4 h-4"></i>
                    Terapkan Filter
                </button>
                @if(request()->filled('search'))
                    <a href="{{ route('admin.pimpinan.index') }}" class="flex items-center justify-center px-4 py-3 bg-red-50 text-red-600 text-[14px] font-bold rounded-xl hover:bg-red-100 transition-colors whitespace-nowrap border border-red-100">
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
                    <th class="px-6 py-5 font-bold text-slate-400 text-[12px] uppercase tracking-widest w-16 text-center">Urutan</th>
                    <th class="px-6 py-5 font-bold text-slate-400 text-[12px] uppercase tracking-widest w-24">Foto</th>
                    <th class="px-6 py-5 font-bold text-slate-400 text-[12px] uppercase tracking-widest">Detail Pimpinan</th>
                    <th class="px-6 py-5 font-bold text-slate-400 text-[12px] uppercase tracking-widest">Tupoksi Singkat</th>
                    <th class="px-6 py-5 font-bold text-slate-400 text-[12px] uppercase tracking-widest text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($pimpinan as $p)
                <tr class="hover:bg-slate-50/80 transition-colors group">
                    <td class="px-6 py-5 text-center align-middle">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-slate-600 font-bold text-[13px] border border-slate-200">
                            {{ $p->urutan }}
                        </span>
                    </td>
                    <td class="px-6 py-5 align-middle">
                        <div class="w-16 h-16 rounded-full bg-slate-100 border-2 border-white overflow-hidden flex-shrink-0 shadow-md ring-4 ring-slate-100 relative">
                            @if($p->foto)
                                <img src="{{ asset('storage/' . $p->foto) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $p->nama }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-slate-200">
                                    <i data-lucide="user" class="w-6 h-6 text-slate-400"></i>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-5 max-w-[280px] align-middle">
                        <h4 class="font-bold text-slate-900 text-[15px] group-hover:text-primary mb-1 transition-colors leading-tight">{{ $p->nama }}</h4>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-blue-50 text-primary text-[12px] font-bold border border-blue-100">
                            {{ $p->jabatan }}
                        </span>
                    </td>
                    <td class="px-6 py-5 align-middle">
                        <p class="text-slate-500 font-medium text-[13px] line-clamp-2 leading-relaxed max-w-[400px]">
                            {{ $p->tupoksi_singkat ?? 'Belum ada deskripsi tupoksi.' }}
                        </p>
                    </td>
                    <td class="px-6 py-5 text-right align-middle">
                        <div class="flex items-center justify-end gap-2 opacity-80 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('profil.pimpinan') }}" target="_blank"
                               class="w-9 h-9 rounded-xl bg-slate-50 text-slate-600 hover:bg-slate-800 hover:text-white flex items-center justify-center transition-colors border border-slate-200 hover:border-slate-800" title="Lihat Halaman Depan">
                                <i data-lucide="external-link" class="w-4 h-4"></i>
                            </a>
                            <a href="{{ route('admin.pimpinan.edit', $p->id) }}"
                               class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white flex items-center justify-center transition-colors border border-amber-200 hover:border-amber-500" title="Edit Pimpinan">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('admin.pimpinan.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pimpinan ini secara permanen?')" class="inline-block">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-9 h-9 rounded-xl bg-red-50 text-red-600 hover:bg-red-500 hover:text-white flex items-center justify-center transition-colors border border-red-200 hover:border-red-500" title="Hapus Pimpinan">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-20 text-center">
                        <div class="inline-flex flex-col items-center justify-center">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                <i data-lucide="users-round" class="w-10 h-10 text-slate-300"></i>
                            </div>
                            <h3 class="font-bold text-slate-800 text-[16px] mb-1">Pimpinan Tidak Ditemukan</h3>
                            <p class="text-[14px] text-slate-500 font-medium mb-4">Daftar pimpinan kosong. Silakan tambah data baru.</p>
                            <a href="{{ route('admin.pimpinan.create') }}" class="text-[14px] font-bold text-primary hover:underline">Tambah Pimpinan Baru</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($pimpinan->hasPages() || $pimpinan->total() > 0)
    <div class="px-6 py-5 border-t border-slate-100 bg-white flex flex-col md:flex-row justify-between items-center gap-4">
        <p class="text-[13px] text-slate-500 font-medium font-sans">
            Menampilkan <span class="font-bold text-slate-800">{{ $pimpinan->firstItem() ?? 0 }}</span> sampai <span class="font-bold text-slate-800">{{ $pimpinan->lastItem() ?? 0 }}</span> dari <span class="font-bold text-slate-800">{{ $pimpinan->total() }}</span> total data
        </p>
        <div class="pagination-wrapper">
            {{ $pimpinan->links() }}
        </div>
    </div>
    @endif
</div>

@endsection

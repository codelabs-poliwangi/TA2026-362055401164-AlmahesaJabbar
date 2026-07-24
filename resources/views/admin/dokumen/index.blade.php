@extends('layouts.admin')
@section('title', 'Daftar Dokumen')
@section('page-title', 'Kelola Dokumen')
@section('page-subtitle', 'Manajemen file publik dan regulasi website Bakesbangpol')

@section('content')

<div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="font-display font-bold text-slate-900 text-2xl mb-1">Daftar Dokumen</h2>
        <p class="text-[14px] text-slate-500 font-medium">Kelola semua file dokumen yang dapat diunduh oleh publik.</p>
    </div>
    <a href="{{ route('admin.dokumen.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-emerald-600 text-white text-[14px] font-bold rounded-xl hover:bg-emerald-700 shadow-lg shadow-emerald-600/20 transition-all hover:-translate-y-0.5 whitespace-nowrap">
        <i data-lucide="upload-cloud" class="w-5 h-5"></i>
        Upload Dokumen Baru
    </a>
</div>

<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
    {{-- Filter Bar --}}
    <div class="p-6 border-b border-slate-50 bg-slate-50/50">
        <form action="{{ route('admin.dokumen.index') }}" method="GET" class="flex flex-col lg:flex-row lg:items-center gap-4">
            <div class="relative flex-1 group">
                <i data-lucide="search" class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama dokumen..."
                       class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-[14px] font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all shadow-sm">
            </div>
            <div class="flex flex-wrap sm:flex-nowrap gap-3">
                <select name="kategori_id" class="px-4 py-3 bg-white border border-slate-200 rounded-xl text-[14px] font-medium text-slate-700 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none shadow-sm min-w-[160px]">
                    <option value="">Semua Kategori</option>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                    @endforeach
                </select>
                <button type="submit" class="flex items-center justify-center gap-2 px-6 py-3 bg-slate-800 text-white text-[14px] font-bold rounded-xl hover:bg-slate-700 hover:shadow-lg hover:shadow-slate-800/20 transition-all whitespace-nowrap">
                    <i data-lucide="filter" class="w-4 h-4"></i>
                    Terapkan
                </button>
                @if(request()->anyFilled(['search', 'kategori_id']))
                    <a href="{{ route('admin.dokumen.index') }}" class="flex items-center justify-center px-4 py-3 bg-red-50 text-red-600 text-[14px] font-bold rounded-xl hover:bg-red-100 transition-colors whitespace-nowrap border border-red-100">
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
                    <th class="px-6 py-5 font-bold text-slate-400 text-[12px] uppercase tracking-widest">Nama Dokumen</th>
                    <th class="px-6 py-5 font-bold text-slate-400 text-[12px] uppercase tracking-widest">Kategori</th>
                    <th class="px-6 py-5 font-bold text-slate-400 text-[12px] uppercase tracking-widest">Detail</th>
                    <th class="px-6 py-5 font-bold text-slate-400 text-[12px] uppercase tracking-widest text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($dokumen as $doc)
                <tr class="hover:bg-slate-50/80 transition-colors group">
                    <td class="px-6 py-5 text-slate-500 font-bold text-[13px] text-center align-middle">
                        {{ ($dokumen->currentPage()-1) * $dokumen->perPage() + $loop->iteration }}
                    </td>
                    <td class="px-6 py-5 max-w-[320px] align-middle">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center flex-shrink-0 border border-emerald-100 mt-0.5 shadow-sm">
                                <i data-lucide="file-text" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <a href="{{ route('admin.dokumen.edit', $doc->id) }}" class="font-bold text-slate-900 text-[15px] hover:text-emerald-600 leading-snug mb-1 block transition-colors">{{ $doc->judul }}</a>
                                <p class="text-[12px] text-slate-500 font-medium line-clamp-1">{{ $doc->deskripsi ?? 'Dokumen Publik Bakesbangpol' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5 align-middle">
                        <span class="inline-flex items-center px-3 py-1.5 rounded-lg bg-slate-100 text-slate-700 text-[12px] font-bold border border-slate-200">
                            <i data-lucide="folder" class="w-3.5 h-3.5 mr-1.5 text-slate-400"></i>
                            {{ $doc->kategori->nama_kategori ?? '-' }}
                        </span>
                    </td>
                    <td class="px-6 py-5 align-middle whitespace-nowrap">
                        <div class="flex flex-col gap-1.5">
                            <div class="flex items-center gap-2 text-[12px] font-medium text-slate-500">
                                <i data-lucide="calendar" class="w-3.5 h-3.5 text-slate-400"></i>
                                <span class="text-slate-700 font-bold">{{ $doc->tanggal_upload ? \Carbon\Carbon::parse($doc->tanggal_upload)->format('d M Y') : $doc->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-[12px] font-medium text-slate-500">
                                <i data-lucide="hard-drive" class="w-3.5 h-3.5 text-slate-400"></i>
                                <span>PDF / 1.5 MB</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-right align-middle">
                        <div class="flex items-center justify-end gap-2 opacity-80 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('dokumen.unduh', $doc->id) }}"
                               class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white flex items-center justify-center transition-colors border border-emerald-200 hover:border-emerald-600 shadow-sm" title="Unduh Dokumen">
                                <i data-lucide="download" class="w-4 h-4"></i>
                            </a>
                            <a href="{{ route('admin.dokumen.edit', $doc->id) }}"
                               class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white flex items-center justify-center transition-colors border border-amber-200 hover:border-amber-500 shadow-sm" title="Edit Dokumen">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('admin.dokumen.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Hapus dokumen ini secara permanen?')" class="inline-block">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-9 h-9 rounded-xl bg-red-50 text-red-600 hover:bg-red-500 hover:text-white flex items-center justify-center transition-colors border border-red-200 hover:border-red-500 shadow-sm" title="Hapus Dokumen">
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
                                <i data-lucide="file-question" class="w-10 h-10 text-slate-300"></i>
                            </div>
                            <h3 class="font-bold text-slate-800 text-[16px] mb-1">Belum Ada Dokumen</h3>
                            <p class="text-[14px] text-slate-500 font-medium mb-4">Mulai dengan mengupload dokumen publik ke dalam sistem.</p>
                            <a href="{{ route('admin.dokumen.create') }}" class="text-[14px] font-bold text-emerald-600 hover:underline">Upload Dokumen</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($dokumen->hasPages() || $dokumen->total() > 0)
    <div class="px-6 py-5 border-t border-slate-100 bg-white flex flex-col md:flex-row justify-between items-center gap-4">
        <p class="text-[13px] text-slate-500 font-medium">
            Menampilkan <span class="font-bold text-slate-800">{{ $dokumen->firstItem() ?? 0 }}</span> sampai <span class="font-bold text-slate-800">{{ $dokumen->lastItem() ?? 0 }}</span> dari <span class="font-bold text-slate-800">{{ $dokumen->total() }}</span> total data
        </p>
        <div class="pagination-wrapper">
            {{ $dokumen->links() }}
        </div>
    </div>
    @endif
</div>

@endsection

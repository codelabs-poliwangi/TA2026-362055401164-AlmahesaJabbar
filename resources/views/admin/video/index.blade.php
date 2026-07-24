@extends('layouts.admin')
@section('title', 'Daftar Video')
@section('page-title', 'Kelola Video')
@section('page-subtitle', 'Manajemen konten link video kegiatan website')

@section('content')

<div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="font-display font-bold text-slate-900 text-2xl mb-1">Daftar Video</h2>
        <p class="text-[14px] text-slate-500 font-medium">Kelola semua video kegiatan Bakesbangpol yang dipublikasikan.</p>
    </div>
    <a href="{{ route('admin.video.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-primary text-white text-[14px] font-bold rounded-xl hover:bg-blue-700 shadow-lg shadow-primary/20 transition-all hover:-translate-y-0.5 whitespace-nowrap">
        <i data-lucide="plus" class="w-5 h-5"></i>
        Tambah Video Baru
    </a>
</div>

<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
    {{-- Filter Bar --}}
    <div class="p-6 border-b border-slate-50 bg-slate-50/50">
        <form action="{{ route('admin.video.index') }}" method="GET" class="flex flex-col lg:flex-row lg:items-center gap-4">
            <div class="relative flex-1 group">
                <i data-lucide="search" class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul video..."
                       class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-[14px] font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all shadow-sm">
            </div>
            <div class="flex flex-wrap sm:flex-nowrap gap-3">
                <select name="status" class="px-4 py-3 bg-white border border-slate-200 rounded-xl text-[14px] font-medium text-slate-700 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none shadow-sm min-w-[150px]">
                    <option value="">Semua Status</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Dipublikasikan</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
                <button type="submit" class="flex items-center justify-center gap-2 px-6 py-3 bg-slate-800 text-white text-[14px] font-bold rounded-xl hover:bg-slate-700 hover:shadow-lg hover:shadow-slate-800/20 transition-all whitespace-nowrap">
                    <i data-lucide="filter" class="w-4 h-4"></i>
                    Terapkan
                </button>
                @if(request()->anyFilled(['search', 'status']))
                    <a href="{{ route('admin.video.index') }}" class="flex items-center justify-center px-4 py-3 bg-red-50 text-red-600 text-[14px] font-bold rounded-xl hover:bg-red-100 transition-colors whitespace-nowrap border border-red-100">
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
                    <th class="px-6 py-5 font-bold text-slate-400 text-[12px] uppercase tracking-widest w-28">Cover</th>
                    <th class="px-6 py-5 font-bold text-slate-400 text-[12px] uppercase tracking-widest">Detail Video</th>
                    <th class="px-6 py-5 font-bold text-slate-400 text-[12px] uppercase tracking-widest">Link URL</th>
                    <th class="px-6 py-5 font-bold text-slate-400 text-[12px] uppercase tracking-widest">Status</th>
                    <th class="px-6 py-5 font-bold text-slate-400 text-[12px] uppercase tracking-widest text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($videos as $v)
                <tr class="hover:bg-slate-50/80 transition-colors group">
                    <td class="px-6 py-5 text-slate-500 font-bold text-[13px] text-center align-middle">
                        {{ ($videos->currentPage()-1) * $videos->perPage() + $loop->iteration }}
                    </td>
                    <td class="px-6 py-5 align-middle">
                        <div class="w-24 h-16 rounded-xl bg-slate-100 border border-slate-200 overflow-hidden flex-shrink-0 relative shadow-sm">
                            @if($v->gambar_cover)
                                <img src="{{ asset('storage/'.$v->gambar_cover) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i data-lucide="video" class="w-6 h-6 text-slate-300"></i>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-5 max-w-[320px] align-middle">
                        <a href="{{ route('admin.video.edit', $v->id) }}" class="font-bold text-slate-900 text-[15px] hover:text-primary line-clamp-2 leading-snug mb-2 transition-colors">{{ $v->judul }}</a>
                        <div class="flex items-center gap-4 text-[12px] text-slate-500 font-medium">
                            <span class="flex items-center gap-1.5"><i data-lucide="user" class="w-3.5 h-3.5 text-slate-400"></i> {{ $v->author->name ?? 'Admin' }}</span>
                            <span class="flex items-center gap-1.5"><i data-lucide="calendar" class="w-3.5 h-3.5 text-slate-400"></i> {{ $v->created_at->format('d M Y') }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-5 align-middle max-w-[200px]">
                        <span class="inline-flex items-center px-3 py-1.5 rounded-lg bg-blue-50 text-primary text-[12px] font-bold border border-blue-100 truncate w-full" title="{{ $v->link_video }}">
                            {{ $v->link_video }}
                        </span>
                    </td>
                    <td class="px-6 py-5 whitespace-nowrap align-middle">
                        @if($v->status == 'published')
                            <div class="flex items-center gap-2">
                                <span class="flex h-2.5 w-2.5 relative">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                                </span>
                                <span class="text-[13px] font-bold text-emerald-700">Dipublikasikan</span>
                            </div>
                        @else
                            <div class="flex items-center gap-2">
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-amber-400"></span>
                                <span class="text-[13px] font-bold text-amber-600">Draft</span>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-5 text-right align-middle">
                        <div class="flex items-center justify-end gap-2 opacity-80 group-hover:opacity-100 transition-opacity">
                            <a href="{{ $v->link_video }}" target="_blank"
                               class="w-9 h-9 rounded-xl bg-slate-50 text-slate-600 hover:bg-slate-800 hover:text-white flex items-center justify-center transition-colors border border-slate-200 hover:border-slate-800" title="Buka Link Video">
                                <i data-lucide="external-link" class="w-4 h-4"></i>
                            </a>
                            <a href="{{ route('admin.video.edit', $v->id) }}"
                               class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white flex items-center justify-center transition-colors border border-amber-200 hover:border-amber-500" title="Edit Video">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('admin.video.destroy', $v->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus video ini secara permanen?')" class="inline-block">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-9 h-9 rounded-xl bg-red-50 text-red-600 hover:bg-red-500 hover:text-white flex items-center justify-center transition-colors border border-red-200 hover:border-red-500" title="Hapus Video">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-20 text-center">
                        <div class="inline-flex flex-col items-center justify-center">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                <i data-lucide="file-x" class="w-10 h-10 text-slate-300"></i>
                            </div>
                            <h3 class="font-bold text-slate-800 text-[16px] mb-1">Data Tidak Ditemukan</h3>
                            <p class="text-[14px] text-slate-500 font-medium mb-4">Silakan ubah filter pencarian atau tambah video baru.</p>
                            <a href="{{ route('admin.video.create') }}" class="text-[14px] font-bold text-primary hover:underline">Tambah Video Baru</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($videos->hasPages() || $videos->total() > 0)
    <div class="px-6 py-5 border-t border-slate-100 bg-white flex flex-col md:flex-row justify-between items-center gap-4">
        <p class="text-[13px] text-slate-500 font-medium">
            Menampilkan <span class="font-bold text-slate-800">{{ $videos->firstItem() ?? 0 }}</span> sampai <span class="font-bold text-slate-800">{{ $videos->lastItem() ?? 0 }}</span> dari <span class="font-bold text-slate-800">{{ $videos->total() }}</span> total data
        </p>
        <div class="pagination-wrapper">
            {{ $videos->links() }}
        </div>
    </div>
    @endif
</div>

@endsection

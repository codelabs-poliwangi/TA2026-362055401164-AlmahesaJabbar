@extends('layouts.admin')
@section('title', 'Kelola Halaman')
@section('page-title', 'Halaman Statis')
@section('page-subtitle', 'Kelola konten pada halaman profil, visi misi, dan informasi statis lainnya.')

@section('content')
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
        <h3 class="font-display font-bold text-slate-900 text-lg">Daftar Halaman</h3>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-900 font-display font-bold text-sm uppercase tracking-wider">
                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">Judul Halaman</th>
                    <th class="px-6 py-4">Slug / Link</th>
                    <th class="px-6 py-4">Terakhir Diperbarui</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($halaman as $h)
                <tr class="hover:bg-slate-50/50 transition group">
                    <td class="px-6 py-6 text-sm text-slate-500 font-medium">{{ $loop->iteration }}</td>
                    <td class="px-6 py-6">
                        <p class="text-sm font-bold text-slate-900 group-hover:text-primary transition-colors">{{ $h->judul_halaman }}</p>
                    </td>
                    <td class="px-6 py-6">
                        <code class="text-[11px] px-2 py-1 bg-slate-100 rounded text-slate-500 font-mono">{{ $h->slug }}</code>
                    </td>
                    <td class="px-6 py-6 text-sm text-slate-400">
                        {{ $h->updated_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-6 py-6">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.halaman.edit', $h->id) }}" class="flex items-center gap-2 px-4 py-2 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white transition shadow-sm border border-amber-100 text-xs font-bold uppercase tracking-wider">
                                <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                Edit Konten
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

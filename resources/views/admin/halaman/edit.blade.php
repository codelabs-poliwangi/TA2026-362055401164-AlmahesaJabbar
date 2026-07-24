@extends('layouts.admin')
@section('title', 'Edit Halaman')
@section('page-title', 'Edit Halaman')
@section('page-subtitle', 'Mengubah konten halaman: ' . $halaman->judul_halaman)

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-2xl p-10 border border-slate-100 shadow-sm">
        <form action="{{ route('admin.halaman.update', $halaman->id) }}" method="POST" class="space-y-8">
            @csrf @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Judul Halaman</label>
                    <input type="text" name="judul_halaman" value="{{ old('judul_halaman', $halaman->judul_halaman) }}" required class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm font-bold transition-all shadow-sm">
                    @error('judul_halaman') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Slug (Tetap)</label>
                    <input type="text" value="{{ $halaman->slug }}" disabled class="w-full px-6 py-4 bg-slate-100 border border-slate-200 rounded-xl text-slate-400 text-sm font-mono cursor-not-allowed shadow-sm">
                    <p class="text-[9px] mt-2 italic text-slate-400">*Slug digunakan untuk pengalamatan sistem dan tidak dapat diubah.</p>
                </div>
            </div>

            <div>
                <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Isi Konten Halaman</label>
                <textarea name="isi_konten" id="editor" rows="15" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">{{ old('isi_konten', $halaman->isi_konten) }}</textarea>
                @error('isi_konten') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-4 pt-4 border-t border-slate-50">
                <button type="submit" class="flex-1 py-4 bg-primary text-white font-bold rounded-xl hover:bg-blue-800 transition shadow-xl shadow-primary/20 flex items-center justify-center gap-3">
                    <i data-lucide="save" class="w-5 h-5"></i>
                    Perbarui Halaman
                </button>
                <a href="{{ route('admin.halaman.index') }}" class="px-8 py-4 bg-white border border-slate-200 text-slate-500 font-bold rounded-xl hover:bg-slate-50 transition">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection

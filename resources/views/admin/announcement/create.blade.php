@extends('layouts.admin')
@section('title', 'Tambah Pengumuman Baru')
@section('page-title', 'Kelola Bilah Pengumuman')
@section('page-subtitle', 'Tambah pengumuman berjalan baru ke atas halaman website')

@section('content')

<div class="mb-8">
    <a href="{{ route('admin.announcement.index') }}" class="inline-flex items-center gap-2 text-[14px] font-bold text-slate-500 hover:text-slate-800 transition">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        Kembali ke Daftar Pengumuman
    </a>
</div>

<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden max-w-4xl">
    <div class="px-8 py-6 border-b border-slate-50 bg-slate-50/50">
        <h2 class="font-display font-bold text-slate-900 text-lg">Form Tambah Pengumuman</h2>
    </div>

    <form action="{{ route('admin.announcement.store') }}" method="POST" class="p-8 space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Teks Pengumuman --}}
            <div class="space-y-2 md:col-span-2">
                <label for="judul" class="text-[13px] font-bold text-slate-700 uppercase tracking-wider block">Teks Pengumuman</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required placeholder="Masukkan pesan pengumuman..."
                       class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-[14px] font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all shadow-sm @error('judul') border-red-500 @enderror">
                <p class="text-[11px] text-slate-400 font-medium">Contoh: Pengumuman Tahap Seleksi Paskibra Kabupaten Banyuwangi</p>
                @error('judul')
                    <p class="text-[12px] text-red-500 font-bold mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Link URL Tujuan --}}
            <div class="space-y-2 md:col-span-2">
                <label for="link" class="text-[13px] font-bold text-slate-700 uppercase tracking-wider block">Link URL Tujuan (Opsional)</label>
                <input type="url" name="link" id="link" value="{{ old('link') }}" placeholder="https://example.com/halaman-pengumuman"
                       class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-[14px] font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all shadow-sm @error('link') border-red-500 @enderror">
                <p class="text-[11px] text-slate-400 font-medium">Masukkan link jika bilah pengumuman dapat diklik untuk mengarahkan pengguna ke halaman/dokumen tertentu.</p>
                @error('link')
                    <p class="text-[12px] text-red-500 font-bold mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status --}}
            <div class="space-y-2 md:col-span-2">
                <label for="status" class="text-[13px] font-bold text-slate-700 uppercase tracking-wider block">Status Publikasi</label>
                <select name="status" id="status" required
                        class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-[14px] font-medium text-slate-700 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none shadow-sm @error('status') border-red-500 @enderror">
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Sembunyikan)</option>
                    <option value="published" {{ old('status', 'published') == 'published' ? 'selected' : '' }}>Published (Publikasikan)</option>
                </select>
                @error('status')
                    <p class="text-[12px] text-red-500 font-bold mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Submit Button --}}
        <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.announcement.index') }}" class="px-6 py-3.5 bg-white border border-slate-200 text-slate-500 text-[14px] font-bold rounded-xl hover:bg-slate-50 transition">Batal</a>
            <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-primary text-white text-[14px] font-bold rounded-xl hover:bg-blue-700 shadow-lg shadow-primary/20 transition-all">
                <i data-lucide="save" class="w-4 h-4"></i>
                Simpan Pengumuman
            </button>
        </div>
    </form>
</div>

@endsection

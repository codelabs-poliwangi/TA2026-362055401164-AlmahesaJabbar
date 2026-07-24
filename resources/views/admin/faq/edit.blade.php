@extends('layouts.admin')
@section('title', 'Edit FAQ')
@section('page-title', 'Kelola FAQ')
@section('page-subtitle', 'Edit data pertanyaan umum dan jawaban')

@section('content')

<div class="mb-8">
    <a href="{{ route('admin.faq.index') }}" class="inline-flex items-center gap-2 text-[14px] font-bold text-slate-500 hover:text-slate-800 transition">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        Kembali ke Daftar FAQ
    </a>
</div>

<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden max-w-4xl">
    <div class="px-8 py-6 border-b border-slate-50 bg-slate-50/50">
        <h2 class="font-display font-bold text-slate-900 text-lg">Form Edit FAQ</h2>
    </div>

    <form action="{{ route('admin.faq.update', $faq->id) }}" method="POST" class="p-8 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6">
            {{-- Pertanyaan --}}
            <div class="space-y-2">
                <label for="pertanyaan" class="text-[13px] font-bold text-slate-700 uppercase tracking-wider block">Pertanyaan</label>
                <input type="text" name="pertanyaan" id="pertanyaan" value="{{ old('pertanyaan', $faq->pertanyaan) }}" required placeholder="Masukkan pertanyaan..."
                       class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-[14px] font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all shadow-sm @error('pertanyaan') border-red-500 @enderror">
                @error('pertanyaan')
                    <p class="text-[12px] text-red-500 font-bold mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jawaban --}}
            <div class="space-y-2">
                <label for="jawaban" class="text-[13px] font-bold text-slate-700 uppercase tracking-wider block">Jawaban</label>
                <textarea name="jawaban" id="jawaban" rows="6" required placeholder="Tulis jawaban lengkap di sini..."
                          class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-[14px] font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all shadow-sm @error('jawaban') border-red-500 @enderror">{{ old('jawaban', $faq->jawaban) }}</textarea>
                @error('jawaban')
                    <p class="text-[12px] text-red-500 font-bold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Urutan Tampil --}}
                <div class="space-y-2">
                    <label for="urutan" class="text-[13px] font-bold text-slate-700 uppercase tracking-wider block">Urutan Tampil</label>
                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $faq->urutan) }}" min="0" required
                           class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-[14px] font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all shadow-sm @error('urutan') border-red-500 @enderror">
                    <p class="text-[11px] text-slate-405 font-medium">FAQ akan diurutkan dari angka terkecil.</p>
                    @error('urutan')
                        <p class="text-[12px] text-red-500 font-bold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="space-y-2">
                    <label for="status" class="text-[13px] font-bold text-slate-700 uppercase tracking-wider block">Status Publikasi</label>
                    <select name="status" id="status" required
                            class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-[14px] font-medium text-slate-750 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none shadow-sm @error('status') border-red-500 @enderror">
                        <option value="draft" {{ old('status', $faq->status) == 'draft' ? 'selected' : '' }}>Draft (Sembunyikan)</option>
                        <option value="published" {{ old('status', $faq->status) == 'published' ? 'selected' : '' }}>Published (Publikasikan)</option>
                    </select>
                    @error('status')
                        <p class="text-[12px] text-red-500 font-bold mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Submit Button --}}
        <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.faq.index') }}" class="px-6 py-3.5 bg-white border border-slate-200 text-slate-500 text-[14px] font-bold rounded-xl hover:bg-slate-50 transition">Batal</a>
            <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-primary text-white text-[14px] font-bold rounded-xl hover:bg-blue-700 shadow-lg shadow-primary/20 transition-all">
                <i data-lucide="save" class="w-4 h-4"></i>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

@endsection

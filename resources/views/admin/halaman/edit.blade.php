@extends('layouts.admin')
@section('title', 'Edit Halaman')
@section('page-title', 'Edit Halaman')
@section('page-subtitle', 'Mengubah konten halaman: ' . $halaman->judul_halaman)

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-2xl p-10 border border-slate-100 shadow-sm">
        <form action="{{ route('admin.halaman.update', $halaman->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf @method('PUT')
            
            @if($halaman->slug === 'struktur-organisasi')
                {{-- Form Khusus Struktur Organisasi --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    {{-- Sisi Kiri: Form Judul & Keterangan --}}
                    <div class="md:col-span-2 space-y-6">
                        <div>
                            <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Judul Halaman <span class="text-red-500">*</span></label>
                            <input type="text" name="judul_halaman" value="{{ old('judul_halaman', $halaman->judul_halaman) }}" required class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm font-bold transition-all shadow-sm">
                            @error('judul_halaman') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Keterangan (Opsional)</label>
                            <textarea name="isi_konten" id="editor" rows="12" placeholder="Tulis keterangan atau penjelasan tambahan mengenai struktur organisasi..." class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">{{ old('isi_konten', $halaman->isi_konten) }}</textarea>
                            @error('isi_konten') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Sisi Kanan: Upload Gambar Struktur --}}
                    <div class="space-y-4">
                        <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-1">Gambar Struktur Organisasi <span class="text-red-500">*</span></label>
                        <span class="text-[10px] text-slate-400 block mb-3 font-sans font-medium">Bagan visual struktur organisasi instansi.</span>
                        
                        <div class="aspect-[4/3] bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-slate-400 p-4 text-center group hover:border-primary transition-colors cursor-pointer relative overflow-hidden" id="preview-container">
                            @if($halaman->gambar)
                                <i data-lucide="image" class="w-12 h-12 mb-2 group-hover:text-primary transition-colors hidden"></i>
                                <p class="text-[10px] font-bold uppercase tracking-widest hidden">Klik untuk ganti gambar</p>
                                <input type="file" name="gambar" id="gambar-input" class="absolute inset-0 opacity-0 cursor-pointer z-10" accept="image/*">
                                <img id="preview-img" src="{{ asset('storage/' . $halaman->gambar) }}" class="absolute inset-0 w-full h-full object-contain bg-slate-100">
                            @else
                                <i data-lucide="image" class="w-12 h-12 mb-2 group-hover:text-primary transition-colors"></i>
                                <p class="text-[10px] font-bold uppercase tracking-widest">Klik untuk pilih gambar</p>
                                <p class="text-[9px] mt-1 italic">Format: JPG, JPEG, PNG, WEBP (Max 2MB)</p>
                                <input type="file" name="gambar" id="gambar-input" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*">
                                <img id="preview-img" class="absolute inset-0 w-full h-full object-contain bg-slate-100 hidden">
                            @endif
                        </div>
                        @error('gambar') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    </div>
                </div>
            @else
                {{-- Form Standar Halaman Lain --}}
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
            @endif

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

@if($halaman->slug === 'struktur-organisasi')
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('gambar-input');
        const preview = document.getElementById('preview-img');
        const container = document.getElementById('preview-container');

        if (input && preview && container) {
            input.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                        const icons = container.querySelectorAll('i, p');
                        icons.forEach(el => el.classList.add('hidden'));
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
@endpush
@endif

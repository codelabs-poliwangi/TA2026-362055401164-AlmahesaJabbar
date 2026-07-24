@extends('layouts.admin')
@section('title', 'Tambah Berita')
@section('page-title', 'Tambah Berita Baru')
@section('page-subtitle', 'Buat artikel berita baru untuk dipublikasikan.')

@section('content')
<form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Main Content --}}
        <div class="w-full lg:w-2/3 space-y-6">
            <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                <div class="mb-6">
                    <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Judul Berita</label>
                    <input type="text" name="judul" value="{{ old('judul') }}" required placeholder="Masukkan judul berita yang menarik..." class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-base font-bold transition-all shadow-sm">
                    @error('judul') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Konten Berita</label>
                    <textarea name="isi" id="editor" rows="20" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">{{ old('isi') }}</textarea>
                    @error('isi') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    <p class="text-[10px] text-slate-400 mt-2 italic">*Gunakan paragraf yang jelas untuk keterbacaan yang baik.</p>
                </div>
            </div>
        </div>

        {{-- Sidebar Settings --}}
        <div class="w-full lg:w-1/3 space-y-6">
            <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                <h3 class="font-display font-bold text-slate-900 mb-6 text-lg border-b border-slate-50 pb-4">Pengaturan Publikasi</h3>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Kategori</label>
                        <select name="kategori_id" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">
                            <option value="">Pilih Kategori</option>
                            @foreach($kategori as $kat)
                                <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                            @endforeach
                        </select>
                        @error('kategori_id') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Tanggal Publish</label>
                        <input type="date" name="tanggal_publish" value="{{ old('tanggal_publish', date('Y-m-d')) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">
                        @error('tanggal_publish') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Status</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="relative block cursor-pointer">
                                <input type="radio" name="status" value="published" {{ old('status', 'published') == 'published' ? 'checked' : '' }} class="peer sr-only">
                                <div class="px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-center text-sm font-bold text-slate-500 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all">Publish</div>
                            </label>
                            <label class="relative block cursor-pointer">
                                <input type="radio" name="status" value="draft" {{ old('status') == 'draft' ? 'checked' : '' }} class="peer sr-only">
                                <div class="px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-center text-sm font-bold text-slate-500 peer-checked:bg-slate-900 peer-checked:text-white peer-checked:border-slate-900 transition-all">Draft</div>
                            </label>
                        </div>
                        @error('status') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                <h3 class="font-display font-bold text-slate-900 mb-6 text-lg border-b border-slate-50 pb-4">Gambar Unggulan</h3>
                <div class="space-y-4">
                    <div class="aspect-video bg-slate-50 rounded-xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-slate-400 p-4 text-center group hover:border-primary transition-colors cursor-pointer relative overflow-hidden" id="preview-container">
                        <i data-lucide="image-plus" class="w-10 h-10 mb-2 group-hover:text-primary transition-colors"></i>
                        <p class="text-[10px] font-bold uppercase tracking-widest">Klik untuk pilih gambar</p>
                        <p class="text-[9px] mt-1 italic">Format: JPG, PNG (Max 2MB)</p>
                        <input type="file" name="gambar" id="gambar-input" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*">
                        <img id="preview-img" class="absolute inset-0 w-full h-full object-cover hidden">
                    </div>
                    @error('gambar') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="flex-1 py-4 bg-primary text-white font-bold rounded-xl hover:bg-blue-800 transition shadow-xl shadow-primary/20 flex items-center justify-center gap-3">
                    <i data-lucide="save" class="w-5 h-5"></i>
                    Simpan Berita
                </button>
                <a href="{{ route('admin.berita.index') }}" class="px-6 py-4 bg-white border border-slate-200 text-slate-500 font-bold rounded-xl hover:bg-slate-50 transition">Batal</a>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    const input = document.getElementById('gambar-input');
    const preview = document.getElementById('preview-img');
    const container = document.getElementById('preview-container');

    input.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
@endsection

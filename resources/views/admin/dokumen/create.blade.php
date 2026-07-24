@extends('layouts.admin')
@section('title', 'Tambah Dokumen')
@section('page-title', 'Tambah Dokumen')
@section('page-subtitle', 'Unggah dokumen baru ke sistem PPID.')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-2xl p-10 border border-slate-100 shadow-sm">
        <form action="{{ route('admin.dokumen.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            
            <div>
                <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Judul Dokumen</label>
                <input type="text" name="judul" value="{{ old('judul') }}" required placeholder="Contoh: Laporan Tahunan 2024" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm font-bold transition-all shadow-sm">
                @error('judul') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Deskripsi Singkat</label>
                <textarea name="deskripsi" rows="3" placeholder="Masukkan ringkasan isi dokumen..." class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Kategori</label>
                    <select name="kategori_id" required class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm font-bold transition-all shadow-sm">
                        <option value="">Pilih Kategori</option>
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Tanggal Dokumen</label>
                    <input type="date" name="tanggal_upload" value="{{ old('tanggal_upload', date('Y-m-d')) }}" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm font-bold transition-all shadow-sm">
                    @error('tanggal_upload') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Pilih File</label>
                <div class="group relative px-6 py-8 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center text-slate-400 hover:border-primary transition-colors cursor-pointer">
                    <i data-lucide="upload-cloud" class="w-10 h-10 mb-3 group-hover:text-primary transition-colors"></i>
                    <p class="text-[10px] font-bold uppercase tracking-widest mb-1" id="file-name-label">Klik untuk pilih file</p>
                    <p class="text-[9px] italic">Format: PDF, DOCX, XLSX (Max 5MB)</p>
                    <input type="file" name="file" id="file-input" required class="absolute inset-0 opacity-0 cursor-pointer">
                </div>
                @error('file') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>

            <input type="hidden" name="status" value="published">

            <div class="flex gap-4 pt-4 border-t border-slate-50">
                <button type="submit" class="flex-1 py-4 bg-primary text-white font-bold rounded-xl hover:bg-blue-800 transition shadow-xl shadow-primary/20 flex items-center justify-center gap-3">
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                    Simpan Dokumen
                </button>
                <a href="{{ route('admin.dokumen.index') }}" class="px-8 py-4 bg-white border border-slate-200 text-slate-500 font-bold rounded-xl hover:bg-slate-50 transition">Batal</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('file-input').addEventListener('change', function() {
        const label = document.getElementById('file-name-label');
        if (this.files[0]) {
            label.textContent = this.files[0].name;
            label.classList.add('text-primary');
        }
    });
</script>
@endpush
@endsection

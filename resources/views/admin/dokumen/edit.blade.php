@extends('layouts.admin')
@section('title', 'Edit Dokumen')
@section('page-title', 'Edit Dokumen')
@section('page-subtitle', 'Perbarui informasi dokumen yang sudah ada.')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-2xl p-10 border border-slate-100 shadow-sm">
        <form action="{{ route('admin.dokumen.update', $dokumen->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf @method('PUT')
            
            <div>
                <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Judul Dokumen</label>
                <input type="text" name="judul" value="{{ old('judul', $dokumen->judul) }}" required class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm font-bold transition-all shadow-sm">
                @error('judul') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Deskripsi Singkat</label>
                <textarea name="deskripsi" rows="3" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">{{ old('deskripsi', $dokumen->deskripsi) }}</textarea>
                @error('deskripsi') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Kategori</label>
                    <select name="kategori_id" required class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm font-bold transition-all shadow-sm">
                        <option value="">Pilih Kategori</option>
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->id }}" {{ old('kategori_id', $dokumen->kategori_id) == $kat->id ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Tanggal Dokumen</label>
                    <input type="date" name="tanggal_upload" value="{{ old('tanggal_upload', $dokumen->tanggal_upload ?? date('Y-m-d')) }}" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm font-bold transition-all shadow-sm">
                    @error('tanggal_upload') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Ganti File (opsional)</label>
                <div class="group relative px-6 py-8 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center text-slate-400 hover:border-primary transition-all cursor-pointer" id="file-container">
                    <i data-lucide="upload-cloud" class="w-10 h-10 mb-3 group-hover:text-primary transition-colors"></i>
                    <p class="text-[10px] font-bold uppercase tracking-widest mb-1" id="file-name-label">{{ basename($dokumen->file) }}</p>
                    <p class="text-[9px] italic">Pilih file baru untuk mengganti (Format: PDF, DOC, DOCX, XLS, XLSX - Max 5MB)</p>
                    <input type="file" name="file" id="file-input" class="absolute inset-0 opacity-0 cursor-pointer z-10" accept=".pdf,.doc,.docx,.xls,.xlsx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                </div>

                <!-- Progress Indicator Bar -->
                <div id="upload-progress-box" class="hidden mt-3.5 p-3.5 bg-slate-50 border border-slate-200 rounded-xl space-y-1.5 transition-all">
                    <div class="flex items-center justify-between text-xs font-bold text-slate-700">
                        <span id="progress-status-text" class="flex items-center gap-1.5">
                            Memproses file...
                        </span>
                        <span id="progress-percent" class="font-extrabold text-blue-600">0%</span>
                    </div>
                    <div class="w-full bg-slate-200 h-2 rounded-full overflow-hidden">
                        <div id="progress-bar" class="bg-blue-600 h-full rounded-full transition-all duration-100 w-0"></div>
                    </div>
                </div>

                @error('file') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>

            <input type="hidden" name="status" value="{{ old('status', $dokumen->status) }}">

            <div class="flex gap-4 pt-4 border-t border-slate-50">
                <button type="submit" id="submit-btn" class="flex-1 py-4 bg-primary text-white font-bold rounded-xl hover:bg-blue-800 transition shadow-xl shadow-primary/20 flex items-center justify-center gap-3">
                    <i data-lucide="refresh-cw" class="w-5 h-5"></i>
                    Perbarui Dokumen
                </button>
                <a href="{{ route('admin.dokumen.index') }}" class="px-8 py-4 bg-white border border-slate-200 text-slate-500 font-bold rounded-xl hover:bg-slate-50 transition">Kembali</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    const fileInput = document.getElementById('file-input');
    const label = document.getElementById('file-name-label');
    const container = document.getElementById('file-container');
    const progressBox = document.getElementById('upload-progress-box');
    const progressBar = document.getElementById('progress-bar');
    const progressPercent = document.getElementById('progress-percent');
    const progressStatus = document.getElementById('progress-status-text');
    const submitBtn = document.getElementById('submit-btn');
    const originalFileName = @json(basename($dokumen->file));

    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;

        if (!validateFile(file, {
            type: 'document',
            allowedExtensions: ['pdf', 'doc', 'docx', 'xls', 'xlsx'],
            maxSizeMB: 5,
            inputElement: this,
            onReset: () => {
                label.textContent = originalFileName;
                label.classList.remove('text-primary');
                resetFileUploadProgress({
                    container,
                    progressBox,
                    progressBar,
                    progressPercent,
                    progressStatus,
                    submitBtn
                });
            }
        })) {
            return;
        }

        label.textContent = file.name;
        label.classList.add('text-primary');

        simulateFileUploadProgress({
            container,
            progressBox,
            progressBar,
            progressPercent,
            progressStatus,
            submitBtn
        });
    });
</script>
@endpush
@endsection

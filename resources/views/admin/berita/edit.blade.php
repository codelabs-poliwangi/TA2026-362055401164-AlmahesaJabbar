@extends('layouts.admin')
@section('title', 'Edit Berita')
@section('page-title', 'Edit Berita')
@section('page-subtitle', 'Perbarui konten artikel berita yang sudah ada.')

@section('content')
<form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Main Content --}}
        <div class="w-full lg:w-2/3 space-y-6">
            <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                <div class="mb-6">
                    <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Judul Berita</label>
                    <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}" required class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-base font-bold transition-all shadow-sm">
                    @error('judul') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Konten Berita</label>
                    <textarea name="isi" id="editor" rows="20" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">{{ old('isi', $berita->isi) }}</textarea>
                    @error('isi') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
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
                                <option value="{{ $kat->id }}" {{ old('kategori_id', $berita->kategori_id) == $kat->id ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                            @endforeach
                        </select>
                        @error('kategori_id') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Tanggal Publish</label>
                        <input type="date" name="tanggal_publish" value="{{ old('tanggal_publish', $berita->tanggal_publish ?? date('Y-m-d')) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">
                        @error('tanggal_publish') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Status</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="relative block cursor-pointer">
                                <input type="radio" name="status" value="published" {{ old('status', $berita->status) == 'published' ? 'checked' : '' }} class="peer sr-only">
                                <div class="px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-center text-sm font-bold text-slate-500 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all">Publish</div>
                            </label>
                            <label class="relative block cursor-pointer">
                                <input type="radio" name="status" value="draft" {{ old('status', $berita->status) == 'draft' ? 'checked' : '' }} class="peer sr-only">
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
                    <div class="aspect-video bg-slate-50 rounded-xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-slate-400 p-4 text-center group hover:border-primary transition-all cursor-pointer relative overflow-hidden" id="preview-container">
                        @if($berita->gambar)
                            <img src="{{ asset('storage/'.$berita->gambar) }}" id="preview-img" class="absolute inset-0 w-full h-full object-cover">
                        @else
                            <i data-lucide="image-plus" class="w-10 h-10 mb-2 group-hover:text-primary transition-colors"></i>
                            <img id="preview-img" class="absolute inset-0 w-full h-full object-cover hidden">
                        @endif
                        <p class="text-[10px] font-bold uppercase tracking-widest relative z-10 bg-black/50 text-white px-2 py-1 rounded">Ganti Gambar</p>
                        <input type="file" name="gambar" id="gambar-input" class="absolute inset-0 opacity-0 cursor-pointer z-20" accept="image/jpeg,image/png,image/jpg,image/webp">
                    </div>

                    <!-- Progress Indicator Bar -->
                    <div id="upload-progress-box" class="hidden p-3.5 bg-slate-50 border border-slate-200 rounded-xl space-y-1.5 transition-all">
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

                    @error('gambar') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" id="submit-btn" class="flex-1 py-4 bg-primary text-white font-bold rounded-xl hover:bg-blue-800 transition shadow-xl shadow-primary/20 flex items-center justify-center gap-3">
                    <i data-lucide="refresh-cw" class="w-5 h-5"></i>
                    Perbarui Berita
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
    const progressBox = document.getElementById('upload-progress-box');
    const progressBar = document.getElementById('progress-bar');
    const progressPercent = document.getElementById('progress-percent');
    const progressStatus = document.getElementById('progress-status-text');
    const submitBtn = document.getElementById('submit-btn');
    const hadOriginalImage = @json((bool)$berita->gambar);
    const originalImageSrc = hadOriginalImage ? @json(asset('storage/'.$berita->gambar)) : '';

    input.addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;

        if (!validateFile(file, {
            type: 'image',
            allowedExtensions: ['jpg', 'jpeg', 'png', 'webp'],
            maxSizeMB: 2,
            inputElement: this,
            onReset: () => {
                if (hadOriginalImage) {
                    preview.src = originalImageSrc;
                    preview.classList.remove('hidden');
                } else {
                    preview.src = '';
                    preview.classList.add('hidden');
                }
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

        // Open Image Cropper Modal
        openImageCropper({
            file: file,
            aspectRatio: 16 / 9,
            outputWidth: 1280,
            outputHeight: 720,
            frameLabel: '16:9 Landscape',
            title: 'Sesuaikan Gambar Berita',
            onCropped: (croppedFile, croppedDataUrl) => {
                const dt = new DataTransfer();
                dt.items.add(croppedFile);
                input.files = dt.files;

                preview.src = croppedDataUrl;
                preview.classList.remove('hidden');

                simulateFileUploadProgress({
                    container,
                    progressBox,
                    progressBar,
                    progressPercent,
                    progressStatus,
                    submitBtn
                });
            },
            onCancel: () => {
                input.value = '';
                if (hadOriginalImage) {
                    preview.src = originalImageSrc;
                    preview.classList.remove('hidden');
                } else {
                    preview.src = '';
                    preview.classList.add('hidden');
                }
                resetFileUploadProgress({
                    container,
                    progressBox,
                    progressBar,
                    progressPercent,
                    progressStatus,
                    submitBtn
                });
            }
        });
    });
</script>
@endpush
@endsection

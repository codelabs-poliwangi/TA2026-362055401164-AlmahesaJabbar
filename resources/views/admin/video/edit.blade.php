@extends('layouts.admin')
@section('title', 'Edit Video')
@section('page-title', 'Kelola Video')
@section('page-subtitle', 'Edit video kegiatan website')

@section('content')

<div class="mb-8">
    <a href="{{ route('admin.video.index') }}" class="inline-flex items-center gap-2 text-[14px] font-bold text-slate-500 hover:text-slate-800 transition">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        Kembali ke Daftar Video
    </a>
</div>

<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden max-w-4xl">
    <div class="px-8 py-6 border-b border-slate-50 bg-slate-50/50">
        <h2 class="font-display font-bold text-slate-900 text-lg">Form Edit Video</h2>
    </div>

    <form action="{{ route('admin.video.update', $video->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Judul Video --}}
            <div class="space-y-2 md:col-span-2">
                <label for="judul" class="text-[13px] font-bold text-slate-700 uppercase tracking-wider block">Judul Video</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $video->judul) }}" required placeholder="Masukkan judul video..."
                       class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-[14px] font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all shadow-sm @error('judul') border-red-500 @enderror">
                @error('judul')
                    <p class="text-[12px] text-red-500 font-bold mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Link Video URL --}}
            <div class="space-y-2 md:col-span-2">
                <label for="link_video" class="text-[13px] font-bold text-slate-700 uppercase tracking-wider block">Link URL Video</label>
                <input type="url" name="link_video" id="link_video" value="{{ old('link_video', $video->link_video) }}" required placeholder="https://www.instagram.com/reel/... atau https://www.youtube.com/watch?v=..."
                       class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-[14px] font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all shadow-sm @error('link_video') border-red-500 @enderror">
                @error('link_video')
                    <p class="text-[12px] text-red-500 font-bold mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Cover Image --}}
            <div class="space-y-2 md:col-span-2 grid grid-cols-1 md:grid-cols-4 gap-6 items-start">
                <div class="md:col-span-1 space-y-2">
                    <label class="text-[13px] font-bold text-slate-700 uppercase tracking-wider block">Cover Sekarang</label>
                    <div class="w-full aspect-video md:aspect-square bg-slate-100 rounded-2xl border border-slate-200 overflow-hidden relative shadow-sm flex items-center justify-center">
                        @if($video->gambar_cover)
                            <img src="{{ asset('storage/'.$video->gambar_cover) }}" class="w-full h-full object-cover" alt="">
                        @else
                            <i data-lucide="image" class="w-8 h-8 text-slate-300"></i>
                        @endif
                    </div>
                </div>
                <div class="md:col-span-3 space-y-2 pt-2 md:pt-6">
                    <label for="gambar_cover" class="text-[13px] font-bold text-slate-700 uppercase tracking-wider block">Ganti Cover Thumbnail (Opsional)</label>
                    <div class="p-4 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl transition-all" id="cover-container">
                        <input type="file" name="gambar_cover" id="gambar_cover" accept="image/jpeg,image/png,image/jpg,image/webp"
                               class="w-full text-[14px] font-medium text-slate-600 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[13px] file:font-semibold file:bg-blue-50 file:text-primary hover:file:bg-blue-100 cursor-pointer @error('gambar_cover') border-red-500 @enderror">
                        <p class="text-[11px] text-slate-400 font-medium mt-2">Format: JPG, JPEG, PNG, WEBP. Maks: 2MB. Kosongkan jika tidak ingin mengganti cover.</p>

                        <!-- Progress Indicator Bar -->
                        <div id="upload-progress-box" class="hidden mt-3 p-3 bg-white border border-slate-200 rounded-xl space-y-1.5 transition-all">
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
                    </div>
                    @error('gambar_cover')
                        <p class="text-[12px] text-red-500 font-bold mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Status --}}
            <div class="space-y-2 md:col-span-2 max-w-md">
                <label for="status" class="text-[13px] font-bold text-slate-700 uppercase tracking-wider block">Status Publikasi</label>
                <select name="status" id="status" required
                        class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-[14px] font-medium text-slate-700 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none shadow-sm @error('status') border-red-500 @enderror">
                    <option value="draft" {{ old('status', $video->status) == 'draft' ? 'selected' : '' }}>Draft (Sembunyikan)</option>
                    <option value="published" {{ old('status', $video->status) == 'published' ? 'selected' : '' }}>Published (Publikasikan)</option>
                </select>
                @error('status')
                    <p class="text-[12px] text-red-500 font-bold mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Submit Button --}}
        <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.video.index') }}" class="px-6 py-3.5 bg-white border border-slate-200 text-slate-500 text-[14px] font-bold rounded-xl hover:bg-slate-50 transition">Batal</a>
            <button type="submit" id="submit-btn" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-primary text-white text-[14px] font-bold rounded-xl hover:bg-blue-700 shadow-lg shadow-primary/20 transition-all">
                <i data-lucide="save" class="w-4 h-4"></i>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    const coverInput = document.getElementById('gambar_cover');
    const container = document.getElementById('cover-container');
    const progressBox = document.getElementById('upload-progress-box');
    const progressBar = document.getElementById('progress-bar');
    const progressPercent = document.getElementById('progress-percent');
    const progressStatus = document.getElementById('progress-status-text');
    const submitBtn = document.getElementById('submit-btn');

    if (coverInput) {
        coverInput.addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;

            if (!validateFile(file, {
                type: 'image',
                allowedExtensions: ['jpg', 'jpeg', 'png', 'webp'],
                maxSizeMB: 2,
                inputElement: this,
                onReset: () => {
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

            // Open Image Cropper Modal (16:9 for Video Thumbnails)
            openImageCropper({
                file: file,
                aspectRatio: 16 / 9,
                outputWidth: 1280,
                outputHeight: 720,
                frameLabel: '16:9 Thumbnail Video',
                title: 'Sesuaikan Cover Video',
                onCropped: (croppedFile, croppedDataUrl) => {
                    const dt = new DataTransfer();
                    dt.items.add(croppedFile);
                    coverInput.files = dt.files;

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
                    coverInput.value = '';
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
    }
</script>
@endpush
@endsection

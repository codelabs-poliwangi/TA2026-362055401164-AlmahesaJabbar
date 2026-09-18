@extends('layouts.admin')
@section('title', 'Edit Pimpinan')
@section('page-title', 'Edit Data Pimpinan')
@section('page-subtitle', 'Perbarui data pejabat atau pimpinan instansi Bakesbangpol.')

@section('content')
<form action="{{ route('admin.pimpinan.update', $pimpinan->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Main Content --}}
        <div class="w-full lg:w-2/3 space-y-6">
            <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                <h3 class="font-display font-bold text-slate-900 mb-6 text-lg border-b border-slate-50 pb-4">Informasi Pribadi & Jabatan</h3>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Nama Lengkap & Gelar</label>
                        <input type="text" name="nama" value="{{ old('nama', $pimpinan->nama) }}" required placeholder="Contoh: Drs. R. Agus Mulyono, M.Si." class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-base font-bold transition-all shadow-sm">
                        @error('nama') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Jabatan / Posisi</label>
                            <input type="text" name="jabatan" value="{{ old('jabatan', $pimpinan->jabatan) }}" required placeholder="Contoh: Kepala Badan / Bendahara" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm font-bold transition-all shadow-sm">
                            @error('jabatan') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Urutan Tampil</label>
                            <input type="number" name="urutan" value="{{ old('urutan', $pimpinan->urutan) }}" required min="1" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm font-bold transition-all shadow-sm">
                            <span class="text-[10px] text-slate-400 block mt-1.5 font-sans font-medium">*Menentukan prioritas tampil (misal: Kepala Badan urutan 1, Sekretaris 2, dst)</span>
                            @error('urutan') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Tugas Pokok & Fungsi (Tupoksi) Singkat</label>
                        <textarea name="tupoksi_singkat" rows="3" placeholder="Tulis ringkasan tugas pimpinan tersebut..." class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm font-medium transition-all shadow-sm">{{ old('tupoksi_singkat', $pimpinan->tupoksi_singkat) }}</textarea>
                        @error('tupoksi_singkat') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Daftar Anggota / Staf (Bisa Banyak Nama)</label>
                        <textarea name="anggota" rows="5" placeholder="Masukkan daftar nama anggota / staf. Tulis satu nama per baris (tekan Enter untuk memisahkan nama)&#10;Contoh:&#10;SITI MARYAM, S.E.&#10;NOVI KRISTINA SARI, S.E." class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm font-medium transition-all shadow-sm">{{ old('anggota', $pimpinan->anggota) }}</textarea>
                        <span class="text-[10px] text-slate-400 block mt-1.5 font-sans font-medium">*Tulis satu nama lengkap per baris. Tekan Enter untuk menuliskan nama staf berikutnya.</span>
                        @error('anggota') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Biografi Lengkap / Profil Singkat</label>
                        <textarea name="bio" id="editor" rows="10" placeholder="Tulis biodata lengkap pimpinan..." class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">{{ old('bio', $pimpinan->bio) }}</textarea>
                        @error('bio') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar Photo & Submit --}}
        <div class="w-full lg:w-1/3 space-y-6">
            <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                <h3 class="font-display font-bold text-slate-900 mb-6 text-lg border-b border-slate-50 pb-4">Foto Profil Resmi</h3>
                <div class="space-y-4">
                    <div class="aspect-square bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-slate-400 p-4 text-center group hover:border-primary transition-colors cursor-pointer relative overflow-hidden" id="preview-container">
                        @if($pimpinan->foto)
                            <i data-lucide="user-plus" class="w-12 h-12 mb-2 group-hover:text-primary transition-colors hidden"></i>
                            <p class="text-[10px] font-bold uppercase tracking-widest hidden">Klik untuk ganti foto</p>
                            <input type="file" name="foto" id="foto-input" class="absolute inset-0 opacity-0 cursor-pointer z-10" accept="image/jpeg,image/png,image/jpg,image/webp">
                            <img id="preview-img" src="{{ asset('storage/' . $pimpinan->foto) }}" class="absolute inset-0 w-full h-full object-cover">
                        @else
                            <i data-lucide="user-plus" class="w-12 h-12 mb-2 group-hover:text-primary transition-colors"></i>
                            <p class="text-[10px] font-bold uppercase tracking-widest">Klik untuk pilih foto</p>
                            <p class="text-[9px] mt-1 italic">Format: JPG, JPEG, PNG, WEBP (Max 2MB)</p>
                            <input type="file" name="foto" id="foto-input" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/jpeg,image/png,image/jpg,image/webp">
                            <img id="preview-img" class="absolute inset-0 w-full h-full object-cover hidden">
                        @endif
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

                    @error('foto') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" id="submit-btn" class="flex-1 py-4 bg-primary text-white font-bold rounded-xl hover:bg-blue-800 transition shadow-xl shadow-primary/20 flex items-center justify-center gap-3">
                    <i data-lucide="save" class="w-5 h-5"></i>
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.pimpinan.index') }}" class="px-6 py-4 bg-white border border-slate-200 text-slate-500 font-bold rounded-xl hover:bg-slate-50 transition">Batal</a>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    const input = document.getElementById('foto-input');
    const preview = document.getElementById('preview-img');
    const container = document.getElementById('preview-container');
    const progressBox = document.getElementById('upload-progress-box');
    const progressBar = document.getElementById('progress-bar');
    const progressPercent = document.getElementById('progress-percent');
    const progressStatus = document.getElementById('progress-status-text');
    const submitBtn = document.getElementById('submit-btn');
    const hadOriginalFoto = @json((bool)$pimpinan->foto);
    const originalFotoSrc = hadOriginalFoto ? @json(asset('storage/' . $pimpinan->foto)) : '';

    input.addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;

        if (!validateFile(file, {
            type: 'image',
            allowedExtensions: ['jpg', 'jpeg', 'png', 'webp'],
            maxSizeMB: 2,
            inputElement: this,
            onReset: () => {
                if (hadOriginalFoto) {
                    preview.src = originalFotoSrc;
                    preview.classList.remove('hidden');
                    const icons = container.querySelectorAll('i, p');
                    icons.forEach(el => el.classList.add('hidden'));
                } else {
                    preview.src = '';
                    preview.classList.add('hidden');
                    const icons = container.querySelectorAll('i, p');
                    icons.forEach(el => el.classList.remove('hidden'));
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

        // Open Image Cropper Modal (Aspect Ratio 3:4 for official portraits)
        openImageCropper({
            file: file,
            aspectRatio: 3 / 4,
            outputWidth: 600,
            outputHeight: 800,
            frameLabel: '3:4 Potret Resmi',
            title: 'Sesuaikan Foto Profil Pimpinan',
            onCropped: (croppedFile, croppedDataUrl) => {
                const dt = new DataTransfer();
                dt.items.add(croppedFile);
                input.files = dt.files;

                preview.src = croppedDataUrl;
                preview.classList.remove('hidden');
                const icons = container.querySelectorAll('i, p');
                icons.forEach(el => el.classList.add('hidden'));

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
                if (hadOriginalFoto) {
                    preview.src = originalFotoSrc;
                    preview.classList.remove('hidden');
                    const icons = container.querySelectorAll('i, p');
                    icons.forEach(el => el.classList.add('hidden'));
                } else {
                    preview.src = '';
                    preview.classList.add('hidden');
                    const icons = container.querySelectorAll('i, p');
                    icons.forEach(el => el.classList.remove('hidden'));
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

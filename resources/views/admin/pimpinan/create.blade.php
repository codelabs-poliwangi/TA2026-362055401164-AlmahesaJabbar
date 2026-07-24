@extends('layouts.admin')
@section('title', 'Tambah Pimpinan')
@section('page-title', 'Tambah Pimpinan Baru')
@section('page-subtitle', 'Daftarkan pejabat atau pimpinan baru untuk ditampilkan pada profil instansi.')

@section('content')
<form action="{{ route('admin.pimpinan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Main Content --}}
        <div class="w-full lg:w-2/3 space-y-6">
            <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                <h3 class="font-display font-bold text-slate-900 mb-6 text-lg border-b border-slate-50 pb-4">Informasi Pribadi & Jabatan</h3>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Nama Lengkap & Gelar</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required placeholder="Contoh: Drs. R. Agus Mulyono, M.Si." class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-base font-bold transition-all shadow-sm">
                        @error('nama') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Jabatan / Posisi</label>
                            <input type="text" name="jabatan" value="{{ old('jabatan') }}" required placeholder="Contoh: Kepala Badan / Bendahara" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm font-bold transition-all shadow-sm">
                            @error('jabatan') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Urutan Tampil</label>
                            <input type="number" name="urutan" value="{{ old('urutan', 1) }}" required min="1" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm font-bold transition-all shadow-sm">
                            <span class="text-[10px] text-slate-400 block mt-1.5 font-sans font-medium">*Menentukan prioritas tampil (misal: Kepala Badan urutan 1, Sekretaris 2, dst)</span>
                            @error('urutan') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Tugas Pokok & Fungsi (Tupoksi) Singkat</label>
                        <textarea name="tupoksi_singkat" rows="3" placeholder="Tulis ringkasan tugas pimpinan tersebut..." class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm font-medium transition-all shadow-sm">{{ old('tupoksi_singkat') }}</textarea>
                        @error('tupoksi_singkat') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Daftar Anggota / Staf (Bisa Banyak Nama)</label>
                        <textarea name="anggota" rows="5" placeholder="Masukkan daftar nama anggota / staf. Tulis satu nama per baris (tekan Enter untuk memisahkan nama)&#10;Contoh:&#10;SITI MARYAM, S.E.&#10;NOVI KRISTINA SARI, S.E." class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm font-medium transition-all shadow-sm">{{ old('anggota') }}</textarea>
                        <span class="text-[10px] text-slate-400 block mt-1.5 font-sans font-medium">*Tulis satu nama lengkap per baris. Tekan Enter untuk menuliskan nama staf berikutnya.</span>
                        @error('anggota') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Biografi Lengkap / Profil Singkat</label>
                        <textarea name="bio" id="editor" rows="10" placeholder="Tulis biodata lengkap pimpinan..." class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">{{ old('bio') }}</textarea>
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
                        <i data-lucide="user-plus" class="w-12 h-12 mb-2 group-hover:text-primary transition-colors"></i>
                        <p class="text-[10px] font-bold uppercase tracking-widest">Klik untuk pilih foto</p>
                        <p class="text-[9px] mt-1 italic">Format: JPG, JPEG, PNG, WEBP (Max 2MB)</p>
                        <input type="file" name="foto" id="foto-input" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*">
                        <img id="preview-img" class="absolute inset-0 w-full h-full object-cover hidden">
                    </div>
                    @error('foto') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="flex-1 py-4 bg-primary text-white font-bold rounded-xl hover:bg-blue-800 transition shadow-xl shadow-primary/20 flex items-center justify-center gap-3">
                    <i data-lucide="save" class="w-5 h-5"></i>
                    Simpan Pimpinan
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

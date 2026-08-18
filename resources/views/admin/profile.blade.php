@extends('layouts.admin')
@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')
@section('page-subtitle', 'Kelola informasi profil dan kata sandi Anda.')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Card 1: Informasi Profil -->
    <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm flex flex-col justify-between">
        <div>
            <div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-100">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-50 to-primary/10 border border-primary/10 flex items-center justify-center text-primary font-black text-2xl shadow-sm">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <h3 class="font-display font-bold text-slate-900 text-lg">Informasi Profil</h3>
                    <p class="text-slate-400 text-sm">Perbarui nama dan alamat email akun Anda.</p>
                </div>
            </div>
            
            <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm font-bold transition-all shadow-sm">
                    @error('name') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm font-bold transition-all shadow-sm">
                    @error('email') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
                <div class="pt-4 border-t border-slate-50">
                    <button type="submit" class="w-full py-4 bg-primary text-white font-bold rounded-xl hover:bg-blue-800 transition shadow-xl shadow-primary/20 flex items-center justify-center gap-3">
                        <i data-lucide="save" class="w-5 h-5"></i> Simpan Profil
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Card 2: Ubah Password -->
    <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm flex flex-col justify-between">
        <div>
            <div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-100">
                <div class="w-16 h-16 rounded-2xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 font-bold text-2xl shadow-sm">
                    <i data-lucide="key-round" class="w-8 h-8"></i>
                </div>
                <div>
                    <h3 class="font-display font-bold text-slate-900 text-lg">Ubah Kata Sandi</h3>
                    <p class="text-slate-400 text-sm">Pastikan akun Anda menggunakan kata sandi yang kuat.</p>
                </div>
            </div>

            <form action="{{ route('admin.profile.password') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Password Saat Ini</label>
                    <div class="relative">
                        <input type="password" id="current_password" name="current_password" required class="w-full px-6 pr-12 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">
                        <button type="button" onclick="togglePasswordVisibility('current_password', 'current_password_icon')" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none">
                            <i id="current_password_icon" data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                    @error('current_password') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Password Baru</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required class="w-full px-6 pr-12 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">
                        <button type="button" onclick="togglePasswordVisibility('password', 'password_icon')" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none">
                            <i id="password_icon" data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                    <p class="text-[11.5px] text-slate-500 font-medium mt-2.5 flex items-start gap-1.5 leading-relaxed bg-amber-50/50 border border-amber-100/50 p-3.5 rounded-xl">
                        <i data-lucide="info" class="w-4 h-4 text-amber-600 flex-shrink-0 mt-0.5"></i>
                        <span>Gunakan minimal 6 karakter dengan kombinasi <strong>angka</strong> dan <strong>simbol</strong> (seperti @, #, $, dll.) agar kata sandi lebih kuat dan aman.</span>
                    </p>
                    @error('password') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Konfirmasi Password Baru</label>
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full px-6 pr-12 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">
                        <button type="button" onclick="togglePasswordVisibility('password_confirmation', 'password_confirmation_icon')" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none">
                            <i id="password_confirmation_icon" data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
                <div class="pt-4 border-t border-slate-50">
                    <button type="submit" class="w-full py-4 bg-amber-500 text-white font-bold rounded-xl hover:bg-amber-600 transition shadow-xl shadow-amber-500/20 flex items-center justify-center gap-3">
                        <i data-lucide="lock" class="w-5 h-5"></i> Ubah Kata Sandi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function togglePasswordVisibility(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.setAttribute('data-lucide', 'eye-off');
        } else {
            input.type = 'password';
            icon.setAttribute('data-lucide', 'eye');
        }
        
        // Re-initialize Lucide icons for the updated icon element
        lucide.createIcons();
    }
</script>
@endpush
@endsection

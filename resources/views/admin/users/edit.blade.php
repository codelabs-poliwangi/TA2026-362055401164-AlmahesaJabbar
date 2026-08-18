@extends('layouts.admin')
@section('title', 'Edit Admin')
@section('page-title', 'Edit Pengguna')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="bg-white rounded-2xl p-10 border border-slate-100 shadow-sm">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
            @csrf @method('PUT')
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
            <div>
                <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Password Baru <span class="font-normal normal-case italic">(kosongkan jika tidak ingin mengganti)</span></label>
                <div class="relative">
                    <input type="password" id="password" name="password" class="w-full px-6 pr-12 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">
                    <button type="button" onclick="togglePasswordVisibility('password', 'password_icon')" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none">
                        <i id="password_icon" data-lucide="eye" class="w-5 h-5"></i>
                    </button>
                </div>
                <p class="text-[11.5px] text-slate-500 font-medium mt-2.5 flex items-start gap-1.5 leading-relaxed bg-amber-50/50 border border-amber-100/50 p-3.5 rounded-xl">
                    <i data-lucide="info" class="w-4 h-4 text-amber-600 flex-shrink-0 mt-0.5"></i>
                    <span>Jika diisi, gunakan minimal 6 karakter dengan kombinasi <strong>angka</strong> dan <strong>simbol</strong> (seperti @, #, $, dll.) agar kata sandi lebih kuat dan aman.</span>
                </p>
                @error('password') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Konfirmasi Password Baru</label>
                <div class="relative">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-6 pr-12 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">
                    <button type="button" onclick="togglePasswordVisibility('password_confirmation', 'password_confirmation_icon')" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none">
                        <i id="password_confirmation_icon" data-lucide="eye" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>
            <div class="flex gap-4 pt-4 border-t border-slate-50">
                <button type="submit" class="flex-1 py-4 bg-primary text-white font-bold rounded-xl hover:bg-blue-800 transition shadow-xl shadow-primary/20 flex items-center justify-center gap-3">
                    <i data-lucide="refresh-cw" class="w-5 h-5"></i> Perbarui
                </button>
                <a href="{{ route('admin.users.index') }}" class="px-8 py-4 bg-white border border-slate-200 text-slate-500 font-bold rounded-xl hover:bg-slate-50 transition">Batal</a>
            </div>
        </form>
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
        
        // Re-initialize Lucide icons
        lucide.createIcons();
    }
</script>
@endpush
@endsection

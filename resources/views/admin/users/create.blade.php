@extends('layouts.admin')
@section('title', 'Tambah Admin')
@section('page-title', 'Tambah Admin Baru')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="bg-white rounded-2xl p-10 border border-slate-100 shadow-sm">
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm font-bold transition-all shadow-sm">
                @error('name') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm font-bold transition-all shadow-sm">
                @error('email') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Password</label>
                <input type="password" name="password" required class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">
                @error('password') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">
            </div>
            <input type="hidden" name="role" value="admin">
            <div class="flex gap-4 pt-4 border-t border-slate-50">
                <button type="submit" class="flex-1 py-4 bg-primary text-white font-bold rounded-xl hover:bg-blue-800 transition shadow-xl shadow-primary/20 flex items-center justify-center gap-3">
                    <i data-lucide="user-plus" class="w-5 h-5"></i> Simpan
                </button>
                <a href="{{ route('admin.users.index') }}" class="px-8 py-4 bg-white border border-slate-200 text-slate-500 font-bold rounded-xl hover:bg-slate-50 transition">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

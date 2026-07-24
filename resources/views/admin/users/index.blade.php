@extends('layouts.admin')
@section('title', 'Kelola Pengguna')
@section('page-title', 'Pengguna')
@section('page-subtitle', 'Kelola akun administrator sistem.')

@section('content')
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex justify-between items-center">
        <h3 class="font-display font-bold text-slate-900 text-lg">Daftar Admin</h3>
        <a href="{{ route('admin.users.create') }}" class="px-6 py-3 bg-primary text-white font-bold rounded-xl hover:bg-blue-800 transition shadow-lg shadow-primary/20 flex items-center gap-2 text-sm">
            <i data-lucide="user-plus" class="w-4 h-4"></i> Tambah Admin
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-900 font-display font-bold text-sm uppercase tracking-wider">
                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Terdaftar</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($users as $user)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-6 py-5 text-sm text-slate-500 font-medium">{{ $loop->iteration }}</td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-sm flex-shrink-0">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <span class="text-sm font-bold text-slate-900">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-sm text-slate-500">{{ $user->email }}</td>
                    <td class="px-6 py-5 text-sm text-slate-400">{{ $user->created_at->format('d/m/Y') }}</td>
                    <td class="px-6 py-5">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="w-9 h-9 flex items-center justify-center rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white transition shadow-sm border border-amber-100">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </a>
                            @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition shadow-sm border border-red-100">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

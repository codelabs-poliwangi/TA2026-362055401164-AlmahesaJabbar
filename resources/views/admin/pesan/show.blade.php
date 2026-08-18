@extends('layouts.admin')
@section('title', 'Detail Pesan Masuk')
@section('page-title', 'Detail Pesan')
@section('page-subtitle', 'Melihat detail isi pesan masuk dari pengunjung')

@section('content')

<div class="mb-8 flex items-center justify-between">
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.pesan.index') }}" class="w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 flex items-center justify-center transition-colors shadow-sm" title="Kembali ke Daftar">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h2 class="font-display font-bold text-slate-900 text-xl leading-tight">Detail Pesan Masuk</h2>
            <p class="text-xs text-slate-500 font-medium">Oleh: {{ $pesan->nama }}</p>
        </div>
    </div>
    <form action="{{ route('admin.pesan.destroy', $pesan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-red-50 text-red-600 border border-red-200 hover:bg-red-500 hover:text-white text-[14px] font-bold rounded-xl shadow-sm hover:border-red-500 transition-colors">
            <i data-lucide="trash-2" class="w-4 h-4"></i>
            Hapus Pesan
        </button>
    </form>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    {{-- Message Body --}}
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 md:p-8">
            <div class="mb-6 pb-6 border-b border-slate-100">
                <span class="text-[11px] font-extrabold text-slate-400 uppercase tracking-widest block mb-2">Subjek Pesan</span>
                <h3 class="font-display font-extrabold text-slate-900 text-xl leading-snug">{{ $pesan->subjek }}</h3>
            </div>
            
            <div>
                <span class="text-[11px] font-extrabold text-slate-400 uppercase tracking-widest block mb-3">Isi Pesan</span>
                <div class="bg-slate-50/50 rounded-2xl p-6 border border-slate-100/50 text-[14px] text-slate-700 leading-relaxed whitespace-pre-line font-medium min-h-[200px]">
                    {{ $pesan->pesan }}
                </div>
            </div>
        </div>
    </div>

    {{-- Sender Meta Info --}}
    <div class="space-y-6">
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 md:p-8">
            <h4 class="font-display font-bold text-slate-950 text-[15px] border-b border-slate-100 pb-4 mb-5 flex items-center gap-2">
                <i data-lucide="info" class="w-4.5 h-4.5 text-primary"></i>
                Informasi Pengirim
            </h4>
            
            <div class="space-y-6">
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Nama Lengkap</span>
                    <div class="font-bold text-slate-800 text-[14px] flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-primary flex items-center justify-center font-bold text-[13px] flex-shrink-0">
                            {{ strtoupper(substr($pesan->nama, 0, 1)) }}
                        </div>
                        <span>{{ $pesan->nama }}</span>
                    </div>
                </div>
                
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Alamat Email</span>
                    <a href="mailto:{{ $pesan->email }}" class="font-bold text-primary text-[14px] hover:underline flex items-center gap-1.5 break-all">
                        <i data-lucide="mail" class="w-4 h-4 text-slate-400 flex-shrink-0"></i>
                        <span>{{ $pesan->email }}</span>
                    </a>
                </div>
                
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Dikirim Pada</span>
                    <div class="font-semibold text-slate-700 text-[13.5px] flex items-center gap-2">
                        <i data-lucide="clock" class="w-4 h-4 text-slate-400 flex-shrink-0"></i>
                        <span>{{ $pesan->created_at->translatedFormat('d F Y, H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

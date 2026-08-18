@extends('layouts.app')

@section('title', 'Hubungi Kami - Bakesbangpol Kabupaten Banyuwangi')

@section('content')
<!-- Page Header -->
<section class="pt-32 pb-20 bg-slate-900 relative overflow-hidden">
    <div class="absolute inset-0 bg-primary/20 z-0"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-display font-extrabold text-white mb-4">Kontak Kami</h1>
        <nav class="flex justify-center text-slate-400 text-sm font-medium">
            <a href="{{ route('beranda') }}" class="hover:text-white">Beranda</a>
            <span class="mx-3">/</span>
            <span class="text-secondary">Kontak</span>
        </nav>
    </div>
</section>

<!-- Contact Section -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-16">
            <!-- Contact Info -->
            <div class="w-full lg:w-1/3">
                <h2 class="text-3xl font-display font-extrabold text-slate-900 mb-8">Informasi Kontak</h2>
                <p class="text-slate-500 mb-12 leading-relaxed">
                    Kami siap melayani Anda. Silahkan hubungi kami melalui saluran informasi resmi berikut atau kunjungi kantor kami pada jam kerja.
                </p>
                
                <div class="space-y-10">
                    <div class="flex gap-6">
                        <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <i data-lucide="map-pin" class="w-7 h-7 text-primary"></i>
                        </div>
                        <div>
                            <h4 class="font-display font-bold text-slate-900 mb-2">Lokasi Kantor</h4>
                            <p class="text-sm text-slate-500 leading-relaxed">Jl. K.H. Agus Salim, Taman Baru, Kec. Banyuwangi, Kabupaten Banyuwangi, Jawa Timur 68416</p>
                        </div>
                    </div>
                    <div class="flex gap-6">
                        <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <i data-lucide="phone" class="w-7 h-7 text-primary"></i>
                        </div>
                        <div>
                            <h4 class="font-display font-bold text-slate-900 mb-2">Telepon / Fax</h4>
                            <p class="text-sm text-slate-500 leading-relaxed">(0333) 425119</p>
                        </div>
                    </div>
                    <div class="flex gap-6">
                        <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <i data-lucide="mail" class="w-7 h-7 text-primary"></i>
                        </div>
                        <div>
                            <h4 class="font-display font-bold text-slate-900 mb-2">Email Resmi</h4>
                            <p class="text-sm text-slate-500 leading-relaxed">kesbangpol.bwi@gmail.com</p>
                        </div>
                    </div>
                    <div class="flex gap-6">
                        <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <i data-lucide="clock" class="w-7 h-7 text-primary"></i>
                        </div>
                        <div>
                            <h4 class="font-display font-bold text-slate-900 mb-2">Jam Kerja</h4>
                            <p class="text-sm text-slate-500 leading-relaxed">Senin - Kamis: 07:30 - 16:00<br>Jumat: 07:30 - 15:30</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="w-full lg:w-2/3">
                <div class="bg-slate-50 rounded-3xl p-10 border border-slate-100 shadow-sm">
                    <h3 class="text-2xl font-display font-extrabold text-slate-900 mb-8">Kirim Pesan</h3>
                    
                    @if(session('success'))
                        <div class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-2xl shadow-sm">
                            <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
                            <span class="text-[14px] font-semibold">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('kontak.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Nama Lengkap</label>
                                <input type="text" name="nama" value="{{ old('nama') }}" required placeholder="Masukkan nama Anda" class="w-full px-6 py-4 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">
                                @error('nama') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" required placeholder="Masukkan email aktif" class="w-full px-6 py-4 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">
                                @error('email') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Subjek</label>
                            <input type="text" name="subjek" value="{{ old('subjek') }}" required placeholder="Apa perihal pesan Anda?" class="w-full px-6 py-4 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">
                            @error('subjek') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Pesan</label>
                            <textarea name="pesan" rows="6" required placeholder="Tuliskan pesan Anda di sini..." class="w-full px-6 py-4 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">{{ old('pesan') }}</textarea>
                            @error('pesan') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                        </div>
                        <button type="submit" class="w-full md:w-fit px-12 py-5 bg-primary text-white font-bold rounded-xl hover:bg-blue-800 transition shadow-xl shadow-primary/20 flex items-center justify-center">
                            Kirim Pesan <i data-lucide="send" class="ml-3 w-5 h-5"></i>
                        </button>
                    </form>
                </div>
                
                <!-- Map Section -->
                <div class="mt-12 aspect-[21/9] rounded-3xl overflow-hidden shadow-md border border-slate-100">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.179374023249!2d114.35208982468303!3d-8.220413982167448!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd15bbec3c85391%3A0x3dae9a6bc9d6fe22!2sKesbangpol+banyuwangi!5e0!3m2!1sid!2sid!4v1723293300000!5m2!1sid!2sid" class="w-full h-full border-0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

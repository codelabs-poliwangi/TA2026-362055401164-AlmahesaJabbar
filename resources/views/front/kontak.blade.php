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
                    <form action="#" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Nama Lengkap</label>
                                <input type="text" placeholder="Masukkan nama Anda" class="w-full px-6 py-4 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Email</label>
                                <input type="email" placeholder="Masukkan email aktif" class="w-full px-6 py-4 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Subjek</label>
                            <input type="text" placeholder="Apa perihal pesan Anda?" class="w-full px-6 py-4 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">Pesan</label>
                            <textarea rows="6" placeholder="Tuliskan pesan Anda di sini..." class="w-full px-6 py-4 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all shadow-sm"></textarea>
                        </div>
                        <button type="submit" class="w-full md:w-fit px-12 py-5 bg-primary text-white font-bold rounded-xl hover:bg-blue-800 transition shadow-xl shadow-primary/20 flex items-center justify-center">
                            Kirim Pesan <i data-lucide="send" class="ml-3 w-5 h-5"></i>
                        </button>
                    </form>
                </div>
                
                <!-- Map Placeholder -->
                <div class="mt-12 aspect-[21/9] bg-slate-200 rounded-3xl overflow-hidden shadow-inner grayscale opacity-60">
                    <div class="w-full h-full flex items-center justify-center text-slate-400">
                        <i data-lucide="map" class="w-12 h-12"></i>
                        <span class="ml-4 font-bold uppercase tracking-widest text-sm">Google Maps Bakesbangpol Banyuwangi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

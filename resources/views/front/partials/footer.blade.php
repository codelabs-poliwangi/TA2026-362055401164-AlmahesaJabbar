<footer class="bg-[#0a1c36] text-slate-400 pt-16 pb-8 border-t border-slate-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-16">

            {{-- Col 1: Brand & Socials --}}
            <div class="space-y-6">
                <a href="{{ route('beranda') }}" class="flex items-center gap-3 group">
                    <picture>
                        <source srcset="{{ asset('assets/img/logo/logo_banyuwangi.webp') }}" type="image/webp">
                        <img src="{{ asset('assets/img/logo/logo_banyuwangi.png') }}" alt="Logo Kabupaten Banyuwangi"
                            width="32" height="40"
                            loading="lazy"
                            decoding="async"
                            class="w-8 h-10 object-contain">
                    </picture>
                    <div class="flex flex-col leading-tight">
                        <span
                            class="font-display font-black text-[13px] tracking-wider text-white leading-none">BAKESBANGPOL</span>
                        <span
                            class="font-display font-bold text-[10px] tracking-widest text-slate-400 uppercase leading-none mt-1">KABUPATEN
                            BANYUWANGI</span>
                    </div>
                </a>
                <p class="text-[12.5px] text-slate-400 leading-relaxed font-sans font-medium">
                    Badan Kesatuan Bangsa dan Politik Kabupaten Banyuwangi berkomitmen mewujudkan masyarakat yang rukun,
                    aman, dan sejahtera.
                </p>
                <div class="flex items-center gap-3 pt-2">
                    {{-- Facebook --}}
                    <a href="https://www.facebook.com/profile.php?id=61579344050332" target="_blank"
                        class="w-8 h-8 rounded-full border border-slate-600 flex items-center justify-center text-slate-400 hover:bg-[#1877F2] hover:border-[#1877F2] hover:text-white hover:scale-110 transition-all duration-300"
                        title="Facebook">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    {{-- Instagram --}}
                    <a href="https://www.instagram.com/bakesbangpol_banyuwangi?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank"
                        class="w-8 h-8 rounded-full border border-slate-600 flex items-center justify-center text-slate-400 hover:bg-gradient-to-tr hover:from-[#f9ce34] hover:via-[#ee2a7b] hover:to-[#6228d7] hover:border-transparent hover:text-white hover:scale-110 transition-all duration-300"
                        title="Instagram">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 0C8.74 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.74 0 12s.014 3.667.072 4.947c.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072s3.667-.014 4.947-.072c4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.26-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.26 0 12 0zm0 5.838a6.162 6.162 0 110 12.324 6.162 6.162 0 010-12.324zM12 16a4 4 0 100-8 4 4 0 000 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                        </svg>
                    </a>
                    {{-- YouTube --}}
                    <a href="https://www.youtube.com/@BakesbangpolBanyuwangi" target="_blank"
                        class="w-8 h-8 rounded-full border border-slate-600 flex items-center justify-center text-slate-400 hover:bg-[#FF0000] hover:border-[#FF0000] hover:text-white hover:scale-110 transition-all duration-300"
                        title="YouTube">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M23.498 6.163a3.003 3.003 0 00-2.11-2.107C19.518 3.545 12 3.545 12 3.545s-7.518 0-9.388.511a3.002 3.002 0 00-2.11 2.107C0 8.033 0 12 0 12s0 3.967.502 5.837a3.002 3.002 0 002.11 2.107C4.482 20.455 12 20.455 12 20.455s7.518 0 9.388-.511a3.002 3.002 0 002.11-2.107C24 15.967 24 12 24 12s0-3.967-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Col 2: Tautan Cepat --}}
            <div>
                <h3
                    class="font-display font-black text-white text-[13px] tracking-wider uppercase mb-6 pb-2 border-b border-slate-800 inline-block">
                    Tautan Cepat</h3>
                <ul class="space-y-3 text-[12.5px] font-sans font-medium">
                    <li><a href="{{ route('beranda') }}" class="hover:text-white transition">Beranda</a></li>
                    <li><a href="{{ route('profil') }}" class="hover:text-white transition">Profil</a></li>
                    <li><a href="#" class="hover:text-white transition">Informasi Publik</a></li>
                    <li><a href="{{ route('publikasi') }}" class="hover:text-white transition">Publikasi</a></li>
                    <li><a href="{{ route('dokumen') }}" class="hover:text-white transition">Dokumen PPID</a></li>
                    <li><a href="{{ route('kontak') }}" class="hover:text-white transition">Kontak</a></li>
                </ul>
            </div>

            {{-- Col 3: Layanan --}}
            <div>
                <h3
                    class="font-display font-black text-white text-[13px] tracking-wider uppercase mb-6 pb-2 border-b border-slate-800 inline-block">
                    Layanan</h3>
                <ul class="space-y-3 text-[12.5px] font-sans font-medium">
                    <li><a href="#" class="hover:text-white transition">Permohonan Informasi</a></li>
                    <li><a href="#" class="hover:text-white transition">Pengaduan Masyarakat</a></li>
                    <li><a href="#" class="hover:text-white transition">Download Formulir</a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-white transition">FAQ</a></li>
                </ul>
            </div>

            {{-- Col 4: Kontak Kami --}}
            <div class="space-y-4">
                <h3
                    class="font-display font-black text-white text-[13px] tracking-wider uppercase mb-6 pb-2 border-b border-slate-800 inline-block">
                    Kontak Kami</h3>
                <ul class="space-y-4 text-[12.5px] font-sans font-medium">
                    <li class="flex items-start gap-3">
                        <i data-lucide="map-pin" class="w-4 h-4 text-slate-400 mt-1 flex-shrink-0"></i>
                        <span class="leading-relaxed">Jl. Letkol Istiqlah No. 109<br>Banyuwangi, Jawa Timur 68416</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i data-lucide="phone" class="w-4 h-4 text-slate-400 flex-shrink-0"></i>
                        <span>(0333) 424 893</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i data-lucide="mail" class="w-4 h-4 text-slate-400 flex-shrink-0"></i>
                        <a href="mailto:bakesbangpol@banyuwangikab.go.id"
                            class="hover:text-white transition">bakesbangpol@banyuwangikab.go.id</a>
                    </li>
                    <li class="flex items-center gap-3">
                        <i data-lucide="clock" class="w-4 h-4 text-slate-400 flex-shrink-0"></i>
                        <span>Senin - Jumat, 08.00 - 16.00 WIB</span>
                    </li>
                </ul>
            </div>

        </div>

        {{-- Bottom bar --}}
        <div class="pt-8 border-t border-slate-900/50 text-center">
            <p class="text-[12px] text-slate-500 font-sans font-medium">
                &copy; 2024 Bakesbangpol Kabupaten Banyuwangi. All rights reserved.
            </p>
        </div>
    </div>
</footer>

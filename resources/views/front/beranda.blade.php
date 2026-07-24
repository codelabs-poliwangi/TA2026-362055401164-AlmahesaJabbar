@extends('layouts.app')

@section('title', 'Beranda - Bakesbangpol Kabupaten Banyuwangi')

@section('content')

    {{-- =============================================
     HERO SECTION
     ============================================= --}}
    <section class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-start gap-10">

                {{-- Left: Text --}}
                <div class="w-full lg:w-1/2 pt-4">
                    <p class="text-[11px] font-semibold tracking-widest uppercase text-slate-700 leading-snug mb-4">
                        Badan Kesatuan Bangsa dan Politik<br>Kabupaten Banyuwangi
                    </p>
                    <h1 class="font-display font-extrabold text-slate-950 leading-[1.05] mb-5"
                        style="font-size: clamp(2.5rem, 5vw, 3.75rem);">
                        Digitalisasi untuk Demokrasi yang Kondusif
                    </h1>
                    <p class="text-sm text-slate-600 leading-relaxed max-w-sm">
                        Mewujudkan Banyuwangi yang berkarakter, demokratis,dan harmonis dalam bingkai Bhinneka Tunggal Ika.
                    </p>
                </div>

                {{-- Right: Hero Image Slider --}}
                <div class="w-full lg:w-1/2">
                    <div class="aspect-square bg-slate-200 rounded-2xl overflow-hidden relative shadow-lg border border-slate-100 group/slider">
                        
                        {{-- Slides --}}
                        <div id="hero-slider" class="w-full h-full relative">
                            <!-- Slide 1 -->
                            <div class="slide absolute inset-0 opacity-100 transition-opacity duration-1000 ease-in-out">
                                <img src="{{ asset('assets/img/hero-section.png') }}" alt="Bakesbangpol Banyuwangi 1"
                                    class="w-full h-full object-cover">
                            </div>
                            <!-- Slide 2 -->
                            <div class="slide absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out">
                                <img src="https://images.unsplash.com/photo-1541807084-5c52b6b3adef?auto=format&fit=crop&w=800&q=80" alt="Bakesbangpol Banyuwangi 2"
                                    class="w-full h-full object-cover">
                            </div>
                            <!-- Slide 3 -->
                            <div class="slide absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out">
                                <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=800&q=80" alt="Bakesbangpol Banyuwangi 3"
                                    class="w-full h-full object-cover">
                            </div>
                            <!-- Slide 4 -->
                            <div class="slide absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out">
                                <img src="https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?auto=format&fit=crop&w=800&q=80" alt="Bakesbangpol Banyuwangi 4"
                                    class="w-full h-full object-cover">
                            </div>
                            <!-- Slide 5 -->
                            <div class="slide absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out">
                                <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=800&q=80" alt="Bakesbangpol Banyuwangi 5"
                                    class="w-full h-full object-cover">
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- =============================================
     FONDASI STRATEGIS
     ============================================= --}}
    <section class="py-20 bg-slate-50/70 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                
                {{-- Left Column: Title & Text --}}
                <div class="lg:col-span-4 space-y-5 lg:sticky lg:top-24">
                    <span class="bg-primary/10 text-primary text-[11px] font-extrabold uppercase tracking-widest px-3 py-1 rounded-full">
                        Fondasi Strategis
                    </span>
                    <h2 class="font-display font-bold text-slate-900 text-3xl leading-snug">
                        Fondasi Strategis
                    </h2>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Pilar utama yang menjadi panduan arah transformasi, visi, misi, serta komitmen pelayanan prima Badan Kesatuan Bangsa dan Politik Kabupaten Banyuwangi.
                    </p>
                </div>

                {{-- Right Column: Cards --}}
                <div class="lg:col-span-8 flex flex-col gap-6">
                    
                    {{-- Visi Card (Full Width inside Right Column) --}}
                    <div class="bg-white rounded-2xl border-l-4 border-l-[#F9B115] border-y border-r border-slate-100 shadow-sm px-8 py-6 flex flex-col md:flex-row gap-5 items-start transition-all duration-300 hover:shadow-md">
                        <div class="w-12 h-12 rounded-xl bg-blue-50/70 text-primary flex items-center justify-center shrink-0 border border-blue-100/50">
                            <i data-lucide="eye" class="w-6 h-6 text-primary"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-display font-bold text-slate-900 text-[18px] mb-1.5">Visi</h3>
                            <p class="text-[14.5px] text-slate-700 leading-relaxed font-semibold">
                                “Mewujudkan Banyuwangi yang MAJU, SEJAHTERA dan BERKAH untuk SEMUA”
                            </p>
                        </div>
                    </div>

                    {{-- Grid of 4 Cards --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Misi 1 --}}
                        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col gap-4 items-start transition-all duration-300 hover:shadow-md">
                            <div class="w-10 h-10 rounded-lg bg-blue-50/70 text-primary flex items-center justify-center shrink-0 border border-blue-100/50">
                                <i data-lucide="trending-up" class="w-5 h-5 text-primary"></i>
                            </div>
                            <div>
                                <h4 class="font-display font-bold text-slate-900 text-[15px] leading-tight mb-2">Pertumbuhan Ekonomi</h4>
                                <p class="text-[13.5px] text-slate-600 leading-relaxed">
                                    “Mewujudkan Pertumbuhan Ekonomi Kabupaten Banyuwangi yang Mandiri dan Berkelanjutan”
                                </p>
                            </div>
                        </div>

                        {{-- Misi 2 --}}
                        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col gap-4 items-start transition-all duration-300 hover:shadow-md">
                            <div class="w-10 h-10 rounded-lg bg-blue-50/70 text-primary flex items-center justify-center shrink-0 border border-blue-100/50">
                                <i data-lucide="scale" class="w-5 h-5 text-primary"></i>
                            </div>
                            <div>
                                <h4 class="font-display font-bold text-slate-900 text-[15px] leading-tight mb-2">Kesejahteraan Sosial</h4>
                                <p class="text-[13.5px] text-slate-600 leading-relaxed">
                                    “Mewujudkan Kesejahteraan Sosial yang Berkeadilan”
                                </p>
                            </div>
                        </div>

                        {{-- Maklumat 1 --}}
                        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col gap-4 items-start transition-all duration-300 hover:shadow-md">
                            <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 border border-emerald-100">
                                <i data-lucide="shield-check" class="w-5 h-5 text-emerald-600"></i>
                            </div>
                            <div>
                                <h4 class="font-display font-bold text-slate-900 text-[15px] leading-tight mb-2">Komitmen Pelayanan</h4>
                                <p class="text-[13.5px] text-slate-600 leading-relaxed">
                                    “Kami berjanji dan sanggup untuk melaksanakan pelayanan sesuai dengan standar pelayanan serta memberikan pelayanan sesuai kewajiban dan akan melakukan perbaikan secara terus-menerus.”
                                </p>
                            </div>
                        </div>

                        {{-- Maklumat 2 --}}
                        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col gap-4 items-start transition-all duration-300 hover:shadow-md">
                            <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 border border-emerald-100">
                                <i data-lucide="award" class="w-5 h-5 text-emerald-600"></i>
                            </div>
                            <div>
                                <h4 class="font-display font-bold text-slate-900 text-[15px] leading-tight mb-2">Tanggung Jawab & Kompensasi</h4>
                                <p class="text-[13.5px] text-slate-600 leading-relaxed">
                                    “Kami bersedia untuk menerima sanksi, dan/atau memberikan kompensasi apabila pelayanan yang diberikan tidak sesuai dengan standar.”
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    {{-- =============================================
     KABAR TERBARU & VIDEO
     ============================================= --}}
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                {{-- Left: Kabar Terbaru --}}
                <div>
                    {{-- Header --}}
                    <div class="mb-1">
                        <h2 class="font-display font-bold text-slate-950 text-2xl">Kabar Terbaru</h2>
                        <p class="text-[13px] text-slate-600 mt-0.5">
                            Informasi dan Publikasi terkini seputar Bakesbangpol Kabupaten Banyuwangi.
                        </p>
                    </div>
                    {{-- Lihat Semua right-aligned --}}
                    <div class="flex justify-end mb-2">
                        <a href="{{ route('publikasi') }}"
                            class="text-[13px] text-slate-800 font-medium hover:text-primary flex items-center gap-1">
                            Lihat Semua <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                    {{-- Image / Article --}}
                    @forelse($beritaTerbaru->take(1) as $berita)
                        <a href="{{ route('publikasi.show', $berita->slug) }}" class="block group">
                            <div class="w-full bg-slate-200 rounded overflow-hidden" style="aspect-ratio:4/3;">
                                @if ($berita->gambar)
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-slate-200">
                                        <i data-lucide="image" class="w-10 h-10 text-slate-400"></i>
                                    </div>
                                @endif
                            </div>
                        </a>
                    @empty
                        <div class="w-full bg-slate-100 rounded flex items-center justify-center text-slate-400 text-sm italic border border-dashed border-slate-300"
                            style="aspect-ratio:4/3;">
                            Belum ada kabar terbaru.
                        </div>
                    @endforelse
                </div>

                {{-- Right: Video --}}
                <div>
                    {{-- Header --}}
                    <div class="mb-1">
                        <h2 class="font-display font-bold text-slate-950 text-2xl">Video</h2>
                        <p class="text-[13px] text-slate-600 mt-0.5">
                            Informasi dan Publikasi terkini seputar Bakesbangpol Kabupaten Banyuwangi.
                        </p>
                    </div>
                    {{-- Lihat Semua right-aligned --}}
                    <div class="flex justify-end mb-2">
                        <a href="https://www.instagram.com/bakesbangpolbanyuwangi/" target="_blank"
                            class="text-[13px] text-slate-800 font-medium hover:text-primary flex items-center gap-1">
                            Lihat Semua <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                    {{-- Video --}}
                    <div class="relative w-full bg-slate-950 rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 group/video" style="aspect-ratio:4/3;" id="video-slider-container">
                        @if($videos && $videos->count() > 0)
                            @foreach($videos as $index => $video)
                                <a href="{{ $video->link_video }}" target="_blank"
                                   class="video-slide absolute inset-0 transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100 z-10 pointer-events-auto' : 'opacity-0 z-0 pointer-events-none' }}">
                                    @if($video->gambar_cover)
                                        <img src="{{ asset('storage/' . $video->gambar_cover) }}" alt="{{ $video->judul }}"
                                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-500 opacity-80 hover:opacity-100">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-slate-900 text-slate-500">
                                            <i data-lucide="video" class="w-12 h-12"></i>
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                                    <div class="absolute bottom-4 left-5 right-5 text-white">
                                        <span class="text-[11px] font-bold tracking-wider uppercase text-white">Video Kegiatan</span>
                                        <h3 class="text-sm font-bold mt-1 line-clamp-2 leading-snug text-white hover:text-white transition-colors">
                                            {{ $video->judul }}
                                        </h3>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            {{-- Fallback --}}
                            <a href="https://www.instagram.com/reel/DY6cRvDSGXa/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==" target="_blank"
                               class="video-slide absolute inset-0 opacity-100 z-10 pointer-events-auto">
                                <img src="{{ asset('assets/img/idul-adha.jpeg') }}" alt="Video Kegiatan Bakesbangpol"
                                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-500 opacity-80 hover:opacity-100">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                                <div class="absolute bottom-4 left-5 right-5 text-white">
                                    <span class="text-[11px] font-bold tracking-wider uppercase text-white">Video Kegiatan</span>
                                    <h3 class="text-sm font-bold mt-1 line-clamp-2 leading-snug text-white hover:text-white transition-colors">
                                        Tandang Bareng Bakesbangpol Kabupaten Banyuwangi
                                    </h3>
                                </div>
                            </a>
                        @endif

                        {{-- Dots indicator --}}
                        @if($videos && $videos->count() > 1)
                            <div class="absolute bottom-4 right-5 z-20 flex gap-1.5 bg-slate-950/40 backdrop-blur-sm px-2.5 py-1.5 rounded-full">
                                @foreach($videos as $index => $video)
                                    <button class="video-dot w-2 h-2 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-[#F9B115] w-4' : 'bg-white/60 hover:bg-white' }}" onclick="event.preventDefault(); event.stopPropagation(); showVideoSlide({{ $index }})"></button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- =============================================
     FAQ
     ============================================= --}}
    <section class="py-12 bg-slate-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="bg-slate-100 rounded-xl px-8 py-8">
                <h2 class="font-display font-bold text-slate-950 text-2xl mb-1">FAQ</h2>
                <p class="text-[13px] text-slate-600 mb-6">Seputar pertanyaan yang paling sering diajukan beserta jawabannya
                </p>

                @if ($faq && $faq->isi_konten && strlen(strip_tags($faq->isi_konten)) > 20)
                    <div class="prose prose-slate max-w-none text-sm">
                        {!! $faq->isi_konten !!}
                    </div>
                @else
                    {{-- Default FAQ Accordion --}}
                    <div class="space-y-2">
                        <details class="group bg-white rounded border border-slate-200">
                            <summary
                                class="flex justify-between items-center px-5 py-3.5 cursor-pointer font-medium text-slate-900 list-none text-sm">
                                Bagaimana cara mengajukan permohonan kunjungan?
                                <i data-lucide="chevron-down"
                                    class="w-4 h-4 text-slate-400 group-open:rotate-180 transition-transform shrink-0"></i>
                            </summary>
                            <p class="px-5 pb-4 text-[13px] text-slate-600 leading-relaxed">
                                Anda dapat mengajukan permohonan melalui surat resmi yang ditujukan kepada Kepala
                                Bakesbangpol Banyuwangi.
                            </p>
                        </details>
                        <details class="group bg-white rounded border border-slate-200">
                            <summary
                                class="flex justify-between items-center px-5 py-3.5 cursor-pointer font-medium text-slate-900 list-none text-sm">
                                Di mana lokasi kantor Bakesbangpol?
                                <i data-lucide="chevron-down"
                                    class="w-4 h-4 text-slate-400 group-open:rotate-180 transition-transform shrink-0"></i>
                            </summary>
                            <p class="px-5 pb-4 text-[13px] text-slate-600 leading-relaxed">
                                Kantor kami berlokasi di Jl. K.H. Agus Salim, Taman Baru, Kec. Banyuwangi.
                            </p>
                        </details>
                        <details class="group bg-white rounded border border-slate-200">
                            <summary
                                class="flex justify-between items-center px-5 py-3.5 cursor-pointer font-medium text-slate-900 list-none text-sm">
                                Apa saja layanan yang tersedia di Bakesbangpol?
                                <i data-lucide="chevron-down"
                                    class="w-4 h-4 text-slate-400 group-open:rotate-180 transition-transform shrink-0"></i>
                            </summary>
                            <p class="px-5 pb-4 text-[13px] text-slate-600 leading-relaxed">
                                Layanan kami meliputi fasilitasi ormas, pendidikan politik, pemantauan keamanan, dan
                                pelayanan dokumen.
                            </p>
                        </details>
                        <details class="group bg-white rounded border border-slate-200">
                            <summary
                                class="flex justify-between items-center px-5 py-3.5 cursor-pointer font-medium text-slate-900 list-none text-sm">
                                Bagaimana cara mendaftarkan organisasi kemasyarakatan?
                                <i data-lucide="chevron-down"
                                    class="w-4 h-4 text-slate-400 group-open:rotate-180 transition-transform shrink-0"></i>
                            </summary>
                            <p class="px-5 pb-4 text-[13px] text-slate-600 leading-relaxed">
                                Pendaftaran ormas dapat dilakukan dengan mengunjungi kantor Bakesbangpol dan membawa dokumen
                                persyaratan yang telah ditentukan.
                            </p>
                        </details>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('#hero-slider .slide');
        const totalSlides = slides.length;
        let slideInterval;

        function showSlide(index) {
            if (index >= totalSlides) {
                currentSlide = 0;
            } else if (index < 0) {
                currentSlide = totalSlides - 1;
            } else {
                currentSlide = index;
            }

            slides.forEach((slide, i) => {
                if (i === currentSlide) {
                    slide.classList.remove('opacity-0');
                    slide.classList.add('opacity-100', 'z-10');
                } else {
                    slide.classList.remove('opacity-100', 'z-10');
                    slide.classList.add('opacity-0');
                }
            });
        }

        function startTimer() {
            slideInterval = setInterval(() => {
                showSlide(currentSlide + 1);
            }, 5000); // 5 seconds interval
        }

        function resetTimer() {
            clearInterval(slideInterval);
            startTimer();
        }

        // Video Slider JS
        let currentVideoSlide = 0;
        const videoSlides = document.querySelectorAll('#video-slider-container .video-slide');
        const videoDots = document.querySelectorAll('#video-slider-container .video-dot');
        const totalVideoSlides = videoSlides.length;
        let videoSlideInterval;

        function showVideoSlide(index) {
            if (totalVideoSlides <= 1) return;

            if (index >= totalVideoSlides) {
                currentVideoSlide = 0;
            } else if (index < 0) {
                currentVideoSlide = totalVideoSlides - 1;
            } else {
                currentVideoSlide = index;
            }

            videoSlides.forEach((slide, i) => {
                if (i === currentVideoSlide) {
                    slide.classList.remove('opacity-0', 'z-0', 'pointer-events-none');
                    slide.classList.add('opacity-100', 'z-10', 'pointer-events-auto');
                } else {
                    slide.classList.remove('opacity-100', 'z-10', 'pointer-events-auto');
                    slide.classList.add('opacity-0', 'z-0', 'pointer-events-none');
                }
            });

            if (videoDots.length > 0) {
                videoDots.forEach((dot, i) => {
                    if (i === currentVideoSlide) {
                        dot.classList.remove('bg-white/60', 'w-2');
                        dot.classList.add('bg-[#F9B115]', 'w-4');
                    } else {
                        dot.classList.remove('bg-[#F9B115]', 'w-4');
                        dot.classList.add('bg-white/60', 'w-2');
                    }
                });
            }
        }

        function startVideoTimer() {
            if (totalVideoSlides <= 1) return;
            videoSlideInterval = setInterval(() => {
                showVideoSlide(currentVideoSlide + 1);
            }, 10000); // 10 seconds interval
        }

        function resetVideoTimer() {
            clearInterval(videoSlideInterval);
            startVideoTimer();
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            startTimer();
            if (totalVideoSlides > 1) {
                startVideoTimer();
            }
        });
    </script>
    @endpush

@endsection

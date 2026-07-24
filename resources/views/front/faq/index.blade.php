@extends('layouts.app')

@section('title', 'FAQ — Bakesbangpol Kabupaten Banyuwangi')

@section('content')
<style>
    .bg-grid-pattern {
        background-size: 20px 20px;
        background-image:
            linear-gradient(to right, rgba(148, 163, 184, 0.05) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(148, 163, 184, 0.05) 1px, transparent 1px);
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    
    .animate-float {
        animation: float 4s ease-in-out infinite;
    }

    .accordion-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease;
        opacity: 0;
    }

    .accordion-item.active .accordion-content {
        opacity: 1;
    }
</style>

{{-- =============================================
   PAGE HEADER BANNER (Premium Dark Blue)
   ============================================= --}}
<section class="relative bg-gradient-to-r from-[#0a1c36] to-[#0e315f] py-16 overflow-hidden">
    <!-- Grid Pattern Overlay -->
    <div class="absolute inset-0 bg-grid-pattern opacity-10 pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col md:flex-row items-center justify-between gap-10">
        <div class="text-white max-w-2xl">
            <h1 class="text-3xl text-white md:text-4.5xl font-display font-black tracking-tight mb-3">FAQ (Pertanyaan Umum)</h1>
            <nav class="flex text-slate-300 text-sm font-semibold mb-6 items-center gap-1.5">
                <a href="{{ route('beranda') }}" class="hover:text-white transition-colors">Beranda</a>
                <i data-lucide="chevron-right" class="w-4 h-4 opacity-75"></i>
                <span class="text-white">FAQ</span>
            </nav>
            <p class="text-slate-200 text-[14px] leading-relaxed font-sans font-medium opacity-90">
                Temukan jawaban cepat atas berbagai pertanyaan umum yang sering diajukan mengenai pelayanan, izin penelitian, rekomendasi ormas, dan kegiatan Bakesbangpol Banyuwangi.
            </p>
        </div>
        <!-- 3D Floating Illustration Placeholder -->
        <div class="relative w-80 h-48 flex-shrink-0 hidden md:block">
            <div class="w-full h-full bg-blue-900/40 border border-blue-800/50 rounded-3xl p-6 flex flex-col justify-center items-center backdrop-blur-md shadow-2xl animate-float">
                <div class="w-16 h-16 bg-blue-500/20 border border-blue-400/30 rounded-2xl flex items-center justify-center text-secondary mb-3 shadow-inner">
                    <i data-lucide="help-circle" class="w-8 h-8 text-[#F9B115]"></i>
                </div>
                <h4 class="font-display font-black text-white text-[14px]">Butuh Bantuan?</h4>
                <p class="text-[12px] text-slate-300 text-center mt-1">Gunakan fitur pencarian untuk menemukan jawaban secara instan.</p>
            </div>
        </div>
    </div>
</section>

{{-- =============================================
   MAIN FAQ CONTENT
   ============================================= --}}
<section class="py-16 bg-slate-50/50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Interactive Search Box --}}
        <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-md shadow-slate-100/30 mb-8">
            <label class="block text-slate-800 text-[13px] font-extrabold uppercase tracking-wider mb-2.5">Cari Pertanyaan</label>
            <div class="relative">
                <i data-lucide="search" class="w-5 h-5 absolute left-4.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" id="searchFaq" placeholder="Ketik kata kunci untuk memfilter FAQ secara instan..."
                       class="w-full pl-12 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-[14.5px] font-medium text-slate-800 placeholder-slate-450 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all shadow-sm">
            </div>
        </div>

        {{-- FAQ List --}}
        <div class="space-y-4" id="faq-container">
            @forelse($faqs as $faq)
                <div class="faq-item accordion-item bg-white border border-slate-100 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden" data-pertanyaan="{{ strtolower($faq->pertanyaan) }}" data-jawaban="{{ strtolower(strip_tags($faq->jawaban)) }}">
                    <button class="accordion-trigger w-full flex items-center justify-between gap-6 px-6 py-5 text-left focus:outline-none select-none transition-colors hover:bg-slate-50/55" onclick="toggleAccordion(this)">
                        <span class="font-display font-bold text-[15px] sm:text-[16px] text-slate-850 leading-snug">
                            {{ $faq->pertanyaan }}
                        </span>
                        <span class="accordion-icon w-8 h-8 rounded-xl bg-slate-55 border border-slate-150 flex items-center justify-center text-slate-500 shrink-0 group-hover:text-primary transition-all duration-300">
                            <i data-lucide="plus" class="w-4 h-4 transition-transform duration-300"></i>
                        </span>
                    </button>
                    <div class="accordion-content border-slate-100">
                        <div class="px-6 pb-6 pt-1 text-[13.5px] sm:text-[14px] text-slate-600 leading-relaxed font-sans font-medium border-t border-slate-50/60 mt-1">
                            {!! nl2br(e($faq->jawaban)) !!}
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white border border-slate-100 rounded-2xl p-16 text-center text-slate-500">
                    <div class="inline-flex flex-col items-center justify-center gap-3">
                        <i data-lucide="help-circle" class="w-12 h-12 text-slate-300 animate-pulse"></i>
                        <span class="font-bold text-[15px] text-slate-700">Belum ada pertanyaan umum yang tersedia.</span>
                    </div>
                </div>
            @endforelse

            {{-- No Results Placeholder --}}
            <div id="no-results" class="bg-white border border-slate-100 rounded-2xl p-16 text-center text-slate-500 hidden">
                <div class="inline-flex flex-col items-center justify-center gap-3">
                    <i data-lucide="search-code" class="w-12 h-12 text-slate-300"></i>
                    <span class="font-bold text-[15px] text-slate-700">Tidak ada pertanyaan yang sesuai dengan kata kunci Anda.</span>
                    <p class="text-[12.5px] text-slate-400">Cobalah kata kunci lain atau hubungi kami secara langsung.</p>
                </div>
            </div>
        </div>

    </div>
</section>

@push('scripts')
<script>
    // Accordion Toggle
    function toggleAccordion(trigger) {
        const item = trigger.closest('.accordion-item');
        const content = item.querySelector('.accordion-content');
        const icon = trigger.querySelector('.accordion-icon i');
        
        const isActive = item.classList.contains('active');
        
        // Close all other accordions
        document.querySelectorAll('.accordion-item').forEach(otherItem => {
            if (otherItem !== item) {
                otherItem.classList.remove('active');
                otherItem.querySelector('.accordion-content').style.maxHeight = null;
                const otherIcon = otherItem.querySelector('.accordion-icon');
                if (otherIcon) {
                    otherIcon.innerHTML = '<i data-lucide="plus" class="w-4 h-4 transition-transform duration-300"></i>';
                }
            }
        });
        
        // Toggle current accordion
        if (isActive) {
            item.classList.remove('active');
            content.style.maxHeight = null;
            icon.setAttribute('data-lucide', 'plus');
        } else {
            item.classList.add('active');
            content.style.maxHeight = content.scrollHeight + 'px';
            icon.setAttribute('data-lucide', 'minus');
        }
        
        lucide.createIcons();
    }

    // Live Instant Search
    const searchInput = document.getElementById('searchFaq');
    const faqItems = document.querySelectorAll('.faq-item');
    const noResults = document.getElementById('no-results');

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            let hasMatches = false;

            faqItems.forEach(item => {
                const question = item.getAttribute('data-pertanyaan');
                const answer = item.getAttribute('data-jawaban');

                if (question.includes(query) || answer.includes(query)) {
                    item.classList.remove('hidden');
                    hasMatches = true;
                } else {
                    item.classList.add('hidden');
                    // Ensure active closed if hidden
                    item.classList.remove('active');
                    item.querySelector('.accordion-content').style.maxHeight = null;
                    const icon = item.querySelector('.accordion-icon i');
                    if (icon) {
                        icon.setAttribute('data-lucide', 'plus');
                    }
                }
            });

            if (hasMatches) {
                noResults.classList.add('hidden');
            } else {
                noResults.classList.remove('hidden');
            }
            lucide.createIcons();
        });
    }
</script>
@endpush
@endsection

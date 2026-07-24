{{--
    Elegant image placeholder component
    Usage: @include('front.partials.img_placeholder', ['class' => 'extra-class'])
--}}
<div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 {{ $class ?? '' }}">
    <div class="flex flex-col items-center gap-2 opacity-50">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
            <circle cx="8.5" cy="8.5" r="1.5"/>
            <polyline points="21 15 16 10 5 21"/>
        </svg>
        <span class="text-[11px] text-slate-500 font-medium tracking-wide">Gambar</span>
    </div>
</div>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Bakesbangpol Banyuwangi')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-white min-h-screen flex flex-col">
    
    {{-- Announcement Bar Ticker --}}
    <div class="bg-[#004795] text-white py-2 overflow-hidden border-b border-blue-900/10 text-[12.5px] font-sans font-semibold relative z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center">
            <!-- Badge -->
            <span class="bg-[#F9B115] text-slate-950 text-[10px] font-black uppercase tracking-widest px-2.5 py-0.5 rounded-md flex items-center gap-1.5 shrink-0 select-none shadow-sm mr-4 z-10">
                <span class="w-1.5 h-1.5 rounded-full bg-red-600 animate-ping"></span>
                Pengumuman
            </span>
            <div class="relative w-full overflow-hidden flex items-center">
                <div class="animate-marquee whitespace-nowrap hover-pause flex gap-20">
                    @if($globalAnnouncements && $globalAnnouncements->count() > 0)
                        {{-- First copy --}}
                        @foreach($globalAnnouncements as $announcement)
                            <a href="{{ $announcement->link ?? '#' }}" class="{{ $announcement->link ? 'hover:text-[#F9B115]' : 'cursor-default' }} transition-colors flex items-center gap-2">
                                <span>{{ $announcement->judul }}</span>
                                @if($announcement->link)
                                    <i data-lucide="arrow-up-right" class="w-3.5 h-3.5 opacity-80 inline"></i>
                                @endif
                            </a>
                        @endforeach
                        {{-- Second copy for seamless infinite scrolling --}}
                        @foreach($globalAnnouncements as $announcement)
                            <a href="{{ $announcement->link ?? '#' }}" class="{{ $announcement->link ? 'hover:text-[#F9B115]' : 'cursor-default' }} transition-colors flex items-center gap-2" aria-hidden="true">
                                <span>{{ $announcement->judul }}</span>
                                @if($announcement->link)
                                    <i data-lucide="arrow-up-right" class="w-3.5 h-3.5 opacity-80 inline"></i>
                                @endif
                            </a>
                        @endforeach
                    @else
                        {{-- Fallback --}}
                        @for($i = 0; $i < 3; $i++)
                            <a href="{{ $globalPengumuman ? route('publikasi.show', $globalPengumuman->slug) : route('publikasi') }}" class="hover:text-[#F9B115] transition-colors flex items-center gap-2">
                                <span>{{ $globalPengumuman ? $globalPengumuman->judul : 'Pengumuman Tahap Seleksi Paskibra Kabupaten Banyuwangi' }}</span>
                                <i data-lucide="arrow-up-right" class="w-3.5 h-3.5 opacity-80 inline"></i>
                            </a>
                        @endfor
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('front.partials.navbar')
    
    <main class="flex-grow">
        @yield('content')
    </main>
    
    @include('front.partials.footer')
    
    <script>
        lucide.createIcons();
    </script>
    @stack('scripts')
</body>
</html>

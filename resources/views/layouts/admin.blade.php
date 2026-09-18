<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Bakesbangpol Banyuwangi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo/logo_banyuwangi.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/logo/logo_banyuwangi.png') }}">
    
    <link rel="stylesheet" href="{{ asset('assets/css/cropper.min.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Local Assets (Self-Hosted) -->
    <script src="{{ asset('assets/js/lucide.min.js') }}"></script>
    <script src="{{ asset('assets/js/cropper.min.js') }}"></script>
</head>
<body class="bg-slate-50 min-h-screen text-slate-800 font-display antialiased selection:bg-primary/20 selection:text-primary">
<div class="flex min-h-screen">

    {{-- Sidebar --}}
    @include('admin.partials.sidebar')

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col min-w-0 transition-all duration-300">
        @include('admin.partials.topbar')
        <main class="flex-1 p-6 md:p-8 overflow-auto">
            @if(session('success'))
                <div class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-2xl shadow-sm">
                    <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
                    <span class="text-[14px] font-semibold">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-2xl shadow-sm">
                    <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0"></i>
                    <span class="text-[14px] font-semibold">{{ session('error') }}</span>
                </div>
            @endif
            
            @yield('content')
            
        </main>
        <footer class="py-6 text-center text-[13px] font-medium text-slate-400 border-t border-slate-200 bg-white">
            &copy; {{ date('Y') }} Badan Kesatuan Bangsa dan Politik Kabupaten Banyuwangi.
        </footer>
    </div>
</div>
@include('admin.partials.modal-file-error')
@include('admin.partials.modal-image-cropper')
<script>
    function renderLucideAdminIcons() {
        if (typeof lucide !== 'undefined' && typeof lucide.createIcons === 'function') {
            lucide.createIcons();
        }
    }
    document.addEventListener('DOMContentLoaded', renderLucideAdminIcons);
    renderLucideAdminIcons();
</script>
@stack('scripts')
</body>
</html>

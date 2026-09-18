<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Bakesbangpol Banyuwangi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo/logo_banyuwangi.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/logo/logo_banyuwangi.png') }}">
    
    <script src="{{ asset('assets/js/lucide.min.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 min-h-screen flex flex-col font-sans antialiased selection:bg-primary/20 selection:text-primary">

    {{-- Navbar (Elegant) --}}
    <nav class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('beranda') }}" class="flex flex-col leading-none hover:opacity-80 transition-opacity">
                    <span class="font-display font-extrabold text-[15px] tracking-tight text-slate-900 uppercase leading-tight">BAKESBANGPOL</span>
                    <span class="font-display font-bold text-[14px] tracking-tight text-primary uppercase leading-tight">BANYUWANGI</span>
                </a>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('beranda') }}" class="text-[14px] font-semibold text-slate-600 hover:text-primary transition-colors">Beranda</a>
                    <a href="{{ route('profil') }}" class="text-[14px] font-semibold text-slate-600 hover:text-primary transition-colors">Profil</a>
                    <a href="{{ route('dokumen') }}" class="text-[14px] font-semibold text-slate-600 hover:text-primary transition-colors">Dokumen</a>
                    <a href="{{ route('publikasi') }}" class="text-[14px] font-semibold text-slate-600 hover:text-primary transition-colors">Publikasi</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Main: Login Form --}}
    <main class="flex-1 flex items-center justify-center px-4 py-12 relative overflow-hidden">
        {{-- Background Decoration --}}
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-primary/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-400/5 rounded-full blur-3xl pointer-events-none"></div>
        
        <div class="w-full max-w-[420px] relative z-10">
            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 p-8 md:p-10">
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-5 rotate-3 hover:rotate-0 transition-transform duration-300">
                        <i data-lucide="shield-check" class="w-8 h-8 text-primary"></i>
                    </div>
                    <h1 class="font-display font-bold text-slate-900 text-2xl mb-2">Selamat Datang</h1>
                    <p class="text-[14px] text-slate-500 font-medium">Masuk untuk mengelola sistem website Bakesbangpol.</p>
                </div>

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-600 rounded-xl text-[13px] font-medium flex items-start gap-3">
                        <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form action="{{ route('admin.login') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-[13px] font-bold text-slate-700 mb-2">Alamat Email</label>
                        <div class="relative group">
                            <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400 group-focus-within:text-primary transition-colors"></i>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan alamat email"
                                   class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-[14px] font-medium placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all duration-200">
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-[13px] font-bold text-slate-700">Password</label>
                        </div>
                        <div class="relative group">
                            <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400 group-focus-within:text-primary transition-colors"></i>
                            <input type="password" id="password" name="password" required placeholder="••••••••"
                                   class="w-full pl-11 pr-12 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-[14px] font-medium placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all duration-200">
                            <button type="button" onclick="togglePasswordVisibility('password', 'password_icon')" aria-label="Tampilkan atau sembunyikan kata sandi" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none z-10">
                                <i id="password_icon" data-lucide="eye" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="flex items-center pt-1">
                        <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-primary border-slate-300 rounded focus:ring-primary focus:ring-offset-1">
                        <label for="remember" class="ml-2.5 text-[13px] text-slate-600 font-bold cursor-pointer select-none">Ingat saya di perangkat ini</label>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                                class="w-full py-3.5 bg-primary text-white font-bold text-[15px] rounded-xl hover:bg-blue-700 hover:shadow-lg hover:shadow-primary/30 transition-all duration-300 flex items-center justify-center gap-2 group">
                            Masuk ke Dashboard
                            <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    {{-- Footer --}}
    <footer class="py-6 text-center text-[13px] font-medium text-slate-400 relative z-10">
        &copy; {{ date('Y') }} Badan Kesatuan Bangsa dan Politik Kabupaten Banyuwangi.
    </footer>

    <script>
        function renderLoginIcons() {
            if (typeof lucide !== 'undefined' && typeof lucide.createIcons === 'function') {
                lucide.createIcons();
            }
        }
        document.addEventListener('DOMContentLoaded', renderLoginIcons);
        renderLoginIcons();

        function togglePasswordVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.setAttribute('data-lucide', 'eye-off');
            } else {
                input.type = 'password';
                icon.setAttribute('data-lucide', 'eye');
            }
            
            // Re-initialize Lucide icons for the updated icon element
            if (typeof lucide !== 'undefined' && typeof lucide.createIcons === 'function') {
                lucide.createIcons();
            }
        }
    </script>
</body>
</html>

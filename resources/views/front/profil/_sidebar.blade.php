{{-- Shared sidebar for profil sub-pages --}}
<div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 sticky top-24">
    <h3 class="font-display font-bold text-slate-900 mb-6 text-lg">Navigasi Profil</h3>
    <div class="space-y-2">
        <a href="{{ route('profil') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition {{ request()->routeIs('profil') && !request()->routeIs('profil.*') ? 'bg-primary text-white' : 'text-slate-600 hover:bg-white hover:shadow-sm' }}">
            <i data-lucide="info" class="w-5 h-5"></i> Profil Instansi
        </a>
        <a href="{{ route('profil.pimpinan') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition {{ request()->routeIs('profil.pimpinan') ? 'bg-primary text-white' : 'text-slate-600 hover:bg-white hover:shadow-sm' }}">
            <i data-lucide="user" class="w-5 h-5"></i> Pimpinan
        </a>
        <a href="{{ route('profil.struktur') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition {{ request()->routeIs('profil.struktur') ? 'bg-primary text-white' : 'text-slate-600 hover:bg-white hover:shadow-sm' }}">
            <i data-lucide="network" class="w-5 h-5"></i> Struktur Organisasi
        </a>
        <a href="{{ route('profil.visi-misi') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition {{ request()->routeIs('profil.visi-misi') ? 'bg-primary text-white' : 'text-slate-600 hover:bg-white hover:shadow-sm' }}">
            <i data-lucide="target" class="w-5 h-5"></i> Visi dan Misi
        </a>
        <a href="{{ route('profil.tupoksi') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition {{ request()->routeIs('profil.tupoksi') ? 'bg-primary text-white' : 'text-slate-600 hover:bg-white hover:shadow-sm' }}">
            <i data-lucide="list-checks" class="w-5 h-5"></i> Tugas Pokok & Fungsi
        </a>
    </div>
</div>

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Halaman;
use App\Models\Pimpinan;

class HalamanController extends Controller
{
    public function profil()
    {
        $halaman = Halaman::where('slug', 'profil')->first();
        return view('front.profil.index', compact('halaman'));
    }

    public function pimpinan()
    {
        $halaman = Halaman::where('slug', 'pimpinan')->first();
        $pimpinanList = Pimpinan::orderBy('urutan')->get();
        return view('front.profil.pimpinan', compact('halaman', 'pimpinanList'));
    }

    public function strukturOrganisasi()
    {
        $halaman = Halaman::where('slug', 'struktur-organisasi')->first();
        $pimpinanList = Pimpinan::orderBy('urutan')->get();
        return view('front.profil.struktur', compact('halaman', 'pimpinanList'));
    }

    public function visiMisi()
    {
        $halaman = Halaman::where('slug', 'visi-misi')->first();
        return view('front.profil.visi-misi', compact('halaman'));
    }

    public function tupoksi()
    {
        $halaman = Halaman::where('slug', 'tupoksi')->first();
        return view('front.profil.tupoksi', compact('halaman'));
    }
}

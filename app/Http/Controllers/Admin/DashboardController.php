<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Dokumen;
use App\Models\Halaman;
use App\Models\Pimpinan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBerita   = Berita::count();
        $totalDokumen  = Dokumen::count();
        $totalHalaman  = Halaman::count();
        $totalPimpinan = Pimpinan::count();

        $beritaTerbaru  = Berita::with('kategori')->latest()->take(5)->get();
        $dokumenTerbaru = Dokumen::with('kategori')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalBerita',
            'totalDokumen',
            'totalHalaman',
            'totalPimpinan',
            'beritaTerbaru',
            'dokumenTerbaru'
        ));
    }
}

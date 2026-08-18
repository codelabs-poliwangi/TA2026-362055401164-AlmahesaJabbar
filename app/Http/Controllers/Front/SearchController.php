<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Dokumen;
use App\Models\Halaman;
use App\Models\Video;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $berita = collect();
        $dokumen = collect();
        $halaman = collect();
        $videos = collect();
        
        if (!empty($search)) {
            // 1. Search news (Berita)
            $berita = Berita::with('kategori')
                ->where('status', 'published')
                ->where(function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                      ->orWhere('isi', 'like', "%{$search}%");
                })
                ->orderBy('tanggal_publish', 'desc')
                ->get();
            
            // 2. Search documents (Dokumen)
            $dokumen = Dokumen::with('kategori')
                ->where('status', 'published')
                ->where(function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                      ->orWhere('deskripsi', 'like', "%{$search}%");
                })
                ->orderBy('created_at', 'desc')
                ->get();
                
            // 3. Search static pages (Halaman)
            $halaman = Halaman::whereIn('slug', ['profil', 'pimpinan', 'struktur-organisasi', 'visi-misi', 'tupoksi'])
                ->where(function ($q) use ($search) {
                    $q->where('judul_halaman', 'like', "%{$search}%")
                      ->orWhere('isi_konten', 'like', "%{$search}%");
                })
                ->get();
                
            // 4. Search videos
            $videos = Video::where('status', 'published')
                ->where('judul', 'like', "%{$search}%")
                ->orderBy('created_at', 'desc')
                ->get();
        }
        
        $totalResults = $berita->count() + $dokumen->count() + $halaman->count() + $videos->count();
        
        return view('front.search', compact('berita', 'dokumen', 'halaman', 'videos', 'search', 'totalResults'));
    }
}

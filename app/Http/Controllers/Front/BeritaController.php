<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KategoriBerita;

class BeritaController extends Controller
{
    public function index()
    {
        $search = request('search');
        $categoryId = request('category');

        $query = Berita::with('kategori')
            ->where('status', 'published')
            ->orderBy('tanggal_publish', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('isi', 'like', "%{$search}%");
            });
        }

        if ($categoryId) {
            $query->where('kategori_id', $categoryId);
        }

        $allBerita = $query->get();

        $beritaUtama = $allBerita->first();
        $beritaLainnya = $allBerita->slice(1);

        $kategori = KategoriBerita::all();

        return view('front.berita.index', compact('beritaUtama', 'beritaLainnya', 'kategori'));
    }

    public function show(string $slug)
    {
        $berita = Berita::with(['kategori', 'author'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $beritaLainnya = Berita::with('kategori')
            ->where('status', 'published')
            ->where('id', '!=', $berita->id)
            ->orderBy('tanggal_publish', 'desc')
            ->take(3)
            ->get();

        return view('front.berita.show', compact('berita', 'beritaLainnya'));
    }
}

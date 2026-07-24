<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KategoriBerita;

class BeritaController extends Controller
{
    public function index()
    {
        $beritaUtama = Berita::with('kategori')
            ->where('status', 'published')
            ->orderBy('tanggal_publish', 'desc')
            ->first();

        $beritaLainnya = Berita::with('kategori')
            ->where('status', 'published')
            ->orderBy('tanggal_publish', 'desc')
            ->skip(1)->take(3)
            ->get();

        $pengumuman = Berita::with('kategori')
            ->where('status', 'published')
            ->whereHas('kategori', fn($q) => $q->where('nama_kategori', 'Pengumuman'))
            ->orderBy('tanggal_publish', 'desc')
            ->first();

        $kategori = KategoriBerita::all();

        return view('front.berita.index', compact('beritaUtama', 'beritaLainnya', 'pengumuman', 'kategori'));
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

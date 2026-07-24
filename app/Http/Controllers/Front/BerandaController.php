<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Dokumen;
use App\Models\Halaman;

class BerandaController extends Controller
{
    public function index()
    {
        $beritaTerbaru = Berita::with('kategori')
            ->where('status', 'published')
            ->orderBy('tanggal_publish', 'desc')
            ->take(4)
            ->get();

        $dokumenTerbaru = Dokumen::with('kategori')
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $fondasiStrategis = Halaman::where('slug', 'fondasi-strategis')->first();
        $videoEmbed = Halaman::where('slug', 'video-embed')->first();
        $faq = Halaman::where('slug', 'faq')->first();
        $videos = \App\Models\Video::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('front.beranda', compact(
            'beritaTerbaru',
            'dokumenTerbaru',
            'fondasiStrategis',
            'videoEmbed',
            'faq',
            'videos'
        ));
    }
}

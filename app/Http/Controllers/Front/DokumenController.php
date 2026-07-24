<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use App\Models\KategoriDokumen;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumen = Dokumen::with('kategori')
            ->where('status', 'published')
            ->when(request('kategori'), fn($q, $id) => $q->where('kategori_id', $id))
            ->when(request('search'), fn($q, $s) => $q->where('judul', 'like', "%$s%"))
            ->paginate(10);

        $kategori = KategoriDokumen::withCount(['dokumen' => fn($q) => $q->where('status', 'published')])->get();

        return view('front.dokumen.index', compact('dokumen', 'kategori'));
    }

    public function unduh(int $id)
    {
        $dokumen = Dokumen::where('status', 'published')->findOrFail($id);
        return Storage::disk('public')->download($dokumen->file, $dokumen->judul . '.' . pathinfo($dokumen->file, PATHINFO_EXTENSION));
    }
}

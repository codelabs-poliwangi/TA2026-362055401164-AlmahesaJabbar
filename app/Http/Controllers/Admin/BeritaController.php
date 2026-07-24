<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $berita = Berita::with('kategori')
            ->when($request->search, fn($q) => $q->where('judul', 'like', "%{$request->search}%"))
            ->when($request->kategori_id, fn($q) => $q->where('kategori_id', $request->kategori_id))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $kategori = KategoriBerita::all();
        return view('admin.berita.index', compact('berita', 'kategori'));
    }

    public function create()
    {
        $kategori = KategoriBerita::all();
        return view('admin.berita.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'           => 'required|max:100',
            'isi'             => 'required',
            'kategori_id'     => 'required|exists:kategori_berita,id',
            'gambar'          => 'nullable|image|max:2048',
            'tanggal_publish' => 'nullable|date',
            'status'          => 'required|in:draft,published',
        ]);

        $data = $request->except('gambar');
        $data['slug'] = $this->uniqueSlug($request->judul);
        $data['created_by'] = Auth::id();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($data);
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $beritum)
    {
        $kategori = KategoriBerita::all();
        return view('admin.berita.edit', ['berita' => $beritum, 'kategori' => $kategori]);
    }

    public function update(Request $request, Berita $beritum)
    {
        $request->validate([
            'judul'           => 'required|max:100',
            'isi'             => 'required',
            'kategori_id'     => 'required|exists:kategori_berita,id',
            'gambar'          => 'nullable|image|max:2048',
            'tanggal_publish' => 'nullable|date',
            'status'          => 'required|in:draft,published',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            if ($beritum->gambar) {
                Storage::disk('public')->delete($beritum->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $beritum->update($data);
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $beritum)
    {
        if ($beritum->gambar) {
            Storage::disk('public')->delete($beritum->gambar);
        }
        $beritum->delete();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }

    private function uniqueSlug(string $judul): string
    {
        $slug  = Str::slug($judul);
        $count = Berita::where('slug', 'like', "{$slug}%")->count();
        return $count ? "{$slug}-{$count}" : $slug;
    }
}

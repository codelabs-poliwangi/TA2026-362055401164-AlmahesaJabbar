<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Halaman;
use Illuminate\Http\Request;

class HalamanController extends Controller
{
    public function index()
    {
        $halaman = Halaman::latest()->paginate(10);
        return view('admin.halaman.index', compact('halaman'));
    }

    public function edit(Halaman $halaman)
    {
        return view('admin.halaman.edit', compact('halaman'));
    }

    public function update(Request $request, Halaman $halaman)
    {
        if ($halaman->slug === 'struktur-organisasi') {
            $request->validate([
                'judul_halaman' => 'required|max:100',
                'gambar'        => $halaman->gambar ? 'nullable|safe_image|image|mimes:jpeg,png,jpg,webp|max:2048' : 'required|safe_image|image|mimes:jpeg,png,jpg,webp|max:2048',
                'isi_konten'    => 'nullable',
            ], [
                'judul_halaman.required' => 'Judul halaman wajib diisi.',
                'gambar.required'        => 'Gambar struktur organisasi wajib diisi.',
                'gambar.image'           => 'File yang diupload harus berupa gambar.',
                'gambar.max'             => 'Ukuran gambar maksimal adalah 2MB.',
            ]);

            $data = $request->only('judul_halaman', 'isi_konten');
            $data['isi_konten'] = \App\Helpers\SecurityHelper::sanitizeHtml($data['isi_konten'] ?? '');

            if ($request->hasFile('gambar')) {
                if ($halaman->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists($halaman->gambar)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($halaman->gambar);
                }
                $data['gambar'] = $request->file('gambar')->store('halaman', 'public');
            }

            $halaman->update($data);
        } else {
            $request->validate([
                'judul_halaman' => 'required|max:100',
                'isi_konten'    => 'required',
            ]);

            $data = $request->only('judul_halaman', 'isi_konten');
            $data['isi_konten'] = \App\Helpers\SecurityHelper::sanitizeHtml($data['isi_konten'] ?? '');

            $halaman->update($data);
        }

        return redirect()->route('admin.halaman.index')->with('success', 'Halaman berhasil diperbarui.');
    }

    // Not needed but required by resource — redirect to index
    public function create()   { return redirect()->route('admin.halaman.index'); }
    public function store()    { return redirect()->route('admin.halaman.index'); }
    public function show()     { return redirect()->route('admin.halaman.index'); }
    public function destroy()  { return redirect()->route('admin.halaman.index'); }
}

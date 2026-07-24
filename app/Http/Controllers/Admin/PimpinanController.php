<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pimpinan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PimpinanController extends Controller
{
    /**
     * Tampilkan daftar pimpinan dengan fitur pencarian dan pengurutan.
     */
    public function index(Request $request)
    {
        $pimpinan = Pimpinan::query()
            ->when($request->search, function ($q) use ($request) {
                $q->where('nama', 'like', "%{$request->search}%")
                  ->orWhere('jabatan', 'like', "%{$request->search}%");
            })
            ->orderBy('urutan')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.pimpinan.index', compact('pimpinan'));
    }

    /**
     * Tampilkan formulir tambah pimpinan baru.
     */
    public function create()
    {
        return view('admin.pimpinan.create');
    }

    /**
     * Simpan data pimpinan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'            => 'required|string|max:100',
            'jabatan'         => 'required|string|max:100',
            'tupoksi_singkat' => 'nullable|string',
            'foto'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'bio'             => 'nullable|string',
            'anggota'         => 'nullable|string',
            'urutan'          => 'required|integer|min:0',
        ], [
            'nama.required'    => 'Nama pimpinan wajib diisi.',
            'jabatan.required' => 'Jabatan pimpinan wajib diisi.',
            'urutan.required'  => 'Urutan tampil wajib diisi.',
            'urutan.integer'   => 'Urutan tampil harus berupa angka.',
            'foto.image'       => 'File yang diupload harus berupa gambar.',
            'foto.max'         => 'Ukuran foto maksimal adalah 2MB.',
        ]);

        $data = $request->except('foto');
        $data['created_by'] = Auth::id();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pimpinan', 'public');
        }

        Pimpinan::create($data);

        return redirect()->route('admin.pimpinan.index')
            ->with('success', 'Data pimpinan baru berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail pimpinan (Opsional, tidak wajib tapi baik untuk kelengkapan).
     */
    public function show(Pimpinan $pimpinan)
    {
        return redirect()->route('admin.pimpinan.edit', $pimpinan->id);
    }

    /**
     * Tampilkan formulir edit pimpinan.
     */
    public function edit(Pimpinan $pimpinan)
    {
        return view('admin.pimpinan.edit', compact('pimpinan'));
    }

    /**
     * Perbarui data pimpinan di database.
     */
    public function update(Request $request, Pimpinan $pimpinan)
    {
        $request->validate([
            'nama'            => 'required|string|max:100',
            'jabatan'         => 'required|string|max:100',
            'tupoksi_singkat' => 'nullable|string',
            'foto'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'bio'             => 'nullable|string',
            'anggota'         => 'nullable|string',
            'urutan'          => 'required|integer|min:0',
        ], [
            'nama.required'    => 'Nama pimpinan wajib diisi.',
            'jabatan.required' => 'Jabatan pimpinan wajib diisi.',
            'urutan.required'  => 'Urutan tampil wajib diisi.',
            'urutan.integer'   => 'Urutan tampil harus berupa angka.',
            'foto.image'       => 'File yang diupload harus berupa gambar.',
            'foto.max'         => 'Ukuran foto maksimal adalah 2MB.',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada dan bukan gambar dummy penting
            if ($pimpinan->foto && Storage::disk('public')->exists($pimpinan->foto)) {
                Storage::disk('public')->delete($pimpinan->foto);
            }
            $data['foto'] = $request->file('foto')->store('pimpinan', 'public');
        }

        $pimpinan->update($data);

        return redirect()->route('admin.pimpinan.index')
            ->with('success', 'Data pimpinan berhasil diperbarui.');
    }

    /**
     * Hapus data pimpinan dari database beserta fotonya.
     */
    public function destroy(Pimpinan $pimpinan)
    {
        if ($pimpinan->foto && Storage::disk('public')->exists($pimpinan->foto)) {
            Storage::disk('public')->delete($pimpinan->foto);
        }

        $pimpinan->delete();

        return redirect()->route('admin.pimpinan.index')
            ->with('success', 'Data pimpinan berhasil dihapus.');
    }
}

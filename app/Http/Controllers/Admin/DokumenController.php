<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use App\Models\KategoriDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    public function index(Request $request)
    {
        $dokumen = Dokumen::with('kategori')
            ->when($request->search, fn($q) => $q->where('judul', 'like', "%{$request->search}%"))
            ->when($request->kategori_id, fn($q) => $q->where('kategori_id', $request->kategori_id))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $kategori = KategoriDokumen::all();
        return view('admin.dokumen.index', compact('dokumen', 'kategori'));
    }

    public function create()
    {
        $kategori = KategoriDokumen::all();
        return view('admin.dokumen.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'           => 'required|max:100',
            'deskripsi'       => 'nullable|max:255',
            'file'            => 'required|mimes:pdf,doc,docx,xls,xlsx|max:5120',
            'kategori_id'     => 'required|exists:kategori_dokumen,id',
            'tanggal_upload'  => 'nullable|date',
            'status'          => 'required|in:draft,published',
        ]);

        $data = $request->except('file');
        $data['file']       = $request->file('file')->store('dokumen', 'public');
        $data['created_by'] = Auth::id();

        Dokumen::create($data);
        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen berhasil ditambahkan.');
    }

    public function edit(Dokumen $dokumen)
    {
        $kategori = KategoriDokumen::all();
        return view('admin.dokumen.edit', compact('dokumen', 'kategori'));
    }

    public function update(Request $request, Dokumen $dokumen)
    {
        $request->validate([
            'judul'           => 'required|max:100',
            'deskripsi'       => 'nullable|max:255',
            'file'            => 'nullable|mimes:pdf,doc,docx,xls,xlsx|max:5120',
            'kategori_id'     => 'required|exists:kategori_dokumen,id',
            'tanggal_upload'  => 'nullable|date',
            'status'          => 'required|in:draft,published',
        ]);

        $data = $request->except('file');

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($dokumen->file);
            $data['file'] = $request->file('file')->store('dokumen', 'public');
        }

        $dokumen->update($data);
        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function destroy(Dokumen $dokumen)
    {
        Storage::disk('public')->delete($dokumen->file);
        $dokumen->delete();
        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen berhasil dihapus.');
    }
}

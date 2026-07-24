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
        $request->validate([
            'judul_halaman' => 'required|max:100',
            'isi_konten'    => 'required',
        ]);

        $halaman->update($request->only('judul_halaman', 'isi_konten'));
        return redirect()->route('admin.halaman.index')->with('success', 'Halaman berhasil diperbarui.');
    }

    // Not needed but required by resource — redirect to index
    public function create()   { return redirect()->route('admin.halaman.index'); }
    public function store()    { return redirect()->route('admin.halaman.index'); }
    public function show()     { return redirect()->route('admin.halaman.index'); }
    public function destroy()  { return redirect()->route('admin.halaman.index'); }
}

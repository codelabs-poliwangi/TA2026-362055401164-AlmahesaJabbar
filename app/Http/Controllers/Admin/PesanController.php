<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesan;

class PesanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pesan = Pesan::query()
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('subjek', 'like', "%{$search}%")
                      ->orWhere('pesan', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.pesan.index', compact('pesan'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Pesan $pesan)
    {
        return view('admin.pesan.show', compact('pesan'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesan $pesan)
    {
        $pesan->delete();

        return redirect()->route('admin.pesan.index')
            ->with('success', 'Pesan masuk berhasil dihapus.');
    }

    // Redirect unused resource routes
    public function create()  { return redirect()->route('admin.pesan.index'); }
    public function store()   { return redirect()->route('admin.pesan.index'); }
    public function edit()    { return redirect()->route('admin.pesan.index'); }
    public function update()  { return redirect()->route('admin.pesan.index'); }
}

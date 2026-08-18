<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesan;

class KontakController extends Controller
{
    public function index()
    {
        return view('front.kontak');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:100',
            'email'  => 'required|email|max:100',
            'subjek' => 'required|string|max:150',
            'pesan'  => 'required|string',
        ], [
            'nama.required'   => 'Nama lengkap wajib diisi.',
            'email.required'  => 'Email wajib diisi.',
            'email.email'     => 'Format email tidak valid.',
            'subjek.required' => 'Subjek wajib diisi.',
            'pesan.required'  => 'Pesan wajib diisi.',
        ]);

        $pesan = Pesan::create($request->all());

        // Send email notification to Bakesbangpol
        try {
            \Illuminate\Support\Facades\Mail::to('kesbangpol.bwi@gmail.com')->send(new \App\Mail\PesanMasukMail($pesan));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal mengirim email notifikasi: ' . $e->getMessage());
        }

        return redirect()->route('kontak')->with('success', 'Pesan Anda berhasil dikirim. Terima kasih!');
    }
}

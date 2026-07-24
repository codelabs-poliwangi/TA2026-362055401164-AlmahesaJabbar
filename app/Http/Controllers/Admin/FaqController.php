<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $faqs = Faq::when($request->search, function($q) use ($request) {
                $q->where('pertanyaan', 'like', "%{$request->search}%")
                  ->orWhere('jawaban', 'like', "%{$request->search}%");
            })
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->orderBy('urutan', 'asc')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban'    => 'required|string',
            'urutan'     => 'required|integer|min:0',
            'status'     => 'required|in:draft,published',
        ]);

        $data = $request->only(['pertanyaan', 'jawaban', 'urutan', 'status']);
        $data['created_by'] = Auth::id();

        Faq::create($data);

        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban'    => 'required|string',
            'urutan'     => 'required|integer|min:0',
            'status'     => 'required|in:draft,published',
        ]);

        $data = $request->only(['pertanyaan', 'jawaban', 'urutan', 'status']);

        $faq->update($data);

        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil dihapus.');
    }
}

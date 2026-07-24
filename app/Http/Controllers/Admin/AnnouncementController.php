<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $announcements = Announcement::when($request->search, fn($q) => $q->where('judul', 'like', "%{$request->search}%"))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.announcement.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcement.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'  => 'required|string|max:255',
            'link'   => 'nullable|url|max:255',
            'status' => 'required|in:draft,published',
        ]);

        $data = $request->only(['judul', 'link', 'status']);
        $data['created_by'] = Auth::id();

        Announcement::create($data);

        return redirect()->route('admin.announcement.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcement.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'judul'  => 'required|string|max:255',
            'link'   => 'nullable|url|max:255',
            'status' => 'required|in:draft,published',
        ]);

        $data = $request->only(['judul', 'link', 'status']);

        $announcement->update($data);

        return redirect()->route('admin.announcement.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()->route('admin.announcement.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}

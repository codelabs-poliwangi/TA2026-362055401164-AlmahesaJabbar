<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $videos = Video::when($request->search, fn($q) => $q->where('judul', 'like', "%{$request->search}%"))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.video.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.video.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'        => 'required|max:100',
            'link_video'   => 'required|url|max:255',
            'gambar_cover' => 'nullable|safe_image|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status'       => 'required|in:draft,published',
        ]);

        $data = $request->except('gambar_cover');
        $data['slug'] = $this->uniqueSlug($request->judul);
        $data['created_by'] = Auth::id();

        if ($request->hasFile('gambar_cover')) {
            $data['gambar_cover'] = $request->file('gambar_cover')->store('videos', 'public');
        }

        Video::create($data);
        return redirect()->route('admin.video.index')->with('success', 'Video berhasil ditambahkan.');
    }

    public function edit(Video $video)
    {
        return view('admin.video.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'judul'        => 'required|max:100',
            'link_video'   => 'required|url|max:255',
            'gambar_cover' => 'nullable|safe_image|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status'       => 'required|in:draft,published',
        ]);

        $data = $request->except('gambar_cover');

        if ($request->hasFile('gambar_cover')) {
            if ($video->gambar_cover) {
                Storage::disk('public')->delete($video->gambar_cover);
            }
            $data['gambar_cover'] = $request->file('gambar_cover')->store('videos', 'public');
        }

        $video->update($data);
        return redirect()->route('admin.video.index')->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(Video $video)
    {
        if ($video->gambar_cover) {
            Storage::disk('public')->delete($video->gambar_cover);
        }
        $video->delete();
        return redirect()->route('admin.video.index')->with('success', 'Video berhasil dihapus.');
    }

    private function uniqueSlug(string $judul): string
    {
        $slug  = Str::slug($judul);
        $count = Video::where('slug', 'like', "{$slug}%")->count();
        return $count ? "{$slug}-{$count}" : $slug;
    }
}

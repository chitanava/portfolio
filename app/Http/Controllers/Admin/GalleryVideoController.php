<?php

namespace App\Http\Controllers\Admin;

use App\Models\Video;
use App\Models\Gallery;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class GalleryVideoController extends Controller
{
    public function create(Gallery $gallery): View
    {
        return view('admin.gallery-video.create', ['gallery' => $gallery]);
    }

    public function store(Request $request, Gallery $gallery): RedirectResponse
    {        
        $validated = $request->validate([
            'title' => 'required',
            'url' => 'required',
            'caption' => 'nullable|string',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:'.config('app.upload_max_filesize'),
            'active' => 'required',
        ]);

        $video = $gallery->videos()->create([
            'title' => $request->title,
            'url' => $request->url,
            'caption' => $request->caption,
            'active' => $request->active,
        ]);

        $video->addMediaFromRequest('cover')->toMediaCollection();

        return redirect()
            ->route('admin.galleries.show', $gallery->id)
            ->with('status', 'Video created.');
    }

    public function edit(Gallery $gallery, Video $video)
    {
        return view('admin.gallery-video.edit', ['gallery' => $gallery, 'video' => $video]);
    }

    public function update(Request $request, Gallery $gallery, Video $video): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required',
            'url' => 'required',
            'caption' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:'.config('app.upload_max_filesize'),
            'active' => 'required',
        ]);

        $video->update([
            'title' => $request->title,
            'url' => $request->url,
            'caption' => $request->caption,
            'active' => $request->active,
        ]);

        if($request->hasFile('cover')){
            $video->getMedia()[0]->delete();
            $video->addMediaFromRequest('cover')->toMediaCollection();
        }

        return redirect()
                ->route('admin.galleries.videos.edit', [$gallery->id, $video->id])
                ->with('status', 'Video updated.');
    }

    public function destroy(Gallery $gallery, Video $video): RedirectResponse
    {
        $video->delete();

        return redirect()
                ->route('admin.galleries.show', $gallery->id)
                ->with('status', 'Video deleted.');
    }
}

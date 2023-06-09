<?php

namespace App\Http\Controllers\Admin;

use App\Models\Album;
use App\Models\Video;
use App\Models\Gallery;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class AlbumVideoController extends Controller
{
    public function create(Gallery $gallery, Album $album): View
    {
        return view('admin.album-video.create', ['gallery' => $gallery, 'album' => $album]);
    }

    public function store(Request $request, Gallery $gallery, Album $album): RedirectResponse
    {        
        $validated = $request->validate([
            'title' => 'required',
            'url' => 'required',
            'caption' => 'nullable|string',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:'.config('app.upload_max_filesize'),
            'active' => 'required',
        ]);

        $image = $album->videos()->create([
            'title' => $request->title,
            'url' => $request->url,
            'caption' => $request->caption,
            'active' => $request->active,
        ]);

        $image->addMediaFromRequest('cover')->toMediaCollection();

        return redirect()
                ->route('admin.galleries.albums.show', [$gallery->id, $album->id])
                ->with('status', 'Video created.');
    }

    public function edit(Gallery $gallery, Album $album, Video $video): View
    {
        return view('admin.album-video.edit', ['gallery' => $gallery, 'album' => $album, 'video' => $video]);
    }

    public function update(Request $request, Gallery $gallery, Album $album, Video $video): RedirectResponse
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
                ->route('admin.galleries.albums.videos.edit', [$gallery->id, $album->id, $video->id])
                ->with('status', 'Video updated.');
    }

    public function destroy(Gallery $gallery, Album $album, Video $video)
    {
        $video->delete();

        return redirect()
                ->route('admin.galleries.albums.show', [$gallery->id, $album->id])
                ->with('status', 'Video deleted.');
    }
}

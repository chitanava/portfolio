<?php

namespace App\Http\Controllers\Admin;

use App\Models\Album;
use App\Models\Image;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class AlbumImageController extends Controller
{

    public function create(Gallery $gallery, Album $album)
    {
        return view('admin.album-image.create', ['gallery' => $gallery, 'album' => $album]);
    }


    public function store(Request $request, Gallery $gallery, Album $album): RedirectResponse
    {        
        $validated = $request->validate([
            'title' => 'required',
            'caption' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:'.config('app.upload_max_filesize'),
            'active' => 'required',
        ]);

        $image = $album->images()->create([
            'title' => $request->title,
            'caption' => $request->caption,
            'active' => $request->active,
        ]);

        $image->addMediaFromRequest('image')->toMediaCollection();

        return redirect()
                ->route('admin.galleries.albums.show', [$gallery->id, $album->id])
                ->with('status', 'Image created.');
    }


    public function edit(Gallery $gallery, Album $album, Image $image)
    {
        return view('admin.album-image.edit', ['gallery' => $gallery, 'album' => $album, 'image' => $image]);
    }


    public function update(Request $request, Gallery $gallery, Album $album, Image $image): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required',
            'caption' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:'.config('app.upload_max_filesize'),
            'active' => 'required',
        ]);

        $image->update([
            'title' => $request->title,
            'caption' => $request->caption,
            'active' => $request->active,
        ]);

        if($request->hasFile('image')){
            $image->getMedia()[0]->delete();
            $image->addMediaFromRequest('image')->toMediaCollection();
        }

        return redirect()
                ->route('admin.galleries.albums.images.edit', [$gallery->id, $album->id, $image->id])
                ->with('status', 'Image updated.');
    }


    public function destroy(Gallery $gallery, Album $album, Image $image)
    {
        $image->delete();

        return redirect()
                ->route('admin.galleries.albums.show', [$gallery->id, $album->id])
                ->with('status', 'Image deleted.');
    }
}

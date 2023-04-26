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

    public function index()
    {
        //
    }


    public function create(Gallery $gallery, Album $album)
    {
        return view('admin.album-image.create', ['gallery' => $gallery, 'album' => $album]);
    }


    public function store(Gallery $gallery, Album $album, Request $request): RedirectResponse
    {        
        $validated = $request->validate([
            'title' => 'required',
            'caption' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
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


    public function show(Gallery $gallery, Image $image)
    {
        //
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
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
            ->route('admin.galleries.albums.show', [$gallery->id, $album->id])
            ->with('status', 'Image updated.');
    }


    public function destroy(Gallery $gallery, Album $album, Image $image)
    {
        $image->delete();

        return redirect()->route('admin.galleries.albums.show', [$gallery->id, $album->id])->with('status', 'Image deleted.');
    }
}

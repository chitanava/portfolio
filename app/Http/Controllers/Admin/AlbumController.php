<?php

namespace App\Http\Controllers\Admin;

use App\Models\Album;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class AlbumController extends Controller
{

    public function index()
    {
        //
    }


    public function create(Gallery $gallery)
    {
        return view('admin.album.create', ['gallery' => $gallery]);
    }


    public function store(Gallery $gallery, Request $request): RedirectResponse
    {        
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable|string',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'active' => 'required',
        ]);

        $album = $gallery->albums()->create([
            'title' => $request->title,
            'description' => $request->description,
            'active' => $request->active,
        ]);

        $album->addMediaFromRequest('cover')->toMediaCollection();

        return redirect()
            ->route('admin.galleries.show', $gallery->id)
            ->with('status', 'Album created.');
    }


    public function show(Gallery $gallery, Album $album)
    {
        return view('admin.album.show', ['gallery' => $gallery, 'album' => $album]);
    }


    public function edit(Gallery $gallery, Album $album)
    {
        return view('admin.album.edit', ['gallery' => $gallery, 'album' => $album]);
    }


    public function update(Request $request, Gallery $gallery, Album $album): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'active' => 'required',
        ]);

        $album->update([
            'title' => $request->title,
            'description' => $request->description,
            'active' => $request->active,
        ]);

        if($request->hasFile('cover')){
            $album->getMedia()[0]->delete();
            $album->addMediaFromRequest('cover')->toMediaCollection();
        }

        return redirect()
            ->route('admin.galleries.show', $gallery->id)
            ->with('status', 'Album updated.');
    }


    public function destroy(Gallery $gallery, Album $album)
    {
        $album->delete();

        return redirect()->route('admin.galleries.show', $gallery->id)->with('status', 'Album deleted.');
    }
}

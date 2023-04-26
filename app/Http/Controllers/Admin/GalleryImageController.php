<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class GalleryImageController extends Controller
{

    public function create(Gallery $gallery)
    {
        return view('admin.gallery-image.create', ['gallery' => $gallery]);
    }


    public function store(Request $request, Gallery $gallery): RedirectResponse
    {        
        $validated = $request->validate([
            'title' => 'required',
            'caption' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'active' => 'required',
        ]);

        $image = $gallery->images()->create([
            'title' => $request->title,
            'caption' => $request->caption,
            'active' => $request->active,
        ]);

        $image->addMediaFromRequest('image')->toMediaCollection();

        return redirect()
            ->route('admin.galleries.show', $gallery->id)
            ->with('status', 'Image created.');
    }


    public function edit(Gallery $gallery, Image $image)
    {
        return view('admin.gallery-image.edit', ['gallery' => $gallery, 'image' => $image]);
    }


    public function update(Request $request, Gallery $gallery, Image $image): RedirectResponse
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
                ->route('admin.galleries.images.edit', [$gallery->id, $image->id])
                ->with('status', 'Image updated.');
    }


    public function destroy(Gallery $gallery, Image $image)
    {
        $image->delete();

        return redirect()
                ->route('admin.galleries.show', $gallery->id)
                ->with('status', 'Image deleted.');
    }
}

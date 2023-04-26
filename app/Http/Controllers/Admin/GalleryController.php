<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class GalleryController extends Controller
{
    public function index()
    {
        return view('admin.gallery.index');
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required',
            'active' => 'required',
        ]);

        Gallery::create($validated);

        return redirect()
                ->route('admin.galleries')
                ->with('status', 'Gallery created.');
    }

    public function show(Gallery $gallery)
    {
        return view('admin.gallery.show', ['gallery' => $gallery]);
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', ['gallery' => $gallery]);
    }

    public function update(Request $request, Gallery $gallery): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required',
            'active' => 'required',
        ]);

        $gallery->update($validated);

        return redirect()
                ->route('admin.galleries.edit', $gallery->id)
                ->with('status', 'Gallery updated.');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        $gallery->delete();

        return redirect()
                ->route('admin.galleries')
                ->with('status', 'Gallery deleted.');
    }
}

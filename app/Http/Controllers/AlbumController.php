<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AlbumController extends Controller
{
    public function index(Gallery $gallery, Album $album)
    {
        abort_if(!$gallery->active, 404);
        abort_if(!$album->active, 404);

        $images = $album->images()
            ->with('media')
            ->where('active', 1)
            ->orderBy('ord', 'asc')
            ->get();

        $videos = $album->videos()
            ->with('media')
            ->where('active', 1)
            ->orderBy('ord', 'asc')
            ->get();

        $albumItems = collect([$images, $videos])->flatten(1)
            ->sortBy('ord')
            ->values();

        return view('site.album', [
            'gallery' => $gallery,
            'album' => $album,
            'albumItems' => $albumItems
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Traits\ItemsTrait;
use App\Models\Album;
use App\Models\Gallery;

class AlbumController extends Controller
{
    use ItemsTrait;
    
    public function index(Gallery $gallery, Album $album)
    {
        abort_if(!$gallery->active, 404);
        abort_if(!$album->active, 404);

        return view('site.album', [
            'gallery' => $gallery,
            'album' => $album,
            'albumItems' => $this->albumItems($album)
        ]);
    }
}

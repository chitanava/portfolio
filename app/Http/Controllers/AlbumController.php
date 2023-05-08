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
            ->where('active', 1)
            ->orderBy('ord', 'asc')
            ->get();

        return view('site.album', [
            'gallery' => $gallery, 
            'album' => $album, 
            'images' => $images]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class GalleryController extends Controller
{
    public function index(Gallery $gallery)
    {
        $albums = $gallery->albums()
            ->where('active', 1)
            ->orderBy('ord', 'asc')
            ->get();

        $images = $gallery->images()
            ->where('active', 1)
            ->orderBy('ord', 'asc')
            ->get();

        $videos = $gallery->videos()
            ->where('active', 1)
            ->orderBy('ord', 'asc')
            ->get();

        $galleryItems = $albums
            ->concat($images)
            ->concat($videos)
            ->sortBy('ord')
            ->values();

            // dd($galleryItems[10]->class);

        return view('site.gallery', ['gallery' => $gallery, 'galleryItems' => $galleryItems]);
    }
}

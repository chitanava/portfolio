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
            ->with('media')
            ->where('active', 1)
            ->orderBy('ord', 'asc')
            ->get();

        $images = $gallery->images()
            ->with('media')
            ->where('active', 1)
            ->orderBy('ord', 'asc')
            ->get();

        $videos = $gallery->videos()
            ->with('media')
            ->where('active', 1)
            ->orderBy('ord', 'asc')
            ->get();

        $galleryItems = collect([$albums, $images, $videos])->flatten(1)->sortBy('ord')->values();

        return view('site.gallery', ['gallery' => $gallery, 'galleryItems' => $galleryItems]);
    }
}

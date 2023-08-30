<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Http\Traits\ItemsTrait;

class GalleryController extends Controller
{
    use ItemsTrait;

    public function index(Gallery $gallery)
    {
        return view('site.gallery', ['gallery' => $gallery, 'galleryItems' => $this->galleryItems($gallery)]);
    }
}

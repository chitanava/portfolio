<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $images = Image::where('active', 1)->inRandomOrder()->take(14)->get();

        return view('site.home', ['images' => $images]);
    }
}

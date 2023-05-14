<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
    public function index()
    {
        $images = Image::whereHasMorph('imageable',
                [\App\Models\Gallery::class, \App\Models\Album::class],
                function(Builder $query){
                    $query->where(['home_bank' => 1, 'active' => 1]);
                })->where('active', 1)->inRandomOrder()->take(14)->get();

        return view('site.home', ['images' => $images]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
    public function index()
    {
        $home_images = Setting::findOrFail(1)->home_images ?? config('settings.home_images');

        $images = Image::with('media')->whereHasMorph(
            'imageable',
            [\App\Models\Gallery::class, \App\Models\Album::class],
            function (Builder $query) {
                $query->where(['home_bank' => 1, 'active' => 1]);
            }
        )->where('active', 1)->inRandomOrder()->take($home_images)->get()->map(function ($image) {
            return $image->getFirstMediaUrl();
        });

        return view('site.home', ['images' => $images]);
    }
}

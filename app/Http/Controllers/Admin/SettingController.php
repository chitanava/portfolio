<?php

namespace App\Http\Controllers\Admin;

use App\Models\Album;
use App\Models\Gallery;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class SettingController extends Controller
{
    public function edit()
    {
        $galleries = Gallery::query()->get();
        $albums = Album::query()->get();

        $settings = Setting::firstOrFail();
        return view('admin.setting.edit', [
            'settings' => $settings, 
            'galleries' => $galleries, 
            'albums' => $albums]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'custom_css' => 'nullable|string',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
            'app_name' => 'nullable|string',
            'gallery_bank' => 'nullable|array',
            'album_bank' => 'nullable|array'
        ]);

        $settings = Setting::firstOrFail();
        $settings->update([
            'custom_css' => $request->custom_css,
            'seo_description' => $request->seo_description,
            'seo_keywords' => $request->seo_keywords,
            'app_name' => $request->app_name,
        ]);

        Gallery::where('home_bank', 1)->update(['home_bank' => 0]);
        Album::where('home_bank', 1)->update(['home_bank' => 0]);

        if($request->gallery_bank){
            foreach($request->gallery_bank as $value){
                $gallery = Gallery::findOrFail($value);
                $gallery->home_bank = 1;
                $gallery->save();
            }
        }

        if($request->album_bank){
            foreach($request->album_bank as $value){
                $album = Album::findOrFail($value);
                $album->home_bank = 1;
                $album->save();
            }
        }

        return redirect()
                ->route('admin.settings.edit')
                ->with('status', 'Settings updated.');
    }
}

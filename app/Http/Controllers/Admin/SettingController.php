<?php

namespace App\Http\Controllers\Admin;

use App\Models\Album;
use App\Models\Gallery;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

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
        if($request->delete_file == 'true' ? 1 : 0){
            Storage::disk('analytics')->delete(env('ANALYTICS_SECRET_JSON'));
        }

        $validated = $request->validate([
            'custom_css' => 'nullable|string',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
            'app_name' => 'nullable|string',
            'gallery_bank' => 'nullable|array',
            'album_bank' => 'nullable|array',
            'default_fonts' => 'required',
            'home_images' => 'nullable|integer',
            'maintenance_mode' => 'required',
            'google_tag' => 'nullable|string',
            'analytics_retrieve_data' => 'required',
            'analytics_property_id' => 'nullable|string',
            'analytics_secret_json' => 'nullable|mimes:json|max:'.config('app.upload_max_filesize'),
            'blog' => 'required',
        ]);
        
        $settings = Setting::firstOrFail();

        $settings->update([
            'custom_css' => $request->custom_css,
            'seo_description' => $request->seo_description,
            'seo_keywords' => $request->seo_keywords,
            'app_name' => $request->app_name,
            'default_fonts' => $request->default_fonts,
            'home_images' => $request->home_images,
            'google_tag' => $request->google_tag,
            'analytics_retrieve_data' => $request->analytics_retrieve_data,
            'analytics_property_id' => $request->analytics_property_id,
            'blog' => $request->blog,
        ]);

        if($request->file('analytics_secret_json')) {
            $path = $request->file('analytics_secret_json')->storeAs('', env('ANALYTICS_SECRET_JSON'), 'analytics');
        }

        if($settings->maintenance_mode !== (int)$request->maintenance_mode) {
            $settings->update([
                'maintenance_mode' => $request->maintenance_mode,
                'maintenance_token' => $request->maintenance_mode ? Str::random(12) : null
            ]);

            if($request->maintenance_mode){
                Artisan::call('up');
                Artisan::call('down --secret="'.$settings->maintenance_token.'"');
            } else {
                Artisan::call('up');
            }
        }

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

    public function downloadAnalyticsSecretJson($file){
        return Storage::disk('analytics')->download($file);
    }
}

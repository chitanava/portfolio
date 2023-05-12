<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::firstOrFail();
        return view('admin.setting.edit', ['settings' => $settings]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'custom_css' => 'nullable|string',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
        ]);

        $settings = Setting::firstOrFail();
        $settings->update($validated);

        return redirect()
                ->route('admin.settings.edit')
                ->with('status', 'Settings updated.');
    }
}

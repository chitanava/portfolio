<?php

namespace App\Http\Controllers\Admin;

use App\Models\Biography;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\TrixAttachment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BiographyController extends Controller
{
    use TrixAttachment;

    public function edit()
    {
        $biography = Biography::firstOrFail();
        return view('admin.biography.edit', ['biography' => $biography]);
    }


    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'body' => 'required',
        ]);

        $biography = Biography::firstOrFail();
        $biography->update($validated);

        return redirect()
                ->route('admin.biography.edit')
                ->with('status', 'Biography updated.');
    }
}

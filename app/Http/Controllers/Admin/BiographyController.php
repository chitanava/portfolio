<?php

namespace App\Http\Controllers\Admin;

use App\Models\Biography;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class BiographyController extends Controller
{
    public function edit(Biography $biography)
    {
        return view('admin.biography.edit', ['biography' => $biography]);
    }


    public function update(Request $request, Biography $biography): RedirectResponse
    {
        $validated = $request->validate([
            'body' => 'required',
        ]);

        $biography->update($validated);

        return redirect()
                ->route('admin.biography.edit', $biography->id)
                ->with('status', 'Biography updated.');
    }
}

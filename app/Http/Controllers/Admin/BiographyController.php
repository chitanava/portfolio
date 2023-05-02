<?php

namespace App\Http\Controllers\Admin;

use App\Models\Biography;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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


    public function attachmentAdd(Request $request)
    { 
        try {
            $validator = Validator::make($request->all(), [
                    'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                ])->validate();

            $path = $request->file('file')->store(
                '',
                'trix'
            );
    
            return response()->json([
                'success' => true,
                'url' => Storage::disk('trix')->url($path),
                'file' => $path
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }


    public function attachmentRemove(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'file' => 'required',
            ])->validate();

            Storage::disk('trix')->delete($request->file);
            
            return response()->json([
                'success' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}

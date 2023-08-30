<?php
namespace App\Http\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

trait TrixAttachment
{
  public function attachmentAdd(Request $request)
    { 
        try {
            $validator = Validator::make($request->all(), [
                    'file' => 'required|mimes:jpeg,png,jpg,pdf|max:'.config('app.upload_max_filesize'),
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
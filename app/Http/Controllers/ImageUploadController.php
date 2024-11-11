<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
     public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            if ($file->getSize() > 5242880) { // 5MB in bytes
            return response()->json(['uploaded' => false, 'error' => [
                'message' => 'File size exceeds the limit of 5MB.'
            ]]);
        }
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/uploads', $filename);
            $url = Storage::url($path);

            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        }

        return response()->json(['uploaded' => false, 'error' => ['message' => 'Failed to upload image']], 400);
    }
}

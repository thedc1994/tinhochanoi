<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class ImageUploadController extends Controller
{
    public function showForm()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120', // tối đa 5MB
        ]);

        $image = $request->file('image');

        // 1. Compress ảnh
        $compressedImage = Image::make($image)
            ->encode('jpg', 75); // nén về JPG, quality 75%

        // 2. Tạo tên ảnh
        $path = 'uploads/' . uniqid() . '.jpg';

        Storage::disk('r2')->put($path, $compressedImage);

        $url = rtrim(env('R2_URL_IMAGE'), '/') . '/' . ltrim($path, '/');

        return response()->json([
            'path' => $path,
            'url' => $url
        ]);

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ShopController extends Controller
{
    public function store(Request $request)
    {
        // Get the original filename
        $filename = $request->file('photo')->getClientOriginalName();

        // Upload the original image to the "shops" directory
        $request->file('photo')->storeAs('shops', $filename);

        // Resize the uploaded image to 500x500 and store it with a prefix "resized-"
        $resizedFilename = 'resized-' . $filename;
        $image = Image::make(storage_path('app/shops/' . $filename))
            ->fit(500, 500)
            ->save(storage_path('app/shops/' . $resizedFilename));

        return 'Success';
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class HouseController extends Controller
{
    public function store(Request $request)
    {
        $filename = $request->file('photo')->store('houses');

        House::create([
            'name' => $request->name,
            'photo' => $filename,
        ]);

        return 'Success';
    }

    public function update(Request $request, House $house)
    {
        // Validate the request
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
        ]);

        // Store the new file
        $newFilename = $request->file('photo')->store('houses');

        // Delete the old file from storage
        Storage::delete($house->photo);

        // Update the house with the new file
        $house->update([
            'name' => $request->name,
            'photo' => $newFilename,
        ]);

        return 'Success';
    }

    // public function download(House $house): BinaryFileResponse
    // {
    //     // Get the file path from the storage
    //     $filePath = storage_path('app/houses/' . basename($house->photo));

    //     // Check if the file exists
    //     if (file_exists($filePath)) {
    //         // Download the file
    //         return response()->download($filePath, $house->name);
    //     } else {
    //         // Handle the case where the file does not exist
    //         abort(404, 'File not found');
    //     }
    // }

    public function download(House $house): BinaryFileResponse
{
    // Get the file path from the storage
    $filePath = storage_path('app/houses/' . basename($house->photo));

    // Check if the file exists in the storage disk
    if (Storage::exists('houses/' . basename($house->photo))) {
        // Download the file
        return response()->download($filePath, $house->name);
    } else {
        // Handle the case where the file does not exist
        abort(404, 'File not found');
    }
}
}
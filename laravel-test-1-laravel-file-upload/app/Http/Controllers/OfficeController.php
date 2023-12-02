<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfficeController extends Controller
{
    public function store(Request $request)
    {
        // Get the original filename
        $originalFilename = $request->file('photo')->getClientOriginalName();

        // Generate a unique filename to avoid conflicts
        $filename = pathinfo($originalFilename, PATHINFO_FILENAME) . '_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();

        // Upload the file to the public disk in the "offices" directory
        $path = $request->file('photo')->storeAs('public/offices', $filename);

        // Create the office record
        Office::create([
            'name' => $request->name,
            'photo' => $filename,
        ]);

        return 'Success';
    }

    public function show(Office $office)
    {
        return view('offices.show', compact('office'));
    }
}
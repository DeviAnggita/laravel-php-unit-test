<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'max:1024', // Max file size is set to 1 megabyte (1024 KB)
        ]);

        // Get the original filename
        $filename = $request->file('logo')->getClientOriginalName();

        // Upload the file to the "logos" directory
        $request->file('logo')->storeAs('logos', $filename);

        // Create the project record
        Project::create([
            'name' => $request->name,
            'logo' => $filename,
        ]);

        return 'Success';
    }
}
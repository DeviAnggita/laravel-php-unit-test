<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Stat;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProjectController extends Controller
{
    // public function store(Request $request)
    // {
    //     // TASK: Currently this statement fails. Fix the underlying issue.
    //     Project::create([
    //         'name' => $request->name
    //     ]);

    //     return redirect('/')->with('success', 'Project created');
    // }

    public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        // Add more validation rules if needed
    ]);

    try {
        // Attempt to create a new project
        $project = Project::create([
            'name' => $request->name,
        ]);

        // Redirect with success message if successful
        return redirect('/')->with('success', 'Project created');
    } catch (\Exception $e) {
        // Handle the exception, e.g., log it or return an error response
        return redirect('/')->with('error', 'Failed to create project');
    }
}

    public function mass_update(Request $request)
    {
        // TASK: Transform this SQL query into Eloquent
        // update projects
        //   set name = $request->new_name
        //   where name = $request->old_name

        // Insert Eloquent statement below
        Project::where('name', $request->old_name)
            ->update(['name' => $request->new_name]);

        return redirect('/')->with('success', 'Projects updated');
    }

    public function destroy($projectId)
    {
        // TASK: change this Eloquent statement to include the soft-deletes records
        $projects = Project::withTrashed()->get();
        Project::destroy($projectId);

        return view('projects.index', compact('projects'));
    }

    public function store_with_stats(Request $request)
    {
        // TASK: on creating a new project, create an Observer event to run SQL
        //   update stats set projects_count = projects_count + 1
        $project = new Project();
        $project->name = $request->name;
        $project->save();

        // Increment projects_count in the stats table
        Stat::increment('projects_count');

        return redirect('/')->with('success', 'Project created');
    }
}
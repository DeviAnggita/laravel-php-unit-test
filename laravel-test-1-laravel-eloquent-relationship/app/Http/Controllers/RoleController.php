<?php

namespace App\Http\Controllers;

use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('users')->get(); // Use eager loading to load users relationship

        return view('roles.index', compact('roles'));
    }
}
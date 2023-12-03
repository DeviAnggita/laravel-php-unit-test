<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.stats');
    }
    
    public function __invoke(Request $request)
    {
        return view('admin.stats');
    }
}
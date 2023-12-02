<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function store(Request $request)
    {
        $company = Company::create([
            'name' => $request->name,
        ]);

        // Add the uploaded photo to the 'companies' collection
        $company->addMediaFromRequest('photo')->toMediaCollection('companies');

        return 'Success';
    }

    public function show(Company $company)
    {
        // Retrieve the full URL of the uploaded photo using Spatie Media Library
        $photo = $company->getFirstMediaUrl('companies');

        return view('companies.show', compact('company', 'photo'));
    }
}
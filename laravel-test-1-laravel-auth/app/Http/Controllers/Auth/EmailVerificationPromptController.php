<?php

// File: app/Http/Controllers/Auth/EmailVerificationPromptController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? Redirect::route('home') // Change 'home' to your actual home route
            : Redirect::route('verification.notice');
    }
}
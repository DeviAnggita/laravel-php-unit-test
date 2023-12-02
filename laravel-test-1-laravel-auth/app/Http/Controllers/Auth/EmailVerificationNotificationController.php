<?php

// File: app/Http/Controllers/Auth/EmailVerificationNotificationController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return Redirect::route('home'); // Change 'home' to your actual home route
        }

        $user->sendEmailVerificationNotification();

        return Redirect::route('verification.notice') // Change 'verification.notice' to your actual email verification notice route
            ->with('status', 'verification-link-sent');
    }
}
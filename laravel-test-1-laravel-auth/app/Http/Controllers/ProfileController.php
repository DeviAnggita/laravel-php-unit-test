<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Perbarui nama dan email
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Perbarui password jika diisi
        if ($request->has('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Simpan perubahan
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }


}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit');
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    public function editPassword(Request $request): View
    {
        return view('profile.edit-password');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'oldPassword' => 'required|string',
            'newPassword' => 'required|string',
        ]);

        if (Hash::check($request->oldPassword, Auth::user()->password)) {
            Auth::user()->update([ 'password' => Hash::make($request->newPassword) ]);
        } else {
            throw ValidationException::withMessages(['oldPassword' => 'Password lama tidak sesuai']);
        }

        return Redirect::route('profile.password.edit');
    }
}

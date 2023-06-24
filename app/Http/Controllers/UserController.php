<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    public function detail($id) {
        $user = User::with('videos')->findOrFail($id);

        return view('users.detail', compact('user'));
    }

    public function indexFollowing() {
        $users = Auth::user()->followings()->get();

        return view('users.following', compact('users'));
    }

    public function toggleFollow($id) {
        $user = User::findOrFail($id);

        Auth::user()->followings()->toggle([
            $user->id => [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        return redirect()->back();
    }
}

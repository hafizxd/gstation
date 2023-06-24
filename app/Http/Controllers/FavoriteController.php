<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Video;
use Carbon\Carbon;

class FavoriteController extends Controller
{
    public function index() {
        $videos = Auth::user()->favorites()->orderBy('created_at', 'desc')->get();

        return view('videos.favorite', compact('videos'));
    }

    public function toggle($id) {
        $video = Video::findOrFail($id);

        $video->favoritedBy()->toggle([
            Auth::user()->id => [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        return redirect()->back();
    }
}

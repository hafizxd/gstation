<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\DeletedReason;
use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function index(Request $request) {
        $videos = Video::with('user')->when(isset($request->search), function ($query) use ($request) {
            $query->where('title', 'LIKE', '%'.$request->search.'%');
        })->orderBy('created_at', 'desc')->get();

        return view('videos.index', compact('videos'));
    }

    public function create() {
        return view('videos.create');
    }

    public function store(Request $request) {
        $request->validate([
            'video' => 'required|max:100000|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi,video/x-matroska',
            'title' => 'required|string',
            'description' => 'nullable',
            'thumbnail' => 'required|image|max:2024'
        ]);

        $videoName = 'video-'.Auth::user()->username.'-'.time().'.'.$request->video->extension();
        $request->video->storeAs('uploads/videos', $videoName);

        $thumbnailName = 'thumbnail-'.Auth::user()->username.'-'.time().'.'.$request->thumbnail->extension();
        $request->thumbnail->storeAs('uploads/thumbnails', $thumbnailName);

        Video::create([
            'title' => $request->title,
            'description' => $request->description,
            'video' => $videoName,
            'thumbnail' => $thumbnailName,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('video.index');
    }

    public function detail($id) {
        $video = Video::with(['user', 'replies.nestedReplies'])->findOrFail($id);

        return view('videos.detail', compact('video'));
    }

    public function destroy($id) {
        $video = Video::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        $video->delete();

        return redirect()->back();
    }

    public function indexMine() {
        $videos = Video::with('user')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return view('videos.mine', compact('videos'));
    }

    public function destroyByAdmin(Request $request, $id) {
        if (Auth::user()->role != 1) {
            dd('a');
            abort(503);
        }

        $video = Video::where('id', $id)->firstOrFail();

        $str = "Video anda ".$video->title." telah dihapus oleh Admin";
        if (isset($request->reason)) {
            $str .= " karena " . $request->reason;
        }

        $video->delete();

        DeletedReason::create([
            'reason' => $str,
            'user_id' => $video->user->id,
            'admin_id' => Auth::user()->id
        ]);

        return redirect()->route('video.index');
    }
}

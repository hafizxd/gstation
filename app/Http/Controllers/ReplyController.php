<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\NestedReply;
use App\Models\Video;
use App\Models\Reply;

class ReplyController extends Controller
{
    public function store(Request $request, $id) {
        $request->validate([
            'reply' => 'required|string'
        ]);

        $video = Video::findOrFail($id);

        $video->replies()->create([
            'body' => $request->reply,
            'user_id' => Auth::user()->id
        ]); 

        return redirect()->back();
    }

    public function destroy($id) {
        $reply = Auth::user()->replies()->findOrFail($id);

        $reply->delete();

        return redirect()->back();
    }

    public function nestedStore(Request $request, $id) {
        $request->validate([
            'nestedReply' => 'required|string'
        ]);

        $reply = Reply::findOrFail($id);

        $reply->nestedReplies()->create([
            'body' => $request->nestedReply,
            'user_id' => Auth::user()->id
        ]); 

        return redirect()->back();
    }

    public function nestedDestroy($id) {
        $nest = Auth::user()->nestedReplies()->findOrFail($id);

        $nest->delete();

        return redirect()->back();
    }
}

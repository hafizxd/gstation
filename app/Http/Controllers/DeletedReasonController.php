<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeletedReason;
use Illuminate\Support\Facades\Auth;

class DeletedReasonController extends Controller
{
    public function index() {
        $reasons = DeletedReason::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return view('deleted-reasons.index', compact('reasons'));
    }
}

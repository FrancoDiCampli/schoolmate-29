<?php

namespace App\Http\Controllers;

use App\Comment;
use App\JobComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request){
        $datos = $request->validate([
            'comment' => 'min:3|max:3000',
        ]);
        Comment::create([
            'user_id' => Auth::user()->id,
            'delivery_id' => $request->delivery,
            'comment' => $datos['comment'],
        ]);

        return redirect()->back();

    }

    public function addJobComment(Request $request)
    {
        $datos = $request->validate([
            'comment' => 'min:3|max:3000',
        ]);
        JobComment::create([
            'user_id' => Auth::user()->id,
            'job_id' => $request->job,
            'comment' => $datos['comment'],
        ]);

        return redirect()->back();
    }
}

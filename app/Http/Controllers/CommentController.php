<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request){


        Comment::create([
            'user_id' => Auth::user()->id,
            'delivery_id' => $request->delivery,
            'comment' => $request->comment,
        ]);

        return redirect()->back();

    }
}

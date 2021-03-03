<?php

namespace App\Http\Controllers;

use App\Post;
use App\Subject;
use App\Annotation;
use App\Traits\PaginarTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Traits\NotificationsTrait;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index($id)
    {
        $subject = Subject::where('id', $id)->where('active', true)->first();
        // $subject->jobs;

        // $posts = Post::where('user_id',Auth::user()->id)->where('subject_id',$id)->with('annotations')->orderBy('created_at', 'DESC')->paginate(2);
        $auxPosts = Post::where('subject_id', $id)->with('annotations')->orderBy('created_at', 'DESC')->get();
        $posts = collect();
        foreach ($auxPosts as $item) {
            if ($item->subject->active == true) {
                $posts->push($item);
            }
        }

        // if (count($posts) < 1) {
        //     if (Auth::user()->roles()->first()->name == 'student') {
        //         return redirect()->route('student');
        //     } else return redirect()->route('teacher');
        // }

        $posts = PaginarTrait::paginate($posts, 5);

        return view('admin.posts.index', compact('subject', 'posts'));
    }

    public function create($id)
    {
        $subject = Subject::find($id);
        return view('admin.posts.create', compact('subject'));
    }

    public function store(Request $request)
    {
        // return $request;
        $sub = Subject::where('id', $request->subject_id)->get();

        $data = $request->validate([
            'title' => 'min:5|max:40',
            'description' => 'min:20|max:90',
            'content' => 'min:20|max:30000',
        ]);
        $data['subject_id'] = $request->subject_id;
        $data['user_id'] = auth()->user()->id;

        Post::create($data);

        return redirect()->route('posts.index', $request->subject_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        if ($post->subject->active == true) {
            if (Auth::user()->student) {
                NotificationsTrait::studentMarkAsRead('post_id', $id);
            }
            return view('admin.posts.showPost', compact('post'));
        } elseif (Auth::user()->roles()->first()->name == 'student') {
            return redirect()->route('student');
        } else return redirect()->route('teacher');
    }

    public function edit(Post $post)
    {
        if ($post->subject->active == true) {
            return view('admin.posts.edit', compact('post'));
        } else return redirect()->route('teacher');
    }

    public function update(Request $request, Post $post)
    {

        $postValidation = $request->validate([
            'title' => 'min:5|max:40|unique:posts,id,' . $post->id,
            'description' => 'min:20|max:90',
            'content' => 'min:20|max:30000'
        ]);

        $post->update($postValidation);

        session()->flash('messages', 'Post actualizado');
        return redirect()->route('posts.index', $post->subject->id);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $idSucject = $post->subject->id;
        $post->annotations()->delete();
        $post->delete();

        session()->flash('messages', 'Post eliminado');
        return redirect()->route('posts.index', $idSucject);
    }
}

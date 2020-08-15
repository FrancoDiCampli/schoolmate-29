<?php

namespace App\Http\Controllers;

use App\Post;
use App\Subject;
use App\Annotation;
use App\Traits\NotificationsTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index($id)
    {
        $subject = Subject::find($id);
        $subject->jobs;

        // $posts = Post::where('user_id',Auth::user()->id)->where('subject_id',$id)->with('annotations')->orderBy('created_at', 'DESC')->paginate(2);
        $posts = Post::where('subject_id',$id)->with('annotations')->orderBy('created_at', 'DESC')->paginate(5);

        return view('admin.posts.index', compact('subject','posts'));
    }

    public function create($id)
    {
        $subject = Subject::find($id);
        return view('admin.posts.create',compact('subject'));

    }

    public function store(Request $request){
        // return $request;
        $sub = Subject::where('id',$request->subject_id)->get();

        $data = $request->validate([
            'title' => 'min:5|max:40',
            'description' => 'min:19|max:90',
            'content' => 'min:20|max:3000',
        ]);
        $data['subject_id'] = $request->subject_id;
        $data['user_id'] = auth()->user()->id;
        
        Post::create($data);

        return redirect()->route('posts.index',$request->subject_id);
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

        if(Auth::user()->student){
            NotificationsTrait::studentMarkAsRead('post_id', $id);
        }

        return view('admin.posts.showPost', compact('post'));
    }

    public function edit(Post $post){

        return view('admin.posts.edit', compact('post'));

    }

    public function update(Request $request, Post $post){

        $postValidation = $request->validate([
            'title'=> 'min:5|max:40|unique:posts,id,'.$post->id,
            'description'=>'min:19|max:90',
            'content'=>'min:20|max:3000'
        ]);

        $post->update($postValidation);

        session()->flash('messages', 'Post actualizado');
        return redirect()->route('posts.index', $post->subject->id);
    }
}

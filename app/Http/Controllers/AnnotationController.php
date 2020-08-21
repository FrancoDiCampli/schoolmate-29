<?php

namespace App\Http\Controllers;

use App\Annotation;
use Illuminate\Http\Request;

class AnnotationController extends Controller
{
    public function store(Request $request){

        $data = $request->validate([
            'annotation' => 'min:3|max:3000'
        ]);
        $data['post_id'] = $request->post_id;
        $data['user_id'] = auth()->user()->id;

        Annotation::create($data);

            return redirect()->back();
    }
}

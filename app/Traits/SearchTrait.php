<?php

namespace App\Traits;

use App\Job;
use App\Post;
use App\Subject;
use App\Delivery;
use Illuminate\Support\Facades\Auth;

trait SearchTrait
{
    public static function searchJobs($request)
    {
        if (auth()->user()->hasRole('student')) {
            $subject = Subject::find($request->subjectID);
            $jobs = Job::where('subject_id', $request->subjectID)
                ->where('state', 1)
                ->where('title', 'LIKE', "%$request->search%")
                ->orderBy('created_at', 'DESC')
                ->get();
            if ($jobs->count() > 0) {
                $subject->jobs = $jobs;
            }
        } else {
            $subject = Subject::find($request->subjectID);
            $jobs = Job::where('subject_id', $request->subjectID)
                ->where('title', 'LIKE', "%$request->search%")
                ->orderBy('created_at', 'DESC')
                ->get();
            if ($jobs->count() > 0) {
                $subject->jobs = $jobs;
            }
        }

        return view('admin.jobs.index', compact('subject'));
    }

    public static function searchPosts($request)
    {
        $subject = Subject::find($request->subjectID);
        $subject->jobs;

        $posts = Post::where('title', 'LIKE', "%$request->search%")
            ->where('subject_id', $request->subjectID)
            ->with('annotations')
            ->orderBy('created_at', 'DESC')
            ->paginate(5);

        if ($posts->count() == 0) {
            $posts = Post::where('subject_id', $request->subjectID)
                ->with('annotations')
                ->orderBy('created_at', 'DESC')
                ->paginate(5);
        }

        return view('admin.posts.index', compact('subject', 'posts'));
    }

    public static function searchDeliveries($request)
    {

        $user = Auth::user()->student->id;
        $jobs = Job::where('subject_id', $request->subjectID)
            ->where('title', 'LIKE', "%$request->search%")
            ->get();

        if ($jobs->count() == 0) {
            $jobs = Job::where('subject_id', $request->subjectID)->get();
        }

        $subject = Subject::find($request->subjectID);

        $deliveries =  Delivery::whereIn('job_id', $jobs->modelkeys())->get();

        $deliveries = $deliveries->where('student_id', $user);

        return view('admin.deliveries.index', compact('deliveries', 'subject'));
    }
}

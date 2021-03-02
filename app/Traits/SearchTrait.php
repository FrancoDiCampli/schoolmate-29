<?php

namespace App\Traits;

use App\Job;
use App\Post;
use App\Subject;
use App\Delivery;
use App\Traits\PaginarTrait;
use Illuminate\Support\Facades\Auth;

trait SearchTrait
{
    public static function searchJobs($request)
    {
        if (auth()->user()->hasRole('student')) {
            // $subject = Subject::find($request->subjectID);
            $subject = Subject::where('id', $request->subjectID)->where('active', true)->first();
            $auxJobs = Job::where('subject_id', $request->subjectID)
                ->where('state', 1)
                ->where('title', 'LIKE', "%$request->search%")
                ->orderBy('created_at', 'DESC')
                ->get();
            $jobs = collect();
            foreach ($auxJobs as $item) {
                if ($item->subject->active == true) {
                    $jobs->push($item);
                }
            }
            if ($jobs->count() > 0) {
                $subject->jobs = $jobs;
            }
        } else {
            // $subject = Subject::find($request->subjectID);
            $subject = Subject::where('id', $request->subjectID)->where('active', true)->first();
            $auxJobs = Job::where('subject_id', $request->subjectID)
                ->where('title', 'LIKE', "%$request->search%")
                ->orderBy('created_at', 'DESC')
                ->get();
            $jobs = collect();
            foreach ($auxJobs as $item) {
                if ($item->subject->active == true) {
                    $jobs->push($item);
                }
            }
            if ($jobs->count() > 0) {
                $subject->jobs = $jobs;
            }
        }
        if ($jobs && $subject) {
            $subject->jobs = PaginarTrait::paginate($jobs, 5);
        } elseif (Auth::user()->roles()->first()->name == 'student') {
            return redirect()->route('student');
        } else return redirect()->route('teacher');

        return view('admin.jobs.index', compact('subject'));
    }

    public static function searchPosts($request)
    {
        // $subject = Subject::find($request->subjectID);
        $subject = Subject::with('jobs')->where('id', $request->subjectID)->where('active', true)->first();

        $auxPosts = Post::where('title', 'LIKE', "%$request->search%")
            ->where('subject_id', $request->subjectID)
            ->with('annotations')
            ->orderBy('created_at', 'DESC')
            ->get();
        $posts = collect();
        foreach ($auxPosts as $item) {
            if ($item->subject->active == true) {
                $posts->push($item);
            }
        }

        if ($posts->count() == 0) {
            $auxPosts = Post::where('subject_id', $request->subjectID)
                ->with('annotations')
                ->orderBy('created_at', 'DESC')
                ->get();
            $posts = collect();
            foreach ($auxPosts as $item) {
                if ($item->subject->active == true) {
                    $posts->push($item);
                }
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

    public static function searchDeliveries($request)
    {
        $user = Auth::user()->student->id;
        $auxJobs = Job::where('subject_id', $request->subjectID)
            ->where('title', 'LIKE', "%$request->search%")
            ->get();

        $jobs = collect();
        foreach ($auxJobs as $item) {
            if ($item->subject->active == true) {
                $jobs->push($item);
            }
        }

        if ($jobs->count() == 0) {
            $auxJobs = Job::where('subject_id', $request->subjectID)->get();
            $jobs = collect();
            foreach ($auxJobs as $item) {
                if ($item->subject->active == true) {
                    $jobs->push($item);
                }
            }
        }

        // $subject = Subject::find($request->subjectID);
        $subject = Subject::where('id', $request->subjectID)->where('active', true)->first();

        if (count($jobs) > 0) {
            $auxKeys = $jobs->keyBy('id');
            $modelKeys = $auxKeys->keys();
        } else $modelKeys = [];

        $deliveries =  Delivery::whereIn('job_id', $modelKeys)->get();

        $deliveries = $deliveries->where('student_id', $user);

        if (count($deliveries) < 1) {
            return redirect()->route('student');
        }

        $deliveries = PaginarTrait::paginate($deliveries, 5);

        return view('admin.deliveries.index', compact('deliveries', 'subject'));
    }
}

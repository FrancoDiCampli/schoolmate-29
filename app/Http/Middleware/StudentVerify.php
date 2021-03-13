<?php

namespace App\Http\Middleware;

use App\Job;
use Closure;
use App\Subject;
use App\Enrollment;
use Illuminate\Support\Facades\Auth;

class StudentVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        switch (auth()->user()->roles()->first()->name) {
            case 'student':
                $aux =  Enrollment::where('student_id', auth()->user()->student->id)->where('cicle', session('selectedAnio'))->select('course_id')->first();
                break;

                #REVISAR PROFE
            case 'teacher':
                $aux = auth()->user()->teacher->subjects;
                return dd($aux);
                break;

            default:
                $aux = null;
                break;
        }

        if ($aux != null) {
            $course_id = $aux->course_id;
        } else $course_id = 0;

        if (Auth::check()) {
            if ($request->route('job')) {
                $job = Job::find($request->route('job'));
                $job_course_id = $job->subject->course->id;
                if ($course_id != $job_course_id) {
                    abort(401);
                }
                return $next($request);
            } elseif ($request->route('subject')) {
                $subject =  Subject::where('id', $request->route('subject'))->where('active', true)->first();
                $subject_course_id = $subject->course->id;
                if ($course_id != $subject_course_id) {
                    abort(401);
                }
                return $next($request);
            }
        }
        abort(401);
    }
}

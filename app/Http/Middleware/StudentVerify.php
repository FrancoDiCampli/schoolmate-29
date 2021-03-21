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
                // return dd($request->route('subject'));
                $subjects = auth()->user()->teacher->subjects;
                $aux = collect();
                foreach ($subjects as $item) {
                    $aux->push($item->course);
                }
                break;

            default:
                $aux = null;
                break;
        }

        if ($aux != null) {
            if (auth()->user()->roles()->first()->name == 'student') {
                $course_id = $aux->course_id;
            }
        } else $course_id = 0;

        if (Auth::check()) {

            switch (auth()->user()->roles()->first()->name) {
                case 'student':
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
                    break;

                case 'teacher':
                    // return dd($aux);
                    foreach ($aux as $course) {
                        if ($request->route('job')) {
                            $job = Job::find($request->route('job'));
                            $job_course_id = $job->subject->course->id;
                            if ($course->id != $job_course_id) {
                                abort(401);
                            }
                            return $next($request);
                        } elseif ($request->route('subject')) {
                            $subject =  Subject::where('id', $request->route('subject'))->where('active', true)->first();

                            if ($subject) {
                                $subject_course_id = $subject->course->id;
                            } else abort(401);

                            if ($course->id != $subject_course_id) {
                                abort(401);
                            }
                            return $next($request);
                        }
                    }
                    break;

                default:
                    $aux = null;
                    break;
            }
        }
        abort(401);
    }
}

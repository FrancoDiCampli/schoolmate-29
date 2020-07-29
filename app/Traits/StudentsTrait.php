<?php

namespace App\Traits;

use App\Job;
use App\Delivery;
use App\Enrollment;
use Illuminate\Support\Facades\Auth;

trait StudentsTrait
{
    public static function student()
    {
        return auth()->user()->student;
    }

    public static function enrollment($year)
    {
         return auth()->user()->student()->enrollments->where('cicle', $year)->first()->course;

        // Traer el curso del alumno en que esta inscripto
        $mat =  Enrollment::where('cicle',$year);

    }

    public static function pending(){
        $user = Auth::user()->student;

        $materias = $user->subjects();

        // $materias->modelkeys();

        $tareas = Job::whereIn('subject_id', $materias->modelkeys())->where('state',1)->get();

        $deliveries = Delivery::where('student_id',$user->id)->get();

        $ex = [];
        foreach($deliveries as $delivery){
            array_push($ex,$delivery->job_id);
        }

        $jobs = $tareas->except($ex);

        return $jobs;

    }
}

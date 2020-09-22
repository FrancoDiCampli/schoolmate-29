<?php

namespace App\Traits;

use App\Job;
use App\User;
use App\Student;
use App\Delivery;
use Carbon\Carbon;
use App\Enrollment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $mat =  Enrollment::where('cicle', $year);
    }

    public static function pendings()
    {
        $user = Auth::user()->student;

        $materias = $user->subjects();

        // $materias->modelkeys();

        $tareas = Job::whereIn('subject_id', $materias->modelkeys())->where('state', 1)->get();

        $deliveries = Delivery::where('student_id', $user->id)->get();

        $ex = [];
        foreach ($deliveries as $delivery) {
            array_push($ex, $delivery->job_id);
        }

        $jobs = $tareas->except($ex);

        return $jobs;
    }
    public static function pending($subject, $id)
    {
        $tareas = Job::where('subject_id', $subject)->where('state', 1)->get();
        $deliveries = Delivery::where('student_id', $id)->get();

        $ex = [];
        foreach ($deliveries as $delivery) {
            array_push($ex, $delivery->job_id);
        }

        $jobs = $tareas->except($ex);

        return $jobs;
    }

    public static function entregas($subject, $id)
    {
    }

    public static function studentUpdate($request, $student)
    {

        $path = null;

        $data = $request->validated();

        // $fecha = new Carbon($data['fnac']);
        // $data['fnac'] = $fecha->format('d/m/Y');

        if ($request->hasFile('file')) {
            $path =  FilesTrait::store($request, 'img/avatar', $request->dni);
            $data['photo'] = $path;
        }
        unset($data['file']);
        Student::where('id', $student->id)->update($data);
        $usuario =  User::find($data['user_id']);

        $pw = $request->password;

        if (strlen($pw) > 7) {
            $pw =  Hash::make($pw);
            $usuario->update([
                'password' => $pw
            ]);
        }

        $usuario->update([
            'name' => $data['name'],
            'dni' => $data['dni']
        ]);



        if (!is_null($path)) {
            if ($usuario->photo) {
                unlink($usuario->photo);
            }
            $usuario->update(['photo' => $data['photo']]);
        }
    }
}

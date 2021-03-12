<?php

namespace App\Http\Controllers;

use App\User;
use App\Course;
use App\Student;
use App\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enrollments = Enrollment::where('cicle', session('selectedAnio'))->with('student')->paginate(10);

        return view('admin.enrollments.index', compact('enrollments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $enrolled =  Enrollment::where('cicle', now()->format('Y'))->select(['student_id'])->get();

        $ex = [];

        foreach ($enrolled as $matricula) {
            array_push($ex, $matricula['student_id']);
        }

        $courses = Course::where('cicle', now()->format('Y'))->get();

        $students = Student::all();

        $students = $students->except($ex);

        return view('admin.enrollments.create', compact('students', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $enrollment = $request->validate([
            'student_id' => 'required',
            'course_id' => 'required',
        ]);

        $enrollment['cicle'] =  now()->format('Y');

        Enrollment::create($enrollment);

        return redirect()->route('enrollments.index')->with('messages', 'Alumno matriculado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //Actualizar la matricula de los alumnos promovidos al nuevo ciclo
    public function updateAll(Request $request)
    {
        $request->validate([
            'curso' => 'required'
        ]);

        $matriculados = [];

        // Cargo todos los alumnos seleccionados a un array
        foreach ($request->matriculados as $key => $val) {
            array_push($matriculados, $key);
        }

        // Elimino la matricula existente
        // foreach ($matriculados as $matricula) {
        //     Enrollment::where('student_id', $matricula)->delete();
        // }

        foreach ($matriculados as $matricula) {

            $aux = Enrollment::where('student_id', $matricula)
                // ->where('course_id', $request->curso)
                ->where('cicle', now()->format('Y'))
                ->first();

            if ($aux) {
                $aux->update([
                    'course_id' => $request->curso,
                ]);
            } else {
                Enrollment::create([
                    'student_id' => $matricula,
                    'course_id' => $request->curso,
                    'cicle' => now()->format('Y')
                ]);
            }
        }

        return redirect()->route('courses.index')->with('messages', 'Alumnos matriculados correctamente.');
    }
}

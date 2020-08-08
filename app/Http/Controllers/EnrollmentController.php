<?php

namespace App\Http\Controllers;

use App\User;
use App\Course;
use App\Student;
use App\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enrollments = Enrollment::where('cicle',2020)->with('student')->get();

        return view('admin.enrollments.index',compact('enrollments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $enrolled =  Enrollment::where('cicle',2020)->select(['student_id'])->get();

        $ex = [];

        foreach($enrolled as $matricula){
            array_push($ex,$matricula['student_id']);

        }

        $courses = Course::all();


        // $students = User::role('student')->get();
        $students = Student::all();

        $students = $students->except($ex);

        return view('admin.enrollments.create',compact('students','courses'));
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
            'student_id'=>'required',
            'course_id'=>'required',
        ]);

        $enrollment['cicle'] =  2020;

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
}

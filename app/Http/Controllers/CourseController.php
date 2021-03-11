<?php

namespace App\Http\Controllers;

use App\Course;
use Carbon\Carbon;
use App\Exports\CourseSheet;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses =  Course::where('cicle', session('selectedAnio'))->get();
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $course = $request->validate([
            'name' => 'required|max:20',
            'code' => 'required|max:20|unique:courses',
            'shift' => 'required',
            'cicle' => 'required|max:4'
        ]);

        $active = $request->filled('active') ? true : false;
        $course['active'] =  $active;

        Course::create($course);
        return redirect()->route('courses.index')->with('messages', 'Course creado correctamente.');
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
        $curso = Course::find($id);

        $students = $curso->getStudents();

        $cursos = Course::where('cicle', now()->format('Y'))->get();

        return view('admin.courses.edit', compact('students', 'cursos'));
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
        $course = Course::find($id);
        $active = $request->filled('active') ? true : false;
        $course->update([
            'active' => $active
        ]);
        foreach ($course->subjects as $item) {
            $item->update([
                'active' => $active
            ]);
        }
        return redirect()->route('courses.index')->with('messages', 'Curso actualizado correctamente.');
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

    public function enrollmentsExcel($id)
    {
        $curso = Course::find($id);
        $export = new CourseSheet($curso);
        return Excel::download($export, $curso->name . '-matriculas.xlsx');
    }
}

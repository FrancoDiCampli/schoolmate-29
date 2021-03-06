<?php

namespace App\Http\Controllers;

use App\User;
use App\Course;
use App\Subject;
use App\Teacher;
use App\Traits\PaginarTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aux =  Subject::all();

        $subjects = collect();

        foreach ($aux as $item) {
            if ($item->course->cicle == session('selectedAnio')) {
                $subjects->push($item);
            }
        }

        $subjects = PaginarTrait::paginate($subjects, 10);

        return view('admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = Teacher::all();
        $courses = Course::where('cicle', now()->format('Y'))->get();
        return view('admin.subjects.create', compact('teachers', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'teacher_id' => 'required',
            'name' => 'required',
            'code' => 'required',
        ]);

        $course_id = Course::where('code', $request->course_id)->first();

        $subject = $request->validate([
            'name' => 'required|max:20',
            'code' => 'required|max:20|unique:subjects',
            'teacher_id' => 'required'
        ]);

        $active = $request->filled('active') ? true : false;
        $subject['course_id'] =  $course_id->id;
        $subject['active'] =  $active;

        Subject::create($subject);
        return redirect()->route('subjects.index')->with('messages', 'Materia creada correctamente.');
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
        $subject = Subject::findOrFail($id);
        $teachers = Teacher::where('id', '<>', $subject->teacher_id)->get();
        return view('admin.subjects.edit', compact('teachers', 'subject'));
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
        $subject = Subject::findOrFail($id);

        if ($request->get('teacher_id')) {
            $subject->update([
                'teacher_id' => $request->get('teacher_id')
            ]);
        }

        $active = $request->filled('active') ? true : false;
        $subject->update([
            'active' => $active
        ]);

        return redirect()->route('subjects.index')->with('messages', 'Materia actualizada correctamente.');
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

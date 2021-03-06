<?php

namespace App\Http\Controllers;

use App\Course;
use App\Student;
use App\Enrollment;
use App\Traits\FilesTrait;
use Illuminate\Http\Request;
use App\Traits\StudentsTrait;
use App\Imports\StudentsImport;
use App\Http\Requests\StoreStudent;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\UpdateStudentProfile;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate(10);
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudent $request)
    {
        $path =  FilesTrait::store($request, $ubicacion = 'img/avatar', $nombre = $request->dni);
        $data = $request->validated();
        $data['photo'] = $path;

        // $request['password'] = Crypt::encrypt($request->password);;

        Student::create($data);


        return redirect()->route('students.index')->with('messages', 'Alumno creado correctamente.');;
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

    public function importar()
    {
        $courses = Course::where('cicle', now()->format('Y'))->get();
        return view('admin.students.import', compact('courses'));
    }

    public function importStudents(Request $request)
    {
        $request->validate([
            'cicle' => 'required',
            'course_id' => 'required',
            'file' => 'required|file|mimes:xlsx',
        ]);

        try {
            Excel::import(new StudentsImport, request()->file('file'));
            $alumnos = Excel::toCollection(new StudentsImport, request()->file('file'));
            // Ver por que no matriculo ultimo alumno
        } catch (\Exception $ex) {
            return back()->with('errores', 'No importo correctamente');
        }

        // Matricula a cada alumno importado
        foreach ($alumnos[0] as $alumno) {

            $res = Student::where('name', $alumno['nombre'])->get();

            Enrollment::create([
                'student_id' => $res[0]['id'],
                'course_id' => $request->course_id,
                'cicle' => $request->cicle
            ]);
        }

        return redirect()->route('students.index')->with('messages', 'Alumnos creados correctamente.');;
    }


    public function updateStudent(UpdateStudentProfile $request, Student $student)
    {
        StudentsTrait::studentUpdate($request, $student);

        $rol = auth()->user()->roles->first()->name;

        if ($rol == 'student') {

            return redirect()->route('student')->with('messages', 'Estudiante actualizado correctamente.');
        } else {
            return redirect()->route('students.index')->with('messages', 'Estudiante actualizado correctamente.');
        }
    }
}

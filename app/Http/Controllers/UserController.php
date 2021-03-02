<?php

namespace App\Http\Controllers;

use App\User;
use App\Course;
use App\Student;
use App\Teacher;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Imports\StudentsImport;
use App\Observers\StudentObserver;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  $users = User::with('roles')->get();
        //  $users = User::all()->first();
        // return $users->roles[0]->name;
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->hasRole('teacher')) {
            $data = Teacher::where('user_id', $user->id)->get();
        } elseif ($user->hasRole('student')) {
            $data = Student::where('user_id', $user->id)->get();
        } else {
            $data = [];
        }

        return view('admin.users.create', compact('user', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = Auth::user();



        if ($user->hasRole('teacher')) {
            Teacher::create($request->all());
        } elseif ($user->hasRole('student')) {
            Student::create($request);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($rol)
    {
        $user = Auth::user();
        switch ($rol) {
            case 'teacher':
                $data = $user->teacher;
                break;
            case 'student':
                $data = $user->student;
                break;
            case 'admin':
                $data = $user;
                break;

            default:

                break;
        }

        return view('admin.users.profile', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::find($id);
        $rol = $user->roles()->first()->name;

        // if ($rol == 'teacher') {
        //     $fechaNac = Carbon::createFromFormat('d/m/Y',$user->teacher->fnac);
        //     $user->teacher->fnac = $fechaNac->format('Y-m-d');
        // } else{
        //     $fechaNac = Carbon::createFromFormat('d/m/Y',$user->student->fnac);
        //     $user->student->fnac = $fechaNac->format('Y-m-d');
        // }


        if ($rol == 'teacher') {
            return view('admin.users.teacherprofile', compact('user'));
        } elseif ($rol == 'student') {
            return view('admin.users.studentprofile', compact('user'));
        }
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
        $user = User::find($id);
        $active = $request->filled('active') ? true : false;
        $user->update([
            'active' => $active
        ]);

        if ($user->hasRole('teacher')) {
            return redirect()->route('teachers.index')->with('messages', 'Usuario actualizado correctamente.');
        }

        return redirect()->route('students.index')->with('messages', 'Usuario actualizado correctamente.');
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

    public function import()
    {
        $courses = Course::all();
        return view('admin.users.import', compact('courses'));
    }
    public function importUsers(Request $request)
    {
        StudentObserver::$course = $request->course_id;
        Excel::import(new StudentsImport, request()->file('file'));

        // Excel::import(new StudentsImport, asset('files/students.xlsx'));
    }

    public function resetPass(User $user)
    {
        return view('admin.users.resetpassword', compact('user'));
    }

    public function reset(UpdateProfile $request, User $user)
    {
        $data = $request->all();
        // $user->update($data);
        User::where('id', $request->id)->update([
            'password' => Hash::make($request->password)
        ]);
        session()->flash('messages', 'La contrasenia se cambio con exito');

        return redirect()->route(Auth::user()->roles->first()->name);
    }
}

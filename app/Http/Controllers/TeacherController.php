<?php

namespace App\Http\Controllers;

use App\User;
use App\Teacher;
use App\Traits\FilesTrait;
use Illuminate\Http\Request;
use App\Imports\TeachersImport;

use App\Http\Requests\StoreTeacher;
use App\Http\Requests\UpdateTeacher;
use App\Traits\TeachersTrait;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;


class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::role('teacher')->get();
        $teachers= Teacher::all();
        return view('admin.teacher.index',compact('teachers'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeacher $request)
    {
        // Aqui usa el observer para crear el usuario del profesor
        $path =  FilesTrait::store($request, 'img/avatar', $request->dni);
        $data = $request->validated();
        $data['photo'] = $path;



        Teacher::create($data);


        return redirect()->route('teachers.index') ->with('messages', 'Profesor creado correctamente.');
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

        $teacher = Teacher::find($id);
        $user = User::find($teacher->user_id);
        return view('admin.users.teacherprofile',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateTeacher(UpdateTeacher $request, Teacher $teacher)
    {


        TeachersTrait::teacherUpdate($request,$teacher);

        $rol = auth()->user()->roles->first()->name;

        if($rol =='teacher'){

            return redirect()->route('teacher') ->with('messages', 'Profesor actualizado correctamente.');

        }else{
            return redirect()->route('teachers.index') ->with('messages', 'Profesor actualizado correctamente.');

        }


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

    public function import(){
        return view('admin.teacher.import');
    }

    public function importTeachers(Request $request){
        try{
        Excel::import(new TeachersImport, request()->file('file'));

        }catch(\Exception $ex){
            return back()->with('errores','No importo correctamente');
        }

        return redirect()->route('teachers.index') ->with('messages', 'Profesores creados correctamente.');;

    }



}

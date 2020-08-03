<?php

namespace App\Http\Controllers;

use App\User;
use App\Teacher;
use App\Traits\FilesTrait;
use Illuminate\Http\Request;
use App\Imports\TeachersImport;

use App\Http\Requests\StoreTeacher;
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

        // $request['password'] = Crypt::encrypt($request->password);;

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
        // $teacher = Teacher::where('id',$id)->with('user')->get();
        $teacher = Teacher::find($id);

        return view('admin.teacher.edit',compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {

        $teacher->update($request->all());

        // Hay que crear una condicion para ver si se cambio el dni y/o las contrasenia
        // en caso de que no se haya cambiano ni buscar el user
        User::where('id', $teacher->user_id)
              ->update([
                        'dni' =>$request->dni,
                        'password' =>bcrypt($request->password)
                        ]);


        return redirect()->route('teachers.index')
        ->with('messages', 'Profesor actualizado correctamente.');

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

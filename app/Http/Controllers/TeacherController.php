<?php

namespace App\Http\Controllers;

use App\User;
use App\Teacher;
use App\Traits\FilesTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
    public function store(Request $request)
    {
        $user  = User::create([
            'dni'=>$request->dni,
            'password'=>bcrypt($request->dni),
        ]);
        $user->assignRole('teacher');
        $request['user_id'] = $user->id;
        $path =  FilesTrait::store($request, $ubicacion = 'img/avatar', $nombre = $request->dni);
        $request['photo'] = $path;
        Teacher::create($request->all());


        return redirect()->route('teachers.index') ->with('messages', 'Profesor creado correctamente.');;
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
                        'password' =>Hash::make($request->password)
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
}

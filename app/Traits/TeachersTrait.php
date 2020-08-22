<?php

namespace App\Traits;

use App\User;
use App\Teacher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

trait TeachersTrait
{
    public static function teacher()
    {
        return auth()->user()->teacher;
    }

    public static function subjects($year)
    {
        return Teacher::subjects()->whereYear('created_at', $year)->get()->each(function ($sub) {
                $sub->course;
                $sub->jobs->each->deliveries;
            });

        // return auth()->user()->teacher()->subjects()->whereYear('created_at', $year)->get()->each(function ($sub) {
        //     $sub->course;
        //     $sub->jobs->each->deliveries;
        // });
    }

    public static function teacherUpdate($request,$teacher){

        $path = null;

        $data = $request->validated();

        $fecha = new Carbon($data['fnac']);
        $data['fnac'] = $fecha->format('d/m/Y');

        if($request->hasFile('file')){
            $path =  FilesTrait::store($request, 'img/avatar', $request->dni);
            $data['photo'] = $path;

        }
        Teacher::where('id',$teacher->id)->update($data);
        $usuario =  User::find($data['user_id']);

        $pw = $request->password;

        if(strlen($pw)>7){
           $pw =  Hash::make($pw);
           $usuario->update([
               'password'=>$pw
           ]);
        }

        $usuario->update([
            'name'=>$data['name'],
            'dni'=>$data['dni']
            ]);



        if(!is_null($path)){
           $usuario->update(['photo'=>$data['photo']]);
        }

    }
}

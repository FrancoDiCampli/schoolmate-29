<?php

namespace App\Traits;

use App\User;
use App\Teacher;

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

    public function teacherUpdate($request,$teacher){
        $path = null;

        $data = $request->validated();
        if($request->hasFile('file')){
            $path =  FilesTrait::store($request, 'img/avatar', $request->dni);
            $data['photo'] = $path;

        }
        Teacher::where('id',$teacher->id)->update($data);
        $usuario =  User::find($data['user_id']);
        $usuario->update(['name'=>$data['name']]);

        if(!is_null($path)){
           $usuario->update(['photo'=>$data['photo']]);
        }

    }
}

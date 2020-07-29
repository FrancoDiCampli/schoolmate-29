<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected  $fillable = ['name','dni','cuil','fnac','phone','email','photo','address','docket','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function subjects(){
        $curso = Enrollment::where('student_id',$this->id)->where('cicle',2020)->select('course_id')->first();

        $curso = Course::where('id',$curso['course_id'])->with('subjects')->get();

        return $curso->first()->subjects;
    }
}

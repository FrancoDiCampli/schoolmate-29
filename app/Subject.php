<?php

namespace App;

use App\User;
use App\Course;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'code', 'course_id', 'teacher_id'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class,'teacher_id');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class)->orderBy('id', 'DESC');
    }

    public function posts()
    {

        return $this->hasMany(Post::class);
    }

    public function students(){
        $curso = Course::where('id',$this->course_id)->get();
        $matriculas = Enrollment::where('course_id',$this->course_id)->get();
        return $matriculas;

    }
}

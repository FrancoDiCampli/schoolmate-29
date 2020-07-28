<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function subjects()
    {
        return $this->hasMany('App\Subject');
    }

    public function students(){
        return $matriculas = Enrollment::where('course_id',$this->id);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}

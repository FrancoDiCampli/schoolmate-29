<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function subjects()
    {
        return $this->hasMany('App\Subject');
    }

    public function students()
    {
        return $matriculas = Enrollment::where('course_id', $this->id);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function getStudents()
    {
        $matriculas = Enrollment::where('course_id', $this->id)->with('student')->get();

        $students = [];

        foreach ($matriculas as $matricula) {
            array_push($students, $matricula->student);
        }

        return $students;
    }
}

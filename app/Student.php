<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use Notifiable;
    protected  $fillable = ['name', 'dni', 'cuil', 'fnac', 'phone', 'email', 'photo', 'address', 'docket', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subjects()
    {
        $course_id = Enrollment::where('student_id', $this->id)->where('cicle', session('selectedAnio'))->select('course_id')->first();
        if (!$course_id) {
            return null;
        }
        $curso = Course::where('id', $course_id['course_id'])->with('subjects')->first();

        return $curso->subjects;
    }

    public function deliveries()
    {

        return $this->hasMany(Delivery::class, 'student_id');
    }
}

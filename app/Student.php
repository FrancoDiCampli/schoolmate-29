<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use Notifiable;
    protected  $fillable = ['name','dni','cuil','fnac','phone','email','photo','address','docket','user_id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function subjects(){
        $curso = Enrollment::where('student_id',$this->id)->where('cicle',2020)->select('course_id')->first();

        $curso = Course::where('id',$curso['course_id'])->with('subjects')->get();

        return $curso->first()->subjects;
    }

    public function deliveries()
    {

        return $this->hasMany(Delivery::class,'student_id');
    }


}

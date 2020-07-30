<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected  $fillable = ['name','dni','cuil','fnac','phone','email','photo','address','docket','user_id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }


    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

}

<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Teacher extends Model
{
    use Notifiable;
    
    protected  $fillable = ['name','dni','cuil','fnac','phone','email','photo','address','docket','user_id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }


    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

}

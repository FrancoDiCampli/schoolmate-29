<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected  $fillable = ['name','dni','cuil','fnac','phone','email','photo','address','docket','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Delivery extends Model
{

    protected $guarded = [];


    protected $state = ['En corrección', 'Rehacer', 'Aprobado'];



    public function state($value)
    {
        return Arr::get($this->state, $value);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class)->with('subject');
    }

    public function subject(){


    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }


}

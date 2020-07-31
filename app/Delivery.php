<?php

namespace App;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Delivery extends Model
{
    use LogsActivity;
    protected static $logName = 'deliveries';
    protected static $logAttributes = ['job_id','student_id','created_at'];
    protected static $recordEvents = ['created'];
    protected $guarded = [];

    protected $state = ['En corrección', 'Por Corregir', 'Aprobado', 'Desaprobado'];

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

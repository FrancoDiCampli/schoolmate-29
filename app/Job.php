<?php

namespace App;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Auth;

class Job extends Model
{
    use LogsActivity;
    protected static $logName = 'jobs';
    protected static $logAttributes = ['title','subject_id','state','type'];
    protected static $recordEvents = ['created','updated'];

    protected $guarded = [];

    protected $state = ['Borrador', 'Activa', 'Rechazado'];

    public function getDescriptionForEvent(string $eventName): string
    {
        switch ($eventName) {
            case 'created':

                $eventName = 'creada';
                break;
            case 'updated':
                $eventName = 'actualizada';
                break;
            default:
                # code...
                break;
        }

        return "Tarea {$eventName}";
    }


    public function state($value)
    {
        return Arr::get($this->state, $value);
    }


    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function deliveries()
    {
        return $this->hasMany(Delivery::class)->with('user');
    }


    public function comments()
    {
        return $this->hasMany('App\JobComment');
    }

    protected $casts = [
        'start' => 'datetime:d-m-Y',
        'end' => 'datetime:d-m-Y'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

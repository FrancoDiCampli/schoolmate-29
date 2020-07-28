<?php

namespace App\Traits;

use App\Teacher;

trait TeachersTrait
{
    public static function teacher()
    {
        return auth()->user()->teacher;
    }

    public static function subjects($year)
    {
        return Teacher::subjects()->whereYear('created_at', $year)->get()->each(function ($sub) {
                $sub->course;
                $sub->jobs->each->deliveries;
            });

        // return auth()->user()->teacher()->subjects()->whereYear('created_at', $year)->get()->each(function ($sub) {
        //     $sub->course;
        //     $sub->jobs->each->deliveries;
        // });
    }
}

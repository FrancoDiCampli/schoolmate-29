<?php

namespace App\Traits;

use App\Job;
use Intervention\Image\Facades\Image;

trait JobsTrait
{

    public static function jobsList($subject_id){

        return $jobs = Job::where('subject_id',$subject_id)->get();


    }

}

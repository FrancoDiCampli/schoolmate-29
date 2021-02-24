<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;
use App\Traits\PaginarTrait;

class AdviserController extends Controller
{
    public function stateJobs($id)
    {
        switch ($id) {
            case '0':
                $jobs = Job::where('state', 0)->get();
                $auxJobs = collect();
                foreach ($jobs as $item) {
                    if ($item->subject->course->cicle == session('selectedAnio')) {
                        $auxJobs->push($item);
                    }
                }
                $jobs = PaginarTrait::paginate($auxJobs, 5);
                $title = "Borrador";
                break;

            case '1':
                $jobs = Job::where('state', 1)->get();
                $auxJobs = collect();
                foreach ($jobs as $item) {
                    if ($item->subject->course->cicle == session('selectedAnio')) {
                        $auxJobs->push($item);
                    }
                }
                $jobs = PaginarTrait::paginate($auxJobs, 5);
                $title = "Activas";
                break;
            case '2':
                $jobs = Job::where('state', 2)->get();
                $auxJobs = collect();
                foreach ($jobs as $item) {
                    if ($item->subject->course->cicle == session('selectedAnio')) {
                        $auxJobs->push($item);
                    }
                }
                $jobs = PaginarTrait::paginate($auxJobs, 5);
                $title = "Rechazadas";
                break;

            default:
                $jobs = [];
                $title = "";
                break;
        }

        return view('admin.advisers.index', compact('jobs', 'title'));
    }
}

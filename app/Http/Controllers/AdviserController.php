<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;

class AdviserController extends Controller
{
    public function stateJobs($id)
    {
        switch ($id) {
            case '0':
                $jobs = Job::where('state', 0)->paginate(5);
                $title = "Borrador";
                break;

            case '1':
                $jobs = Job::where('state', 1)->paginate(5);
                $title = "Activas";
                break;
            case '2':
                $jobs = Job::where('state', 2)->paginate(5);
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

<?php

namespace App\Http\Controllers;

use App\Job;
use App\User;
use App\Student;
use App\Subject;
use App\Teacher;
use App\Delivery;
use Illuminate\Http\Request;
use App\Traits\StudentsTrait;
use App\Traits\TeachersTrait;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function studentx()
    {
        $id = Auth::user()->student->id;
        $jobs = StudentsTrait::pending(2, $id);
        dd($jobs);
    }

    public function student()
    {

        $user = Auth::user()->student;

        $subjects = $user->subjects();

        $ids = $subjects->modelkeys();
        $subjects = Subject::whereIn('id', $ids)->with('posts')->get();

        $deliveries = Delivery::where('student_id', $user->id)->get();

        $jobs = StudentsTrait::pendings();


        return view('admin.students.home', compact('user', 'jobs', 'deliveries', 'subjects'));
    }

    public function teacher()
    {
        $id =  auth()->user()->teacher->id;
        $subjects = Subject::where('teacher_id', $id)->get();

        return view('admin.teacher.home', compact('subjects'));
    }
    public function admin()
    {
        return view('admin.admin.index');
    }

    public function adviser()
    {
        $jobs = Job::where('state', 0)->get();
        $activas = Job::where('state', 1)->get();
        $rechazadas = Job::where('state', 2)->get();

        $jobs = count($jobs);
        $activas = count($activas);
        $rechazadas = count($rechazadas);
        return view('admin.advisers.home', compact('jobs', 'activas', 'rechazadas'));
    }
}

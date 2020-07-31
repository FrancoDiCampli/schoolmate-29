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
    public function __construct()
    {
        $this->middleware('role:student')->only('student');
        $this->middleware('role:teacher')->only('teacher');
        $this->middleware('role:adviser')->only('adviser');
    }

    public function home()
    {
        return view('home');
    }

    public function student()
    {
        $user = Auth::user()->student;

        $materias = $user->subjects();
        $subjects = $materias;

        // $enrol = StudentsTrait::enrollment(2020);
        // $subjects =  $enrol->subjects;

        $ids = $subjects->modelkeys();
        $subjects = Subject::whereIn('id', $ids)->with('posts')->get();

        $deliveries = Delivery::where('student_id', $user->id)->get();
        $jobs = StudentsTrait::pending();


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
        return view('admin.advisers.index', compact('jobs'));
    }
}

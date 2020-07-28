<?php

namespace App\Http\Controllers;

use App\Job;
use App\User;
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

    public function home(){
        return view('home');
    }

   public function student(){
    return 'hola estudiante';
   }
   public function teacher(){

//     $year = now()->format('Y');
//    return $subjects = TeachersTrait::subjects($year);

   return $teacher = Teacher::where('user_id',Auth()->user()->id)->get();
   return $teacher = $teacher[0]->id;
    return Subject::where('teacher_id',$teacher['id'])->get();
    return view('admin.jobs.index', compact('subjects'));
   }
   public function admin(){
    return view('admin.admin.index');
   }
}

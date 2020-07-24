<?php

namespace App\Http\Controllers;

use App\User;
use App\Subject;
use App\Delivery;
use App\Job;
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
    return 'hola profe';
   }
   public function admin(){
    return view('admin.admin.index');
   }
}

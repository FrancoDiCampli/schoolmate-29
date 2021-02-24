<?php

namespace App\Http\Controllers;

use App\Job;
use App\User;
use ZipArchive;
use App\Student;
use App\Subject;
use App\Teacher;
use App\Delivery;
use Illuminate\Http\Request;
use App\Traits\StudentsTrait;
use App\Traits\TeachersTrait;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function home()
    {
        $data = auth()->user()->roles()->first();
        switch ($data->name) {
            case 'admin':
                return redirect()->route('admin');
                break;
            case 'student':
                return redirect()->route('student');
                break;
            case 'teacher':
                return redirect()->route('teacher');
                break;
            case 'adviser':
                return redirect()->route('adviser');
                break;

            default:
                # code...
                break;
        }
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

        if ($user->subjects()) {
            $subjects = $user->subjects();

            $ids = $subjects->modelkeys();
            $subjects = Subject::whereIn('id', $ids)->with('posts')->get();

            $deliveries = Delivery::where('student_id', $user->id)->get();

            $jobs = StudentsTrait::pendings();
        } else {
            $subjects = [];

            $deliveries = [];

            $jobs = [];
        }

        return view('admin.students.home', compact('user', 'jobs', 'deliveries', 'subjects'));
    }

    public function teacher()
    {
        $aux = auth()->user()->teacher->subjects->each->course;
        $subjects = collect();

        foreach ($aux as $item) {
            if ($item->course->cicle == session('selectedAnio')) {
                $subjects->push($item);
            }
        }

        return view('admin.teacher.home', compact('subjects'));
    }
    public function admin()
    {
        return view('admin.admin.index');
    }

    public function adviser()
    {
        $jobs = Job::where('state', 0)->get();
        $auxJobs = collect();
        foreach ($jobs as $item) {
            if ($item->subject->course->cicle == session('selectedAnio')) {
                $auxJobs->push($item);
            }
        }

        $activas = Job::where('state', 1)->get();
        $auxActivas = collect();
        foreach ($activas as $item) {
            if ($item->subject->course->cicle == session('selectedAnio')) {
                $auxActivas->push($item);
            }
        }

        $rechazadas = Job::where('state', 2)->get();
        $auxRechazadas = collect();
        foreach ($rechazadas as $item) {
            if ($item->subject->course->cicle == session('selectedAnio')) {
                $auxRechazadas->push($item);
            }
        }

        $jobs = count($auxJobs);
        $activas = count($auxActivas);
        $rechazadas = count($auxRechazadas);
        return view('admin.advisers.home', compact('jobs', 'activas', 'rechazadas'));
    }

    public function tareasZip()
    {
        $zip_file = 'tareasBackup.zip';
        $zip = new ZipArchive();
        $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $path = public_path('tareas');
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));

        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relarivePath = 'tareas/' . substr($filePath, strlen($path) + 1);

                $zip->addFile($filePath, $relarivePath);
            }
        }
        $zip->close();
        return response()->download($zip_file);
    }

    public function entregasZip()
    {
        $zip_file = 'entregasBackup.zip';
        $zip = new ZipArchive();
        $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $path = public_path('entregas');
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));

        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relarivePath = 'entregas/' . substr($filePath, strlen($path) + 1);

                $zip->addFile($filePath, $relarivePath);
            }
        }
        $zip->close();
        return response()->download($zip_file);
    }
}

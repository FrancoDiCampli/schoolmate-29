<?php

namespace App\Http\Controllers;

use App\Job;
use App\Comment;
use App\Subject;
use App\Delivery;
use Carbon\Carbon;
use App\Traits\FilesTrait;
use App\Traits\NotificationsTrait;
use Illuminate\Http\Request;
use App\Traits\StudentsTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Youtube;

class DeliveryController extends Controller
{
    public function pendings($subject)
    {

        $jobs =  Subject::find($subject);

        // $jobs = StudentsTrait::pendings();

        $now = Carbon::now();



        return view('admin.deliveries.pendings', compact('jobs', 'now'));
    }

    public function index($id)
    {
        $user = Auth::user()->student->id;
        $jobs = Job::where('subject_id', $id)->get();
        $deliveries =  Delivery::where('job_id', $jobs->modelkeys())->get();
        $deliveries->where('student_id', $user);

        return view('admin.deliveries.index', compact('deliveries'));
    }

    public function descargar($job)
    {
        $file = public_path('tareas/') . $job;
        return response()->download($file);
    }

    public function deliver($job)
    {
        $user = Auth::user();
        $job = Job::find($job);

        NotificationsTrait::studentMarkAsRead('job_id', $job->id);

        $delivery = $job->deliveries->where('student_id', $user->student->id)->first();

        if ($delivery) {
            $comments = $delivery->comments;
        } else {
            $comments = [];
        }

        return view('admin.deliveries.create', compact('job', 'delivery', 'comments'));
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $link = $request->link;
            if ($request->hasFile('video')) {
                $video = Youtube::upload($request->file('video')->getPathName(), [
                    'title'       => $request->input('title'),
                    'description' => $request->input('description')
                ], 'unlisted');

                $link = "http://www.youtube.com/watch?v=" . $video->getVideoId();
            }
            $nameFile = FilesTrait::store($request, 'entregas', auth()->user()->student->name);

            $delivery = Delivery::create([
                'job_id' => $request->job,
                'file_path' => $nameFile,
                'state' => 0,
                'link' => $link,
                'student_id' => Auth::user()->student->id,
            ]);

            // Si tiene comentarios los crea
            if ($request->comment) {
                Comment::create([
                    'user_id' => Auth::user()->id,
                    'delivery_id' => $delivery->id,
                    'comment' => $request->comment,
                ]);
            }
        });

        session()->flash('message', 'Entrega creada');

        return redirect()->route('student');
    }

    public function update(Request $request, $id)
    {
        $delivery = Delivery::find($id);
        if (Auth::user()->roles()->first()->name == 'teacher') {
            $delivery->update([
                'state' => $request->state
            ]);
            session()->flash('messages', 'Entrega actualizada');
            return redirect()->route('job.deliveries', $request->id_job);
        } else {
            $link = $request->link;
            if ($request->hasFile('video')) {
                $video = Youtube::upload($request->file('video')->getPathName(), [
                    'title'       => $request->input('title'),
                    'description' => $request->input('description')
                ], 'unlisted');

                $link = "http://www.youtube.com/watch?v=" . $video->getVideoId();
            }
            $nameFile = FilesTrait::update($request, 'entregas', auth()->user()->student->name, $delivery);
            $delivery->update([
                'state' => 0,
                'file_path' => $nameFile,
                'link' => $link
            ]);
            session()->flash('messages', 'Entrega actualizada');
            return redirect()->route('jobs.index', $delivery->job->subject->id);
        }
    }
}

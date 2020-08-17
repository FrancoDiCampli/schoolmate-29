<?php

namespace App\Http\Controllers;

use App\Job;
use Youtube;
use App\Comment;
use App\Subject;
use App\Delivery;
use App\Http\Requests\StoreDelivery;
use App\Http\Requests\UpdateDelivery;
use Carbon\Carbon;
use App\Traits\LogsTrait;
use App\Traits\FilesTrait;
use Illuminate\Http\Request;
use App\Traits\StudentsTrait;
use App\Traits\NotificationsTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

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

        $subject = Subject::find($id);

        $deliveries =  Delivery::whereIn('job_id', $jobs->modelkeys())->get();

        $deliveries = $deliveries->where('student_id', $user);

        return view('admin.deliveries.index', compact('deliveries', 'subject'));
    }

    public function descargarDelivery($delivery)
    {
        $aux = Delivery::find($delivery);
        $file = public_path($aux->file_path);
        return response()->download($file);
    }

    public function deliver($job)
    {

        $user = Auth::user();
        $job = Job::find($job);
        $vid = substr($job->link, -11);
        if ($job->file_path) {
            $file = url($job->file_path);
        } else $file = '';

        NotificationsTrait::studentMarkAsRead('job_id', $job->id);

        $delivery = $job->deliveries->where('student_id', $user->student->id)->first();

        if($delivery){
            if ($delivery->file_path) {
                $fileDelivery = url($delivery->file_path);
            } else $fileDelivery = '';
        } else { $fileDelivery = ''; }

        if ($delivery) {
            $comments = $delivery->comments;
        } else {
            $comments = [];
        }
        if($delivery){
                  $activities = Activity::where('log_name','deliveries')->where('subject_id',$delivery->id)->get();

        }else{
            $activities = null;
        }

        return view('admin.deliveries.create', compact('job', 'file', 'vid', 'delivery', 'comments','activities', 'fileDelivery'));
    }

    public function store(StoreDelivery $request)
    {

        $link = $request->link;
        if ($request->hasFile('video')) {
            $video = Youtube::upload($request->file('video')->getPathName(), [
                'title'       => $request->input('title'),
                'description' => $request->input('description')
            ], 'unlisted');

            $link = "http://www.youtube.com/watch?v=" . $video->getVideoId();
        }
        $nameFile = FilesTrait::store($request, 'entregas', auth()->user()->student->name);

        $data = $request->validated();
        $data['job_id'] = $request->job;
        $data['state'] = 0;
        unset($data['file']);
        $data['file_path'] = $nameFile;
        $data['student_id'] = Auth::user()->student->id;

        $delivery = Delivery::create($data);

        LogsTrait::logDelivery($delivery,0);
        // Si tiene comentarios los crea
        if ($request->comment) {
            Comment::create([
                'user_id' => Auth::user()->id,
                'delivery_id' => $delivery->id,
                'comment' => $request->comment,
            ]);
        }

        session()->flash('messages', 'Entrega creada');
        return redirect()->route('deliveries.subject', $delivery->job->subject->id);
    }

    public function update(UpdateDelivery $request, $id)
    {
        $delivery = Delivery::find($id);
        if (Auth::user()->roles()->first()->name == 'teacher') {
            $delivery->update([
                'state' => $request->state
            ]);
            LogsTrait::logDelivery($delivery,$request->state);
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
            LogsTrait::logDelivery($delivery,0);
            session()->flash('messages', 'Entrega actualizada');
            return redirect()->route('deliveries.subject', $delivery->job->subject->id);
        }
    }
}

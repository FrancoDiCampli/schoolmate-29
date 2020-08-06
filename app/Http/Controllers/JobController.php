<?php

namespace App\Http\Controllers;

use App\Job;
use Youtube;
use App\User;
use App\Subject;
use App\Delivery;
use App\Traits\JobsTrait;
use App\Traits\LogsTrait;
use App\Traits\FilesTrait;
use Illuminate\Http\Request;
use App\Http\Requests\StoreJob;
use App\Traits\NotificationsTrait;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class JobController extends Controller
{
    public function __construct()
    {
        // $this->middleware('role:teacher');
    }


    public function index($id)
    {
        if (Auth::user()->hasRole('student')) {
            $subject = Subject::find($id);
            // $subject = Job::where('state',1)->get();
            $subject->jobs = $subject->jobs->where('state', 1);


        } else{

        $subject = Subject::find($id);
        $subject->jobs;

        }

        // $posts = Post::where('user_id',Auth::user()->id)->where('subject_id',$id)->with('annotations')->orderBy('created_at', 'DESC')->paginate(2);

        return view('admin.jobs.index', compact('subject'));
    }

    // Yo agregando metodos
    public function subject($id){
        $subject = Subject::find($id);
        $subject->jobs;

        return view('admin.jobs.subject', compact('subject'));
    }

    public function create($subject)
    {
        $subject = Subject::find($subject);
        return view('admin.jobs.create', compact('subject'));
    }

    public function store(StoreJob $request)
    {
        $link = $request->link;
        if($request->hasFile('video')){
            $video = Youtube::upload($request->file('video')->getPathName(), [
                'title'       => $request->input('title'),
                'description' => $request->input('description')
            ],'unlisted');

            $link = "http://www.youtube.com/watch?v=". $video->getVideoId();
        }


        $subject = Subject::find($request->subject);
        $nameFile = FilesTrait::store($request, 'tareas', $subject->name);
        $data = $request->validated();

        $data['subject_id'] = $subject->id;
        $data['state'] = 0;
        $data['file_path'] = $nameFile;
        unset($data['file']);
        $data['link'] = $link;

        $job = Job::create($data);

        LogsTrait::logJob($job,0);

        session()->flash('messages', 'Tarea creada');

        return redirect()->action('JobController@index', $subject->id);
    }

    public function show($id)
    {
        $job = Job::find($id);

        $matriculas = $job->subject->course->enrollments;

        $aux = $job->deliveries->keyBy('student_id');

        $faltan = $matriculas->whereNotIn('student_id', $aux->keys());

        $entregas = $job->deliveries()->get();

        $alumnos = $faltan->map(function ($item) {
            return $item->student;
        });

        return view('admin.jobs.deliveries', compact('job', 'entregas', 'alumnos'));
    }

    public function showJob($id)
    {
        $activities = Activity::where('log_name','jobs')->where('subject_id',$id)->get();

        $job = Job::find($id);
        $job->comments;
        $vid = substr($job->link, -11);
        if ($job->file_path) {
            $file = url($job->file_path);
        } else $file = '';
        
        if (Auth::user()->roles()->first()->name == 'adviser') {
            NotificationsTrait::adviserMarkAsRead($id);
        } else {
            NotificationsTrait::teacherMarkAsRead('job_id', $id);
        }


        return view('admin.jobs.showJob', compact('job', 'file', 'vid','activities'));
    }

    public function edit($id)
    {
        $job = Job::find($id);
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $job = Job::find($id);
        $user = Auth::user()->id;
        $cond = $request->state;

        LogsTrait::logJob($job,$cond);





        $stateJob = $job->state;
        $subject = Subject::find($request->subject);

        if (Auth::user()->roles()->first()->name == 'adviser') {
            $job->update(['state' => $request->state]);

            session()->flash('messages', 'Tarea actualizada');
            return redirect()->route('adviser.jobs', $stateJob);

        } else{
            $data = $request->validate([
                'title' => 'required',
                'description' => 'required',
                'link' => 'nullable|url',
                'start' => 'date',
                'end' => 'date'
            ]);
            $data['subject_id'] = $subject->id;
            $data['state'] = 0;

            if ($request->file) {
                $nameFile = FilesTrait::update($request, 'tareas', $subject->name, $job);
                $data['file_path'] = $nameFile;
            }

            $job->update($data);

            session()->flash('messages', 'Tarea actualizada');
            return redirect()->route('jobs.index', $subject->id);
        }


    }

    public function destroy($id)
    {
        $job = Job::find($id);
        $subjectId =  $job->subject->id;
        $job->delete();

        session()->flash('messages', 'Tarea eliminada');
        return redirect()->route('jobs.index', $subjectId);
    }

    public function descargar($job)
    {
        $file = public_path('tareas/') . $job;
        return response()->download($file);
    }

    public function descargarDelivery($delivery)
    {
        $file = public_path('entregas/') . $delivery;
        return response()->download($file);
    }

    public function filtrar(Request $request)
    {
        $filtros = collect();
        foreach ($request->params as $param) {
            $filtros->push(str_replace('tag-', '', $param));
        }

        return $subject = Subject::where('name', $filtros->first())->with('jobs')->get();
    }

    public function delivery($delivery)
    {
        $user = Auth::user();
        $delivery =  Delivery::find($delivery);
        $delivery->comments;
        $vid = substr($delivery->link, -11);

        if (auth()->user()->roles()->first()->name == 'teacher') {
            NotificationsTrait::teacherMarkAsRead('delivery_id', $delivery->id);
        }

        if($delivery){
            $activities = Activity::where('log_name','deliveries')->where('subject_id',$delivery->id)->get();

        }else{
            $activities = null;
        }

        return view('admin.jobs.delivery', compact('delivery','user', 'vid', 'activities'));
    }

    public function test(){
        return $activity = Activity::where('log_name','deliveries')->where('subject_id',3)->get();

    }
}

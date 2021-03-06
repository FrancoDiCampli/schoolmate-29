<?php

namespace App\Http\Controllers;

use App\Job;
use Youtube;
use ZipArchive;
use App\Subject;
use App\Delivery;
use App\Traits\LogsTrait;
use App\Traits\FilesTrait;
use App\Traits\PaginarTrait;
use Illuminate\Http\Request;
use App\Http\Requests\StoreJob;
use App\Http\Requests\UpdateJob;
use App\Traits\NotificationsTrait;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class JobController extends Controller
{
    public function index($id)
    {
        if (Auth::user()->hasRole('student')) {
            $subject = Subject::where('id', $id)->where('active', true)->first();
            // $subject = Job::where('state',1)->get();
            $subject->jobs = $subject->jobs->where('state', 1);
            $subject->jobs = PaginarTrait::paginate($subject->jobs, 5);
        } elseif (Auth::user()->hasRole('teacher')) {
            $subject = Subject::where('id', $id)->where('active', true)->first();
            if ($subject) {
                $subject->jobs = PaginarTrait::paginate($subject->jobs, 5);
            }
        } else $subject = null;

        // $posts = Post::where('user_id',Auth::user()->id)->where('subject_id',$id)->with('annotations')->orderBy('created_at', 'DESC')->paginate(2);

        return view('admin.jobs.index', compact('subject'));
    }

    // Yo agregando metodos
    public function subject($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->jobs;

        return view('admin.jobs.subject', compact('subject'));
    }

    public function create($subject)
    {
        $subject = Subject::findOrFail($subject);
        return view('admin.jobs.create', compact('subject'));
    }

    public function store(StoreJob $request)
    {
        $link = $request->link;
        if ($request->hasFile('video')) {
            $video = Youtube::upload($request->file('video')->getPathName(), [
                'title'       => $request->input('title'),
                'description' => $request->input('description')
            ], 'unlisted');

            $link = "http://www.youtube.com/watch?v=" . $video->getVideoId();
        }


        $subject = Subject::findOrFail($request->subject);
        $nameFile = FilesTrait::store($request, 'tareas', $subject->name);
        $data = $request->validated();

        $data['subject_id'] = $subject->id;
        $data['state'] = 0;
        $data['file_path'] = $nameFile;
        unset($data['file']);
        $data['link'] = $link;
        $data['teacher_name'] = $subject->teacher->name;

        $job = Job::create($data);

        activity('jobs')
            ->causedBy(Auth::user())
            ->performedOn($job)
            ->withProperties(['estado' => 'creada'])
            ->log('Tarea creada');

        session()->flash('messages', 'Tarea creada');

        return redirect()->action('JobController@index', $subject->id);
    }

    public function show($id)
    {
        $job = Job::findOrFail($id);
        if ($job->subject->active == true) {
            $matriculas = $job->subject->course->enrollments;

            $aux = $job->deliveries->keyBy('student_id');

            $faltan = $matriculas->whereNotIn('student_id', $aux->keys());

            $entregas = $job->deliveries()->get();

            $alumnos = $faltan->map(function ($item) {
                return $item->student;
            });
            $aux = $alumnos->sortBy('name');

            $alumnos = $aux->values();

            return view('admin.jobs.deliveries', compact('job', 'entregas', 'alumnos'));
        } else return redirect()->route('teacher');
    }

    public function showJob($id)
    {
        $activities = Activity::where('log_name', 'jobs')->where('subject_id', $id)->get();

        $job = Job::findOrFail($id);
        if ($job->subject->active == true) {
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
            $entregas = false;
            foreach ($job->deliveries as $entrega) {
                if (file_exists($entrega->file_path)) {
                    $entregas = true;
                }
            }
            return view('admin.jobs.showJob', compact('job', 'file', 'vid', 'activities', 'entregas'));
        } elseif (Auth::user()->roles()->first()->name == 'adviser') {
            return redirect()->route('adviser');
        } else return redirect()->route('teacher');
    }

    public function edit($id)
    {
        $job = Job::findOrFail($id);
        if ($job->subject->active == true) {
            return view('admin.jobs.edit', compact('job'));
        } else return redirect()->route('teacher');
    }

    public function update(UpdateJob $request, $id)
    {
        $job = Job::findOrFail($id);
        $user = Auth::user()->id;

        LogsTrait::logJob($job, $request->state);

        $stateJob = $job->state;
        $subject = Subject::findOrFail($request->subject);

        if (Auth::user()->roles()->first()->name == 'adviser') {
            $request->validate([
                'state' => 'required'
            ]);
            $job->update(['state' => $request->state]);

            session()->flash('messages', 'Tarea actualizada');
            return redirect()->route('adviser.jobs', $stateJob);
        } else {
            // $data = $request->validate([
            //     'title' => 'min:5|max:40',
            //     'description' => 'min:20|max:3000',
            //     'link' => 'nullable|regex:/^.+youtu.+$/i',
            //     'file' => 'nullable|file|mimes:pdf,xlsx,pptx,docx,jpg,jpeg,png',
            //     'start' => 'date',
            //     'end' => 'date|after_or_equal:' . $request->start,
            // ]);
            $data = $request->validated();
            unset($data['file']);
            $data['subject_id'] = $subject->id;
            $data['state'] = 0;
            $data['teacher_name'] = $subject->teacher->name;

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
        $job = Job::findOrFail($id);
        $subjectId =  $job->subject->id;

        $job->deliveries;

        if ($job->state != 1) {
            if (count($job->deliveries) > 0) {
                session()->flash('errores', 'No se puede eliminar, posee entregas');
                return redirect()->route('jobs.index', $subjectId);
            }

            if (file_exists($job->file_path)) {
                unlink($job->file_path);
            }

            $job->delete();

            session()->flash('messages', 'Tarea eliminada');
            return redirect()->route('jobs.index', $subjectId);
        } else {
            return back();
        }
    }

    public function deleteAll($id)
    {
        $job = Job::findOrFail($id);
        $subjectId =  $job->subject->id;

        if (count($job->deliveries) > 0) {
            foreach ($job->deliveries as $entrega) {
                if (file_exists($entrega->file_path)) {
                    unlink($entrega->file_path);
                    $entrega->file_path = null;
                    $entrega->touch();
                }
                auth()->user()->teacher->notifications()
                    ->where('data->delivery_id', $entrega->id)
                    ->delete();
            }
        }

        if (file_exists($job->file_path)) {
            unlink($job->file_path);
            $job->file_path = null;
            $job->touch();
        }

        session()->flash('messages', 'Tarea y Entregas eliminadas');
        return redirect()->route('jobs.index', $subjectId);
    }

    public function descargarJob($job)
    {
        $aux = Job::findOrFail($job);
        $file = public_path($aux->file_path);
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
        $delivery =  Delivery::with('comments')->findOrFail($delivery);
        // $delivery->comments;
        $vid = substr($delivery->link, -11);
        if ($delivery->file_path) {
            $file = url($delivery->file_path);
        } else $file = '';

        if (auth()->user()->roles()->first()->name == 'teacher') {
            NotificationsTrait::teacherMarkAsRead('delivery_id', $delivery->id);
        }

        if ($delivery) {
            $activities = Activity::where('log_name', 'deliveries')->where('subject_id', $delivery->id)->get();
        } else {
            $activities = null;
        }

        return view('admin.jobs.delivery', compact('delivery', 'user', 'vid', 'activities', 'file'));
    }

    public function test()
    {
        return $activity = Activity::where('log_name', 'deliveries')->where('subject_id', 3)->get();
    }

    public function entregasPDF($id)
    {
        $job = Job::with('deliveries')->findOrFail($id);

        $matriculas = $job->subject->course->enrollments;

        $aux = $job->deliveries->keyBy('student_id');

        $faltan = $matriculas->whereNotIn('student_id', $aux->keys());

        $entregas = $job->deliveries()->get();

        $alumnos = $faltan->map(function ($item) {
            return $item->student;
        });

        $aux = $alumnos->sortBy('name');

        $alumnos = $aux->values();

        $pdf = app('dompdf.wrapper')->loadView('entregasPDF', compact('entregas', 'job', 'alumnos'))->setPaper('A4');
        return $pdf->stream(now()->format('d-m-Y') . '_Entregas' . time() . '.pdf');
    }

    public function descargarEntregas($id)
    {
        $job = Job::findOrFail($id);
        $zip_file = $job->title . '.zip';
        $zip = new ZipArchive();
        $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        $pdf = app('dompdf.wrapper')->loadView('tareaPDF', compact('job'))->setPaper('A4');
        $name = $job->title . '.pdf';
        file_put_contents($name, $pdf->output());
        $zip->addFile($name);

        if ($job->file_path) {
            $zip->addFile($job->file_path);
        }

        foreach ($job->deliveries as $delivery) {
            if ($delivery->file_path) {
                $zip->addFile($delivery->file_path);
            }
        }

        // $job->update([
        //     'download' => true
        // ]);

        $zip->close();
        unlink($name);
        return response()->download($zip_file)->deleteFileAfterSend(true);
    }
}

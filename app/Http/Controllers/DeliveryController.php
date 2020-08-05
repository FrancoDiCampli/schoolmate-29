<?php

namespace App\Http\Controllers;

use App\Job;
use App\Comment;
use App\Subject;
use App\Delivery;
use Carbon\Carbon;
use App\Traits\FilesTrait;
use Illuminate\Http\Request;
use App\Traits\StudentsTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    public function pendings($subject){

        $jobs =  Subject::find($subject);

        // $jobs = StudentsTrait::pendings();

        $now = Carbon::now();



        return view('admin.deliveries.pendings', compact('jobs', 'now'));
    }

    public function index($id){
        $user = Auth::user()->student->id;
        $jobs = Job::where('subject_id',$id)->get();
        $deliveries =  Delivery::where('job_id',$jobs->modelkeys())->get();
        $deliveries->where('student_id',$user);

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
        $delivery = $job->deliveries->where('student_id', $user->student->id)->first();

        if($delivery){
            $comments = $delivery->comments;
        } else {
            $comments = [];
        }

        return view('admin.deliveries.create', compact('job', 'delivery', 'comments'));
    }

    public function store(Request $request)
    {
        // try {
            DB::transaction(function () use ($request) {
                $nameFile = FilesTrait::store($request, $ubicacion = 'entregas', $nombre = auth()->user()->student->name);

                if ($nameFile) {
                    $delivery = Delivery::create([
                        'job_id' => $request->job,
                        'file_path' => $nameFile,
                        'state' => 0,
                        'link' => null,
                        'student_id' => Auth::user()->student->id,
                    ]);
                }

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
        // } catch (\Throwable $th) {
        //     session()->flash('message', 'Error');
        // }

        return redirect()->route('student');
    }

    public function update(Request $request, $id)
    {
        return $request;
        Delivery::where('id', $id)

        ->update(['state' => $request->state]);

          return redirect()->route('job.deliveries', $request->id_job);
    }

}

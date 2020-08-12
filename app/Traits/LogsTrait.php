<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;


trait LogsTrait
{

    public static function logJob($job,$cond){
        $user = Auth::user()->id;

        $e = $job->state;



       if($e == 0 && $cond == 0){
            $estado = 'Tarea actualizada';
        }elseif($e == 0 && $cond == 1){
            $estado = 'Tarea activada';

            }elseif($e == 0 && $cond == 2){
                $estado = 'Revisar Tarea';

                }elseif($e == 2 && $cond == 0){
                        $estado = 'Tarea corregida';
                    }

            activity('jobs')
                ->causedBy($user)
                ->performedOn($job)
                ->withProperties(['estado' => 'actualizada'])
                ->log($estado);

        // switch ($cond) {
        //     case 0 :
        //         activity('jobs')
        //         ->causedBy($user)
        //         ->performedOn($job)
        //         ->withProperties(['estado' => 'borrador'])
        //         ->log('Tarea creada');
        //         break;

        //     case 1 :
        //         activity('jobs')
        //         ->causedBy($user)
        //         ->performedOn($job)
        //         ->withProperties(['estado' => 'activa'])
        //         ->log('Tarea activada');
        //         break;

        //     case 2 :
        //         activity('jobs')
        //         ->causedBy($user)
        //         ->performedOn($job)
        //         ->withProperties(['estado' => 'revisar'])
        //         ->log('Tarea por revisar');
        //         break;

        //     case 3 :
        //         activity('jobs')
        //         ->causedBy($user)
        //         ->performedOn($job)
        //         ->withProperties(['estado' => 'borrador'])
        //         ->log('Tarea actualizada');
        //         break;
        //     default:
        //         # code...
        //         break;
        // }

    }

    public static function logDelivery($delivery,$cond){

        // 'En corrección', 'Rehacer', 'Aprobado']
        $user = Auth::user()->id;
        switch ($cond) {
            case 0 :
                activity('deliveries')
                ->causedBy($user)
                ->performedOn($delivery)

                ->withProperties(['estado' => 'En Corrección'])
                ->log('Entrega realizada');

                break;
            case 1 :
                activity('deliveries')
                ->causedBy($user)
                ->performedOn($delivery)

                ->withProperties(['estado' => 'rehacer'])
                ->log('Rehacer tarea');

                    break;
            case 2 :
                activity('deliveries')
                ->causedBy($user)
                ->performedOn($delivery)

                ->withProperties(['estado' => 'aprobado'])
                ->log('Tarea aprobada');

                    break;
            default:
                # code...
                break;
        }

    }
}

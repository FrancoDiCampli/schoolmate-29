<?php

namespace App\Traits;

use App\Job;
use App\User;
use App\Notifications\JobCreated;
use App\Notifications\JobUpdated;
use App\Notifications\DeliveryCreated;
use App\Notifications\DeliveryUpdated;
use App\Student;

trait NotificationsTrait
{
    public static function adviserCreateNotifications($type, $job)
    {
        switch ($type) {
            case 'created':
                $advisers = User::role('adviser')->get();
                foreach ($advisers as $adviser) {
                    $adviser->notify(new JobCreated($job));
                }
                break;

            case 'updated':
                $advisers = User::role('adviser')->get();
                foreach ($advisers as $adviser) {
                    $adviser->notify(new JobUpdated($job, 'Tarea Actualizada'));
                }
                break;
        }
    }

    public static function studentCreateNotifications($object)
    {
        $aux = get_class($object);
        switch ($aux) {
            case 'App\Job':
                $matriculas = $object->subject->course->enrollments;
                $matriculas->map(function ($item) use ($object) {
                    $student = $item->student;
                    $student->notify(new JobCreated($object));
                });
                break;

            case 'App\Delivery':
                $student = Student::find($object->student_id);
                $student->notify(new DeliveryUpdated($object, 'Revisar Entrega'));
                break;
        }
    }

    public static function teacherCreateNotifications($event, $object)
    {
        $aux = get_class($object);
        switch ($aux) {
            case 'App\Job':
                $teacher = $object->subject->teacher;
                $teacher->notify(new JobUpdated($object, 'Revisar Tarea'));
                break;

            case 'App\Delivery':
                switch ($event) {
                    case 'created':
                        $job = $object->job;
                        $teacher = $job->subject->teacher;
                        $teacher->notify(new DeliveryCreated($object));
                        break;

                    case 'updated':
                        $job = Job::find($object->job_id);
                        $teacher = $job->subject->teacher;
                        $teacher->notify(new DeliveryUpdated($object, 'Entrega Actualizada'));
                        break;
                }
                break;
        }
    }

    public static function adviserMarkAsRead($id)
    {
        $notif = auth()->user()->notifications()->whereNotifiable_id(auth()->user()->id)
            ->whereRead_at(null)
            ->where('data->job_id', $id)
            ->get();

        $notif->markAsRead();
    }

    public static function studentMarkAsRead($data, $id)
    {
        $notif = auth()->user()->student->notifications()->whereNotifiable_id(auth()->user()->student->id)
            ->whereRead_at(null)
            ->where('data->' . $data, $id)
            ->get();

        $notif->markAsRead();
    }

    public static function teacherMarkAsRead($data, $id)
    {
        $notif = auth()->user()->teacher->notifications()->whereNotifiable_id(auth()->user()->teacher->id)
            ->whereRead_at(null)
            ->where('data->' . $data, $id)
            ->get();

        $notif->markAsRead();
    }
}

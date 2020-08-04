<?php

namespace App\Observers;

use App\Job;
use App\Notifications\JobCreated;
use App\Notifications\JobUpdated;
use App\Traits\NotificationsTrait;
use App\User;

class JobObserver
{
    /**
     * Handle the job "created" event.
     *
     * @param  \App\Job  $job
     * @return void
     */
    public function created(Job $job)
    {
        NotificationsTrait::adviserCreateNotifications('created', $job);

        // $advisers = User::role('adviser')->get();
        // foreach ($advisers as $adviser) {
        //     $adviser->notify(new JobCreated($job));
        // }
    }

    /**
     * Handle the job "updated" event.
     *
     * @param  \App\Job  $job
     * @return void
     */
    public function updated(Job $job)
    {
        switch ($job->state) {
            case 1:
                NotificationsTrait::studentCreateNotifications($job);

                // $matriculas = $job->subject->course->enrollments;
                // $matriculas->map(function ($item) use ($job) {
                //     $student = $item->student;
                //     $student->notify(new JobCreated($job));
                // });
                break;

            case 2:
                NotificationsTrait::teacherCreateNotifications('updated', $job);

                // $teacher = $job->subject->teacher;
                // $teacher->notify(new JobUpdated($job, 'Revisar Tarea'));
                break;

            case 0:
                NotificationsTrait::adviserCreateNotifications('updated', $job);

                // $advisers = User::role('adviser')->get();
                // foreach ($advisers as $adviser) {
                //     $adviser->notify(new JobUpdated($job, 'Tarea Actualizada'));
                // }

                break;
        }
    }

    /**
     * Handle the job "deleted" event.
     *
     * @param  \App\Job  $job
     * @return void
     */
    public function deleted(Job $job)
    {
        //
    }

    /**
     * Handle the job "restored" event.
     *
     * @param  \App\Job  $job
     * @return void
     */
    public function restored(Job $job)
    {
        //
    }

    /**
     * Handle the job "force deleted" event.
     *
     * @param  \App\Job  $job
     * @return void
     */
    public function forceDeleted(Job $job)
    {
        //
    }
}

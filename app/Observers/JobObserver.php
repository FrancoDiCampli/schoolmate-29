<?php

namespace App\Observers;

use App\Job;
use App\User;
use App\Notifications\JobCreated;
use App\Notifications\JobUpdated;
use App\Traits\NotificationsTrait;

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
                break;

            case 2:
                NotificationsTrait::teacherCreateNotifications('updated', $job);
                break;

            case 0:
                NotificationsTrait::adviserCreateNotifications('updated', $job);
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

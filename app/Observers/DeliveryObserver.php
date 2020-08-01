<?php

namespace App\Observers;

use App\Job;
use App\Delivery;
use App\Notifications\DeliveryCreated;
use App\Notifications\DeliveryUpdated;

class DeliveryObserver
{
    /**
     * Handle the delivery "created" event.
     *
     * @param  \App\Delivery  $delivery
     * @return void
     */
    public function created(Delivery $delivery)
    {
        $job = $delivery->job;
        $teacher = $job->subject->teacher;
        $teacher->notify(new DeliveryCreated($delivery));
    }

    /**
     * Handle the delivery "updated" event.
     *
     * @param  \App\Delivery  $delivery
     * @return void
     */
    public function updated(Delivery $delivery)
    {
        $job = Job::find($delivery->job_id);
        $teacher = $job->subject->teacher;
        $teacher->notify(new DeliveryUpdated($delivery, ' '));
    }

    /**
     * Handle the delivery "deleted" event.
     *
     * @param  \App\Delivery  $delivery
     * @return void
     */
    public function deleted(Delivery $delivery)
    {
        //
    }

    /**
     * Handle the delivery "restored" event.
     *
     * @param  \App\Delivery  $delivery
     * @return void
     */
    public function restored(Delivery $delivery)
    {
        //
    }

    /**
     * Handle the delivery "force deleted" event.
     *
     * @param  \App\Delivery  $delivery
     * @return void
     */
    public function forceDeleted(Delivery $delivery)
    {
        //
    }
}

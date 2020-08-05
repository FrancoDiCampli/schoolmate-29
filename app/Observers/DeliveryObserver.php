<?php

namespace App\Observers;

use App\Job;
use App\Delivery;
use App\Notifications\DeliveryCreated;
use App\Notifications\DeliveryUpdated;
use App\Traits\NotificationsTrait;

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
        NotificationsTrait::teacherCreateNotifications('created', $delivery);
    }

    /**
     * Handle the delivery "updated" event.
     *
     * @param  \App\Delivery  $delivery
     * @return void
     */
    public function updated(Delivery $delivery)
    {
        switch ($delivery->state) {
            case 1:
                NotificationsTrait::studentCreateNotifications($delivery);
                break;
            
            case 0:
                NotificationsTrait::teacherCreateNotifications('updated', $delivery);
                break;
        }
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

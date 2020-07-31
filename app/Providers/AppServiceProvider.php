<?php

namespace App\Providers;

use App\Delivery;
use App\Job;
use App\Observers\DeliveryObserver;
use App\Observers\JobObserver;
use App\Student;
use App\Observers\StudentObserver;
use App\Observers\TeacherObserver;
use App\Teacher;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Delivery::observe(DeliveryObserver::class);
        Job::observe(JobObserver::class);
        Teacher::observe(TeacherObserver::class);
        Student::observe(StudentObserver::class);

        View::composer('*', function ($view) {
            $rol = auth()->user()->roles->first()->name;

            switch ($rol) {
                case 'teacher':
                    $noLeidas = auth()->user()->teacher->unreadNotifications()->get();
                    break;

                case 'student':
                    $noLeidas = auth()->user()->student->unreadNotifications()->get();
                    break;
            }

            $cant = count($noLeidas);

            $view->with(['cant' => $cant, 'noLeidas' => $noLeidas]);
        });
    }
}

<?php

namespace App\Providers;

use App\Job;
use App\Student;
use App\Teacher;
use App\Delivery;
use App\Observers\JobObserver;
use App\Observers\StudentObserver;
use App\Observers\TeacherObserver;
use App\Observers\DeliveryObserver;
use Illuminate\Support\Facades\Auth;
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
            if (Auth::check()) {
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
            }
        });
    }
}

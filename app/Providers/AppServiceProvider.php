<?php

namespace App\Providers;

use App\Job;
use App\Post;
use App\Course;
use App\Student;
use App\Teacher;
use App\Delivery;
use App\Observers\JobObserver;
use App\Observers\PostObserver;
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
        session()->put('selectedAnio', now()->format('Y'));

        Delivery::observe(DeliveryObserver::class);
        Job::observe(JobObserver::class);
        Teacher::observe(TeacherObserver::class);
        Student::observe(StudentObserver::class);
        Post::observe(PostObserver::class);

        View::composer('layouts.dashboard', function ($view) {
            if (Auth::check()) {
                $rol = auth()->user()->roles->first()->name;
                $ciclos = Course::all()->groupBy('cicle');

                switch ($rol) {
                    case 'teacher':
                        $noLeidas = auth()->user()->teacher->unreadNotifications()->take(3)->get();
                        $todas = auth()->user()->teacher->unreadNotifications()->get();
                        break;

                    case 'adviser':
                        $noLeidas = auth()->user()->unreadNotifications()->take(3)->get();
                        $todas = auth()->user()->unreadNotifications()->get();
                        break;

                    case 'student':
                        $noLeidas = auth()->user()->student->unreadNotifications()->take(3)->get();
                        $todas = auth()->user()->student->unreadNotifications()->get();
                        break;

                    default:
                        $noLeidas = [];
                        $todas = [];
                        break;
                }

                $cant = count($todas);

                $view->with([
                    'cant' => $cant,
                    'noLeidas' => $noLeidas,
                    'ciclos' => $ciclos
                ]);
            }
        });
    }
}

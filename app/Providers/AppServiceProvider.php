<?php

namespace App\Providers;

use App\Student;
use App\Observers\StudentObserver;
use App\Observers\TeacherObserver;
use App\Teacher;
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

        Teacher::observe(TeacherObserver::class);
        Student::observe(StudentObserver::class);

    }
}

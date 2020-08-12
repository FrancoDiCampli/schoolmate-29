<?php

namespace App\Observers;

use App\User;
use App\Teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class TeacherObserver
{
    /**
     * Handle the teacher "created" event.
     *
     * @param  \App\Teacher  $teacher
     * @return void
     */
    public function created(Teacher $teacher)
    {

        $user  = User::create([
            'dni'=>$teacher->dni,
            'password' =>Hash::make($teacher->dni),
            'name'=>$teacher->name,
        ]);
        $user->assignRole('teacher');

        $teacher->update([
            'user_id'=>$user->id
        ]);
    }

    /**
     * Handle the teacher "updated" event.
     *
     * @param  \App\Teacher  $teacher
     * @return void
     */
    public function updated(Teacher $teacher)
    {

    }

    /**
     * Handle the teacher "deleted" event.
     *
     * @param  \App\Teacher  $teacher
     * @return void
     */
    public function deleted(Teacher $teacher)
    {
        //
    }

    /**
     * Handle the teacher "restored" event.
     *
     * @param  \App\Teacher  $teacher
     * @return void
     */
    public function restored(Teacher $teacher)
    {
        //
    }

    /**
     * Handle the teacher "force deleted" event.
     *
     * @param  \App\Teacher  $teacher
     * @return void
     */
    public function forceDeleted(Teacher $teacher)
    {
        //
    }
}

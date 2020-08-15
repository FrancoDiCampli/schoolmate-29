<?php

use App\Subject;
use App\Enrollment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'AdminController@home')->name('home');

    //Admin
    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('admin', 'AdminController@admin')->name('admin');
        // Courses
        Route::resource('courses', 'CourseController');
        // Subjects
        Route::resource('subjects', 'SubjectController');
        // Matriculas
        Route::resource('enrollments', 'EnrollmentController');
        // Students
        Route::resource('students', 'StudentController');
        Route::get('import', 'StudentController@importar')->name('import.students');
        Route::post('importarAlumnos', 'StudentController@importStudents')->name('save.students');
        // Teachers
        Route::resource('teachers', 'TeacherController');
        Route::get('importar', 'TeacherController@import')->name('import.teachers');
        Route::post('importarProfes', 'TeacherController@importTeachers')->name('save.teachers');

        // Backup Tareas
        Route::get('tareasZip', 'AdminController@tareasZip');
        Route::get('entregasZip', 'AdminController@entregasZip');
    });

    //Asesores
    Route::group(['middleware' => ['role:adviser|admin']], function () {
        Route::get('adviser', 'AdminController@adviser')->name('adviser');
        Route::get('stateJobs/{id}', 'AdviserController@stateJobs')->name('adviser.jobs');
    });

    // Profesores
    Route::group(['middleware' => ['role:teacher|admin']], function () {
        Route::get('teacher', 'AdminController@teacher')->name('teacher');
        //   Tareas
        Route::resource('jobs', 'JobController')->except(['index', 'create', 'update']);
        //  Tareas de la materia
        Route::get('job/{subject}', 'JobController@subject')->name('job.subject');
        // Crea tarea para una materia dada
        Route::get('job/create/{subject}', 'JobController@create')->name('jobs.create');
        Route::get('jobs/descargar/{job}', 'JobController@descargar')->name('jobs.descargar');
        // Muestra las entregas de la tarea
        Route::get('job/deliveries/{job}', 'JobController@show')->name('job.deliveries');
        Route::get('entrega/{delivery}', 'JobController@delivery')->name('job.delivery');
        Route::put('updateTeacher/{teacher}','TeacherController@updateTeacher')->name('update.teacher');
    });

    // Alumnos
    Route::group(['middleware' => ['role:student|admin']], function () {
        Route::get('student', 'AdminController@student')->name('student');
        Route::post('deliver', 'DeliveryController@store')->name('deliver.store');
        Route::get('pendings/{subject}', 'DeliveryController@pendings')->name('deliveries.pendings');
        // Entregas
        Route::resource('deliveries', 'DeliveryController')->except('create', 'index', 'update');
        Route::get('deliver/{job}', 'DeliveryController@deliver')->name('deliver');
        Route::get('entregas/{subject}', 'DeliveryController@index')->name('deliveries.subject');
        Route::put('updateStudent/{student}','StudentController@updateStudent')->name('update.student');
    });

    // Asesores y Profesores
    Route::group(['middleware' => ['role:adviser|teacher|admin']], function () {
        Route::get('jobs/showJob/{id}', 'JobController@showJob')->name('jobs.showJob');
        Route::resource('jobs', 'JobController')->only(['update']);
        //Comentario de la tarea, entre el profesor y el asesor
        Route::post('add/JobComment', 'CommentController@addJobComment')->name('JobComment.store');
    });

    // Alumnos y Profesores
    Route::group(['middleware' => ['role:student|teacher|admin']], function () {
        Route::put('updateDelivery/{id}', 'DeliveryController@update')->name('delivery.update');
        Route::get('tareas/{subject}', 'JobController@index')->name('jobs.index');
        // Comentarios de la tarea, ida y vuelta entre prof y alumno respecto a una tarea particular
        Route::resource('comments', 'CommentController');
        // Posts
        Route::resource('posts', 'PostController')->except('create', 'index');
        Route::get('posts/index/{subject}', 'PostController@index')->name('posts.index'); //agregado para index del post
        Route::get('newpost/{subject}', 'PostController@create')->name('new.post');
        // Comentarios de los post del muro
        Route::resource('annotations', 'AnnotationController');

        Route::get('descargarDelivery/{delivery}', 'DeliveryController@descargarDelivery')->name('descargarDelivery');
    });

    // Alumnos, Asesores y Profesores
    Route::group(['middleware' => ['role:student|teacher|adviser|admin']], function () {

        Route::get('descargarJob/{job}', 'JobController@descargarJob')->name('descargarJob');
        // Notificaciones
        Route::get('notifications', function () {
            if (Auth::check()) {
                $rol = auth()->user()->roles->first()->name;
                switch ($rol) {
                    case 'teacher':
                        $todas = auth()->user()->teacher->notifications()->get();
                        break;

                    case 'adviser':
                        $todas = auth()->user()->notifications()->get();
                        break;

                    case 'student':
                        $noLeidas = auth()->user()->student->notifications()->take(3)->get();
                        $todas = auth()->user()->student->notifications()->get();
                        break;

                    default:
                        $todas = [];
                        break;
                }
                $cant = count($todas);
                return view('admin.notifications', compact('todas','cant'));
            }
        })->name('notifications');
    });

    Route::resource('user', 'UserController');
    Route::get('reset/{user}','UserController@resetPass')->name('user.reset');
    Route::put('reset','UserController@reset')->name('reset');

    // Ruta de  pruebas del log de actividades de una tarea/entrega
    Route::get('test', 'JobController@test')->name('test');

});

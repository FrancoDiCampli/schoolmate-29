<?php

use App\Enrollment;
use App\Subject;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/','AdminController@home')->name('home');

    Route::get('student','AdminController@student')->name('student');
    Route::get('admin','AdminController@admin')->name('admin');
    Route::get('teacher','AdminController@teacher')->name('teacher');
    Route::get('adviser', 'AdminController@adviser')->name('adviser');

    //Asesores
    Route::get('stateJobs/{id}', 'AdviserController@stateJobs')->name('adviser.jobs');

    // Profesores
    Route::resource('teachers', 'TeacherController');
    Route::get('importar','TeacherController@import')->name('import.teachers');
    Route::post('importarProfes','TeacherController@importTeachers')->name('save.teachers');

    // Cursos
    Route::resource('courses', 'CourseController');

    // Materias
    Route::resource('subjects', 'SubjectController');

    // Alumnos
    Route::resource('students', 'StudentController');
    Route::get('import','StudentController@importar')->name('import.students');
    Route::post('importarAlumnos','StudentController@importStudents')->name('save.students');

      // Matriculas
      Route::resource('enrollments', 'EnrollmentController');

    //   Tareas
    Route::resource('jobs', 'JobController')->except(['index','create']);
        // Tareas indice del profe
    Route::get('tareas/{subject}','JobController@index')->name('jobs.index');
        //  Tareas de la materia
    Route::get('job/{subject}', 'JobController@subject')->name('job.subject');
        // Crea tarea para una materia dada
    Route::get('job/create/{subject}', 'JobController@create')->name('jobs.create');

    Route::get('jobs/showJob/{id}', 'JobController@showJob')->name('jobs.showJob');
    Route::get('jobs/descargar/{job}', 'JobController@descargar')->name('jobs.descargar');
        // Muestra las entregas de la tarea
    Route::get('job/deliveries/{job}', 'JobController@show')->name('job.deliveries');
    Route::get('entrega/{delivery}', 'JobController@delivery')->name('job.delivery');

    // Posts
    Route::resource('posts', 'PostController')->except('create', 'index');
    Route::get('posts/index/{subject}', 'PostController@index')->name('posts.index'); //agregado para index del post
    Route::get('newpost/{subject}','PostController@create')->name('new.post');

    // Comentarios de los post del muro
    Route::resource('annotations', 'AnnotationController');


    // Entregas
    Route::resource('deliveries', 'DeliveryController')->except('create', 'index');;
    // Probando esto
    Route::get('pendings/{subject}', 'DeliveryController@pendings')->name('deliveries.pendings');
    Route::get('entregas/{subject}','DeliveryController@index')->name('deliveries.subject');
    Route::get('deliver/{job}', 'DeliveryController@deliver')->name('deliver');
    Route::post('deliver', 'DeliveryController@store')->name('deliver.store');
    Route::put('updateDelivery/{id}','DeliveryController@update')->name('delivery.update');



    // Comentarios de la tarea, ida y vuelta entre prof y alumno respecto a una tarea particular
    Route::resource('comments', 'CommentController');

    //Comentario de la tarea, entre el profesor y el asesor
    Route::post('add/JobComment','CommentController@addJobComment')->name('JobComment.store');

    Route::resource('user', 'UserController');

    // Notificaciones
    Route::get('notifications', function(){
        $todas = auth()->user()->notifications;
        return view('admin.notifications', compact('todas'));
    })->name('notifications');

    // Ruta de  pruebas del log de actividades de una tarea/entrega
    Route::get('test','JobController@test')->name('test');

});



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
        // Taras indice del profe
    Route::get('jobs/{subject}','JobController@index')->name('jobs.index');
        //  Tareas de la materia
    Route::get('job/{subject}', 'JobController@subject')->name('job.subject');
        // Crea tarea para una materia dada
    Route::get('job/create/{subject}', 'JobController@create')->name('job.create');

    Route::get('job/showJob/{id}', 'JobController@showJob')->name('job.showJob');
    Route::get('jobs/descargar/{job}', 'JobController@descargar')->name('jobs.descargar');


    // Posts
    Route::resource('posts', 'PostController')->except('create', 'index');
    Route::get('posts/index/{subject}', 'PostController@index')->name('posts.index'); //agregado para index del post
    Route::get('newpost/{subject}','PostController@create')->name('new.post');

    // Comentarios de los post del muro
    Route::resource('annotations', 'AnnotationController');


    // Entregas
    Route::resource('deliveries', 'DeliveryController');
    Route::get('pendings', 'DeliveryController@pendings')->name('deliveries.pendings');
    Route::get('deliver/{job}', 'DeliveryController@deliver')->name('deliver');
    Route::post('deliver', 'DeliveryController@store')->name('deliver.store');


});


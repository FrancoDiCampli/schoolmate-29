<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/','AdminController@home')->name('home');

    Route::get('student','AdminController@student')->name('student');
    Route::get('admin','AdminController@admin')->name('admin');
    Route::get('teacher','AdminController@teacher')->name('teacher');


    Route::resource('teachers', 'TeacherController');
    Route::get('importarProfes','TeacherController@import')->name('import.teachers');

});


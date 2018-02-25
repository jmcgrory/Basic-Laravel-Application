<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* 
    // Example Dynamic Route
    Route::get('/users/{id}/{name}', function ($id, $name) {
        return ('<p>This is the ID '.$id.' from User '.$name.'</p>');
    });
*/



    // ROOT
    Route::get('/', 'PagesController@index');

    // About
    Route::get('/about', 'PagesController@about');

    // Services
    Route::get('/services', 'PagesController@services');

    // Resource Route
    Route::resource('posts', 'PostsController');
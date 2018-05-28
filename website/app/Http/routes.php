<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//Route qui redirige les urls de connection (/login, /logout, /register)
Route::auth();
//Route qui redirige l'URL /
Route::get('/', 'HomeController@index');
//Route qui redirige l'url /location
Route::post('/locations/{imei}/{longitude}/{latitude}','LocationController@add');
//Route qui redirige l'Url /home
Route::get('/home', 'HomeController@index');

<?php

use App\Core\Routing\Route;


Route::get('/', 'HomeController@index');

Route::post('/contact/add', 'ContactController@add');
Route::get('/contact/delete/{id}', 'ContactController@delete');

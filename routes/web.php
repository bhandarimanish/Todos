<?php

use Illuminate\Support\Facades\Route;

Route::get('/','TodoController@index');

Route::resource('todo','TodoController');
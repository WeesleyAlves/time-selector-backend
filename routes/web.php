<?php

Route::get('/', function () {
    return view('home');
});


Route::get('/times','ControllerEquipes@getAll');
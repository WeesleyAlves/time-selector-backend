<?php

Route::get('/', function () {
    return view('home');
});


Route::get('/times','ControllerEquipes@getAll');

Route::get('/times/{id}','ControllerEquipes@getId');

//Route::delete('/times/{id}','ControllerEquipes@delete');

Route::post('/times/{id}','ControllerEquipes@montar');


// rotas jogadores

Route::post('/jogador','ControllerEquipes@insert');

Route::post('/jogador/delete','ControllerEquipes@delete');
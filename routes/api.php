<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->namespace('Api')->group(function (){

    Route::prefix('imoveis')->group(function (){

        Route::get('/', 'ImovelController@getImoveis');
        Route::post('/adicionar', 'ImovelController@postImoveis');
        Route::put('/editar/{id}', 'ImovelController@putImoveis');
        Route::delete('/deletar/{id}', 'ImovelController@deleteImoveis');

    });


    Route::prefix('interessados')->group(function (){

        Route::get('/', 'InteressadosController@getInteressados');
        Route::post('/adicionar', 'InteressadosController@postInteressados');
        Route::put('/editar/{id}', 'InteressadosController@putInteressados');
        Route::delete('/deletar/{id}', 'InteressadosController@deleteInteressados');

    });







});

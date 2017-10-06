<?php

Route::get('api/clients', 'Endpoints\ClientsEndpointController@get');
Route::post('api/clients', 'Endpoints\ClientsEndpointController@store');
Route::put('api/clients/{client}', 'Endpoints\ClientsEndpointController@update');
Route::delete('api/clients/{client}', 'Endpoints\ClientsEndpointController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

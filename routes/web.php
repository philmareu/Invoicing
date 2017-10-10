<?php

Auth::routes();

Route::view('/', 'dashboard.index');
Route::get('settings', 'SettingsController@get');
Route::get('settings/account', 'Settings\AccountSettingsController@get');
Route::put('settings/account', 'Settings\AccountSettingsController@update');

Route::get('api/clients', 'Endpoints\ClientsEndpointController@get');
Route::post('api/clients', 'Endpoints\ClientsEndpointController@store');
Route::put('api/clients/{client}', 'Endpoints\ClientsEndpointController@update');
Route::delete('api/clients/{client}', 'Endpoints\ClientsEndpointController@destroy');

Route::get('/home', 'HomeController@index')->name('home');

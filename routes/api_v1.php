<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//TODO не забыть throttle
Route::group(['middleware' => ['auth:api','cors','throttle']], function() {
    Route::resource('errors', 'ErrorsAPIController');
    Route::resource('works', 'WorksAPIController');
});

Route::resource('constants', 'ConstantsAPIController');

Route::resource('logs', 'LogsAPIController');

Route::resource('positions', 'PositionsAPIController');

Route::resource('structures', 'StructuresAPIController');

Route::resource('vacancies', 'VacancyAPIController');
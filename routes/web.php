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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/industry/images', 'IndustryController@getIndustryImages');

Route::get('/Aggregate/PFRE', 'AggregateDataController@getAggregateUniversitiesPFREGraphData')
    ->name('aggregate.PFRE.view');
Route::post('/Aggregate/PFRE', 'AggregateDataController@getAggregateUniversitiesPFRE')
    ->name('aggregate.PFRE');

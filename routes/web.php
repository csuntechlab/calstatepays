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
use App\Models\FieldOfStudy;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function() {
    dd(FieldOfStudy::with('hegisCategory')->where('Agriculture', 1)->get());
});
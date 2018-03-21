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

//Aggregate Routes - These are routes that pull data for ALL universities
Route::get('aggregate/income/student-path','AggregateDataController@getAverageIncomeByStudentPath')
            ->name('student-path-avg');

Route::get('aggregate/income/industry','AggregateDataController@getAverageIncomeByIndustry')->name('avg_income_industry');
Route::get('/Aggregate/TopTenMajors','AggregateDataController@getAggregateTopTenMajors')->name('aggregate.top.majors');
Route::get('aggregate/income/student-path','AggregateDataController@getAverageIncomeByStudentPath')
    ->name('student-path-avg');
//Data Routes

//Learn and Earn Routes
Route::get('/learn-and-earn/industry/{schoolId}/{industryTitle}', 'LearnAndEarnController@getCollegeMajor');
Route::get('/learn-and-earn/major-data/{schoolId}/{majorId}', 'LearnAndEarnController@getCollegeMajor');

//Major
Route::get('major/hegis-codes', 'MajorController@getAllHegisCodes')
    ->name('major.hegis-codes');

//Industry
Route::get('industry/naics-titles', 'IndustryController@getAllIndustryNaicsTitles')->name('industry.naics-titles');

//Student Path
Route::get('student-path', 'StudentPathController@getAllStudentPaths')->name('student-paths');

// File Routes
Route::get('import-export-view', 'ExcelController@showImportExportView')->name('import.export.view');
Route::post('import-file', 'ExcelController@importFile')->name('importFile');

//Middleware
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

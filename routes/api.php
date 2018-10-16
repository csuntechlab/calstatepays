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
//Major
Route::get('major/field-of-study', 'MajorController@getAllFieldOfStudies');
// Route::get('/major/code/{majorName}', 'MajorController@getHegisCode');  TODO: why do i comment this out and get an error

/** Swap university_id -> university_name */
Route::get('major/hegis-codes/university/{university_name}', 'MajorController@getAllHegisCodesByUniversity')->name('major.hegis-codes');

/** Swap university_id -> university_name */
Route::get('major/hegis-codes/{universityName}/{fieldOfStudyId}', 'MajorController@filterByFieldOfStudy');

/** $university_id -> $university_name */
Route::get('major/{major}/{university}', 'MajorController@getMajorEarnings');

/** TODO: $universityId -> $universityName */
Route::get('/major/{major}/{university}/{age_range}/{education_level}/{annual_earnings}/{financial_aid}',
    'MajorController@getFREData')->name('major.fre-data');

//Industry

Route::get('industry/naics-titles', 'IndustryController@getAllIndustryNaicsTitles')->name('industry.naics-titles');

Route::get('industry/{hegis_code}/{universityName}/{degreeLevel}', 'IndustryController@getIndustryPopulationByRank');

Route::get('industry/images/{hegis_code}/{universityName}/{degreeLevel}', 'IndustryController@getIndustryPopulationByRankWithImages');

//Student Path
Route::get('student-path', 'StudentPathController@getAllStudentPaths')->name('student-paths');

//University
Route::get('/university', 'UniversityController@getAllUniversities');

// File Routes
Route::get('import-export-view', 'ExcelController@showImportExportView')->name('import.export.view');
Route::post('import-file', 'ExcelController@importFile')->name('importFile');

//Middleware
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

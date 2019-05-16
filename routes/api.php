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


Route::get('major/hegis-codes/university/{university}', 'MajorController@getAllHegisCodesByUniversity')->name('major.hegis-codes');

/** Swap university_id -> university_name */
Route::get('major/hegis-codes/{university}/{fieldOfStudyId}', 'MajorController@filterByFieldOfStudy');

/** $university_id -> $university_name */
Route::get('major/{major}/{university}', 'MajorController@getMajorEarnings');

//Industry

Route::get('industry/naics-titles', 'IndustryController@getAllIndustryNaicsTitles')->name('industry.naics-titles');

// change route variables from hegis_code to major... universityName to university
Route::get('industry/{major}/{university}', 'IndustryController@getIndustryPopulationByRank');

Route::get('industry/images/{major}/{university}', 'IndustryController@getIndustryPopulationByRankWithImages');


// University
Route::get('/university', 'UniversityController@getAllUniversities');

// Power User data

Route::get('/power/images', 'PowerUsersController@getPowerUsersCardImages');
Route::get('/power', 'PowerUsersController@getTableauOptInUniversityData');

// Feedback
Route::post('/feedback/post', 'FeedBackController@postFeedBack');

// pfre
Route::get(
    '/pfre/{entry_status}/{major}/{in_school_earning}/{financial_aid}',
    'PfreController@getFREData'
);

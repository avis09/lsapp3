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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// list the venues

Route::get('venues', 'VenueApiController@index');

//list single venue
Route::get('venue/{id}', 'VenueApiController@show');

//Create new venue
Route::post('venue', 'VenueApiController@store');

//update Venue

Route::put('venue', 'VenueApiController@store');

// delete
Route::delete('venue/{id}', 'VenueApiController@destroy');

//list venues depending on venue type id
Route::get('venues/{venueTypeId}', ['uses' =>'VenueApiController@getVenuesBasedOnId']);


// list the venuetype
Route::get('venuetypes', 'VenueTypeApiController@index');

//list single venuetype
Route::get('venuetype/{id}', 'VenueTypeApiController@show');

//Create new venuetype
Route::post('venuetype', 'VenueTypeApiController@store');

//update Venuetype

Route::put('venuetype', 'VenueTypeApiController@store');

// delete
Route::delete('venuetype/{id}', 'VenueTypeApiController@destroy');



//list building
Route::get('buildings', 'BuildingApiController@index');

//list single building
Route::get('building/{id}', 'BuildingApiController@show');

//Create new building
Route::post('building', 'BuildingApiController@store');

//update buidling

Route::put('building', 'BuildingApiController@store');

// delete
Route::delete('building/{id}', 'BuildingApiController@destroy');





//list feedback
Route::get('feedbacks', 'FeedbackApiController@index');

//list single feedback
Route::get('feedback/{id}', 'FeedbackApiController@show');
//Create new feedback
Route::post('feedback', 'FeedbackApiController@store');




//list user
Route::get('users', 'LoginApiController@index');

//list single user
Route::get('user/{id}', 'LoginApiController@show');

Route::post('user', 'LoginApiController@store');

//LOGIN
Route::post('login', 'LoginApiController@login');


//reservation
Route::get('schedules/{venueID}/{date}', 'SchedulesApiController@showAvailSched');

Route::get('schedules_reserved/{venueID}/{date}', 'SchedulesApiController@showReservedSched');

Route::post('schedules', 'SchedulesApiController@store');


Route::get('schedules_myreserved/{userID}', 'SchedulesApiController@showMyReservedSched');










// list the profile

Route::get('profiles', 'ViewprofileApiController@index');

//list single profile
Route::get('profile/{id}', 'ViewprofileApiController@show');

//Create new profile
Route::post('profile', 'ViewprofileApiController@store');

//update profile

Route::put('profile/{id}', 'ViewprofileApiController@store');


Route::post('profile/{id}', 'ViewprofileApiController@store');



//waiver


Route::get('waivers', 'WaiverApiController@index');


Route::post('waiver', 'WaiverApiController@store');


Route::get('venuegallery/{id}', 'VenueGalleryApiController@show');
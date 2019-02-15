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

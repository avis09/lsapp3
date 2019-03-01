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
/*
Route::get('/', function () {
    return view('pages.index');
});

Route::get('/about', function() {
    return view('pages.about');
});

Route::get('/users/{id}', function($id){
    return 'This is user '.$name.' with an id of';
});
*/

//Route::group(['middleware' => 'web'], function() {


// Thesis Home -----------------------------------------------------------------------------------------------------

use Illuminate\Support\Facades\Input;

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/broshome', 'BroshomeController@index')->name('bros');
// LOG IN ----------------------------------------------------------------------------------------------------------
//route for show login form
Route::get('/', 'Auth\LoginController@showLoginForm');

//route for login
Route::post('/login', 'Auth\LoginController@login');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

//Functions for schedule
Route::get('/findVenueSched', 'SchedulesController@findVenueSched');
Route::get('/showSchedules', 'SchedulesController@showSchedules');
Route::group(['middleware' => ['guest']], function () {
    // Guest routs
});

//Student-----------------------------------------------------------------------------------------------------------
Route::group(['middleware' => 'student', 'prefix' => 'student'], function () {

    //Feedbacks
//         Route::get('feedbacks/index', 'FeedbacksController@index')->name('feedbacks.index');
        Route::get('feedbacks/create', 'FeedbacksController@create')->name('feedbacks.create');
    Route::post('feedbacks/create', 'FeedbacksController@store')->name('feedbacks.store');

        //schedules
        Route::get('schedules/index', 'SchedulesController@index')->name('schedules.index');
        Route::get('schedules/create', 'SchedulesController@create')->name('schedules.create');
        Route::post('schedules/create', 'SchedulesController@store')->name('schedules.store');
        Route::get('schedules/{id}/edit', 'SchedulesController@edit')->name('schedules.edit');
        Route::post('schedules/update', 'SchedulesController@update')->name('schedules.update');
});
////Registrar-----------------------------------------------------------------------------------------------------------
Route::group(['middleware' => 'registrar', 'prefix' => 'registrar'], function () {

    //Feedbacks
    Route::get('feedbacks/index', 'FeedbacksController@index')->name('feedbacks.index');
    //Venues
    Route::get('venues/index', 'VenuesController@index')->name('venues.index');
    Route::get('venues/create', 'VenuesController@create')->name('venues.create');
    Route::post('venues/create', 'VenuesController@store')->name('venues.store');
    Route::get('venues/{id}/edit', 'VenuesController@edit')->name('venues.edit');
    Route::post('venues/update', 'VenuesController@update')->name('venues.update');
    Route::get('venues/reports', 'VenuesController@indexReports')->name('venues.indexReports');

    Route::get('Picture/create', 'PictureController@create')->name('Picture.create');
    Route::post('Picture/create', 'PictureController@store')->name('Picture.store');
    Route::get('Picture/index', 'PictureController@index')->name('Picture.index');
//    //schedules
//    Route::get('schedules/index', 'SchedulesController@index')->name('schedules.index');
//    Route::get('schedules/create', 'SchedulesController@create')->name('schedules.create');
//    Route::post('schedules/create', 'SchedulesController@store')->name('schedules.store');
//    Route::get('schedules/{id}/edit', 'SchedulesController@edit')->name('schedules.edit');
//    Route::post('schedules/update', 'SchedulesController@update')->name('schedules.update');
});
//GASD-----------------------------------------------------------------------------------------------------------
Route::group(['middleware' =>  'gasd', 'prefix' => 'gasd'], function () {

//Feedbacks
    Route::get('feedbacks/index2', 'FeedbacksController@index2')->name('feedbacks.index2');
    //Venues
    Route::get('venues/index2', 'VenuesController@index2')->name('venues.index2');
    Route::get('venues/create2', 'VenuesController@create2')->name('venues.create2');
    Route::post('venues/create2', 'VenuesController@store2')->name('venues.store2');
    Route::get('venues/{id}/edit', 'VenuesController@edit')->name('venues.edit');
    Route::post('venues/update', 'VenuesController@update')->name('venues.update');
    Route::get('venues/reports2', 'VenuesController@indexReports2')->name('venues.indexReports2');

//    //schedules
//    Route::get('schedules/index', 'SchedulesController@index')->name('schedules.index');
//    Route::get('schedules/create', 'SchedulesController@create')->name('schedules.create');
//    Route::post('schedules/create', 'SchedulesController@store')->name('schedules.store');
//    Route::get('schedules/{id}/edit', 'SchedulesController@edit')->name('schedules.edit');
//    Route::post('schedules/update', 'SchedulesController@update')->name('schedules.update');
});
//ITD-----------------------------------------------------------------------------------------------------------
Route::group(['middleware' => 'itd', 'prefix' => 'itd'], function () {


//Users
    Route::get('users/index', 'Auth\UsersController@index')->name('users.index');
    Route::get('users/create', 'Auth\UsersController@create')->name('users.create');
    Route::post('users/create', 'Auth\UsersController@store')->name('users.store');
    Route::get('users/show','Auth\UsersController@show')->name('users.show');
    Route::get('users/{id}/edit', 'Auth\UsersController@edit')->name('users.edit');
    Route::put('users/{id}/edit', 'Auth\UsersController@update')->name('users.update');
    Route::get('logtimes/index', 'LogtimesController@index')->name('logtimes.index');

});


//---------------------------------------------------------------------------------------------------------------------

////Schedule
//Route::get('/schedules/create', 'SchedulesController@create')->name('schedules.create');
//Route::post('/schedules/create', 'SchedulesController@store')->name('schedules.store');


//    Route::get('schedules/create', 'SchedulesController@create', function()
//    {
//        $venueTypeID = Input::get('venueTypeID');
//        $subcategories = \App\Time::where('venueTypeID','=', $venueTypeID)->get();
//        return $subcategories;
//
//    });

//Route::get('schedules/create/sched',function()
//{
//    $venueTypeID = Input::get('venueTypeID');
//    $subcategories = \App\Time::where('venueTypeID','=', $venueTypeID)->get();
//    return $subcategories;
//
//});

//NOTES *************************************************************************************************
// Traversy Media Laravel --------------------------------------
//Route::get('/', 'PagesController@index');
//Route::get('/about', 'PagesController@about');
//Route::get('/services', 'PagesController@services');
//Route::resource('posts', 'PostsController');
//Auth::routes();
//----------------------------------------------------------------

//Route::group(['prefix' => 'books'], function ()
//    {
//        Route::get('/', ['as' => 'index', 'uses' => 'BooksController@index']);
//        Route::post('store', ['as' => 'store', 'uses' => 'BooksController@store']);
//        Route::get('show/{id}', ['as' => 'show', 'uses' => 'BooksController@show']);
//        Route::post('update/{id}', ['as' => 'update', 'uses' => 'BooksController@update']);
//        Route::delete('destroy/{id}', ['as' => 'destroy', 'uses' => 'BooksController@destroy']);
//        });

// New log in
//Route::post('/login', 'Auth\LoginController@login');
//Route::get('/login', 'Auth\LoginController@viewlogin');

// CRUD Venues
//Route::resource('/venues', 'VenuesController');

// CRUD Classrooms
//Route::resource('/classrooms', 'ClassroomsController');

// CRUD Users
//Route::resource('/users', 'Auth\UsersController');
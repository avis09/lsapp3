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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/broshome', 'BroshomeController@index')->name('bros');


//Student-----------------------------------------------------------------------------------------------------------
Route::group(['middleware' => 'student'], function () {
    Route::get('/schedules/create', 'SchedulesController@create')->name('schedules.create');
    Route::post('/schedules/create', 'SchedulesController@store')->name('schedules.store');
    Route::get('/schedules/{id}/edit', 'SchedulesController@edit')->name('schedules.edit');
    Route::post('/schedules/update', 'SchedulesController@update')->name('schedules.update');
});
//GASD-----------------------------------------------------------------------------------------------------------
Route::group(['middleware' => 'gasd'], function () {
    //Schedule
    Route::get('/schedules/create', 'SchedulesController@create')->name('schedules.create');
    Route::post('/schedules/create', 'SchedulesController@store')->name('schedules.store');

    //Venues
    Route::get('/venues/create', 'VenuesController@create')->name('venues.create');
    Route::post('/venues/create', 'VenuesController@store')->name('venues.store');
    Route::get('/venues/{id}/edit', 'VenuesController@edit')->name('venues.edit');
    Route::post('/venues/update', 'VenuesController@update')->name('venues.update');
});
//Registrar-----------------------------------------------------------------------------------------------------------
Route::group(['middleware' => 'registrar'], function () {
    //Schedule
    Route::get('/schedules/create', 'SchedulesController@create')->name('schedules.create');
    Route::post('/schedules/create', 'SchedulesController@store')->name('schedules.store');

    //Venues
    Route::get('/venues/create', 'VenuesController@create')->name('venues.create');
    Route::post('/venues/create', 'VenuesController@store')->name('venues.store');
    Route::get('/venues/{id}/edit', 'VenuesController@edit')->name('venues.edit');
    Route::post('/venues/update', 'VenuesController@update')->name('venues.update');
});
//ITD-----------------------------------------------------------------------------------------------------------
Route::group(['middleware' => 'itd'], function () {
    //Schedule
    Route::get('/schedules/create', 'SchedulesController@create')->name('schedules.create');
    Route::post('/schedules/create', 'SchedulesController@store')->name('schedules.store');

    //Venues
    Route::get('/users/create', 'VenuesController@create')->name('users.create');
    Route::post('/users/create', 'VenuesController@store')->name('users.store');
    Route::get('/users/{id}/edit', 'VenuesController@edit')->name('users.edit');
    Route::post('/users/update', 'VenuesController@update')->name('users.update');
});

//---------------------------------------------------------------------------------------------------------------------
//route for show login form
Route::get('/', 'Auth\LoginController@showLoginForm');

//route for login
Route::post('/login', 'Auth\LoginController@login');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/logout', 'Auth\LoginController@logout')->name('logout');



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
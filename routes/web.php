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
    Route::get('/', 'PagesController@index');
    Route::get('/about', 'PagesController@about');
    Route::get('/services', 'PagesController@services');

    Route::resource('posts', 'PostsController');
    Auth::routes();

// Thesis

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/broshome', 'BroshomeController@index')->name('bros');

// CRUD Venues
    Route::resource('/venues', 'VenuesController');

// CRUD Classrooms
    Route::resource('/classrooms', 'ClassroomsController');
// CRUD Users
    Route::resource('/users', 'Auth\UsersController');
//Route::resource('/schedules', 'SchedulesController');
// Reservations
//    Route::group(['middleware' => 'student'], function () {
//      Route::resource('schedules/create', 'SchedulesController@create');
//   // Route::resource('schedules.create', 'SchedulesController@create');
//
    Route::resource('/schedules', 'SchedulesController');
//    });
//    Route::group(['prefix' => 'books'], function ()
//    {
//        Route::get('/', ['as' => 'index', 'uses' => 'BooksController@index']);
//        Route::post('store', ['as' => 'store', 'uses' => 'BooksController@store']);
//        Route::get('show/{id}', ['as' => 'show', 'uses' => 'BooksController@show']);
//        Route::post('update/{id}', ['as' => 'update', 'uses' => 'BooksController@update']);
//        Route::delete('destroy/{id}', ['as' => 'destroy', 'uses' => 'BooksController@destroy']);
//        });
//});
// New log in
//Route::post('/login', 'Auth\LoginController@login');
//Route::get('/login', 'Auth\LoginController@viewlogin');

//route for show login form
Route::get('/', 'Auth\LoginController@showLoginForm');

//route for login
Route::post('/login', 'Auth\LoginController@login');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

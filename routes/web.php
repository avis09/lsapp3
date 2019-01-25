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

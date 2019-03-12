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


Route::get('/test', 'SchedulesController@showSchedules');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/broshome', 'BroshomeController@index')->name('bros');
Route::get('emails/create', 'EmailsController@index')->name('bros');
Route::post('/sendmail', 'EmailsController@sendmail')->name('bros');
// LOG IN ----------------------------------------------------------------------------------------------------------
//route for show login form
Route::get('/', 'Auth\LoginController@showLoginForm');

//route for login
Route::post('/login', 'Auth\LoginController@login');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/faq', 'FAQController@index');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

//Functions for schedule
Route::post('/get-available-time', 'SchedulesController@getAvailableTimeToSchedule');
Route::post('/get-new-available-time', 'SchedulesController@getNewAvailableTimeToSchedule');


Route::post('/findVenueSched', 'SchedulesController@findVenueSched');
Route::get('/showSchedules', 'SchedulesController@showSchedules');


//TRIAL
Route::get('/send', 'VenuesController@sendcreate');
Route::post('/send', 'VenuesController@sendstore');

//R


Route::group(['middleware' => 'auth', 'prefix' => 'auth'], function () {
    Route::post('/update-password', 'Auth\UsersController@updatePassword');
});

//Student-----------------------------------------------------------------------------------------------------------
Route::group(['middleware' => 'student', 'prefix' => 'student'], function () {

    //Feedbacks
//         Route::get('feedbacks/index', 'FeedbacksController@index')->name('feedbacks.index');
        Route::get('/feedback', 'FeedbacksController@showFeedbackPage')->name('feedbacks.page');
        Route::post('/feedbacks/send-feedback', 'FeedbacksController@store')->name('feedbacks.store');

        //schedules
        Route::get('schedules/calendar', 'SchedulesController@showCalendarPage')->name('schedules.index');
        Route::get('schedules/list', 'SchedulesController@showReservationPage');
        Route::post('/schedules/create-reservation', 'SchedulesController@createReservation')->name('schedules.store');
        Route::get('schedules/{id}/edit', 'SchedulesController@edit')->name('schedules.edit');
        Route::post('schedules/update', 'SchedulesController@update')->name('schedules.update');
        Route::post('/schedule/get-venuesofvenuetype', 'SchedulesController@getVenuesOfVenueType');
        Route::get('/schedule/get-user-reservations', 'SchedulesController@getUserReservations');
        Route::post('/schedule/update-reservation-status', 'SchedulesController@updateReservationStatus');

    //get canceled users
    Route::get('/schedule/get-cancelled-schedules', 'SchedulesController@getCancelledUserReservations');

        //gallery
        Route::get('/venue-rooms', 'VenuesController@showRoomVenues');
        Route::get('/venue-courts', 'VenuesController@showCourtVenues');
        Route::get('/change-password', function(){
            return view('pages.change-password');
        });

        Route::post('/show-schedules', 'SchedulesController@showSchedules');

        //PROFILE UPDATE
        Route::get('/profile', 'Auth\UsersController@showProfile');
        Route::post('/update-profile', 'Auth\UsersController@updateProfile');
    //FAQ
    Route::get('/faq', function() {
        return view('pages.student.faq');
    });
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

    // venues gallery
    Route::get('gallery/index', 'GalleryController@index')->name('Gallery.index');
    //add pictures
    Route::get('picture/create', 'PictureController@create')->name('Picture.create');
    Route::post('picture/create', 'PictureController@store')->name('Picture.store');
    Route::get('picture/index', 'PictureController@index')->name('Picture.index');

    //R
     Route::get('/venues/get-venues', 'VenuesController@getVenues');
     Route::post('/venues/add-venue', 'VenuesController@store');

    //FAQ
    Route::get('/registrarfaq', function() {
        return view('pages.registrar.registrarfaq');
    });
    Route::get('/profile', 'Auth\UsersController@showProfile');
    Route::get('/change-password', function(){
        return view('pages.change-password');
    });
    //Schedules
    Route::get('/schedules/list', 'SchedulesController@showReservationPageReg');
    Route::get('/schedules/get-pending', 'SchedulesController@getPendingSchedulesReg');
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
    //A
    Route::get('venues/index2', 'VenuesController@index2');
    Route::get('/venues/get-venues', 'VenuesController@getVenues2');
    Route::post('/venues/add-venue', 'VenuesController@store');

    //
    Route::get('venues/create2', 'VenuesController@create2')->name('venues.create2');
    Route::post('venues/create2', 'VenuesController@store2')->name('venues.store2');
    Route::get('venues/{id}/edit', 'VenuesController@edit')->name('venues.edit');
    Route::post('venues/update', 'VenuesController@update')->name('venues.update');
    Route::get('venues/reports2', 'VenuesController@indexReports2')->name('venues.indexReports2');
    //FAQ
    Route::get('/gasdfaq', function() {
        return view('pages.gasd.gasdfaq');
    });

//    //schedules
    //Anz
    Route::get('/schedules/list', 'SchedulesController@showReservationPageGasd');
    Route::get('/schedules/get-pending', 'SchedulesController@getPendingSchedulesGasd');

    //get archived users
    Route::get('/schedules/archived', 'SchedulesController@showArchivedReservationsGasd');
    Route::get('/schedules/get-archived-schedules', 'SchedulesController@getArchivedReservationsGasd');
//    Route::get('schedules/index', 'SchedulesController@index')->name('schedules.index');
//    Route::get('schedules/create', 'SchedulesController@create')->name('schedules.create');
//    Route::post('schedules/create', 'SchedulesController@store')->name('schedules.store');
//    Route::get('schedules/{id}/edit', 'SchedulesController@edit')->name('schedules.edit');
//    Route::post('schedules/update', 'SchedulesController@update')->name('schedules.update');

    Route::get('/profile', 'Auth\UsersController@showProfile');
    Route::get('/change-password', function(){
        return view('pages.change-password');
    });
});
//ITD-----------------------------------------------------------------------------------------------------------
Route::group(['middleware' => 'itd', 'prefix' => 'itd'], function () {
//Users
    Route::get('users/index', 'Auth\UsersController@index')->name('users.index');
    Route::get('users/create', 'Auth\UsersController@create')->name('users.create');
    Route::post('/users/create', 'Auth\UsersController@store')->name('users.store');
    Route::get('users/show','Auth\UsersController@show')->name('users.show');
    Route::get('users/{id}/edit', 'Auth\UsersController@edit')->name('users.edit');
    Route::put('users/{id}/edit', 'Auth\UsersController@update')->name('users.update');
    Route::get('accountlogs/index', 'LogtimesController@index')->name('accountlogs.index');
    Route::get('activeusers/index', 'LogtimesController@index')->name('activeusers.index');

    Route::get('/reset-password/{slug}', 'Auth\UsersController@showResetPasswordPage');
    Route::post('/reset-password', 'Auth\UsersController@resetPassword');
    //FAQ
    Route::get('/itdfaq', function() {
        return view('pages.itd.itdfaq');
    });

    //R
    Route::post('/users/validate-email-phone', 'Auth\UsersController@validateEmailPhoneNumber');
    Route::get('/users/get-users', 'Auth\UsersController@getUsers');
    Route::post('/users/get-specific-userinfo', 'Auth\UsersController@getSpecificUserInfo');
    Route::post('/users/validate-email-phone', 'Auth\UsersController@validateEmailPhoneNumber');
    Route::post('/users/validate-update-email-phone', 'Auth\UsersController@validateUpdateEmailPhoneNumber');
    Route::get('/users/generate-password', 'Auth\UsersController@generatePassword');
    Route::post('/users/archive-user', 'Auth\UsersController@archiveUser');
    Route::get('/profile', 'Auth\UsersController@showProfile');
    Route::get('/users/get-archivedusers', 'Auth\UsersController@getArchiveUsers');
    Route::get('/users/reports-archived-users', 'Auth\UsersController@showArchiveUsersPage');
    Route::post('/users/update-user', 'Auth\UsersController@updateUser');

    Route::get('/change-password', function(){
        return view('pages.change-password');
    });
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

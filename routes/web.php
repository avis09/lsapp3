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
    Route::post('/update-profile', 'Auth\UsersController@updateProfile');
});

//student-----------------------------------------------------------------------------------------------------------
Route::group(['middleware' => 'student', 'prefix' => 'student'], function () {



    Route::get('/practice', 'FeedbacksController@get');
    Route::post('/add', 'FeedbacksController@add');
    Route::get('/look', 'FeedbacksController@look');
    Route::post('/get-look', 'FeedbacksController@getlook');

        //Feedbacks --------
//         Route::get('feedbacks/index', 'FeedbacksController@index')->name('feedbacks.index');
        Route::get('/feedback', 'FeedbacksController@showFeedbackPage')->name('feedbacks.page');
        Route::post('/feedbacks/send-feedback', 'FeedbacksController@store')->name('feedbacks.store');


        //schedules------
        //add a reservation, reservation list, (view, cancel, archive)
        Route::get('schedules/list', 'SchedulesController@showReservationPage');
        //add
        Route::get('/schedule/get-user-reservations', 'SchedulesController@getUserReservations');
        Route::post('/schedules/create-reservation', 'SchedulesController@createReservation')->name('schedules.store');
        //edit
        Route::get('schedules/{id}/edit', 'SchedulesController@edit')->name('schedules.edit');
        Route::post('schedules/update', 'SchedulesController@update')->name('schedules.update');
        Route::post('/schedule/update-reservation-status', 'SchedulesController@updateReservationStatus');
        //calendar
        Route::get('schedules/calendar', 'SchedulesController@showCalendarPage')->name('schedules.index');
        Route::post('/schedules/get-venuesofvenuetype', 'SchedulesController@getVenuesOfVenueType');
        Route::post('/show-schedules', 'SchedulesController@showSchedules');
        Route::post('/schedule/get-specific-schedule', 'SchedulesController@getSpecificSchedule');
        Route::post('/schedule/get-waiver', 'SchedulesController@getWaiver');
        //get canceled users
        Route::get('/schedule/get-cancelled-schedules', 'SchedulesController@getCancelledUserReservations');

        //venue gallery -------
        Route::get('/venue-rooms', 'VenuesController@showRoomVenues');
        Route::get('/venue-courts', 'VenuesController@showCourtVenues');
        Route::post('/venues/get-room-equipments', 'VenuesController@getRoomEquipments');
        Route::post('/get-reason', 'SchedulesController@getReason');
        //change pw ------
        Route::get('/change-password', function(){
            return view('pages.change-password');
        });
        Route::post('/get-reason', 'SchedulesController@getReason');
        //PROFILE UPDATE --------
        Route::get('/profile', 'Auth\UsersController@showProfile');
        //FAQ
        Route::get('/faq', function() {
         return view('pages.student.faq');
        });
});
////Registrar-----------------------------------------------------------------------------------------------------------
Route::group(['middleware' => 'registrar', 'prefix' => 'registrar'], function () {


    
    Route::post('/validate-image', 'VenuesController@validateImage');
    //Dashboard ------
    Route::get('/dashboard', 'RegistrarController@showDashboard');
    //Feedbacks ------
    Route::get('feedbacks/index', 'FeedbacksController@index')->name('feedbacks.index');
    Route::get('/feedbacks/get-feedbacks', 'FeedbacksController@getFeedbacksReg');

    //Venues - Rooms ------
    Route::get('/venues', 'VenuesController@showRoomPage')->name('venues.index');
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

    //R (Venues AJAX)
    Route::get('/calendar', 'SchedulesController@showRegistrarCalendarPage');
    Route::get('/venues/get-venues', 'VenuesController@getRoomVenues');
    Route::post('/venues/get-specific-room', 'VenuesController@getSpecificRoom');
    Route::post('/venues/add-venue', 'VenuesController@store');
    Route::post('/venues/update-venue', 'VenuesController@updateRoomVenue');
    Route::post('/venue/update-status', 'VenuesController@updateVenueStatus');
    Route::post('/venues/get-room-equipments', 'VenuesController@getRoomEquipments');
    Route::post('/schedule/update-reservation-status', 'SchedulesController@updateReservationStatus');
    Route::post('/schedule/get-venuesofvenuetype', 'SchedulesController@getVenuesOfVenueType');
    Route::post('/show-schedules', 'SchedulesController@showSchedules');
    Route::get('/room-gallery', 'VenuesController@showRoomGallery');
    Route::post('/get-reason', 'SchedulesController@getReason');
    //FAQ -------
    Route::get('/registrarfaq', function() {
        return view('pages.registrar.registrarfaq');
    });
    //Profile-----
    Route::get('/profile', 'Auth\UsersController@showProfile');
    //Cghange pass-----
    Route::get('/change-password', function(){
        return view('pages.change-password');
    });

    //Schedules - (accept or decline list)
    Route::get('/schedules/list', 'SchedulesController@showReservationPageReg');
    Route::get('/schedules/get-pending', 'SchedulesController@getPendingReservationsReg');
    Route::get('/schedules/get-all-reservations', 'SchedulesController@getAllReservationsReg');
    Route::get('/schedules/get-archived', 'SchedulesController@getArchivedReservationsReg');

    //clutch reserve
    Route::get('/schedules/regsched', 'SchedulesController@showRegSched');

    //The missing part for add schedule in BROS (reg and gasd)----
    Route::get('/schedules/get-user-reservations', 'SchedulesController@getUserReservations');
    Route::post('/schedules/get-venuesofvenuetype', 'SchedulesController@getVenuesOfVenueType');
    Route::post('/show-schedules', 'SchedulesController@showSchedules');
    Route::post('/schedule/get-specific-schedule', 'SchedulesController@getSpecificSchedule');
    Route::post('/schedule/get-waiver', 'SchedulesController@getWaiver');
    //get canceled users
    Route::get('/schedule/get-cancelled-schedules', 'SchedulesController@getCancelledUserReservations');    


    Route::post('/schedules/create-reservation', 'SchedulesController@createReservation');
    Route::get('/schedules/{id}/edit', 'SchedulesController@edit')->name('schedules.edit');
    Route::post('/schedules/update', 'SchedulesController@update')->name('schedules.update');
//    //schedules
//    Route::get('schedules/index', 'SchedulesController@index')->name('schedules.index');
//    Route::get('schedules/create', 'SchedulesController@create')->name('schedules.create');
//    Route::post('schedules/create', 'SchedulesController@store')->name('schedules.store');
//    Route::get('schedules/{id}/edit', 'SchedulesController@edit')->name('schedules.edit');
//    Route::post('schedules/update', 'SchedulesController@update')->name('schedules.update');
});
//GASD-----------------------------------------------------------------------------------------------------------
Route::group(['middleware' =>  'gasd', 'prefix' => 'gasd'], function () {
    Route::get('/dashboard', 'GasdController@showDashboard');
//Feedbacks

    Route::get('feedbacks/index2', 'FeedbacksController@index2')->name('feedbacks.index2');
    //Venues
    //A
    Route::get('venues/index2', 'VenuesController@index2');
    Route::get('/venues/get-venues', 'VenuesController@getCourtVenues');
    Route::post('/venues/add-venue', 'VenuesController@store');
    Route::post('/venues/get-specific-court', 'VenuesController@getSpecificCourt');
    //
    Route::post('/validate-image', 'VenuesController@validateImage');
    Route::get('venues/create2', 'VenuesController@create2')->name('venues.create2');
    Route::post('venues/create2', 'VenuesController@store2')->name('venues.store2');
    Route::get('venues/{id}/edit', 'VenuesController@edit')->name('venues.edit');
    Route::post('venues/update', 'VenuesController@update')->name('venues.update');
    Route::get('venues/reports2', 'VenuesController@indexReports2')->name('venues.indexReports2');
    Route::post('/venue/update-status', 'VenuesController@updateVenueStatus');

    Route::get('/calendar', 'SchedulesController@showGasdCalendarPage');
    Route::get('/feedbacks', 'FeedbacksController@showGasdFeedbacks');
    Route::get('/feedbacks/get-feedbacks', 'FeedbacksController@getFeedbacksGasd');
    //FAQ
    Route::get('/gasdfaq', function() {
        return view('pages.gasd.gasdfaq');
    });
    Route::get('/courts', 'VenuesController@showCourtPage');
    Route::get('/court-gallery', 'VenuesController@showCourtGallery');
//    //schedules
    // Route::post('/schedule/update-reservation-status', 'SchedulesController@updateReservationStatus');
    //Anz
    Route::get('/schedules/list', 'SchedulesController@showReservationPageGasd');
    Route::get('/schedules/get-pending', 'SchedulesController@getPendingReservationsGasd');
    Route::get('/schedules/get-all-reservations', 'SchedulesController@getAllReservationsGasd');
    Route::get('/schedules/get-archived', 'SchedulesController@getArchivedReservationsGasd');
    Route::post('/schedule/update-reservation-status', 'SchedulesController@updateReservationStatus');
    Route::post('/schedule/get-waiver', 'SchedulesController@getWaiver');
    Route::post('/schedule/get-venuesofvenuetype', 'SchedulesController@getVenuesOfVenueType');
    Route::post('/show-schedules', 'SchedulesController@showSchedules');

    //add a reservaition GASD
    Route::get('/schedules/get-user-reservations', 'SchedulesController@getUserReservations');
    Route::post('/schedules/get-venuesofvenuetype', 'SchedulesController@getVenuesOfVenueType');
    Route::post('/show-schedules', 'SchedulesController@showSchedules');
    Route::post('/schedule/get-specific-schedule', 'SchedulesController@getSpecificSchedule');
    Route::post('/schedule/get-waiver', 'SchedulesController@getWaiver');
    //get canceled users
    Route::get('/schedule/get-cancelled-schedules', 'SchedulesController@getCancelledUserReservations');


    //add a schedules gasd
    Route::get('/schedules/gasdsched', 'SchedulesController@showGasdSched');
    Route::get('/schedules/calendar', 'SchedulesController@showCalendarPage')->name('schedules.index');
    Route::post('/schedules/create-reservation', 'SchedulesController@createReservation')->name('schedules.store');
    Route::get('/schedules/{id}/edit', 'SchedulesController@edit')->name('schedules.edit');
    Route::post('/schedules/update', 'SchedulesController@update')->name('schedules.update');
    Route::post('/get-reason', 'SchedulesController@getReason');
    // profile ------
    Route::get('/profile', 'Auth\UsersController@showProfile');
    //change pw ------
    Route::get('/change-password', function(){
        return view('pages.change-password');
    });

});
//ITD-----------------------------------------------------------------------------------------------------------
Route::group(['middleware' => 'itd', 'prefix' => 'itd'], function () {
//Users
    Route::get('users/index', 'ItdController@showDashboard')->name('users.index');
    Route::get('users/create', 'Auth\UsersController@create')->name('users.create');
    Route::post('/users/create', 'Auth\UsersController@store')->name('users.store');
    Route::get('users/show','Auth\UsersController@show')->name('users.show');
    Route::get('users/{id}/edit', 'Auth\UsersController@edit')->name('users.edit');
    Route::put('users/{id}/edit', 'Auth\UsersController@update')->name('users.update');
    //logtimes
    Route::get('accountlogs/index', 'LogtimesController@index')->name('accountlogs.index');
    Route::get('/accountlogs/get-logs', 'LogtimesController@getLogTime');
    Route::get('activeusers/index', 'LogtimesController@index')->name('activeusers.index');

    Route::get('/reset-password/{slug}', 'Auth\UsersController@showResetPasswordPage');
    Route::post('/reset-password', 'Auth\UsersController@resetPassword');
    //FAQ
    Route::get('/itdfaq', function() {
        return view('pages.itd.itdfaq');
    });

    //R
    
    Route::get('/reservation-settings', 'Auth\UsersController@showReservationSettings');
    Route::post('/update-reservation-settings', 'Auth\UsersController@updateReservationSettings');
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
//get archived users
//    Route::get('/schedules/archived', 'SchedulesController@showArchivedReservationsGasd');
//    Route::get('/schedules/get-archived-schedules', 'SchedulesController@getArchivedReservationsGasd');
//    Route::get('schedules/index', 'SchedulesController@index')->name('schedules.index');
//    Route::get('schedules/create', 'SchedulesController@create')->name('schedules.create');
//    Route::post('schedules/create', 'SchedulesController@store')->name('schedules.store');
//    Route::get('schedules/{id}/edit', 'SchedulesController@edit')->name('schedules.edit');
//    Route::post('schedules/update', 'SchedulesController@update')->name('schedules.update');
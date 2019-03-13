<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Feedback;
class RegistrarController extends Controller
{
    public function showDashboard(){

//total number of schedules count
        $countAllSchedules = DB::table('schedules')
            ->join('venue', 'venue.venueID', '=', 'schedules.venueID')
            ->select('schedules.scheduleID')
            ->where('venue.venueTypeID', '=', '1')
            ->count();

        $countAllTotalRooms = DB::table('venue')
            ->select('venueID')
            ->where('venueTypeID', '=', '1')
            ->count();


        $countAllActiveRooms = DB::table('venue')
            ->leftJoin('venuestatus', 'venuestatus.venueStatusID', '=', 'venue.venueStatusID')
            ->rightJoin('venuetype','venuetype.venueTypeID','=', 'venue.venueTypeID')
            ->select('venue.venueID')
            ->where('venuestatus.venueStatusID', '=', '1')
            ->where('venuetype.venueTypeID', '=', '1')
            ->count();

        $feedbacks = Feedback::whereHas('f_venue', function ($query){
            $query->where('venueTypeID', 1);
        })->with('f_venue','f_user')->OrderBy('created_at', 'DESC')->take(10)->get();


        $reservations = Schedule::whereHas('f_venue', function ($query){
            $query->where('venueTypeID', 1);
        })->with('f_time','f_venue.f_venueTypeV' ,'f_venue.f_buildingV', 'f_venue.floor', 'reservationStatus', 'user')
        ->where('statusID', '=', '1')
        ->OrderBy('date', 'ASC')
        ->take(10)
        ->get();


        return view('pages.registrar.dashboard')
            ->with('countAllSchedules', $countAllSchedules)
            ->with('countAllTotalRooms', $countAllTotalRooms)
            ->with('countAllActiveRooms', $countAllActiveRooms)
            ->with('feedbacks', $feedbacks)
            ->with('reservations', $reservations);


    }

}

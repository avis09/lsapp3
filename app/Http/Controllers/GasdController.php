<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GasdController extends Controller
{
    public function showDashboard(){

//total number of schedules count
        $countAllSchedules = DB::table('schedules')
            ->join('venue', 'venue.venueID', '=', 'schedules.venueID')
            ->select('schedules.scheduleID')
            ->where('venue.venueTypeID', '=', '2')
            ->count();

        $countAllTotalRooms = DB::table('venue')
            ->select('venueID')
            ->where('venueTypeID', '=', '2')
            ->count();


        $countAllActiveRooms = DB::table('venue')
            ->leftJoin('venuestatus', 'venuestatus.venueStatusID', '=', 'venue.venueStatusID')
            ->rightJoin('venuetype','venuetype.venueTypeID','=', 'venue.venueTypeID')
            ->select('venue.venueID')
            ->where('venuestatus.venueStatusID', '=', '1')
            ->where('venuetype.venueTypeID', '=', '2')
            ->count();


        return view('pages.gasd.dashboard')
            ->with('countAllSchedules', $countAllSchedules)
            ->with('countAllTotalRooms', $countAllTotalRooms)
            ->with('countAllActiveRooms', $countAllActiveRooms);


    }
}

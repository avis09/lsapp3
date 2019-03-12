<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ItdController extends Controller
{
    public function showDashboard()
    {

//total number of schedules count

        $countUsers = DB::table('users')
            ->select('userID')
            ->count();

        $countAllSchedules = DB::table('schedules')
            ->join('venue', 'venue.venueID', '=', 'schedules.venueID')
            ->select('schedules.scheduleID')
            ->where('venue.venueTypeID', '=', '2')
            ->count();


        return view('pages.itd.users')
            ->with('countUsers', $countUsers)
        ->with('countAllSchedules', $countAllSchedules);
//            ->with('countAllTotalRooms', $countAllTotalRooms)
//            ->with('countAllActiveRooms', $countAllActiveRooms);


    }
}

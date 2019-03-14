<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ItdController extends Controller
{
    public function showDashboard()
    {

//total number of schedules count


        $countAllActiveUsers = DB::table('users')
            ->join('userstatus', 'userstatus.userStatusID', '=', 'users.userStatusID')
            ->select('users.userID')
            ->where('userstatus.userStatusID', '=', '1')
            ->count();

//        $countAllInActiveUsers = DB::table('users')
//            ->join('venue', 'venue.venueID', '=', 'schedules.venueID')
//            ->select('schedules.scheduleID')
//            ->where('venue.venueTypeID', '=', '2')
//            ->count();
//
//        $countAllArchivedUsers = DB::table('users')
//            ->join('venue', 'venue.venueID', '=', 'schedules.venueID')
//            ->select('schedules.scheduleID')
//            ->where('venue.venueTypeID', '=', '2')
//            ->count();

        return view('pages.itd.users')
        ->with('countAllActiveUsers', $countAllActiveUsers);
//      ->with('countAllInActiveUsers', $countAllInActiveUsers)
//       ->with('countAllArchivedUsers', $countAllArchivedUsers);


    }
}

<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrarController extends Controller
{
    public function showDashboard(){

//schedules count
        $count = DB::table('schedules')
            ->join('venue', 'venue.venueID', '=', 'schedules.venueID')
            ->select('schedules.scheduleID')
            ->where('venue.venueTypeID', '=', '1')
            ->count();

        return view('pages.registrar.dashboard')
            ->with('count', $count);

    }

}

<?php

namespace App\Http\Controllers;

use App\LogTime;
use App\Audittrails;
use App\User;
use App\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogtimesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        $f_logs = array('f_logs' => DB::table('logtime')->get());
        $logtime = logtime::orderBy('inTime', 'DESC')->get();
        //$logtime = logtime::select('userID', 'inTime', 'outTime')->orderBy('inTime', 'dsc');
        return view('pages.itd.accountlogs')
            ->with('logtime', $logtime)
            ->with('f_logs', $f_logs);
    }

    public function getLogTime(){
        // $venues = Venue::select('venueID', 'buildingID', 'venueName', 'venueFloorID', 'venueTypeID', 'userID', 'venueStatusID' )->where('venueTypeID', 1)->paginate(10);

        // $logtime = LogTime::with('f_logs')->orderBy('inTime', 'DESC')->get();
        $logtime = Audittrails::with('users','users.f_userrole')->orderBy('created_at', 'DESC')->get();
        return $logtime;
    }
}

<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\Time;
use App\VenueSchedule;
use Carbon\Carbon;
use App\Venue;
use Illuminate\Http\Request;
use Calendar;
use DB;
use App\Http\Controllers\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedule =
        $venues = Venue::all();
        return view('schedules.calendar')
            ->with('schedules', $schedule)
            ->with('venues', $venues);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $schedule = array('schedules' => DB::table('schedules')->get());
//        $scheduleV = array('venue' => DB::table('venue')->get());
        $venues = DB::table('venue')
            ->select('*')
            ->get();

        //Get venue ID
//        $venues = array('venue' => DB::table('venue')
//            ->select('venue.venueTypeID')
//            ->where('venue.venueID', '=', $venueID)
//            ->get());

        $scheduleT = array('time' => DB::table('time')->get());

        $scheduleVT = array('venuetype' => DB::table('venuetype')->get());
//        return view('schedules.addschedule')->with('schedule', $schedule)
//            ->with('scheduleT', $scheduleT)
//            ->with('scheduleV', $scheduleV)
//            ->with('scheduleVT', $scheduleVT);

        return view('schedules.addschedule')
            ->with('venues', $venues);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'purpose' => 'required',
//            'dateAdded' => 'required'

        ]);
//        $validator = Validator::make($request->all(), [
//            'purpose' => 'required',
//            'dateAdded' => 'required',
//            'timeTypeID' => 'required',
//        ]);
//
//        if ($validator->fails()) {
//            \Session::flash('warning', 'Please enter the valid details');
//            return Redirect::to('/schedules')->withInput()->withErrors($validator);
//        }


        $schedule = new Schedule();
        $schedule->userID = auth()->user()->userID;
        $schedule->purpose = $request->input('purpose');
        $schedule->created_at = $request->input('created_at');
        $schedule->statusID = ('1');
        $schedule->date = $request->input('date');
        $schedule->venueID = $request->input('venue');
        $schedule->timeID = Input::get('time');
        $schedule->save();

        //$venueSchedule = VenueSchedule::where('venueScheduleID', $schedule->venueScheduleID)->first();
        //$venueSchedule->venueSchedStatus = "Occupied";
        //$venueSchedule->save();
//        if ($schedule->save()){
//
//        }

//        \Session::flash('success','Schedule made successfully');
        return Redirect::to('/schedules/create')->with('success', 'Reservation made');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = Schedule::find($id);
        return view('schedules.showschedule')->with('schedules', $schedule);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function findVenueSched(Request $request)
    {
//        $venueExist = DB::table('venue')
//            ->join('venueschedule', $request->venueID, '=', 'venueschedule.venueID')
//            ->select('venueschedule.venueScheduleID')
//            ->first();

        //check if existing venue
        $existsVenue = DB::table('venue')
            //->join('venueschedule', 'venueschedule.venueScheduleID', '=', $venueExist)
            ->where('venueID', $request->venueID)
            ->select('venueID')
            ->value('venueID');

        //check if existing date
        $existsDate = DB::table('schedules')
            //->join('venueschedule', 'venueschedule.venueScheduleID', '=', $venueExist)
            ->where('date', $request->date)
            ->select('date')
            ->value('date');

        //get time id from based on values above
        $timeID = DB::table('schedules')
            ->where('date', $existsDate)
            ->where('venueID', $existsVenue)
            ->select('timeID')
            ->value('timeID');


        //get venue type based on venue id selected
        $venueType = DB::table('venue')
            ->select('venueTypeID')
            ->where('venueID', $request->venueID)
            ->value('venueTypeID');

        //if it exists, show only time that is not in schedules table
        if($existsVenue && $existsDate){
            $data = DB::table('time')
                ->select('time.timeID', 'time.timeStartTime', 'time.timeEndTime')
                ->where('venueTypeID', $venueType)
                ->where('timeID', '!=', $timeID)
                ->get();

            //dd($data);
        }

        //else pakita lahat ng time depende sa venue type nung venue id
        else{
            $data = DB::table('time')
                ->select('time.timeID', 'time.timeStartTime', 'time.timeEndTime')
                ->where('venueTypeID', $venueType)
                ->get();
        }
        return response()->json($data);

//        $venueID = Input::get('venue');
//        $data = Regencies::where('venueID', '=', $venueID)->get();
//        return response()->json($data);
    }

    public function showSchedules(Request $request){
        //check if existing venue
        $existsVenue = DB::table('venue')
            //->join('venueschedule', 'venueschedule.venueScheduleID', '=', $venueExist)
            ->where('venueID', $request->venueID)
            ->select('venueID')
            ->value('venueID');

        //check if existing date
        $existsDate = DB::table('schedules')
            //->join('venueschedule', 'venueschedule.venueScheduleID', '=', $venueExist)
            ->where('date', $request->date)
            ->select('date')
            ->value('date');

        //get time id from based on values above
        $timeID = DB::table('schedules')
            ->where('date', $existsDate)
            ->where('venueID', $existsVenue)
            ->select('timeID')
            ->value('timeID');

        //get venue type based on venue id selected
        $venueType = DB::table('venue')
            ->select('venueTypeID')
            ->where('venueID', $request->venueID)
            ->value('venueTypeID');

        //if it exists, show only time that is not in schedules table
        if($existsVenue && $existsDate) {
            $data = DB::table('schedules')
                ->select('venueID', 'timeID')
                ->where('date', $existsDate)
                ->where('venueID', $existsVenue)
                ->get();
        }
        return response()->json($data);

//        $venueID = Input::get('venue');
//        $data = Regencies::where('venueID', '=', $venueID)->get();
//        return response()->json($data);
    }
}

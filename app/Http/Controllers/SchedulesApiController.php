<?php

namespace App\Http\Controllers;

use App\Http\Resources\ScheduleResource;
use App\Schedule;
use App\Venue;
use Illuminate\Http\Request;
use DB;

class SchedulesApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$this->validate($request, [
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
        $schedule->purpose = $request->input('purpose');V
        $schedule->created_at = $request->input('created_at');
        $schedule->statusID = ('1');
        $schedule->date = $request->input('date');
        $schedule->venueID = $request->input('venue');
        $schedule->timeID = $request->input('time');
        $schedule->save();
//        if ($schedule->save()){
//
//        }

//        \Session::flash('success','Schedule made successfully');
        return Redirect::to('/schedules/create')->with('success', 'Reservation made');*/


        $schedule = $request->isMethod('put') ? Schedule::findOrFail($request->scheduleID) : new Schedule();

        $schedule->userID = $request->input('userID');
        $schedule->purpose = $request->input('purpose');
        $schedule->created_at = $request->input('created_at');
        $schedule->statusID = $request->input('statusID');
        $schedule->date = $request->input('date');
        $schedule->venueID = $request->input('venueID');
        $schedule->timeID = $request->input('timeID');

        if ($schedule->save()) {
            return new ScheduleResource($schedule);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function showAvailSched($venueID, $date)
    {

        $existsVenue = DB::table('venue')
            //->join('venueschedule', 'venueschedule.venueScheduleID', '=', $venueExist)
            ->where('venueID', $venueID)
            ->select('venueID')
            ->value('venueID');

        //check if existing date
        $existsDate = DB::table('schedules')
            //->join('venueschedule', 'venueschedule.venueScheduleID', '=', $venueExist)
            ->where('date', $date)
            ->select('date')
            ->value('date');

        //get time id from based on values above
        $timeIDs = DB::table('schedules')
            ->select('*')
            ->where('date', $existsDate)
            ->where('venueID', $existsVenue)
            ->whereIn('statusID', [1, 2])
            ->get('timeID')
            ->pluck('timeID');

        //get venue type based on venue id selected
        $venueType = DB::table('venue')
            ->select('venueTypeID')
            ->where('venueID', $venueID)
            ->value('venueTypeID');

        //if it exists, show only time that is not in schedules table
        if ($existsVenue && $existsDate) {
            $data = DB::table('time')
                ->select('time.timeID', 'time.timeStartTime', 'time.timeEndTime')
                ->where('venueTypeID', $venueType)
                ->whereNotIn('timeID', $timeIDs)
                ->get();

        } //else pakita lahat ng time depende sa venue type nung venue id
        else {
            $data = DB::table('time')
                ->select('time.timeID', 'time.timeStartTime', 'time.timeEndTime')
                ->where('venueTypeID', $venueType)
                ->get();
        }
        return response()->json($data);
    }

    public function showReservedSched($venueID, $date)
    {
        //check if existing venue
        $existsVenue = DB::table('venue')
            //->join('venueschedule', 'venueschedule.venueScheduleID', '=', $venueExist)
            ->where('venueID', $venueID)
            ->select('venueID')
            ->value('venueID');

        //check if existing date
        $existsDate = DB::table('schedules')
            //->join('venueschedule', 'venueschedule.venueScheduleID', '=', $venueExist)
            ->where('date', $date)
            ->select('date')
            ->value('date');

        //if it exists, show only time that is not in schedules table
        if ($existsVenue && $existsDate) {
            $data = DB::table('schedules')
                ->join('time', 'time.timeID', 'schedules.timeID')
                ->join('status', 'status.statusID', 'schedules.statusID')
                ->join('users', 'users.userID', 'schedules.userID')
                ->select('time.timeStartTime', 'time.timeEndTime', 'date', 'status.statusName', 'users.firstName', 'users.lastName')
                ->where('date', $existsDate)
                ->where('venueID', $existsVenue)
                ->get();

            return response()->json($data);
        }
    }
}


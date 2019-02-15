<?php

namespace App\Http\Controllers;

use App\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Calendar;
use DB;
use App\Http\Controllers\Validator;
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
        $schedule = Schedule::all();
        return view('schedules.scheduleindex')->with('schedules', $schedule);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schedule = array('schedules' => DB::table('schedules')->get());
        $scheduleT = array('time' => DB::table('time')->get());
        $scheduleV = array('venue' => DB::table('venue')->get());
        $scheduleVT = array('venuetype' =>DB::table('venuetype')->get());
        return view('schedules.addschedule')->with('schedule', $schedule)
            ->with('scheduleT', $scheduleT)
            ->with('scheduleV', $scheduleV)
            ->with('scheduleVT', $scheduleVT);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
        $schedule->timeID = $request->input('time');
        $schedule->save();
//        if ($schedule->save()){
//
//        }

//        \Session::flash('success','Schedule made successfully');
        return Redirect::to('/schedules/create')->with('success', 'Reservation made');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

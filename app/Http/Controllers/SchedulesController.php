<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;
use Calendar;
use DB;
use App\Http\Controllers\Validator;

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
        return view('schedules.addschedule')->with('schedule', $schedule)->with('scheduleT', $scheduleT)->with('scheduleV', $scheduleV);
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
        $schedule->userID = $request->input('1');
        $schedule->purpose = $request->input('purpose');
        $schedule->dateAdded = $request->input('dateAdded');
        $schedule->statusID = ('1');
        $schedule->date = $request->input('date');
        $schedule->venueID = $request->input('venue');
        $schedule->timeID = $request->input('time');
        $schedule->save();
//        if ($schedule->save()){
//
//        }

//        \Session::flash('success','Schedule made successfully');
        return Redirect::to('/schedules')->with('success', 'Reservation made');
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

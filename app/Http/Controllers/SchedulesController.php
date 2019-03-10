<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\Time;
use App\VenueSchedule;
use Carbon\Carbon;
use App\Venue;
use App\VenueType;
use Illuminate\Http\Request;
use Calendar;
use DB;
use App\Http\Controllers\Validator;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class SchedulesController extends Controller
{
    private $data;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedule =
        $venues = Venue::all();
        return view('pages.student.calendar')
            ->with('schedules', $schedule)
            ->with('venues', $venues);
    }

    public function showCalendarPage()
    {
        $venueTypes = VenueType::all();
        return view('pages.student.calendar', compact('venueTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showReservationPage()
    {
        $scheduleVenueType = VenueType::all();
        return view('pages.student.schedule', compact('scheduleVenueType'));
    }

    public function getVenuesOfVenueType(Request $request){
        $venues = Venue::where('venueTypeID', $request->id)->get();
        return response()->json($venues);
    }

    public function getUserReservations(){
        $schedules = Schedule::with('f_time','f_venue.f_venueTypeV' ,'f_venue.f_buildingV', 'f_venue.floor', 'reservationStatus')->where('userID', auth()->user()->userID)->where('statusID', '!=', '6')->get();

         print_r(json_encode($schedules));
    }

    public function updateReservationStatus(Request $request){
        $user = Schedule::find($request->id);
        $user->statusID = $request->type;
        if($user->save()){
            switch ($request->type) {
                case '2':
                    $content_message = 'Approved';
                    break;
                case '3':
                    $content_message = 'Rejected';
                    break;
                case '4':
                    $content_message = 'Cancelled';
                    break;
                case '5':
                    $content_message = 'Done';
                    break;
                case '6':
                    $content_message = 'Archived';
                    break;
                default:
                    break;
            }

          return response()->json(['title' => 'Success', 'content_message' => 'Reservation Successfully '.$content_message, 'type' => 'success', 'success' => true]);
        }
        else{
          return response()->json(['title' => 'Error', 'content_message' => 'Something went wrong.', 'success' => false]);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'purpose' => 'required',
            'time' => 'required'
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
//        $user = Auth::user();

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


//        if($user->userRoleID == 1) {
        //          dd(auth::user());
        return Redirect::to('student/create')->with('success', 'Reservation made');
//        }elseif ($user->userRoleID == 2){
//            return Redirect::to('gasd/schedules/create')->with('success', 'Reservation made');
//        }elseif ($user->userRoleID == 3) {
//            return Redirect::to('registrar/schedules/create')->with('success', 'Reservation made');
//        }


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
        return view('pages.student.showschedule')->with('schedules', $schedule);
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
            ->where('venueID', $request->venueID)
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


//        $venueID = Input::get('venue');
//        $data = Regencies::where('venueID', '=', $venueID)->get();
    }

    public function showSchedules(Request $request)
    {
        $check_schedule = Schedule::where('venueID', $request->id)->where('date', $request->date)->get();
        if(count($check_schedule) > 0){
            $schedules = Venue::distinct()->select('schedules.date','time.timeStartTime','time.timeEndTime')
            ->selectSub('IF((SELECT timeID from schedules where timeID = time.timeID),1,0)', 'check')
            ->join('venuetype', 'venue.venueTypeID', 'venuetype.venueTypeID')
            ->leftJoin('time', 'venueType.venueTypeID', 'time.venueTypeID')
            ->rightJoin('schedules', 'venue.venueID', 'schedules.venueID')
            ->where('venue.venueID', $request->id)
            ->where('date', $request->date)->get();
            
        }
        // no schedule
        else{
            $schedules = Venue::select('time.timeStartTime','time.timeEndTime')
            ->join('venuetype', 'venue.venueTypeID', 'venuetype.venueTypeID')
            ->leftJoin('time', 'venueType.venueTypeID', 'time.venueTypeID')
            ->where('venue.venueID', $request->id)->get();
        }
        return response()->json($schedules);

       
    }
}

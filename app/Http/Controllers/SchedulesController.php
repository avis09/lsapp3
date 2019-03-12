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


    //Reg*************************************************************************************
    public function showReservationPageReg()
    {
        $schedules = Schedule::with('user','f_time', 'f_venue', 'reservationStatus', 'venueType');
        return view('pages.registrar.schedules', compact('schedules'));
    }
    //Pending Reservations

    public function getPendingSchedulesReg(){
        $schedules = Schedule::with('user', 'f_time', 'f_venue', 'reservationStatus', 'venueType')
            //->where('f_venue.venueTypeID', '=','1')
            ->where('statusID', '=', '1')
            ->get();

        return response()->json($schedules);
    }
    //GASD***********************************************************************************
    public function showReservationPageGasd()
    {
        $schedules = Schedule::with('user','f_time', 'f_venue', 'reservationStatus', 'venueType');
        return view('pages.gasd.schedules', compact('schedules'));
    }
    //Pending Reservations

    public function getPendingSchedulesGasd(){
        $schedules = Schedule::with('user', 'f_time', 'f_venue', 'reservationStatus', 'venueType')
         //  ->where('venueTypeID', '=','2')
            ->where('statusID', '=', '1')
            ->get();

        return response()->json($schedules);
    }
    //GASD***********************************************************************************


//User reservation list
    public function getUserReservations(){
        $schedules = Schedule::with('f_time','f_venue.f_venueTypeV' ,'f_venue.f_buildingV', 'f_venue.floor', 'reservationStatus')
            ->where('userID', auth()->user()->userID)
            ->where('statusID', '!=', '6')
            ->get();

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
//Canceled Reservation List******************************************************************************
    public function getCancelledReservations(){
        $schedules = Schedule::with('f_time','f_venue.f_venueTypeV' ,'f_venue.f_buildingV', 'f_venue.floor', 'reservationStatus')
            ->where('userID', auth()->user()->userID)
            ->where('statusID', '=', '4')
            ->get();

        print_r(json_encode($schedules));
    }
//Archived Reservation list******************************************************************************
    public function showArchivedReservationsGasd()
    {
        $schedules = Schedule::with('user','f_time', 'f_venue', 'reservationStatus', 'venueType');
        return view('pages.gasd.archivedschedules', compact('schedules'));
    }
    public function getArchivedReservationsGasd(){
        $schedules = Schedule::with('f_time','f_venue.f_venueTypeV' ,'f_venue.f_buildingV', 'f_venue.floor', 'reservationStatus', 'user')
//            ->where('userID', auth()->user()->userID)
            ->where('statusID', '=', '6')
            ->get();

        print_r(json_encode($schedules));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createReservation(Request $request)
    {
        // $this->validate($request, [
        //     'purpose' => 'required',
        // ]);


        // $times = json_decode($request->times);
        // foreach ($times as $key => $timeID) {
        //    $schedule = Schedule::create([
        //         "userID" => auth()->user()->userID,
        //         "venueID" => $request->venue,
        //         "timeID" => $timeID,
        //         "statusID" => 1,
        //         "purpose" => $request->purpose,
        //         "date" => $request->date,
        //         "created_at" => Carbon::now(),
        //         "updated_at" => Carbon::now()
        //     ]);
        // }
        $waiver_name = json_decode($request->waiver_name);
        $waiver_id = json_decode($request->waiver_id);
        if(!empty($request->waiver_name)){
            for($i=0;$i<count($waiver_name);$i++){
                echo "name:".$waiver_name[$i]."  id:".$waiver_id[$i];
            }
        }

        die();

        if (!empty($schedule->scheduleID)) {
              return response()->json(["success"=>true, "message" => "Reservation request successfully submitted."]);
         }
         else{
              return response()->json(["success"=>false, "message" => "Something went wrong."]);
         }
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

    public function getAvailableTimeToSchedule(Request $request)
    {
        $check_schedule = Schedule::where('venueID', $request->id)->where('date', $request->date)->get();
        if(count($check_schedule) > 0){
            $timeIDs = Schedule::select('*')
            ->where('date', $request->date)
            ->where('venueID', $request->id)
            ->whereIn('statusID', [1, 2])
            ->get('timeID')
            ->pluck('timeID');

            $data = Time::select('time.timeID', 'time.timeStartTime', 'time.timeEndTime')
            ->join('venue', 'venue.venueTypeID', 'time.venueTypeID')
            ->where('venue.venueID', $request->id)
            ->whereNotIn('timeID', $timeIDs)
            ->get();
        }
        // no schedule
        else{
            $data = Venue::select('time.timeID','time.timeStartTime','time.timeEndTime')
            ->join('venuetype', 'venue.venueTypeID', 'venuetype.venueTypeID')
            ->leftJoin('time', 'venueType.venueTypeID', 'time.venueTypeID')
            ->where('venue.venueID', $request->id)->get();
        }

        return response()->json($data);
    }


    public function getNewAvailableTimeToSchedule(Request $request)
    {
        $check_schedule = Schedule::where('venueID', $request->id)->where('date', $request->date)->get();
        if(count($check_schedule) > 0){
            $timeIDs = Schedule::select('*')
            ->where('date', $request->date)
            ->where('venueID', $request->id)
            ->whereIn('statusID', [1, 2])
            ->get('timeID')
            ->pluck('timeID');

            $times = json_decode($request->times);
            $timeIDs = json_decode($timeIDs);
            
            foreach ($times as $key => $time) {
                array_push($timeIDs, $time);
            }
            $data = Time::select('time.timeID', 'time.timeStartTime', 'time.timeEndTime')
            ->join('venue', 'venue.venueTypeID', 'time.venueTypeID')
            ->where('venue.venueID', $request->id)
            ->whereNotIn('timeID', $timeIDs)
            ->get();
        }
        // no schedule
        else{
            $times = json_decode($request->times);
            $timeIDs = array();
            foreach ($times as $key => $time) {
                array_push($timeIDs, $time);
            }
            $data = Venue::select('time.timeID','time.timeStartTime','time.timeEndTime')
            ->join('venuetype', 'venue.venueTypeID', 'venuetype.venueTypeID')
            ->leftJoin('time', 'venueType.venueTypeID', 'time.venueTypeID')
            ->where('venue.venueID', $request->id)
            ->whereNotIn('time.timeID', $timeIDs)->get();
        }
            return response()->json($data);
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

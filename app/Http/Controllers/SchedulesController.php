<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\Time;
use App\VenueSchedule;
use Carbon\Carbon;
use App\Venue;
use App\User;
use App\VenueType;
use App\Waiver;
use Illuminate\Http\Request;
use Calendar;
use DB;
use App\Http\Controllers\Validator;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\DB;
use App\Mail\MailSched;
use Illuminate\Support\Facades\Mail;
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

    public function getPendingReservationsReg(){
        $schedules = Schedule::with('user', 'f_time', 'f_venue', 'reservationStatus', 'venueType')
            //->where('f_venue.venueTypeID', '=','1')
            ->where('statusID', '=', '1')
            ->get();

        return response()->json($schedules);
    }
    //get archived reservations

    public function getAllReservationsReg(){
        $schedules = Schedule::with('user', 'f_time', 'f_venue', 'reservationStatus', 'venueType')
            //->where('f_venue.venueTypeID', '=','1')
            ->where('statusID', '!=', '1')
            ->where('statusID', '!=', '6')
            ->get();

        return response()->json($schedules);
    }

    public function getArchivedReservationsReg(){
        $schedules = Schedule::with('user', 'f_time', 'f_venue', 'reservationStatus', 'venueType')
//            ->where('userID', auth()->user()->userID)
            ->where('statusID', '=', '6')
            ->get();

        print_r(json_encode($schedules));
    }

    //GASD***********************************************************************************
    public function showReservationPageGasd()
    {
        // $schedules = Schedule::with('user','f_time', 'f_venue', 'reservationStatus', 'venueType');
        return view('pages.gasd.schedules');
    }
    //get Pending Reservations

    public function getPendingReservationsGasd(){
        $schedules = Schedule::whereHas('f_venue', function ($query){
            $query->where('venueTypeID', 2);
        })->with('user', 'f_time', 'f_venue', 'reservationStatus', 'venueType')
        ->where('statusID', '=', '1')->get();

        return response()->json($schedules);

    }
    public function getAllReservationsGasd(){
         $schedules = Schedule::whereHas('f_venue', function ($query){
            $query->where('venueTypeID', 2);
        })->with('user', 'f_time', 'f_venue', 'reservationStatus', 'venueType')
            ->where('statusID', '!=', '1')
            ->where('statusID', '!=', '6')
            ->get();

        return response()->json($schedules);
    }

    public function getArchivedReservationsGasd(){
        $schedules = Schedule::whereHas('f_venue', function ($query){
            $query->where('venueTypeID', 2);
        })->with('user', 'f_time', 'f_venue', 'reservationStatus', 'venueType')
        ->where('statusID', '=', '6')
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
        $schedule = Schedule::find($request->id);
        $schedule->statusID = $request->type;
        if($schedule->save()){
            switch ($request->type) {
                case '2':
                    $content_message = 'Approved';
                    $this->sendEmailAndSMS($request->id,$request->type);
                    break;
                case '3':
                    $content_message = 'Rejected';
                    $this->sendEmailAndSMS($request->id,$request->type);
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

        $times = json_decode($request->times);
        foreach ($times as $key => $timeID) {
           $schedule = Schedule::create([
                "userID" => auth()->user()->userID,
                "venueID" => $request->venue,
                "timeID" => $timeID,
                "statusID" => 1,
                "purpose" => $request->purpose,
                "date" => $request->date,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ]);
        }

        if (!empty($schedule->scheduleID)) {
            if(!empty($request->waiver_name)){
                $waiver_name = json_decode($request->waiver_name);
                $waiver_id = json_decode($request->waiver_id);
                for($i=0;$i<count($waiver_name);$i++){
                    $waiver = Waiver::create([
                        "scheduleID" => $schedule->scheduleID, "studentName" => $waiver_name[$i], "studentIDnumber" =>$waiver_id[$i]
                    ]);
                    // echo "name:".$waiver_name[$i]."  id:".$waiver_id[$i];
                }
            }
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

    public function sendEmailAndSMS($userID,$type){
        $user = User::where('userID', $userID)->first();
        if($type == 2){
            $message = 'Your reservation request was approved.';
            $content = 'Approved!';
        }
        else if($type == 3){
            $message = 'Your reservation request was rejected.';
            $content = 'Rejected!';
        }

        // Mail::to($user->email)->send(new MailSched)->view('emails.sendConfirmation', compact('content'));



	    // Account details
        // API key  acc for
        // User: anz.zel17@gmail.com Pass: Anzel123
	    //$apiKey = urlencode('WPQcktKiJak-ulfoMOJHh49Byt8uDAzf3rZ0e0wvnI');
        // API key  acc for
        // User: jananzel.santos@benilde.edu.ph Pass: Anzel123
        $apiKey = urlencode('PEht7ggsi4Q-md1NMBdZPq8mbA9dDhhc0duRmZwkS8');


        // Message details
        $numbers = array($user->phoneNumber);
        $sender = urlencode('ANZEL');
        $message = rawurlencode($message);

        $numbers = implode(',', $numbers);

        // Prepare data for POST request
        $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

        // Send the POST request with cURL
        $ch = curl_init('https://api.txtlocal.com/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        // Process your response here
        return $response;


    }
}

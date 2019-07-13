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
use App\UserRole;
use App\Audittrails;
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

    public function showRegSched()
    {
        $scheduleVenueType = VenueType::all();
        return view('pages.registrar.regsched', compact('scheduleVenueType'));
    }
    public function showGasdSched()
    {
        $scheduleVenueType = VenueType::all();
        return view('pages.gasd.gasdsched', compact('scheduleVenueType'));
    }

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

    public function showRegistrarCalendarPage()
    {
        $venueTypes = VenueType::all();
        return view('pages.registrar.calendar', compact('venueTypes'));
    }

    public function showGasdCalendarPage()
    {
        $venueTypes = VenueType::all();
        return view('pages.gasd.calendar', compact('venueTypes'));
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

    public function getSpecificSchedule(Request $request){
        $schedule = Schedule::with('f_time', 'f_venue', 'f_venue.f_venueTypeV')->where('scheduleID', $request->id)->first();
        return response()->json($schedule);
    }


    //Reg*************************************************************************************
    public function showReservationPageReg()
    {
        $schedules = Schedule::with('user','f_time', 'f_venue', 'reservationStatus', 'venueType');
        return view('pages.registrar.schedules', compact('schedules'));
    }
    //Pending Reservations

    public function getPendingReservationsReg(){
        $schedules = Schedule::whereHas('f_venue', function ($query){
            $query->where('venueTypeID', 1);
        })->with('user', 'f_time', 'f_venue', 'reservationStatus')
        ->where('statusID', '=', '1')->get();

        return response()->json($schedules);
    }
    //get archived reservations

    public function getAllReservationsReg(){
         $schedules = Schedule::whereHas('f_venue', function ($query){
            $query->where('venueTypeID', 1);
        })->with('user', 'f_time', 'f_venue', 'reservationStatus')
            ->where('statusID', '!=', '1')
            ->where('statusID', '!=', '6')
            ->get();

        return response()->json($schedules);
    }

    public function getArchivedReservationsReg(){
        $schedules = Schedule::whereHas('f_venue', function ($query){
            $query->where('venueTypeID', 1);
        })->with('user', 'f_time', 'f_venue', 'reservationStatus')
        ->where('statusID', '=', '6')
        ->get();

         return response()->json($schedules);
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
        })->with('user', 'f_time', 'f_venue', 'reservationStatus')
        ->where('statusID', '=', '1')->get();

        return response()->json($schedules);

    }
    public function getAllReservationsGasd(){
         $schedules = Schedule::whereHas('f_venue', function ($query){
            $query->where('venueTypeID', 2);
        })->with('user', 'f_time', 'f_venue', 'reservationStatus')
            ->where('statusID', '!=', '1')
            ->where('statusID', '!=', '6')
            ->get();

        return response()->json($schedules);
    }

    public function getArchivedReservationsGasd(){
        $schedules = Schedule::whereHas('f_venue', function ($query){
            $query->where('venueTypeID', 2);
        })->with('user', 'f_time', 'f_venue', 'reservationStatus')
        ->where('statusID', '=', '6')
        ->get();

         return response()->json($schedules);
    }


    //GASD***********************************************************************************


//User reservation list
    public function getUserReservations(){
        $schedules = Schedule::with('f_time.f_scheduleT','f_venue.f_venueTypeV' ,'f_venue.f_buildingV', 'f_venue.floor', 'reservationStatus')
            ->where('userID', auth()->user()->userID)
            ->where('statusID', '!=', '6')
            ->get();

         print_r(json_encode($schedules));
    }

    public function getReason(Request $request) {
        $schedules = Schedule::select('updatedMessage')->where('scheduleID', $request->sched_id)->first();
        return response()->json($schedules);
    }

    public function updateReservationStatus(Request $request){
        $schedule = Schedule::find($request->id);
        $schedule->statusID = $request->type;
        if(!empty($request->reason)){
        $schedule->updatedMessage = $request->reason;
        }
        $schedule->updated_at = Carbon::now();
        if($schedule->save()){
            switch ($request->type) {
                case '2':
                    $content_message = 'Approved';
                    $this->sendEmailAndSMS($request->userID,$request->type, "");
                    break;
                case '3':
                    $content_message = 'Rejected';
                    $this->sendEmailAndSMS($request->userID,$request->type, "");
                    break;
                case '4':
                    $content_message = 'Cancelled';
                    break;
                case '5':
                    $content_message = 'Updated';
                    break;
                case '6':
                    $content_message = 'Archived';
                    break;
                default:
                    break;
            }
            
            Audittrails::create(['userID' => Auth::user()->userID, 'activity' => $content_message.' reservation']);
          return response()->json(['title' => 'Success', 'content_message' => 'Reservation Successfully '.$content_message, 'type' => 'success', 'success' => true]);
        }
        else{
          return response()->json(['title' => 'Error', 'content_message' => 'Something went wrong.', 'success' => false]);
        }
    }

    public function getCancelledReservations(){
        $schedules = Schedule::with('f_time','f_venue.f_venueTypeV' ,'f_venue.f_buildingV', 'f_venue.floor', 'reservationStatus')
            ->where('userID', auth()->user()->userID)
            ->where('statusID', '=', '4')
            ->get();

        print_r(json_encode($schedules));
    }

    public function getWaiver(Request $request)
    {
        $waiver = Waiver::where('scheduleID', $request->id)->get();
        return response()->json($waiver);
    }

    public function showArchivedReservationsGasd()
    {
        $schedules = Schedule::with('user','f_time', 'f_venue', 'reservationStatus', 'venueType');
        return view('pages.gasd.archivedschedules', compact('schedules'));
    }

    public function createReservation(Request $request)
    {
        $times = json_decode($request->times);
        $scheduleIDs = array();
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

           array_push($scheduleIDs, $schedule->scheduleID);
           $this->sendEmailAndSMS(auth()->user()->userID, 1, $request->venue_type);
        }

        if (!empty($schedule->scheduleID)) {
            if(!empty($request->waiver_name)){
                $waiver_name = json_decode($request->waiver_name);
                $waiver_id = json_decode($request->waiver_id);
                foreach ($scheduleIDs as $key => $scheduleID) {
                    for($i=0;$i<count($waiver_name);$i++){
                        $waiver = Waiver::create([
                            "scheduleID" => $scheduleID, "studentName" => $waiver_name[$i], "studentIDnumber" =>$waiver_id[$i]
                        ]);
                        // echo "name:".$waiver_name[$i]."  id:".$waiver_id[$i];
                    }
                }
            }
                Audittrails::create(['userID' => Auth::user()->userID, 'activity' => 'Added reservation']);
              return response()->json(["success"=>true, "message" => "Reservation request successfully submitted."]);
         }
         else{
              return response()->json(["success"=>false, "message" => "Something went wrong."]);
         }

    }

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
            ->selectSub('IF((SELECT timeID from schedules where timeID = time.timeID AND venueID = '.$request->id.' AND date = "'.$request->date.'"),1,0)', 'check');
            $schedules = Venue::distinct()->select('schedules.date', 'time.timeStartTime', 'time.timeEndTime')
            ->selectSub('IF((SELECT timeID from schedules where timeID = time.timeID AND venueID = '.$request->id.' AND date = "'.$request->date.'" AND statusID NOT IN(3,4,6)),1,0)', 'check')
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

    public function sendEmailAndSMS($userID, $type, $venueTypeID){
        if($type == 1){
            $listerRole = Venue::where('venueTypeID', $venueTypeID)->first();
            $user = User::where('userID', $listerRole->userID)->first();
            // $user_role = UserRole::where('userRoleID', auth()->user()->userRoleID)->first();
            $message = 'You have new reservation request.';
            $title = 'New Reservation Request';
            $body = 'You have new reservation request.';
            $mail_content = array(
                'title' => $title, 
                'body' => $body, 
                'receiver_name' => $user->firstName.' '.$user->lastName,
                'user_role' => "Developer",
                'sender_name' => "CSB BROS"
                );
        } else if($type == 2){
            $user = User::where('userID', $userID)->first();
            $user_role = UserRole::where('userRoleID', auth()->user()->userRoleID)->first();
            $message = 'Your reservation request was approved.';
            $title = 'Reservation Request';
            $body = 'Your reservation request was approved.';
            $mail_content = array(
                'title' => $title, 
                'body' => $body, 
                'receiver_name' => $user->firstName.' '.$user->lastName,
                'user_role' => $user_role->roleType,
                'sender_name' => auth()->user()->firstName.' '.auth()->user()->lastName
                );
        } else if($type == 3){
            $user = User::where('userID', $userID)->first();
            $user_role = UserRole::where('userRoleID', auth()->user()->userRoleID)->first();
            $message = 'Your reservation request was rejected.';
            $title = 'Reservation Request';
            $body = 'Sorry, your reservation request was rejected.';
            $mail_content = array(
                'title' => $title, 
                'body' => $body, 
                'receiver_name' => $user->firstName.' '.$user->lastName,
                'user_role' => $user_role->roleType,
                'sender_name' => auth()->user()->firstName.' '.auth()->user()->lastName
                );
        }

        $mail_content = array(
                        'title' => $title, 
                        'body' => $body, 
                        'receiver_name' => $user->firstName.' '.$user->lastName,
                        'user_role' => $user_role->roleType,
                        'sender_name' => auth()->user()->firstName.' '.auth()->user()->lastName
                        );
                        print_r($user);

        


        // Account details
        // API key  acc for
        // User: anz.zel17@gmail.com Pass: Anzel123
        //$apiKey = urlencode('WPQcktKiJak-ulfoMOJHh49Byt8uDAzf3rZ0e0wvnI');
        // API key  acc for
        // User: jananzel.santos@benilde.edu.ph Pass: Anzel123
        $apiKey = urlencode('PEht7ggsi4Q-md1NMBdZPq8mbA9dDhhc0duRmZwkS8');

        // Message details
        $numbers = array($user->phoneNumber);
        $sender = urlencode('CSB BROS');
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
        
        // Email sender
         Mail::to($user->email)->send(new MailSched($mail_content));

         return $response;

    }


}

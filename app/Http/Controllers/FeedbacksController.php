<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Practice2;
use App\User;
use App\Venue;
use App\VenueType;
use App\Audittrails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;


class FeedbacksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //reg
    public function index()
    {

        //$feedbacks = Feedback::select('feedbackID', 'comment', 'created_at', 'venueID', 'userID' )
//        $feedbacks = DB::table('feedbacks')
//        ->join('venue', 'venueID', '=', 'venue.venueID')
//        ->select('feedbacks.*', 'venue.venuetypeID')
//        ->get();
//        $feedbacks = Feedback::all();
      $feedbacks = DB::table('feedbacks')
          ->leftJoin('venue', 'venue.venueID', '=', 'feedbacks.venueID')
          ->rightJoin('users', 'users.userID', '=', 'feedbacks.userID')
          ->select('feedbacks.feedbackID', 'feedbacks.comment', 'feedbacks.created_at', 'venue.venueName', 'users.firstName')
          ->orderBy('feedbacks.created_at', 'desc')
            ->where('venue.venueTypeID', '=', '1')
            ->get();
        return view ('pages.registrar.feedbacksindex')
            ->with('feedbacks', $feedbacks);

    }

    public function showGasdFeedbacks(){
        return view('pages.gasd.feedbacks');
    }


    public function getFeedbacksReg(){
        $feedbacks = Feedback::whereHas('f_venue', function ($query){
            $query->where('venueTypeID', 1);
        })->with('f_venue','f_user')->get();

        // $feedbacks = Feedback::with('f_venue','f_user')->whereHas('f_venue', function($query))
        //     //->where('venueTypeID', '!=', '1')
        //     ->get();
        print_r(json_encode($feedbacks));

    }

    public function getFeedbacksGasd(){
        $feedbacks = Feedback::whereHas('f_venue', function ($query){
            $query->where('venueTypeID', 2);
        })->with('f_venue','f_user')->get();

        // $feedbacks = Feedback::with('f_venue','f_user')->whereHas('f_venue', function($query))
        //     //->where('venueTypeID', '!=', '1')
        //     ->get();
        print_r(json_encode($feedbacks));

    }

    //gasd
    public function index2()
    {
        $feedbacks = DB::table('feedbacks')
            ->leftJoin('venue', 'venue.venueID', '=', 'feedbacks.venueID')
            ->rightJoin('users', 'users.userID', '=', 'feedbacks.userID')
            ->select('feedbacks.feedbackID', 'feedbacks.comment', 'feedbacks.created_at', 'venue.venueName', 'users.firstName')
            ->orderBy('feedbacks.created_at', 'desc')
            ->where('venue.venueTypeID', '=', '2')
            ->get();
        return view ('feedbacks.feedbacksindex2')
            ->with('feedbacks', $feedbacks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showFeedbackPage()
    {
        $venueTypes = VenueType::all();

        return view('pages.student.sendfeedbacks', compact('venueTypes'));
        // return view ('pages.student.sendfeedbacks')
        //     //->with('venues', $venues);
        //     ->with('users', $users)
        //     ->with('f_venue', $f_venue);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::beginTransaction();

        try {
            $feedbacks = new Feedback();
            $feedbacks->comment = $request->input('comment');
            $feedbacks->created_at = Carbon::now();
            $feedbacks->venueID = $request->venue_name;
            $feedbacks->userID = auth()->user()->userID;
            if ($feedbacks->save()) {
                Audittrails::create(['userID' => Auth::user()->userID, 'activity' => 'Sent a feedback']);
            }
        } catch(ValidationException $e)
        {
            // Rollback and then redirect
            // back to form with errors
            DB::rollback();
            return response()->json(['message' => 'Something went wrong.', 'success' => false]);
        } catch(\Exception $e)
        {
            DB::rollback();
            return response()->json(['message' => 'Something went wrong.', 'success' => false]);
        }

        DB::commit();
        return response()->json(['message' => 'Comment has been sent!', 'success' => true]);
        

        // return Redirect::to('student/schedules/create')->with('success', 'Feedback sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

//    public function get()
//    {
//        return view('practice');
//    }
//
//    public function add(Request $request)
//    {
//        $practice = new Practice2();
//        $practice->venue = $request->input('venue');
//        $practice->name = $request->input('name');
//        $practice->time = $request->input('time');
//        if($practice->save()){
//            return response()->json(['message' => 'Comment has been sent!', 'success' => true]);
//        }
//
//        // return Redirect::to('student/schedules/create')->with('success', 'Feedback sent');
//    }
//
//    public function look()
//    {
//        $practice = Practice2::all();
//
//        return view('showpractice', compact('practice'));
//        // return view ('pages.student.sendfeedbacks')
//        //     //->with('venues', $venues);
//        //     ->with('users', $users)
//        //     ->with('f_venue', $f_venue);
//    }
//    public function getlook()
//    {
//        $practice = Practice2::all();
//
//        print_r(json_encode($practice));
//    }

    public function data()
{
    $practice2 = DB::table('practice2')->get();
    return view ('posts.datatable')
        ->with('practice2', $practice2);
}
    public function getData()
    {

        $practice2 = DB::table('practice2')->get();
       return response()->json($practice2);

    }
    public function dataStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'venue' => 'required',
            'timeStart' => 'required',
            'timeEnd' => 'required',
            'comment' => 'required'
        ]);

        $feedbacks = new Feedback();
        $feedbacks->name = $request->input('name');
        $feedbacks->venue = $request->input('venue');
        $feedbacks->timeStart = $request->input('timeStart');
        $feedbacks->timeEnd = $request->input('timeEnd');
        $feedbacks->comment = $request->input('comment');

        if($feedbacks->save()){
            return response()->json(['message' => 'Comment has been sent!', 'success' => true]);
        }

        // return Redirect::to('student/schedules/create')->with('success', 'Feedback sent');
    }

}

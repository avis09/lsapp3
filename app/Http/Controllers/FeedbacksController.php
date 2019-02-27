<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\User;
use App\Venue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class FeedbacksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$feedbacks = Feedback::select('feedbackID', 'comment', 'created_at', 'venueID', 'userID' )
//        $feedbacks = DB::table('feedbacks')
//        ->join('venue', 'venueID', '=', 'venue.venueID')
//        ->select('feedbacks.*', 'venue.venuetypeID')
//        ->get();
//        $feedbacks = Feedback::all();
      $feedbacks = DB::table('feedbacks')
          ->join('venue', 'venue.venueID', '=', 'feedbacks.venueID')
          ->join('users', 'users.userID', '=', 'feedbacks.userID')
          ->select('feedbacks.feedbackID', 'feedbacks.comment', 'feedbacks.created_at', 'venue.venueName', 'users.firstName')
          ->orderBy('feedbacks.created_at', 'desc')
            ->where('venue.venueTypeID', '=', '1')
            ->get();
        return view ('feedbacks.feedbacksindex')
            ->with('feedbacks', $feedbacks);

    }
    public function index2()
    {
        $feedbacks = DB::table('feedbacks')
            ->join('venue', 'venue.venueID', '=', 'feedbacks.venueID')
            ->join('users', 'users.userID', '=', 'feedbacks.userID')
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
    public function create()
    {
        $users = array('users' => DB::table('users')->get());
        //$venues = array('venue' => DB::table('venue')->get());
        //$f_venue = array('venue' => DB::table('venue')->get());
        $f_venue = Venue::all();

        return view ('feedbacks.sendfeedbacks')
            //->with('venues', $venues);
            ->with('users', $users)
            ->with('f_venue', $f_venue);
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
            'Comment' => 'required'
        ]);

        $feedbacks = new Feedback();
        $feedbacks->comment = $request->input('Comment');
        $feedbacks->created_at = Carbon::now();
        $feedbacks->venueID = $request->input('f_venue');
        $feedbacks->userID = auth()->user()->userID;
        $feedbacks->save();

        return Redirect::to('student/schedules/create')->with('success', 'Feedback sent');
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
}

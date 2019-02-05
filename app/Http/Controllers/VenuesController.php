<?php

namespace App\Http\Controllers;

use App\Venue;
use Illuminate\Http\Request;
use DB;
// use App\VenuesController;

class VenuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venues = Venue::all();
        return view('venues.venueindex')->with('venues', $venues);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $venueB = array('building' => DB::table('building')->get());
        $venueF = array('venuefloor' => DB::table('venuefloor')->get());
        $venueT = array('venuetype' => DB::table('venuetype')->get());
        return view('venues.addvenue')->with('venueB', $venueB)->with('venueF', $venueF)->with('venueT', $venueT);
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

            'venueName' => 'required',



        //    'cover_image' => 'image|nullable|max:1999'
        ]);


        // Create post
        $venues = new Venue;
        $venues->buildingID = $request->input('buildingID');
        $venues->venueName = $request->input('venueName');
        $venues->venueFloorID = $request->input('venueFloorID');
        $venues->venueTypeID = $request->input('venueTypeID');
        $venues->userID = $request->input('1');
      //  $venue->place = auth()->user()->id;
      //  $venue->cover_image = $fileNameToStore;

        $venues->save();
        return redirect('/venues')->with('success', 'Venue Added');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venue = Venue::find($id);
        return view('venues.showvenue')->with('venue', $venue);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $venue = Venue::find($id);
        // Check for correct user
       // if(auth()->user()->id !==$post->user_id){
       //     return redirect('/posts')->with('error', 'Unauthorized Page');
       // }
        return view('venues.editvenue')->with('venue', $venue);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $venueID)
    {
        $this->validate($request, [
            'buildingID' => 'required',
            'venueName' => 'required',
            'venueFloorID' => 'required',
            'venueTypeID' => 'required',
            'userID' => 'required'


            //    'cover_image' => 'image|nullable|max:1999'
        ]);

        // update post
        $venues = new Venue;
        $venues->buildingID = $request->input('buildingID');
        $venues->venueName = $request->input('venueName');
        $venues->venueFloorID = $request->input('venueFloorID');
        $venues->venueTypeID = $request->input('venueTypeID');
        $venues->userID = $request->input('userID');
        //  $venue->place = auth()->user()->id;
        //  $venue->cover_image = $fileNameToStore;
        $venues->save();
        return redirect('/venues')->with('success', 'Venue Added');

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

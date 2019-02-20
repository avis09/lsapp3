<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Venue;
Use App\Http\Resources\Venue as VenueResource;
use Illuminate\Support\Facades\DB;

class VenueApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get venues
        $venues = Venue::paginate(15);
//        $venueTypes = DB::table('venueType')->get();
//
//        dd($venueTypes);

        // return collection as resource
        return VenueResource::collection($venues);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $venues = $request->isMethod('put') ? Venue::findOrFail($request->venueID) : new Venue;

        $venues->venueID = $request->input('venueID');
        $venues->buildingID = $request->input('buildingID');
        $venues->venueName = $request->input('venueName');
        $venues->venueFloorID = $request->input('venueFloorID');
        $venues->venueTypeID = $request->input('venueTypeID');
        $venues->userID = $request->input('userID');

        if($venues->save()){
            return new VenueResource($venues);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //getting a single venue
        $venue = Venue::findOrFail($id);
        //return single article
        return new VenueResource($venue);
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
        $venue = Venue::findOrFail($id);

        if($venue->delete()){
            return new VenueResource($venue);
        }
    }

    public function getVenuesBasedOnId($venueTypeId){
        $venueBasedOnId = Venue::where('venueTypeID', $venueTypeId)->get();
        return new VenueResource($venueBasedOnId);
    }
}
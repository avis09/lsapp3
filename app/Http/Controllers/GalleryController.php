<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\Http\Resources\Venue;
use App\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $venue = Venue::all();
//        $equipments = Equipment::all();
//        $picture = Picture::all();

        $venue = DB::table('venue')
            ->leftJoin('equipment', 'equipment.venueID', '=', 'venue.venueID')
            ->rightJoin('picture', 'picture.venueID', '=', 'venue.venueID')
            ->select('venue.venueID', 'equipmentID', 'picture.pictureID')

            ->get();
        //, 'picture.pictureID'
//            ->join('users', 'users.userID', '=', 'feedbacks.userID')
//            ->select('feedbacks.feedbackID', 'feedbacks.comment', 'feedbacks.created_at', 'venue.venueName', 'users.firstName')
//            ->orderBy('feedbacks.created_at', 'desc')
//            ->where('venue.venueTypeID', '=', '1')
//        $venue = Venue::with('equipment')->all();
        dd($venue);
        return view('gallery.gallery')
            ->with('venue', $venue);
//            ->with('equipments', $equipments)
//            ->with('picture', $picture);


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
        //
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

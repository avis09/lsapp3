<?php

namespace App\Http\Controllers;

use App\Picture;
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
        //$users = User::select('users.id', 'first_name', 'last_name', 'email', 'phone', 'birth_date','created_at')->orderBy('created_at', 'dsc')->leftjoin('patients','patients.patient_id','users.id')->where('role_id', 3)->paginate(10);
        //index for ROOM
        $venues = Venue::select('venueID', 'buildingID', 'venueName', 'venueFloorID', 'venueTypeID', 'userID', 'venueStatusID' )->where('venueTypeID', 1)->paginate(10);
        $f_buildingV = array('building' => DB::table('building')->get());
        $f_userV = array('users' => DB::table('users')->get());
        return view('venues.venueindex')
                ->with('venues', $venues)
                ->with('f_buildingV', $f_buildingV)
                ->with('f_userV', $f_userV);
    }
    public function index2()
    {
        //Index Court
        $venues = Venue::select('venueID', 'buildingID', 'venueName', 'venueFloorID', 'venueTypeID', 'userID', 'venueStatusID')->where('venueTypeID', 2)->paginate(10);
        $f_venueStatusV = array('venuestatus' => DB::table('venuestatus')->get());
        return view('venues.venueindex')
            ->with('venues', $venues)
            ->with('f_venueStatusVu', $f_venueStatusV);
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
        $venueST = array('venueStatus' => DB::table('venueStatus')->get());
        return view('venues.addvenue')
            ->with('venueB', $venueB)
            ->with('venueF', $venueF)
            ->with('venueT', $venueT)
            ->with('venueST', $venueST);
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

//        $picture = new Picture();
//        $picture->venueID = $venues->venueID;
//        // Handle File Upload
//        if($request->hasFile('pictureName')){
//            // Get filename with the extension
//            $filenameWithExt = $request->file('pictureName')->getClientOriginalName();
//            // Get just filename
//            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
//            // Get just ext
//            $extension = $request->file('pictureName')->getClientOriginalExtension();
//            // Filename to store
//            $fileNameToStore= $filename.'_'.time().'.'.$extension;
//            // Upload Image
//            $path = $request->file('pictureName')->storeAs('public/cover_images', $fileNameToStore);
//        } else {
//            $fileNameToStore = 'noimage.jpg';
//        }
//        $picture->pictureName = $fileNameToStore;
//        $picture->save();
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

            'venueName' => 'required',


            //    'cover_image' => 'image|nullable|max:1999'
        ]);

        // update post
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

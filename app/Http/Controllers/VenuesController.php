<?php

namespace App\Http\Controllers;

use App\Picture;
use App\User;
use App\Venue;
use App\VenueType;
use Illuminate\Http\Request;
use DB;
use Storage;
use Carbon\Carbon;
// use App\VenuesController;

class VenuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // *****************
    // 1 = Registrar
    // 2 = GASD
    //******************

    // Registrar List of Venues (ROOMS)
    public function index()
    {
        //$users = User::select('users.id', 'first_name', 'last_name', 'email', 'phone', 'birth_date','created_at')->orderBy('created_at', 'dsc')->leftjoin('patients','patients.patient_id','users.id')->where('role_id', 3)->paginate(10);
        //index for ROOM
        $venueB = array('building' => DB::table('building')->get());
        $venueF = array('venuefloor' => DB::table('venuefloor')->get());
        $venueT = array('venuetype' => DB::table('venuetype')->get());
        $venueST = array('venueStatus' => DB::table('venueStatus')->get());
        return view('pages.registrar.venues')
            ->with('venueB', $venueB)
            ->with('venueF', $venueF)
            ->with('venueT', $venueT)
            ->with('venueST', $venueST);

        // $venues = Venue::select('venueID', 'buildingID', 'venueName', 'venueFloorID', 'venueTypeID', 'userID', 'venueStatusID' )->where('venueTypeID', 1)->paginate(10);
        // $f_buildingV = array('building' => DB::table('building')->get());
        // //$f_statusV = array('status' => DB::table('status')->get());
        // $f_userV = array('users' => DB::table('users')->get());
        // return view('venues.venueindex')
        //         ->with('venues', $venues)
        //         ->with('f_buildingV', $f_buildingV)
        //         ->with('f_userV', $f_userV);
                //->with('f_statusV', $f_statusV);
    }



    public function getVenues(){
         // $venues = Venue::select('venueID', 'buildingID', 'venueName', 'venueFloorID', 'venueTypeID', 'userID', 'venueStatusID' )->where('venueTypeID', 1)->paginate(10);

         $venues = Venue::with('f_buildingV','f_userV','f_venueTypeV','floor','f_venueStatusV')->where('venueTypeID', 1)->get();
          print_r(json_encode($venues));
        // $f_buildingV = array('building' => DB::table('building')->get());
        // //$f_statusV = array('status' => DB::table('status')->get());
        // $f_userV = array('users' => DB::table('users')->get());
        // $venues = view('venues.venueindex')
        //         ->with('venues', $venues)
        //         ->with('f_buildingV', $f_buildingV)
        //         ->with('f_userV', $f_userV);
    }

    // GASD List of Venues (Venues)
    public function index2()
    {
        //Index Court
        $venues = Venue::select('venueID', 'buildingID', 'venueName', 'venueFloorID', 'venueTypeID', 'userID', 'venueStatusID')->where('venueTypeID', 2)->paginate(10);
        $f_venueStatusV = array('venuestatus' => DB::table('venuestatus')->get());
        $f_userV = array('users' => DB::table('users')->get());
        return view('pages.gasd.venueindex')
            ->with('venues', $venues)
            ->with('f_venueStatusVu', $f_venueStatusV)
            ->with('f_userV', $f_userV);
    }
    // Registrar Reports on number Active Rooms
    public function indexReports()
    {
        $count = DB::table('venue')
            ->join('venuetype', 'venuetype.venueTypeID', '=', 'venue.venueTypeID')
            ->select('venue.venueID')
            //->orderBy('feedbacks.created_at', 'desc')
            ->where('venue.venueTypeID', '=', '1')
            ->count();

        return view('pages.registrar.venuereportsregistrar')
            ->with('count', $count);
    }
    // GASD Reports on number Active Courts
    public function indexReports2()
    {
        $count = DB::table('venue')
            ->join('venuetype', 'venuetype.venueTypeID', '=', 'venue.venueTypeID')
            ->join('venuestatus', 'venuestatus.venueStatusID', '=', 'venue.venueStatusID')
            ->select('venue.venueID')
            //->orderBy('feedbacks.created_at', 'desc')
            ->where('venue.venueTypeID', '=', '2')
            ->where('venue.venueStatusID', '=', '1')
            ->count();

        return view('pages.gasd.venuereportsgasd')
            ->with('count', $count);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Registar Create
    // public function create(Request $request)
    // {
    //     $venueB = array('building' => DB::table('building')->get());
    //     $venueF = array('venuefloor' => DB::table('venuefloor')->get());
    //     $venueT = array('venuetype' => DB::table('venuetype')->get());
    //     $venueST = array('venueStatus' => DB::table('venueStatus')->get());
    //     return view('pages.registrar.addvenue')
    //         ->with('venueB', $venueB)
    //         ->with('venueF', $venueF)
    //         ->with('venueT', $venueT)
    //         ->with('venueST', $venueST);
    // }


    //GASD Create
    public function create2()
    {
        $venueB = array('building' => DB::table('building')->get());
        $venueF = array('venuefloor' => DB::table('venuefloor')->get());
        $venueT = array('venuetype' => DB::table('venuetype')->get());
        $venueST = array('venueStatus' => DB::table('venueStatus')->get());
        return view('pages.gasd.addvenue2')
            ->with('venueB', $venueB)
            ->with('venueF', $venueF)
            ->with('venueT', $venueT)
            ->with('venueST', $venueST);
    }


    public function GenerateFilename($reqtype, $filename)
    {
        return strtoupper(date('Y-m-d').'-'.$reqtype.'-'.md5($filename . microtime()));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function showVenueGallery(){
        $venueTypes = VenueType::all();
        return view('pages.student.venue-gallery', compact('venueTypes'));
    }

    //Registrar Store
    public function store(Request $request)
    {

        $this->validate($request, [
            'venueName' => 'required',
        //    'cover_image' => 'image|nullable|max:1999'
        ]);

        $venues = new Venue;
        $venues->buildingID = $request->input('buildingID');
        $venues->venueName = $request->input('venueName');
        $venues->venueFloorID = $request->input('venueFloorID');
        //Add venue type room
        $venues->venueTypeID = '1';
        $venues->venueStatusID = $request->input('venueStatus');
        $venues->userID = auth()->user()->userID;
      //  $venue->place = auth()->user()->id;
      //  $venue->cover_image = $fileNameToStore;
            $venueImages = $request->venueImages;
        if($venues->save()){

                if($request->hasfile('venue_image'))
                {
                    foreach($request->file('venue_image') as $venueImage)
                    {
                        $venueImageName = $this->GenerateFilename('room', $venueImage).".".$venueImage->getClientOriginalExtension();
                        // Store file or image to storage
                        Storage::disk('public')->put('venue images/rooms/'.$venueImageName, file_get_contents($venueImage));
                        $venue_image = new Picture;
                        $venue_image->venueID = $venues->venueID;
                        $venue_image->pictureName = $venueImageName;
                        $venue_image->created_at = Carbon::now()->toDateTimeString();
                        $venue_image->save();
                    }
                }


            // }
        }


        return response()->json(['message' => 'Venue Successfully Added!', 'success' => true]); 

        // return redirect('registrar/venues/create')->with('success', 'Venue Added');



    }
    // GASD Store
    public function store2(Request $request)
    {
        $this->validate($request, [

            'venueName' => 'required',

        ]);


        // Create post
        $venues = new Venue;
        $venues->buildingID = $request->input('buildingID');
        $venues->venueName = $request->input('venueName');
        $venues->venueFloorID = $request->input('venueFloorID');
        //Add venue type court
        $venues->venueTypeID = '2';
        $venues->venueStatusID = $request->input('venueStatus');
        $venues->userID = auth()->user()->userID;
        //  $venue->place = auth()->user()->id;
        //  $venue->cover_image = $fileNameToStore;
        $venues->save();
        return redirect('gasd/venues/create2')->with('success', 'Venue Added');



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

//SEND MESSAGE TRIAL
    public function sendcreate()
    {
        $user = User::all();
        return view('send')
            ->with('user', $user);

    }
     public function sendstore()
    {

	// Account details
        // API key  acc for
        // User: anz.zel17@gmail.com Pass: Anzel123
	    //$apiKey = urlencode('WPQcktKiJak-ulfoMOJHh49Byt8uDAzf3rZ0e0wvnI');
        // API key  acc for
        // User: jananzel.santos@benilde.edu.ph Pass: Anzel123
        $apiKey = urlencode('PEht7ggsi4Q-md1NMBdZPq8mbA9dDhhc0duRmZwkS8');


	// Message details
	$numbers = array('639065581339');
	$sender = urlencode('ANZEL');
	$message = rawurlencode('Code worked!');

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
	echo $response;


    }


}

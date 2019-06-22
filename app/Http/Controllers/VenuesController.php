<?php

namespace App\Http\Controllers;

use App\Picture;
use App\User;
use App\Venue;
use App\Equipment;
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
    public function showRoomPage()
    {
        $venueB = array('building' => DB::table('building')->get());
        $venueF = array('venuefloor' => DB::table('venuefloor')->get());
        $venueT = array('venuetype' => DB::table('venuetype')->get());
        $venueST = array('venueStatus' => DB::table('venueStatus')->where('venueStatusID', '!=', '3')->get());
        return view('pages.registrar.venues')
            ->with('venueB', $venueB)
            ->with('venueF', $venueF)
            ->with('venueT', $venueT)
            ->with('venueST', $venueST);
    }

    public function showCourtPage()
    {
        $venueB = array('building' => DB::table('building')->get());
        $venueF = array('venuefloor' => DB::table('venuefloor')->get());
        $venueT = array('venuetype' => DB::table('venuetype')->get());
        $venueST = array('venueStatus' => DB::table('venueStatus')->where('venueStatusID', '!=', '3')->get());
        return view('pages.gasd.venues')
            ->with('venueB', $venueB)
            ->with('venueF', $venueF)
            ->with('venueT', $venueT)
            ->with('venueST', $venueST);
    }


    public function getSpecificRoom(Request  $request){
    $venues = Venue::with('f_buildingV','floor','f_venueStatusV','pictures', 'f_equipment')->where('venueID', $request->id)->first();
         return response()->json($venues);
   }

   public function getSpecificCourt(Request  $request){
    $venues = Venue::with('f_buildingV','floor','f_venueStatusV','pictures')->where('venueID', $request->id)->first();
         return response()->json($venues);
   }

    public function getRoomVenues(){
         $venues = Venue::with('f_buildingV','f_userV','f_venueTypeV','floor','f_venueStatusV')->where('venueTypeID', 1)->where('venueStatusID', '!=', 3)->get();
          print_r(json_encode($venues));
    }


    public function getRoomEquipments(Request $request){
        $equipments = Equipment::where('venueID', $request->id)->with('f_equipmentStatus')->get();
        return response()->json($equipments);
    }


    // GASD List of Venues (Venues)
    public function index2()
    {
        //Index Court
        $venues = Venue::select('venueID', 'buildingID', 'venueName', 'venueFloorID', 'venueTypeID', 'userID', 'venueStatusID')->where('venueTypeID', 2)->paginate(10);
        $f_venueStatusV = array('venuestatus' => DB::table('venuestatus')->get());
        $f_userV = array('users' => DB::table('users')->get());
        return view('pages.gasd.venues')
            ->with('venues', $venues)
            ->with('f_venueStatusVu', $f_venueStatusV)
            ->with('f_userV', $f_userV);
    }
    
    public function getCourtVenues(){
        $venues = Venue::with('f_buildingV','f_userV','f_venueTypeV','floor','f_venueStatusV')->where('venueTypeID', 2)->where('venueStatusID', '!=', 3)
            ->get();
        print_r(json_encode($venues));
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


    public function showRoomVenues(){
        $venues = Venue::with('pictures')->where('venueTypeID', 1)->where('venueStatusID', 1)->get();
        return view('pages.student.venue-rooms', compact('venues'));

    }

    public function showRoomGallery(){
        $venues = Venue::with('pictures')->where('venueTypeID', 1)->where('venueStatusID', 1)->get();
        return view('pages.registrar.room-gallery', compact('venues'));
    }
    
    public function showCourtGallery(){
        $venues = Venue::with('pictures')->where('venueTypeID', 2)->where('venueStatusID', 1)->get();
        return view('pages.gasd.court-gallery', compact('venues'));
    }

    public function showCourtVenues(){
        $venues = Venue::with('pictures')->where('venueTypeID', 2)->where('venueStatusID', 1)->get();
        return view('pages.student.venue-courts', compact('venues'));
    }

    public function updateVenueStatus(Request $request){
        $venue = Venue::find($request->id);
        $venue->venueStatusID = $request->type;
        if($venue->save()){
            switch ($request->type) {
                case '1':
                    $content_message = 'Activated';
                    break;
                case '2':
                    $content_message = 'Deactivated';
                    break;
                case '3':
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
        if(auth()->user()->userRoleID == 2){
             $venues->venueTypeID = 2;   
        }
        else if(auth()->user()->userRoleID == 3){
             $venues->venueTypeID = 1;
        }
        $venues->venueStatusID = $request->input('venueStatus');
        $venues->userID = auth()->user()->userID;
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
                        $venue_image->updated_at = Carbon::now()->toDateTimeString();
                        $venue_image->save();
                    }


                    if(!empty($request->input('equipment_name'))){
                        $equipmentName = array();
                        $barCode = array();
                        $equipmentStatusID = array();
                        $equipmentName = $request->input('equipment_name');
                        $barCode = $request->input('equipment_barcode');
                        $equipmentStatusID = json_decode($request->input('equipmentStatus'));

                        for($i=0;$i<count($equipmentName);$i++){
                            $waiver = Equipment::create([
                                "venueID" => $venues->venueID, 
                                "equipmentStatusID" => $equipmentStatusID[$i],
                                "equipmentName" =>$equipmentName[$i],
                                "barCode" => $barCode[$i],
                                "created_at" => Carbon::now(),
                                "updated_at" => Carbon::now()
                            ]);
                         }
                    }
                }  

                Audittrails::create(['userID' => auth()->user()->userID, 'activity' => 'Added new venue']);
        }

        return response()->json(['message' => 'Venue Successfully Added!', 'success' => true]);

        // return redirect('registrar/venues/create')->with('success', 'Venue Added');
    }

    public function updateRoomVenue(Request $request){
        $this->validate($request, [
            'venueName' => 'required',
        //    'cover_image' => 'image|nullable|max:1999'
        ]);

        $venues = Venue::find($request->venueID);
        $venues->buildingID = $request->input('buildingID');
        $venues->venueName = $request->input('venueName');
        $venues->venueFloorID = $request->input('venueFloorID');
        $venues->venueStatusID = $request->input('venueStatus');
        $venues->userID = auth()->user()->userID;
        if($venues->save()){
                $existingPicture = json_decode($request->input('existingPicture'));
                $delete_picture = Picture::where('venueID', $request->venueID)->whereNotIn('pictureID', $existingPicture)->delete();
                if($request->hasfile('venue_image'))
                {
                    // $arraysAreEqual = ($a == $b); 
                    // TRUE if $a and $b have the same key/value pairs.
                    // $arraysAreEqual = ($a === $b);
                     // TRUE if $a and $b have the same key/value pairs in the same order and of the same types.
                    
                    foreach($request->file('venue_image') as $venueImage)
                    {
                        if (!empty($venueImage)){
                            //delete existing pictures 
                            //adding of pictures
                            $venueImageName = $this->GenerateFilename('room', $venueImage).".".$venueImage->getClientOriginalExtension();
                            Storage::disk('public')->put('venue images/rooms/'.$venueImageName, file_get_contents($venueImage));
                            $venue_image = new Picture;
                            $venue_image->venueID = $request->venueID;
                            $venue_image->pictureName = $venueImageName;
                            $venue_image->created_at = Carbon::now()->toDateTimeString();
                            $venue_image->save();
                        }
                    }

                    if(!empty($request->input('equipment_name'))){
                        $equipmentName = array();
                        $barCode = array();
                        $equipmentStatusID = array();
                        $equipmentName = $request->input('equipment_name');
                        $barCode = $request->input('equipment_barcode');
                        $equipmentStatusID = json_decode($request->input('equipmentStatus'));

                        $delete_equipment = Equipment::where('venueID', $request->venueID)->delete();
                        for($i=0;$i<count($equipmentName);$i++){
                            $waiver = Equipment::create([
                                "venueID" => $request->venueID, 
                                "equipmentStatusID" => $equipmentStatusID[$i],
                                "equipmentName" =>$equipmentName[$i],
                                "barCode" => $barCode[$i],
                                "created_at" => Carbon::now(),
                                "updated_at" => Carbon::now()
                            ]);
                         }
                    }
                }
                Audittrails::create(['userID' => auth()->user()->userID, 'activity' => 'Updated venue']);  
        }

        return response()->json(['message' => 'Venue Successfully Updated!', 'success' => true]);

    }

    public function show($id)
    {
        $venue = Venue::find($id);
        return view('venues.showvenue')->with('venue', $venue);
    }


    public function edit($id)
    {
        $venue = Venue::find($id);
        // Check for correct user
       // if(auth()->user()->id !==$post->user_id){
       //     return redirect('/posts')->with('error', 'Unauthorized Page');
       // }
        return view('venues.editvenue')->with('venue', $venue);
    }

    public function update(Request $request, $venueID)
    {
        $this->validate($request, [
            'venueName' => 'required',
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

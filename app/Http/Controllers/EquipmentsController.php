<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use DB;

class EquipmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipment = Equipment::all();
        return view('equipments.equipmentindex')->with('equipment', $equipment);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $venueI = array('venue' => DB::table('venue')->get());
        $equipmentstatusI = array('equipmentstatus' => DB::table('equipmentstatus')->get());
        return view('equipments.addequipment')->with('venueI', $venueI)->with('equipmentstatusI', $equipmentstatusI);
    }
//    public function create2()
//    {
//        $venues = Venue::select('venueID')->where('venueTypeID', 2);
//        $equipmentstatusI = array('equipmentstatus' => DB::table('equipmentstatus')->get());
//        return view('equipments.addequipment')->with('venues', $venues);
//    }

    public function store(Request $request)
    {
        $this->validate($request, [
            //  'userRoleID' => 'required',
//            'firstName' => 'required',
//            'LastName' => 'required',
//            'Password' => 'required',
//            'phoneNumber' => 'required',
//            'email' => 'required'
            //    'cover_image' => 'image|nullable|max:1999'
        ]);

        $equipment = new Equipment;
        $equipment->venueID = $request->input('venue');
        $equipment->equipmentName = $request->input('equipmentName');
        $equipment->barCode = $request->input('barCode');
        $equipment->equipmentStatusID = $request->input('equipmentstatus');

        $equipment->save();

        return redirect('/equipments')->with('success', 'Equipment Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipment = Equipment::find($id);
        return view('equipments.showequipmnet')->with('equipment', $equipment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipment = Equipment::find($id);
        $venueI = array('venue' => DB::table('venue')->get());
        $equipmentstatusI = array('equipmentstatus' => DB::table('equipmentstatus')->get());
        return view('equipments.editequipment')->with('venueI', $venueI)->with('equipmentstatusI', $equipmentstatusI);
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
        $equipment = new Equipment;
        $equipment->venueID = $request->input('venue');
        $equipment->equipmentName = $request->input('equipmentName');
        $equipment->barCode = $request->input('barCode');
        $equipment->equipmentStatusID = $request->input('equipmentstatus');

        $equipment->save();

        return redirect('/equipments')->with('success', 'Equipment Updated');
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

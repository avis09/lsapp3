<?php

namespace App\Http\Controllers;

use App\Classroom;
use Illuminate\Http\Request;
use DB;
use App\Venue;

class ClassroomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classrooms = Classroom::all();
        return view('classrooms.classroomindex')->with('classrooms', $classrooms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $venues = array('venues' => DB::table('venue')->get());
        return view('classrooms.addclassroom', $venues);
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
            'RoomFloor' => 'required',
            'RoomNumber' => 'required'
            //    'cover_image' => 'image|nullable|max:1999'
        ]);
        // Create post
        $classroom = new Classroom;
        $classroom->RoomFloor = $request->input('RoomFloor');
        $classroom->RoomNumber = $request->input('RoomNumber');
        $classroom->venueID = $request->input('venues');
        $classroom->venueName = $request->input('venues');
        //  $venue->place = auth()->user()->id;
        //  $venue->cover_image = $fileNameToStore;
        $classroom->save();



        return redirect('/classrooms')->with('success', 'Classroom Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classroom = Classroom::find($id);
        // $venues = Venue::find($user_id);
        return view('classrooms.showclassroom')->with('classrooms', $classroom);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classroom = Classroom::find($id);
        // Check for correct user
        // if(auth()->user()->id !==$post->user_id){
        //     return redirect('/posts')->with('error', 'Unauthorized Page');
        // }
        return view('classrooms.editclassroom')->with('classrooms', $classroom);
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
        $this->validate($request, [
            'RoomFloor' => 'required',
            'RoomNumber' => 'required'
        ]);

        // Create post
        $classroom = Classroom::find($id);
        $classroom->RoomFloor = $request->input('RoomFloor');
        $classroom->RoomNumber = $request->input('RoomNumber');
        $classroom->venueID = $request->input('venues');
        $classroom->save();

        return redirect('/classrooms')->with('success', 'Classroom Updated');
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

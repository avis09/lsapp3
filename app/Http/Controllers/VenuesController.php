<?php

namespace App\Http\Controllers;

use App\Venue;
use Illuminate\Http\Request;
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
        return view('venues.addvenue');
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

        // Handle File Upload
        /* if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore ='noimage.jpg';
        }
        */

        // Create post
        $venue = new Venue;
        $venue->venueName = $request->input('venueName');
      //  $venue->place = auth()->user()->id;
      //  $venue->cover_image = $fileNameToStore;
        $venue->save();

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
            'venueName' => 'required'

        ]);

        // Update post
        $venue = Venue::find($venueID);
        $venue->venueName = $request->input('venueName');

        $venue->save();

        return redirect('/venues')->with('success', 'Venue Updated');
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

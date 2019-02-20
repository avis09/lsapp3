<?php

namespace App\Http\Controllers;

use App\Http\Resources\Venuetype;
use Illuminate\Http\Request;
use App\Http\Requests;
Use App\Http\Resources\Venuetype as VenuetypeResource;

class VenueTypeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venuetypes = \App\VenueType::paginate(15);

        return VenuetypeResource::collection($venuetypes);
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
        $venuetype = $request->isMethod('put') ? VenueType::findOrFail($request->venueTypeID) : new VenueType();

        $venuetype->venueTypeID = $request->input('venueTypeID');
        $venuetype->venueTypeName = $request->input('venueTypeName');

        if($venuetype->save()){
            return new VenueResource($venuetype);
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
        $venuetype = VenueType::findOrFail($id);

        return new VenuetypeResource($venuetype);
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
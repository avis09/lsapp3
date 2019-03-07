<?php

namespace App\Http\Controllers;

use App\Http\Resources\ViewprofileResource;
use App\User;
use Illuminate\Http\Request;

class ViewprofileApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = User::paginate(15);

        return ViewprofileResource::collection($profiles);
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
        $profile = $request->isMethod('put') ? User::findOrFail($request->userID) : new User();

        $profile->userID = $request->input('userID');
        $profile->firstName = $request->input('firstName');
        $profile->lastName = $request->input('lastName');
        $profile->IDnumber = $request->input('IDnumber');
        $profile->email = $request->input('email');
        $profile->phoneNumber = $request->input('phoneNumber');


        if($profile->save()){
            return new ViewprofileResource($profile);
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
        $profile = User::findOrFail($id);


        return new ViewprofileResource($profile);
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

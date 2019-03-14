<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use App\Http\Resources\Login as LoginResource;
use Illuminate\Support\Facades\Auth;

class LoginApiController extends Controller
{
//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function index()
//    {
//        $users = User::paginate(15);
//
//        return LoginResource::collection($users);
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        //
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        $user = $request->isMethod('put') ? User::findOrFail($request->userID) : new User();
//
//        $user->userID = $request->input('userID');
//        $user->userRoleID = $request->input('userRoleID');
//        $user->firstName = $request->input('firstName');
//        $user->lastName = $request->input('lastName');
//        $user->phoneNumber = $request->input('phoneNumber');
//        $user->email = $request->input('email');
//        $user->apiToken = $request->input('apiToken');
//        $user->departmentID = $request->input('departmentID');
//        $user->userStatusID = $request->input('userStatusID');
//        $user->IDnumber = $request->input('IDnummber');
//      ;
//
//        if($user->save()){
//            return new LoginResource($user);
//        }
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function show($id)
//    {
//        $user = User::findOrFail($id);
//
//        return new LoginResource($user);
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function edit($id)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, $id)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy($id)
//    {
//        //
//    }

    public function login(Request $request)
    {
       $attempt = Auth::attempt(['IDnumber' => $request->input('IDnumber'), 'password' => $request->input('password')], false);
        if ($attempt) {
//            Auth::user();
//            email::where('IDnumber', $request->IDnumber)->first();

            return response()->json(['message' => 'success']);
//            Session::save();
            //return redirect()->route('schedules.create');

        }


        else {
            return response()->json(['message' => 'failed']);
        }
    }

}
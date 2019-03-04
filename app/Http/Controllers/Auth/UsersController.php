<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
Use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Collection;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $userRs = array('userrole' => DB::table('userrole')->get());
        $userSs = array('userstatus' => DB::table('userstatus')->get());
        $userDs = array('department' => DB::table('department')->get());

        // return view('users.userindex')->with('users', $user);
        return view('pages.dashboard.users')->with('userRs', $userRs)->with('userSs', $userSs)->with('userDs', $userDs)->with('users', $user);
    }

    public function getUsers(){
        $users = User::with('f_userrole',
        'f_userstatus',
        'f_department')->get();
        
         return json_encode($users);
    }

   
        public function getSpecificUserInfo(Request $request){
        $user = User::with('f_userrole',
        'f_userstatus',
        'f_department')->where('userID', $request->id)->first();
        
         return json_encode($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected function validateEmailPhoneNumber(Request $request){
            if(!empty($request->email)){
                $check_email = User::where('email', $request->email)->first();
                $data['email'] = (empty($check_email)) ? 1 : 0;
            }
            else{
                $data['email'] = 0;
            }
            if(!empty($request->phoneNumber)){
                $checkPhoneNumber = User::where('phoneNumber', $request->phoneNumber)->first();
                $data['phoneNumber'] =  (empty($checkPhoneNumber)) ? 1 : 0;
            }
            else{
                $data['phoneNumber'] = 0;
            }
            if(!empty($request->IDnumber)){
                $checkIDnumber = User::where('IDnumber', $request->IDnumber)->first();
                $data['IDnumber'] =  (empty($checkIDnumber)) ? 1 : 0;
            }
            else{
                $data['phoneNumber'] = 0;
            }

            // $data['password'] = ($request->password == $request->password_confirmation) ? 1 : 0;
            print_r(json_encode($data));

    }

    public function generatePassword(){
        $plength = 4;
        $password = substr(str_shuffle(str_repeat($x='abcdefghijklmnopqrstuvwxyz', ceil($plength/strlen($x)) )),1,$plength);
        $plength = 3;
        $password .= substr(str_shuffle(str_repeat($x='0123456789', ceil($plength/strlen($x)) )),1,$plength);

       return json_encode($password);

    }

    public function create()
    {
        $userRs = array('userrole' => DB::table('userrole')->get());
        $userSs = array('userstatus' => DB::table('userstatus')->get());
        $userDs = array('department' => DB::table('department')->get());

        return view('users.adduser')->with('userRs', $userRs)->with('userSs', $userSs)->with('userDs', $userDs);
       //  return view('users.adduser')->with($userRs)->with($userSs)->with($userDs);

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
           //  'userRoleID' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'password' => 'required',
            'phoneNumber' => 'required',
            'email' => 'required'
            //    'cover_image' => 'image|nullable|max:1999'
        ]);
        // Create post
        $user = new User;
        $user->userRoleID = $request->input('userrole');
        $user->firstName = $request->input('firstName');
        $user->lastName = $request->input('lastName');
        $user->userStatusID = 1;
        $password = $request->input('password');
        $user->password = Hash::make($password);
        //$user->Password = bcrypt(request('Password'));
        //$user->Password = $request->Hash(['password']);
        $user->areaCode = $request->input('areaCode');
        $user->phoneNumber = $request->input('phoneNumber');
        $user->email = $request->input('email');
        $user->apiToken = str_random(60);
        $user->departmentID = $request->input('department');
        $user->IDnumber = $request->input('IDnumber');
        $user->fcmtoken = str_random(60);
        $user->userStatusID = $request->input('userStatus');
        //  $venue->place = auth()->user()->id;
        //  $venue->cover_image = $fileNameToStore;
        $user->save();

        // return redirect('/users/create')->with('success', 'User Profile Added');
        return response()->json(['message' => 'Account Successfully Added.', 'success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.showuser')->with('users', $user);
    }
    



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $userRs = array('userrole' => DB::table('userrole')->get());
        $userSs = array('userstatus' => DB::table('userstatus')->get());
        $userDs = array('department' => DB::table('department')->get());
        return view('users.edituser')->with('user', $user)->with('userRs', $userRs)->with('userSs', $userSs)->with('userDs', $userDs);
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
             // 'userRoleID' => 'required',
            'firstName' => 'required',
            'LastName' => 'required',
//            'password' => 'required',
//            'phoneNumber' => 'required',
            'email' => 'required'
            //    'cover_image' => 'image|nullable|max:1999'
        ]);
        //update
        $user = new User;
        $user->userRoleID = $request->input('userrole');
        $user->firstName = $request->input('firstName');
        $user->LastName = $request->input('LastName');
        $user->userStatusID = $request->input('userstatus');
        $password = $request->input('password');
        $user->password = Hash::make($password);
        //$user->password = Hash::make($user['password']);
        //$user->Password = bcrypt(request('Password'));
        //$user->Password = $request->Hash(['password']);
        $user->phoneNumber = $request->input('phoneNumber');
        $user->email = $request->input('email');
        $user->apiToken =  str_random(60);
        $user->departmentID = $request->input('department');
        $user->IDnumber = $request->input('IDnumber');
        $user->save();

        return redirect('/users/{id}/edit')->with('success', 'User Profile Updated');


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

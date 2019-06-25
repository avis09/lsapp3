<?php

namespace App\Http\Controllers\Auth;

use App\Audittrails;
use App\Http\Controllers\Controller;
use App\User;
use App\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

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
        $userSs = array('userstatus' => DB::table('userstatus')->where('userStatusID', '!=', 3)->get());
        $userDs = array('department' => DB::table('department')->get());

        // return view('users.userindex')->with('users', $user);
        return view('pages.itd.users')->with('userRs', $userRs)->with('userSs', $userSs)->with('userDs', $userDs)->with('users', $user);
    }

    public function getUsers()
    {
        $users = User::with('f_userrole',
            'f_userstatus',
            'f_department')->where('userStatusID', '!=', '3')->get();

        return json_encode($users);
    }

    public function showArchiveUsersPage()
    {
        return view('pages.itd.reports-archiveusers');
    }

    public function getArchiveUsers()
    {
        $users = User::with('f_userrole',
            'f_userstatus',
            'f_department')->where('userStatusID', '3')->get();

        return json_encode($users);
    }

    public function getSpecificUserInfo(Request $request)
    {
        $user = User::with('f_userrole',
            'f_userstatus',
            'f_department')->where('userID', $request->id)->first();

        print_r(json_encode($user));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected function validateEmailPhoneNumber(Request $request)
    {
        if (!empty($request->email)) {
            $check_email = User::where('email', $request->email)->first();
            $data['email'] = (empty($check_email)) ? 1 : 0;
        } else {
            $data['email'] = 0;
        }
        if (!empty($request->phoneNumber)) {
            $checkPhoneNumber = User::where('phoneNumber', $request->phoneNumber)->first();
            $data['phoneNumber'] = (empty($checkPhoneNumber)) ? 1 : 0;
        } else {
            $data['phoneNumber'] = 0;
        }
        if (!empty($request->IDnumber)) {
            $checkIDnumber = User::where('IDnumber', $request->IDnumber)->first();
            $data['IDnumber'] = (empty($checkIDnumber)) ? 1 : 0;
        } else {
            $data['phoneNumber'] = 0;
        }

        // $data['password'] = ($request->password == $request->password_confirmation) ? 1 : 0;
        print_r(json_encode($data));

    }

    protected function validateUpdateEmailPhoneNumber(Request $request)
    {
        if (!empty($request->email)) {
            $check_email = User::where('email', $request->email)->where('userID', '!=', $request->userID)->first();
            $data['email'] = (empty($check_email)) ? 1 : 0;
        } else {
            $data['email'] = 0;
        }
        if (!empty($request->phoneNumber)) {
            $checkPhoneNumber = User::where('phoneNumber', $request->phoneNumber)->where('userID', '!=', $request->userID)->first();
            $data['phoneNumber'] = (empty($checkPhoneNumber)) ? 1 : 0;
        } else {
            $data['phoneNumber'] = 0;
        }
        if (!empty($request->IDnumber)) {
            $checkIDnumber = User::where('IDnumber', $request->IDnumber)->where('userID', '!=', $request->userID)->first();
            $data['IDnumber'] = (empty($checkIDnumber)) ? 1 : 0;
        } else {
            $data['phoneNumber'] = 0;
        }

        // $data['password'] = ($request->password == $request->password_confirmation) ? 1 : 0;
        print_r(json_encode($data));

    }

    public function generatePassword()
    {
        $plength = 4;
        $password = substr(str_shuffle(str_repeat($x = 'abcdefghijklmnopqrstuvwxyz', ceil($plength / strlen($x)))), 1, $plength);
        $plength = 3;
        $password .= substr(str_shuffle(str_repeat($x = '0123456789', ceil($plength / strlen($x)))), 1, $plength);

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
            'email' => 'required',
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
        $user->phoneNumber = '63' . $request->input('phoneNumber');
        $user->email = $request->input('email');
        $user->apiToken = str_random(60);
        $user->departmentID = $request->input('department');
        $user->IDnumber = $request->input('IDnumber');
        $user->fcmtoken = str_random(60);
        $user->userStatusID = $request->input('userStatus');
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
        //  $venue->place = auth()->user()->id;
        //  $venue->cover_image = $fileNameToStore;

        if ($user->save()) {
            $new_user = User::find($user->userID);
            $role = UserRole::find($new_user->userRoleID);
            Audittrails::create(['userID' => Auth::user()->userID, 'activity' => 'Added new ' . $role->roleType . ' user [name: ' . $new_user->firstName . ' ' . $new_user->lastName . ']']);
        }

        // return redirect('/users/create')->with('success', 'User Profile Added');
        return response()->json(['message' => 'Account Successfully Added.', 'success' => true,
            'userStatusID' => $request->input('userStatus')]);
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

    public function edit($id)
    {
        $user = User::find($id);
        $userRs = array('userrole' => DB::table('userrole')->get());
        $userSs = array('userstatus' => DB::table('userstatus')->get());
        $userDs = array('department' => DB::table('department')->get());
        return view('users.edituser')->with('user', $user)->with('userRs', $userRs)->with('userSs', $userSs)->with('userDs', $userDs);
    }

    public function UpdatePassword(Request $request)
    {
        $user = User::find(auth()->user()->userID);
        $old = $user->toJson();
        $field = array();
        $message = '';
        if ($request->new_password === $request->confirm_password && Hash::check($request->current_password, $user->password)) {
            if (Hash::check($request->new_password, $user->password)) {
                $status = false;
                $result = "error";
                $message = "New password cannot be the same as your current password.";
            } else {
                $user->password = Hash::make($request->new_password);

                if ($user->save()) {
                    Audittrails::create(['userID' => auth()->user()->userID, 'activity' => 
                    'Changed Password']);

                }
                
                $status = true;
                $result = "success";
                $message = "You have successfully updated your password.";
            }
        } else {
            $status = false;
            $result = "error";
            if (!Hash::check($request->current_password, $user->password)) {
                $message = "Incorrect Password";
                $field[] = array('field' => 'current_password', 'message' => $message);
            }
            if ($request->new_password != $request->confirm_password) {
                $message = "New Password does not match";
                $field[] = array('field' => 'confirm_password', 'message' => $message);
            }
        }

        $response = array(
            "success" => $status,
            "result" => $result,
            "message" => $message,
            "field" => $field,
        );

        return response($response)->header('Content-Type', 'application/json');
    }

    public function updateUser(Request $request)
    {
        $this->validate($request, [
            'userrole' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'phoneNumber' => 'required',
            'email' => 'required',
            //    'cover_image' => 'image|nullable|max:1999'
        ]);
        //update
        $user = User::find($request->userID);
        $user->userRoleID = $request->input('userrole');
        $user->firstName = $request->input('firstName');
        $user->lastName = $request->input('lastName');
        $user->phoneNumber = '63' . $request->input('phoneNumber');
        $user->email = $request->input('email');
        //$user->password = Hash::make($user['password']);
        // $user->apiToken =  str_random(60);
        $user->departmentID = $request->input('department');
        $user->IDnumber = $request->input('IDnumber');
        $user->userStatusID = $request->input('userStatus');
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
        if ($user->save()) {
            $current_user = User::find($request->userID);
            $role = UserRole::find($current_user->userRoleID);
            Audittrails::create(['userID' => Auth::user()->userID, 'activity' => 'Updated ' . $role->roleType . ' user [name: ' . $current_user->firstName . ' ' . $current_user->lastName . ']']);
        }

        // return redirect('/users/{id}/edit')->with('success', 'User Profile Updated');
        return response()->json(['message' => 'Account Successfully Updated.', 'success' => true]);
    }

    public function showProfile()
    {
        $userInfo = User::find(auth()->user()->userID);

        $userInfo->phoneNumber = str_replace("63", "", $userInfo->phoneNumber);
        return view('pages.profile', compact('userInfo'));

    }

    public function updateProfile(Request $request)
    {
        $user = User::find(auth()->user()->userID);
        $user->phoneNumber = "63" . $request->input('phoneNumber');
        if ($user->save()) {
            Audittrails::create(['userID' => auth()->user()->userID, 
            'activity' => 'Updated Profile']);

        }

        return response()->json(['message' => 'updated profile!', 'success' => true]);
    }

    public function archiveUser(Request $request)
    {
        $user = User::find($request->id);
        $user->userStatusID = 3;
        $user->updated_at = Carbon::now();
        if ($user->save()) {
            $current_user = User::find($request->id);
            $role = UserRole::find($current_user->userRoleID);
            Audittrails::create(['userID' => Auth::user()->userID, 'activity' => 'Archived ' . $role->roleType . ' user [name: ' . $current_user->firstName . ' ' . $current_user->lastName . ']']);
            return response()->json(['title' => 'Archived', 'content' => 'User Successfully Archived.', 'type' => 'success', 'success' => true]);
        } else {
            return response()->json(['title' => 'Error', 'content' => 'Something went wrong.', 'success' => false]);
        }
    }

    public function showResetPasswordPage($slug)
    {
        $user = User::where('IDnumber', $slug)->first();
        if (!empty($user)) {
            return view('pages.reset-password', compact('user', 'slug'));
        } else {

        }
    }

    public function resetPassword(Request $request)
    {
        $new_password = $request->new_password;
        $confirm_password = $request->confirm_password;
        if ($new_password == $confirm_password) {
            $user = User::where('IDnumber', $request->id)->update(['password' => Hash::make($confirm_password), 'updated_at' => Carbon::now()]);
            if ($user) {
                return response()->json(['success' => true, 'title' => 'Success', 'type' => 'success', 'message' => 'Password Successfully Updated.']);
            }
        } else {
            return response()->json(['success' => false, 'title' => 'Error', 'type' => 'error', 'message' => 'Password does not match.']);
        }
    }
}

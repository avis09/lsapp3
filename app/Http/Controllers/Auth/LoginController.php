<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Audittrails;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Login1Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    protected $redirectTo = '/schedules';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        // return view('auth.viewlogin');
        return view('login');
    }

    public function login(Request $request)
    {
        $attempt = Auth::attempt(['IDnumber' => $request->IDnumber, 'password' => $request->password],  false);
        // 'userStatusID' => 1
        if ($attempt) {

            $user = Auth::user();
//            Auth::user();
//            email::where('IDnumber', $request->IDnumber)->first();
//            return redirect()->route('schedules.create');
            // $log = new LogTime();
            // $log->userID = $user->userID;
            // $log->activity = 'Logged in';
            // $log->save();

            Audittrails::create(['userID' => Auth::user()->userID, 'activity' => 'Logged in']);
            if(auth()->user()->userStatusID == 2 || auth()->user()->userStatusID == 3) {
                        auth()->logout();
                        return back()->withErrors(['errorMessage' => 'Your account has been deactivated.']);
             }
             else{
                    if($user->userRoleID == 1) {
                //          dd(auth::user());
                        return redirect('student/schedules/list');
                    }
                    elseif ($user->userRoleID == 2){
                        return redirect('gasd/dashboard');
                    }
                    elseif ($user->userRoleID == 3) {
                        return redirect('/registrar/dashboard');
                    }
                    elseif ($user->userRoleID == 4) {
                        return redirect('itd/users/index');
                     }
            } 

            Session::save();
        }
        else {

            // return redirect()->route('login');
            return back()->withErrors(['errorMessage' => 'Invalid username or password.']);
        }
    }

    public function logout(Request $request)
    {
        // LogTime::where('userID', Auth::user()->userID)->update(['outTime' => Carbon::now()->setTimezone('Asia/Manila')]);
        Audittrails::create(['userID' => Auth::user()->userID, 'activity' => 'Logged out']);
        Auth::logout();
        $request->session()->flush();
//        $request->session()->regenerate();
        return redirect()->route('login');
    }


}

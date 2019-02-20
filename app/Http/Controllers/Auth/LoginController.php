<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\LogTime;
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
        return view('auth.viewlogin');
    }

    public function login(Request $request)
    {
        $attempt = Auth::attempt(['IDnumber' => $request->IDnumber, 'password' => $request->password], false);
        if ($attempt) {

            $user = Auth::user();
//            Auth::user();
//            email::where('IDnumber', $request->IDnumber)->first();
//            return redirect()->route('schedules.create');
            $log = new LogTime();
            $log->userID = $user->userID;
            $log->inTime = Carbon::now()->setTimezone('Asia/Manila');
            $log->save();

            if($user->userRoleID == 1) {
        //          dd(auth::user());
                return redirect('student/schedules/index');
            }elseif ($user->userRoleID == 2){
                return redirect('gasd/venues/index2');
            }elseif ($user->userRoleID == 3) {
                return redirect('registrar/venues/index');
            }elseif ($user->userRoleID == 4) {
                return redirect('itd/users/index');
            }

            Session::save();
        }
        else {
            return redirect()->route('login');
        }
    }

    public function logout(Request $request)
    {
        $log = LogTime::where('userID', Auth::user()->userID)->first();
        $log->outTime = Carbon::now()->setTimezone('Asia/Manila');
        $log->save();

        Auth::logout();
        $request->session()->flush();
//        $request->session()->regenerate();
        return redirect()->route('login');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */

}

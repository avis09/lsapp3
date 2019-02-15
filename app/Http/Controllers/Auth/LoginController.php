<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
//            Auth::user();
//            email::where('IDnumber', $request->IDnumber)->first();

            Session::save();
//            return redirect()->route('schedules.create');
            if(auth::user()->userRoleID == 1) {
                return redirect()->route('schedules.create');
            }elseif (auth::user()->userRoleID == 2){
                return redirect()->route('venues.create');
            }elseif (auth::user()->userRoleID == 3) {
                return redirect()->route('venues.index');
            }elseif (auth::user()->userRoleID == 4) {
                return redirect()->route('users.create');
            }
        }
        else {
            return redirect()->route('login');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('login');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */

}

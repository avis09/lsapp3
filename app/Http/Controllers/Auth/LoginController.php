<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Login1Controller;

class LoginController extends Controller
{
//    protected $redirectTo = '/schedules';
//
//    public function __construct()
//    {
//        $this->middleware('guest')->except('logout');
//    }
//
//    public function viewlogin()
//    {
//        return view('login');
//    }
//    public function login(Request $request)
//    {
//        if (Auth::attempt(['email' => $request->email, 'Password' => $request->Password])) {
////            Auth::user();
////            email::where('IDnumber', $request->IDnumber)->first();
//
//            Session::save();
//
//            return redirect()->route('schedules');
//        }
////        } else {
////            return redirect()->route('login');
////        }
//    }
//    public function logout(Request $request)
//    {
//        Auth::logout();
//        $request->session()->flush();
//        $request->session()->regenerate();
//        return redirect()->route('schedules');
//    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */

}

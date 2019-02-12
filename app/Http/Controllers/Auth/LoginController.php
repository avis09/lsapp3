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
        $attempt = Auth::attempt(['email' => $request->email, 'password' => $request->password], false);
        if ($attempt) {
//            Auth::user();
//            email::where('IDnumber', $request->IDnumber)->first();

            Session::save();
            return redirect()->route('schedules.create');
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

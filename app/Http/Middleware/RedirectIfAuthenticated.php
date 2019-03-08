<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if (Auth::guard($guard)->check()) {

            if(auth()->user()->userRoleID == 1) {
                return redirect('student/schedules/list');
            }elseif (auth()->user()->userRoleID == 2){
                return redirect('gasd/venues/index2');
            }elseif (auth()->user()->userRoleID == 3) {
                return redirect('registrar/venues/index');
            }elseif (auth()->user()->userRoleID == 4) {
                return redirect('itd/users/index');
            }
            else 
            {
                auth()->logout();
                return back();
            }


        }
        return $next($request);

        // if (Auth::guard($guard)->check()) {
        //     return redirect('venues');
        // }

        // return $next($request);
    }
}

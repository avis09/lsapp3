<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 13/02/2019
 * Time: 3:38 PM
 */

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;

class ITD
{
    public function handle($request, Closure $next)
    {
        if (!Auth::user()) {
            return redirect('login');
        } else if (Auth::user()->userRoleID != 4) {
            return redirect('home');
        }
        //
        return $next($request);
    }
}
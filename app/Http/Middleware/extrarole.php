<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 18/02/2019
 * Time: 4:22 PM
 */

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;

class extrarole
{
    public function handle($request, Closure $next)
    {
        if (!Auth::user()) {
            return redirect('login');
        } else if (Auth::user()->userRoleID != 5) {
            return redirect('home');
        }
        //
        return $next($request);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 13/02/2019
 * Time: 3:39 PM
 */

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;

class Registrar
{
    public function handle($request, Closure $next)
    {
        if (!Auth::user()) {
            return redirect('login');
        } else if (Auth::user()->userRoleID != 3) {
            return redirect('/error404');
        }
        //next
        return $next($request);
    }
}
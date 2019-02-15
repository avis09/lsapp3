<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 13/02/2019
 * Time: 3:38 PM
 */

namespace App\Http\Middleware;


use Illuminate\Support\Facades\Auth;
use Closure;

class Student
{
    public function handle($request, Closure $next)
    {
        if(!Auth::user()){
            return redirect('login');
        }else{
            if(Auth::user()->userRoleID != 1){}
            //

            return redirect('/welcome');
    }
    }
}
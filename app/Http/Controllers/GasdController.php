<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GasdController extends Controller
{
    public function showDashboard(){
        return view('pages.registrar.dashboard');
    }
}

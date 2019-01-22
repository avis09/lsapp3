<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BroshomeController extends Controller
{
    public function index() {
        $title = 'Welcome To Bros';
        //return view('pages.index', compact('title'));
        return view('pages.index')->with('title', $title);
    }
}
